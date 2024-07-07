<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    protected $commands = [
        Commands\RunNodeScript::class,
        Commands\DailySendEmail::class,
        Commands\WeeklySendEmail::class,
        Commands\MonthlySendEmail::class,
    ];

    /**
     * Define the application's command schedule.
     */
    protected function schedule(Schedule $schedule): void
    {
        // $schedule->command('inspire')->hourly();
        $schedule->command('nodescript:cron')->everyminute();
        // $schedule->command('nodescript:cron')->daily();
        // $schedule->command('email:daily')->daily();
        // $schedule->command('email:weekly')->weekly();
        // $schedule->command('email:monthly')->monthlyOn(1, '15:00');
    }

    /**
     * Register the commands for the application.
     */
    protected function commands(): void
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
