<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Symfony\Component\Process\Exception\ProcessFailedException;
use Symfony\Component\Process\Process;

class RunNodeMonthlyScript extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'nodescript-monthly:cron';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $process = new Process(['node', base_path('resources/js/monthly/generateSaleGraphPdf.js')]);
        $process->run();

        // Executes after the command finishes
        if (!$process->isSuccessful()) {
            throw new ProcessFailedException($process);
        }

        echo $process->getOutput();

        // Create and run second process
        $process2 = new Process(['node', base_path('resources/js/monthly/generateAfterSaleGraphPdf.js')]);
        $process2->run();

        // Check if process 2 was successful
        if (!$process2->isSuccessful()) {
            throw new ProcessFailedException($process2);
        }

        echo $process2->getOutput();

        // Create and run third process
        $process3 = new Process(['node', base_path('resources/js/monthly/generateCrmGraphPdf.js')]);
        $process3->run();

        // Check if process 2 was successful
        if (!$process3->isSuccessful()) {
            throw new ProcessFailedException($process3);
        }

        echo $process3->getOutput();

        return 0;
    }
}
