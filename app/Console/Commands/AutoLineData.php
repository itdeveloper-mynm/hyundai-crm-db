<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Services\AutoLineService;
use App\Models\Application;
use Illuminate\Support\Facades\Log;

class AutoLineData extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:auto-line-data';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    protected $autoline;

    public function __construct(AutoLineService $autoline)
    {
        parent::__construct();
        $this->autoline = $autoline;
    }

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $db_data = $this->getDbData();
        Log::channel('auto_line')->info("inside AutoLineData");
        if(count($db_data) > 0){
            foreach ($db_data as $application) {
                $this->autoline->callApi($application);
            }
        }
        Log::channel('auto_line')->info("inside AutoLineData end");
        return 1;
    }

    public function getDbData()
    {
        return Application::where('category','Qualified')
            ->whereNull('lead_id')
            ->whereDate('updated_at','>=','2025-06-01')
            ->orderby('id','asc')
            ->limit(50)
            ->get();
    }
}
