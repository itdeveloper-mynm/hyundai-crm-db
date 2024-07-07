<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Symfony\Component\Process\Exception\ProcessFailedException;
use Symfony\Component\Process\Process;

class RunNodeScript extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'nodescript:cron';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Run the Node.js script';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $process = new Process(['node', base_path('resources/js/daily/generateSaleGraphPdf.js')]);
        $process->run();

        // Executes after the command finishes
        if (!$process->isSuccessful()) {
            throw new ProcessFailedException($process);
        }

        echo $process->getOutput();

        // Create and run second process
        $process2 = new Process(['node', base_path('resources/js/daily/generateAfterSaleGraphPdf.js')]);
        $process2->run();

        // Check if process 2 was successful
        if (!$process2->isSuccessful()) {
            throw new ProcessFailedException($process2);
        }

        echo $process2->getOutput();

        return 0;
    }

}
