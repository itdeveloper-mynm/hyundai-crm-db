<?php

namespace App\Services;

use App\Models\Application;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use App\Models\AutolineApiToken;

class AutoLineService
{
    protected $accesstokenUrl;
    protected $saleLeadUrl;

    public function __construct()
    {
        // for stage test
        // $this->accesstokenUrl = 'https://api.eu-stage.keyloop.io/oauth/client_credential/accesstoken?grant_type=client_credentials'; // Store API URL in config/services.php
        //$this->saleLeadUrl = 'https://api.eu-stage.keyloop.io/partner/33531/97100005-H-0147T/v1/sales-lead'; // Store API URL in config/services.php

        // for live
        $this->accesstokenUrl = 'https://api.eu.keyloop.io/oauth/client_credential/accesstoken?grant_type=client_credentials'; // Store API URL in config/services.php
        $this->saleLeadUrl = 'https://api.eu.keyloop.io/partner/33475/97100005-H-0135L/v1/sales-lead'; // Store API URL in config/services.php
    }

    /**
     * Get a valid token from the database or request a new one.
     */
    public function getValidToken()
    {
        $apiToken = AutolineApiToken::latest()->first();

        if ($apiToken && $apiToken->isValid()) {
            return $apiToken->token;
        }

        return $this->getNewToken();
    }

    /**
     * Request a new token from the third-party API and store it.
     */
    public function getNewToken()
    {
        // $url = $this->accesstokenUrl . 'oauth/client_credential/accesstoken?grant_type=client_credentials';
        $url = $this->accesstokenUrl;

        $postData = [
            //'client_id' => "mGdfiijbinsHDoqNfF159PaoOwCYff3k", // for test
            //'client_secret' => "TOt5lIEGQM2Y81zt", // for test
            'client_id' => "caKu4tPUzkQdhPZFF8jAoMOXcrizH2fq", // for live
            'client_secret' => "OzUCSGfkY6Rhid6GbbuXgeF3iFtZDBNE06JA_2vjum6eqBD3ZjwItpjK-MSyMx1E", // for live
            'grant_type' => 'client_credentials',
        ];

        $response = $this->makeCurlRequest($url, 'POST', $postData);

        if ($response && isset($response['access_token'])) {
            $expiresInSeconds = (int) $response['expires_in']; // Convert to integer
            // Store the new token in the database
            $token = AutolineApiToken::create([
                'token' => $response['access_token'],
                'expires_at' => now()->addSeconds($expiresInSeconds),
            ]);

            return $token->token;
        }

        throw new \Exception('Failed to retrieve API token');
    }

    /**
     * Call third-party API with a valid token.
     */
    public function callApi($row, $retry = true)
    {
        $data = $this->createLead($row);
        $token = $this->getValidToken();
        $url = $this->saleLeadUrl;


        Log::channel('auto_line')->info("postdata for id " .$row->id);
        Log::channel('auto_line')->info($data);

        $response = $this->makeCurlRequest($url, 'POST', $data, $token);

        Log::channel('auto_line')->info("api response");
        Log::channel('auto_line')->info($response);

        // Check if response contains "Invalid Access Token" error
        if ($response && isset($response['fault']) && isset($response['fault']['faultstring'])) {
            if ($response['fault']['faultstring'] === "Invalid Access Token" && $retry) {
                // Fetch a new token and retry the request once
                $newToken = $this->getNewToken();
                return $this->callApi($row, false);
            }
        }

        // Check if leadId exists in the response
        if ($response && isset($response['leadId'])) {
            $row->update(['lead_id' => $response['leadId']]);
            return [
                'status' => 'success',
                'message' => 'Lead ID found successfully',
                'leadId' => $response['leadId']
            ];
        }

        return $response ?? ['status'=> 'error' ,'message' => 'API request failed'];
    }

