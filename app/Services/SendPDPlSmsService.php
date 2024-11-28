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

                $response_decoded = sendSmsPdPl($number);

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
