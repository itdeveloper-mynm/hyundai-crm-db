<?php

namespace App\Services;

use App\Models\Application;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;

class SyncGenesysService
{
    // SyncSaleLeadsGenesys
    const CONTACT_LIST_ID = "767b9401-0061-4cf5-b7d1-0a6a129cbd20";
    const AUTH_URL = "https://login.mypurecloud.ie/oauth/token";
    const CONTACT_SYNC_URL = "https://api.mypurecloud.ie/api/v2/outbound/contactlists/";

    const CLIENT_ID = "480c9bdc-e6d2-4854-9408-73241f7eab7b";
    const CLIENT_SECRET = "YL5JxGKVdhHkMmmqfajXGMT4kvO_vTyRZy8WSuGvAtY";
    private $token;
    private $syncd_ids = [];

    public function __construct()
    {
        $this->setToken($this->readToken());
    }

    public function getToken()
    {
        return $this->token;
    }

    public function setToken($token)
    {
        $this->token = $token;
    }

    public function readToken()
    {
        return Storage::exists('app/syncGenesysService/token.json')
               ? Storage::get('app/syncGenesysService/token.json')
               : null;
    }

    public function authorize()
    {
		$curl = curl_init();

		curl_setopt_array($curl, array(
		  CURLOPT_URL => self::AUTH_URL,
		  CURLOPT_RETURNTRANSFER => true,
		  CURLOPT_ENCODING => "",
		  CURLOPT_MAXREDIRS => 10,
		  CURLOPT_TIMEOUT => 0,
		  CURLOPT_FOLLOWLOCATION => true,
		  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		  CURLOPT_CUSTOMREQUEST => "POST",
		  CURLOPT_POSTFIELDS => "grant_type=client_credentials",
		  CURLOPT_HTTPHEADER => array(
		    "Content-Type: application/x-www-form-urlencoded",
		    "Authorization: Basic ".base64_encode(self::CLIENT_ID.":".self::CLIENT_SECRET),
		    "Content-Type: application/x-www-form-urlencoded"
		  ),
		));

		$response = curl_exec($curl);

		curl_close($curl);

		$response_decoded = json_decode($response,true);

        if (isset($response_decoded['access_token'])) {
            Storage::put('app/syncGenesysService/token.json', $response_decoded['access_token']);
            $this->setToken($response_decoded['access_token']);
        } else {
            Log::channel('sync_service_log')->info("syncGenesysService");
            Log::channel('sync_service_log')->info($response);
        }
    }

    public function syncApplications()
    {
        $token = $this->getToken();
        if (empty($token)) {
            $this->authorize();
            $token = $this->getToken();
        }

        $contacts_data = $this->getUnsyncedApplicationsArr();
        if(count($contacts_data) === 0) {
            Log::channel('sync_service_log')->info("Everything is synced.");
            return;
        }

            $curl = curl_init();

            curl_setopt_array($curl, array(
            CURLOPT_URL => self::CONTACT_SYNC_URL.self::CONTACT_LIST_ID."/contacts",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS =>json_encode($contacts_data),
            CURLOPT_HTTPHEADER => array(
                "Authorization: Bearer ".$token,
                "Content-Type: application/json"
            ),
            ));

            $response = curl_exec($curl);

            curl_close($curl);

            $response_decoded = json_decode($response,true);
            Log::channel('sync_service_log')->info("SyncGenesysService syncApplications");
            Log::channel('sync_service_log')->info($response_decoded);

        if (isset($response_decoded['status']) && $response_decoded['status'] == 401) {
            $this->authorize();
            // Log::channel('sync_service_log')->info($response);
            // $this->syncApplications();  // Retry after authorization
        } elseif (isset($response_decoded['status']) && $response_decoded['status'] == 400) {
            // Log::channel('sync_service_log')->info($response);
        } else {
            Application::whereIn('id', $this->syncd_ids)
                ->update(['sync_genesys' => 1]);
            // Log::channel('sync_service_log')->info($response);
        }
    }

    public function getUnsyncedApplicationsArr()
    {
        $return_arr = [];
        $db_data = $this->getDbData();

        if(count($db_data) > 0 ){
            foreach ($db_data as $application) {
                $this->syncd_ids[] = $application->id;
                $contact = [
                    'id' => $application->id,
                    'contactListId' => self::CONTACT_LIST_ID,
                    'data' => [
                        'Campaign' => $application->campaign->name ?? "",
                        'Data Type' => $application->type,
                        'First Name' => $application->customer->first_name,
                        'Last Name' => $application->customer->last_name,
                        'Mobile' => $application->customer->mobile,
                        'Email' => $application->customer->email ?? "",
                        'Dealer City' => $application->city->name ?? "",
                        'Dealer Branch' => $application->branch->name ?? "",
                        'Preferred Time' => $application->preferred_appointment_time ?? "",
                        'Vehicle' => $application->vehicle->name ?? "",
                        'Purchase Plan' => $application->purchase_plan ?? "",
                        'Monthly Salary' => $application->monthly_salary ?? "",
                        'Bank' => $application->customer->bank->name ?? "",
                        'Source' => $application->source->name ?? "",
                        'Request Date' => $application->request_date,
                        'Contact Comments' => '',
                        'Interested?' => '',
                        'Salesman  comments' => '',
                        'Schedule callback' => '',
                        'Appointment date' => '',
                        // 'TimeZone' => 'Asia/Riyadh',
                        'TimeZone' => date("Y-m-d"),
                    ],
                    'callable' => true,
                    'phoneNumberStatus' => new \stdClass(),
                ];
                $return_arr[] = $contact;
            }
        }
        return $return_arr;
    }

    public function getDbData()
    {
        return Application::where('sync_genesys', 0)
            ->where('created_at', '>', now()->subDay()) // for new records
            ->where(function ($query) {
                $query->where('type', 'request_a_test_quote')
                      ->orWhere('type', 'request_a_test_drive')
                      ->orWhere('type', 'career')
                      ->orWhere('type', 'used_cars')
                      ->orWhere('type', 'request_a_brochure')
                      ->orWhere('type', 'request_a_quote')
                      ->orWhere('type', 'special_offers')
                      ->orWhere('type', 'leads')
                      ->orWhere('type', 'leads')
                      ->orWhere('type', 'events')
                      ->orWhere('type', 'employees_program')
                      ->orWhere(function ($query) {
                          $query->where('type', 'contact_us')
                                ->where('department', 'sales_maketing');
                      });
            })
            ->limit(50)
            ->get();
    }

    // public function getDbData()
    // {
    //     return Application::where('sync_genesys', 0)
    //         ->where('created_at', '>', now()->subDay()) // for new records
    //         ->limit(50)
    //         ->get();
    // }
}
