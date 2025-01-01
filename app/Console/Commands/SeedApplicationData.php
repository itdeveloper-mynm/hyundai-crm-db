<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class SeedApplicationData extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'seed:application-data';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Seed the application data using ApplicationDataSeeder';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        Log::info('SeedApplicationData start');
        $this->call('db:seed', [
            '--class' => 'ApplicationDataSeeder',
        ]);

        Log::info('SeedApplicationData end');
        $this->info('Application data seeded successfully.');
    }
}
