<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Imports\SalesDataImport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Storage;
use Log;

class ApplicationImportExcel implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;


    protected $filePath;

    /**
     * Create a new job instance.
     */

     public function __construct($filePath)
     {
         $this->filePath = $filePath;
     }

    /**
     * Execute the job.
     */

     public function handle()
     {
         Log::info('Processing file: ' . $this->filePath);

         try {
             Excel::import(new SalesDataImport, $this->filePath);
         } catch (\Exception $e) {
             Log::error('Error processing file: ' . $e->getMessage());
         }
     }

    // public function handle(): void
    // {
    //     Excel::import(new SalesDataImport, $this->filePath);
    //     // Delete the file after import
    //     Storage::delete($this->filePath);
    // }
}
