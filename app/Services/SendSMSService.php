<?php

namespace App\Services;

use App\Models\Application;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class SendSMSService
{
    private $syncd_ids = [];

    public function sendSMSAPI()
    {
        $contacts_data = $this->getUnsendSMSApplicationsArr();
        // if (count($this->syncd_ids) > 0) {
        //     // Application::whereIn('id', $this->syncd_ids)
        //     //     ->update(['is_sms_send' => 1]);
        // }
    }

    public function getUnsendSMSApplicationsArr()
    {
        $db_data = $this->getDbData();

        if(count($db_data) > 0 ){
            foreach ($db_data as $application) {
                $this->syncd_ids[] = $application->id;

                // $mobileNumber = ltrim($application->customer->mobile, '0');
                // $to_number = '966' . $mobileNumber;
                $to_number = $application->customer->mobile;

                $username = 'hyundainaghiruwxep4ahtfa';
                $password = '9f4ur1w30mytcn5kx7dj82ln09gcjbwn';

                $id = '1025445076';
                $templateinfo = '263457';

                if ($this->isArabic($application->customer->first_name)) {
                    $id = '1025445073';
                    $templateinfo = '263458';
                }

                $postdata ='{
                    "apiver": "1.0",
                    "whatsapp": {
                      "ver": "2.0",
                      "dlr": {
                        "url": ""
                      },
                      "messages": [
                        {
                          "coding": 1,
                          "id": "'.$id.'",
                          "msgtype": 1,
                         "templateinfo":"'.$templateinfo.'",
                          "addresses": [
                            {
                              "seq": "6310710c80900d37f7b99f56-20220901",
                              "to": "'.$to_number.'",
                              "from": "9668001240191",
                              "tag": "1"

                            }
                          ]
                        }
                      ]
                    }
                  }';


                Log::info("postdata");
                Log::info($postdata);

                  $curl = curl_init();

                  curl_setopt_array($curl, array(
                  CURLOPT_URL => 'https://api.goinfinito.me/unified/v2/send',
                  CURLOPT_RETURNTRANSFER => true,
                  CURLOPT_ENCODING => '',
                  CURLOPT_MAXREDIRS => 10,
                  CURLOPT_TIMEOUT => 0,
                  CURLOPT_FOLLOWLOCATION => true,
                  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                  CURLOPT_CUSTOMREQUEST => 'POST',
                  CURLOPT_POSTFIELDS => $postdata,
                   CURLOPT_HTTPHEADER => array(
                      'Content-Type: application/json'
                   ),
                  CURLOPT_USERPWD => "$username:$password",
                  ));

                  $response = curl_exec($curl);

                  curl_close($curl);

                  $response_decoded = json_decode($response,true);

                   Log::info("SendSMSService");
                   Log::info($response_decoded);

                   if($response_decoded['status'] == 'Success'){
                        Application::where('id', $application->id)->update(['is_sms_send' => 1]);
                   }

            }
        }

        return 1;
    }

    public function getDbData()
    {
        return Application::where('is_sms_send', 0)
            ->where('created_at', '>', now()->subDay())
            ->limit(50)
            ->get();
    }

    public function isArabic($str)
    {
        return preg_match('/[\p{Arabic}]/u', $str);
    }

    public function isEnglish($str)
    {
        return preg_match('/[a-zA-Z]/', $str);
    }
}
