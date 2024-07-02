<?php

namespace App\Services;

use App\Models\Application;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;

class SyncGenesysService
{
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
        $response = Http::asForm()->withHeaders([
            'Authorization' => 'Basic ' . base64_encode(self::CLIENT_ID . ':' . self::CLIENT_SECRET),
        ])->post(self::AUTH_URL, [
            'grant_type' => 'client_credentials',
        ]);

        $response_decoded = $response->json();

        if (isset($response_decoded['access_token'])) {
            Storage::put('app/syncGenesysService/token.json', $response_decoded['access_token']);
            $this->setToken($response_decoded['access_token']);
        } else {
            Storage::append('app/syncGenesysService/issues.log', $response->body());
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

        $response = Http::withToken($token)
            ->post(self::CONTACT_SYNC_URL . self::CONTACT_LIST_ID . '/contacts', $contacts_data);

        $response_decoded = $response->json();

        if (isset($response_decoded['status']) && $response_decoded['status'] == 401) {
            $this->authorize();
            $this->syncApplications();  // Retry after authorization
        } elseif (isset($response_decoded['status']) && $response_decoded['status'] == 400) {
            Storage::append('app/syncGenesysService/issues.log', $response->body());
        } else {
            Application::whereIn('id', $this->syncd_ids)
                ->update(['sync_genesys' => 1]);
            Storage::append('app/syncGenesysService/issues.log', $response->body());
        }
    }

    public function getUnsyncedApplicationsArr()
    {
        $return_arr = [];
        $db_data = $this->getDbData();
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
                    'Salesman comments' => '',
                    'Schedule callback' => '',
                    'Appointment date' => '',
                    'TimeZone' => 'Asia/Riyadh',
                ],
                'callable' => true,
                'phoneNumberStatus' => new \stdClass(),
            ];
            $return_arr[] = $contact;
        }
        return $return_arr;
    }

    public function getDbData()
    {
        return Application::where('sync_genesys', 0)
            ->limit(50)
            ->get();
    }
}
