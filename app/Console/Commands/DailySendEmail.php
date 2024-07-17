<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendMailWithAttachment;
use App\Models\EmailSendingCriteria;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;

class DailySendEmail extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'email:daily';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send daily email with attachment';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $files = Storage::files('public/pdf_graph/daily');
        $filePaths = []; // Initialize an array to hold local file paths

        // Process each file to get local paths
        foreach ($files as $file) {
            $filePath = storage_path('app/' . $file); // Convert to local path
            $filePaths[] = $filePath; // Add local path to the array
        }

        $row = EmailSendingCriteria::where('type', 'Daily')->first();
        $subject = $row->header ?? "Daily Graphs";
        $recipients = $row->emails ? explode(',', $row->emails) : [];
        $data = [
            'subject' => $subject,
            'message' => $row->body,
        ];

        // $formattedDate = currdate();
        // $attachmentPath = storage_path('app/public/pdf_graph/daily/'. $formattedDate .'-sale-graph.pdf');

        $data['files'] = $filePaths;

        foreach ($recipients as $recipient) {
            Mail::to($recipient)->send(new SendMailWithAttachment($data, $subject));
        }

        // Delete files after sending email
        foreach ($files as $filePath) {
            Storage::delete($filePath);
        }

        Log::info('Daily email sent successfully!');
    }
}
