<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Services\SendSMSService;
use Illuminate\Support\Facades\Log;

class SendSMSServiceCron extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'sync:sendsms-applications';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    protected $sendSms;

    public function __construct(SendSMSService $sendSms)
    {
        parent::__construct();
        $this->sendSms = $sendSms;
    }


    /**
     * Execute the console command.
     */
    public function handle()
    {
        Log::info("inside SendSMSServiceCron");
        $this->sendSms->sendSMSAPI();
        return 0;
    }
}
