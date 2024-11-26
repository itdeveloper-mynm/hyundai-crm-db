<?php

namespace App\Services;

use App\Models\Application;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class SendPDPlSmsService
{
    private $syncd_ids = [];

    public function sendSMSAPI()
    {
        $contacts_data = $this->getUnsendSMSApplicationsArr();

    }

    public function getUnsendSMSApplicationsArr()
    {
        $db_data = $this->getDbData();

        foreach ($db_data as $application) {
            $this->syncd_ids[] = $application->id;


            $to_number = $application->customer->mobile;

            $username = 'hyundainaghiruwxep4ahtfa';
            $password = '9f4ur1w30mytcn5kx7dj82ln09gcjbwn';

            $id = '1025445076';
            $templateinfo = '263457';

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
                    Application::where('id', $application->id)->update(['read_accept' => 3]);
               }

        }

        return 1;
    }

    public function getDbData()
    {
        // 2 for old leads check and 3 value mean sms is send
        return Application::where('read_accept',2)
            ->orderby('id','asc')
            ->limit(50)
            ->get();
    }

}
