<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Services\SyncServiceLeadsGenesys;

class SyncServiceLeadsGenesysCron extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:sync-service-leads-genesys-cron';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    protected $sendGenService;

    public function __construct(SyncServiceLeadsGenesys $sendGenService)
    {
        parent::__construct();
        $this->sendGenService = $sendGenService;
    }
    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->sendGenService->syncApplications();
        return 0;
    }
}