    /**
     * Make a cURL request
     */
    private function makeCurlRequest($url, $method, $data = [], $token = null)
    {
        $ch = curl_init();

        $headers = [
            'Content-Type: application/json',
        ];

        if ($token) {
            $headers[] = 'Authorization: Bearer ' . $token;
        }

        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

        if ($method === 'POST') {
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
        } elseif ($method === 'PUT') {
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'PUT');
            curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
        } elseif ($method === 'DELETE') {
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'DELETE');
        }

        $response = curl_exec($ch);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);

        if ($httpCode === 200) {
            return json_decode($response, true);
        }

        return null;
    }

    private function createLead($row)
    {
        $application_name = 'HydDashboard';
        $leadData = [
            "leadSourceCode" => "GENERAL_SALES_INQUIRY",
            "leadRequestType" => [
                "requestType" => "SALES_INQUIRY",
                "description" => "Request for vehicle sales inquiry."
            ],
            "appointmentDateTime" => currdateTime(),
            "submissionDate" => currdateTime(),
            "displayName" =>$row->customer->full_name ?? "",
            "externalReference" => [
                "provider" => "DummyProvider",
                "application" => "Keyloop-ZA-T",
                "id" => $application_name,
                "url" => "http://leadmanagement.DummyProvider.com/6e5b8bd0-8867-446c-a3a8-8ade9f7a07a0"
            ],
            "leadReferenceData" => [
                // "externalCampaignId" => "0320", // is ki jaga sheet sy data aya ga
                "externalCampaignId" => $row->branch->cc_code ?? 'h100', // is ki jaga sheet sy data aya ga
                "externalDealerId" => "44014796-B"
            ],
            "source" => "WEBSITE",
            "contact" => [
                "contactDetails" => [
                    "customerId" => "",
                    "names" => [
                        "familyName" => $row->customer->full_name ?? "",
                        "familyName2" => "",
                        "middleName" => "",
                        "givenName" => $row->customer->full_name ?? "",
                        "preferredName" => $row->customer->full_name ?? "",
                        "initials" => "",
                        "salutation" => $row->customer->full_name ?? "",
                        "titleCommon" => "Mr.",
                    ],
                    "addresses" => [
                        "home" => [
                            "physicalAddress" => [
                                "streetType" => "",
                                "streetName" => "",
                                "houseNumber" => "",
                                "buildingName" => "",
                                "floorNumber" => "",
                                "doorNumber" => "",
                                "blockName" => "",
                                "estate" => "",
                                "postalCode" => "",
                                "suburb" => "",
                                "city" => $row->city->name ?? "",
                                "county" => "",
                                "province" => "",
                                "countryCode" => "SA"
                            ],
                            "postalAddress" => [
                                "poBoxName" => "",
                                "poBoxNumber" => "12",
                                "poBoxSuite" => "",
                                "postalCode" => "",
                                "suburb" => "",
                                "city" => $row->city->name ?? "",
                                "county" => "",
                                "province" => "",
                                "countryCode" => "SA"
                            ]
                        ]
                    ],
                    "communication" => [
                        "home" => [
                            "mobile" => $row->customer->mobile ?? "",
                            "landline" => "",
                            "fax" => "",
                            "email" => $row->customer->email ?? "",
                        ],
                        "work" => [
                            "mobile" => $row->customer->mobile ?? "",
                            "landline" => "",
                            "fax" => "",
                            "email" => $row->customer->email ?? "",
                        ]
                    ],
                    "externalReferences" => [
                        [
                            "provider" => "AVME Leads 2.0",
                            "application" => "LEADMANAGEMENT",
                            "id" => $application_name,
                            "url" => "http://leadmanagement.DummyProvider.com/6e5b8bd0-8867-446c-a3a8-8ade9f7a07a0"
                        ]
                    ]
                ],
                "privacy" => [
                    "privacyId" => "01-184",
                    "level" => "OEM",
                    "usage" => "PRIVATE",
                    "providerName" => "Dealer",
                    "description" => "Basic privacy statement",
                    "validFrom" => "2019-01-01T00:00:00.000Z",
                    "validUntil" => "2029-12-31T00:00:00.000Z",
                    "channel" => [
                        // "post" => "AGREED",
                        "post" => $row->read_accept == 1 ? "AGREED" : "DENIED",
                        "email" => "DENIED",
                        "phone" => "UNKNOWN",
                        "messaging" => "AGREED"
                    ]
                ]
            ],
            "interest" => [
                "budget" => [
                    "minimum" => 10000,
                    "maximum" => 20000
                ],
                "age" => [
                    "minimum" => 0,
                    "maximum" => 60
                ],
                "mileage" => [
                    "minimum" => [
                        "unit" => "KM",
                        "value" => 120000
                    ],
                    "maximum" => [
                        "unit" => "KM",
                        "value" => 120000
                    ]
                ],
                "fuelTypes" => ["DIESEL"],
                "class" => "CAR",
                "condition" => "NEW",
                "specifications" => [
                    [
                        "make" => [
                            "description" => "Hyundi",
                            "codes" => [
                                [
                                    "provider" => "AVME Leads 2.0",
                                    "application" => "LEADMANAGEMENT",
                                    "id" => $application_name
                                ]
                            ]
                        ],
                        "model" => [
                            "description" => $row->vehicle->name ?? "",
                            "codes" => [
                                [
                                    "provider" => "AVME Leads 2.0",
                                    "application" => "LEADMANAGEMENT",
                                    "id" => $application_name
                                ]
                            ]
                        ],
                        "variant" => [
                            "description" => "string",
                            "codes" => [
                                [
                                    "provider" => "AVME Leads 2.0",
                                    "application" => "LEADMANAGEMENT",
                                    "id" => $application_name,
                                    "url" => "http://leadmanagement.DummyProvider.com/6e5b8bd0-8867-446c-a3a8-8ade9f7a07a0"
                                ]
                            ]
                        ],
                    ]
                ],
                "vehiclesOfInterest" => [
                    [
                        "vehicleId" => "",
                        "description" =>  $row->vehicle->name ?? "",
                        "identification" => [
                            "vin" => "",
                            "chassis" => "",
                            "licensePlate" => "",
                            "engineNumber" => ""
                        ],
                        "externalReferences" => [
                            "provider" => "AVME Leads 2.0",
                            "application" => "LEADMANAGEMENT",
                            "id" => $application_name,
                            "url" => "http://leadmanagement.DummyProvider.com/6e5b8bd0-8867-446c-a3a8-8ade9f7a07a0"

                        ]
                    ]
                ],
            ],
            "notes" => [
                [
                    "title" => "Dealer City",
                    "details" => $row->city->name ?? "",
                ],
                [
                    "title" => "Dealer Branch",
                    "details" => $row->branch->name ?? "",
                ],
                [
                    "title" => "Purchase Plan",
                    "details" => $row->purchase_plan ?? "",
                ],
                [
                    "title" => "Monthly Salary",
                    "details" => $row->monthly_salary ?? "",
                ],
                [
                    "title" => "Customers Bank",
                    "details" => $row->customer->bank->name ?? "",
                ],
                [
                    "title" => "Source Name",
                    "details" => $row->source->name ?? "",
                ],
                [
                    "title" => "Campaign Name",
                    "details" => $row->campaign->name ?? "",
                ],
                [
                    "title" => "Preferred Appointment Time",
                    "details" => $row->preferred_appointment_time ?? "",
                ],
                [
                    "title" => "Category",
                    "details" => $row->category ?? "",
                ],
                [
                    "title" => "Sub Category",
                    "details" => $row->sub_category ?? "",
                ],
                [
                    "title" => "Kyc",
                    "details" => $row->kyc ?? "",
                ]
            ],
            "activity" => [
                "activityType" => [
                    "activityTypeCode" => "VEHICLE_SOLD",
                    "description" => "Activity indicating vehicle sale."
                ],
                "activityDateTime" => currdateTime(),
                "activityNote" => "Test consider vehicle note"
            ]
        ];

        // return response()->json($leadData);
        return $leadData;
    }

}
