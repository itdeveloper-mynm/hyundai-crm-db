<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Services\SyncGenesysService;
use Illuminate\Support\Facades\Log;

class SyncGenesysServiceCron extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:sync-genesys-service-applications';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    protected $sendGenService;

    public function __construct(SyncGenesysService $sendGenService)
    {
        parent::__construct();
        $this->sendGenService = $sendGenService;
    }

    /**
     * Execute the console command.
     */
    public function handle()
    {
        Log::channel('sync_service_log')->info("inside SyncGenesysServiceCron");
        $this->sendGenService->syncApplications();
        return 0;
    }
}
