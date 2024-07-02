<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
use App\Models\Application;

class SyncServiceLeadsGenesys
{
    const CONTACT_LIST_ID = "7795460a-be68-4739-97ed-af1d4f18f1b0";
    const AUTH_URL = "https://login.mypurecloud.ie/oauth/token";
    const CONTACT_SYNC_URL = "https://api.mypurecloud.ie/api/v2/outbound/contactlists/";
    const CLIENT_ID = "480c9bdc-e6d2-4854-9408-73241f7eab7b";
    const CLIENT_SECRET = "YL5JxGKVdhHkMmmqfajXGMT4kvO_vTyRZy8WSuGvAtY";

    private $token;
    private $syncd_ids = [];

    public function __construct()
    {
        $this->token = $this->readToken();
    }

    public function getToken()
    {
        return $this->token;
    }

    public function readToken()
    {
        return Storage::exists('app/syncServiceLeadsGenesys/token.json')
               ? Storage::get('app/syncServiceLeadsGenesys/token.json')
               : null;
    }

    public function authorize()
    {
        $response = Http::asForm()->withHeaders([
            'Authorization' => 'Basic ' . base64_encode(self::CLIENT_ID . ':' . self::CLIENT_SECRET),
        ])->post(self::AUTH_URL, [
            'grant_type' => 'client_credentials'
        ]);

        $responseData = $response->json();

        if (isset($responseData['access_token'])) {
            Storage::put('app/syncServiceLeadsGenesys/token.json', $responseData['access_token']);
            $this->token = $responseData['access_token'];
        } else {
            Storage::append('app/syncServiceLeadsGenesys/issues.log', json_encode($responseData));
        }
    }

    public function syncApplications()
    {
        if (empty($this->token)) {
            $this->authorize();
        }

        $contactsData = $this->getUnsyncedApplicationsArr();

        if (count($contactsData) === 0) {
            Storage::append('app/syncServiceLeadsGenesys/issues.log', 'Everything is synced.');
            return;
        }

        $response = Http::withToken($this->token)->post(self::CONTACT_SYNC_URL . self::CONTACT_LIST_ID . '/contacts', $contactsData);

        $responseData = $response->json();

        if ($response->status() == 401) {
            $this->authorize();
        } elseif ($response->status() == 400) {
            Storage::append('app/syncServiceLeadsGenesys/issues.log', json_encode($responseData));
        } else {
            Application::whereIn('dummy_applicationid', $this->syncd_ids)->update(['sync_genesys' => 1]);
            Storage::append('app/syncServiceLeadsGenesys/issues.log', json_encode($responseData));
        }
    }

    public function getUnsyncedApplicationsArr()
    {
        $returnArr = [];
        $dbData = $this->getDbData();

        if (count($dbData) > 0) {
            foreach ($dbData as $application) {
                $contact = [];
                $this->syncd_ids[] = $application->dummy_applicationid;
                $contact['id'] = $application->dummy_applicationid;
                $contact['contactListId'] = self::CONTACT_LIST_ID;
                $contact['data'] = [
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
                    'Contact Comments'   => '',
                    'Interested?'        => '',
                    'Salesman comments'  => '',
                    'Schedule callback'  => '',
                    'Appointment date'   => '',
                    'TimeZone'           => date('Y-m-d')
                ];
                $contact['callable'] = true;
                $contact['phoneNumberStatus'] = new \stdClass();
                $returnArr[] = $contact;
            }
        }

        return $returnArr;
    }

    public function getDbData()
    {
        return Application::where('sync_genesys', 0)
            ->where(function ($query) {
                $query->where('type', 'special_offers')
                      ->orWhere('type', 'online_service_booking')
                      ->orWhere('type', 'service_offers')
                      ->orWhere(function ($query) {
                          $query->where('type', 'contact_us')
                                ->where('department', 'after_sales');
                      });
            })
            ->limit(50)
            ->get();
    }
}
