<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    protected $commands = [
        Commands\RunNodeScript::class,
        Commands\DailySendEmail::class,
        Commands\RunNodeWeeklyScript::class,
        Commands\WeeklySendEmail::class,
        Commands\RunNodeMonthlyScript::class,
        Commands\MonthlySendEmail::class,
    ];

    /**
     * Define the application's command schedule.
     */
    protected function schedule(Schedule $schedule): void
    {
        // $schedule->command('inspire')->hourly();
        $schedule->command('nodescript:cron')->everyminute();
        $schedule->command('email:daily')->everyminute();

        // $schedule->command('nodescript-weekly:cron')->everyminute();
        // $schedule->command('email:weekly')->everyminute();

        // $schedule->command('nodescript-monthly:cron')->monthlyOn(1, '14:45');
        // $schedule->command('email:monthly')->monthlyOn(1, '15:00');


        ///below code for live

        // $schedule->command('nodescript:cron')->dailyAt('7:45');
        // $schedule->command('email:daily')->dailyAt('8:00');

        // $schedule->command('nodescript-weekly:cron')->weeklyOn(1, '7:45');
        // $schedule->command('email:weekly')->weeklyOn(1, '8:00');

        // $schedule->command('nodescript-monthly:cron')->monthlyOn(1, '14:45');
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
