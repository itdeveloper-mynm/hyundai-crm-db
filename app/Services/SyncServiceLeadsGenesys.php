<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
use App\Models\Application;
use Illuminate\Support\Facades\Log;

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

    public function setToken($token)
	{
		return $this->token = $token;
	}

    public function readToken()
    {
        return Storage::exists('app/syncServiceLeadsGenesys/token.json')
               ? Storage::get('app/syncServiceLeadsGenesys/token.json')
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
            Storage::put('app/syncServiceLeadsGenesys/token.json', $response_decoded['access_token']);
            $this->setToken($response_decoded['access_token']);
        } else {
            Log::info("syncServiceLeadsGenesys authorize");
            Log::info($response);
        }

    }

    public function syncApplications()
    {
        $token = $this->getToken();
		if(empty($token)) {
			$this->authorize();
		}

        $contactsData = $this->getUnsyncedApplicationsArr();
        // dd($contactsData);

        if (count($contactsData) === 0) {
            Log::info("Everything is synced.");
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
		  CURLOPT_POSTFIELDS =>json_encode($contactsData),
		  CURLOPT_HTTPHEADER => array(
		    "Authorization: Bearer ".$token,
		    "Content-Type: application/json"
		  ),
		));

		$response = curl_exec($curl);

		curl_close($curl);

		$response_decoded = json_decode($response,true);
        Log::info("SyncServiceLeadsGenesys syncApplications");
        Log::info($response_decoded);


        if (isset($response_decoded['status']) && $response_decoded['status'] == 401) {
            $this->authorize();
        } elseif (isset($response_decoded['status']) && $response_decoded['status'] == 400) {
        } else {
            Application::whereIn('id', $this->syncd_ids)->update(['sync_genesys' => 1]);
            // Log::info($response);
        }

    }

    public function getUnsyncedApplicationsArr()
    {
        $returnArr = [];
        $dbData = $this->getDbData();

        if (count($dbData) > 0) {
            foreach ($dbData as $application) {
                $contact = [];
                $this->syncd_ids[] = $application->id;
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
