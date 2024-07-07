<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendMailWithAttachment;
use App\Models\EmailSendingCriteria;

class WeeklySendEmail extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'email:weekly';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send weekly email with attachment';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $row = EmailSendingCriteria::where('type', 'Weekly')->first();
        $subject = $row->subject ?? "Graph Email";
        $recipients = $row->emails ? explode(',', $row->emails) : [];
        $data = [
            'subject' => $subject,
            'message' => $row->body,
        ];
        $attachmentPath = storage_path('2024-07-02.pdf');

        foreach ($recipients as $recipient) {
            Mail::to($recipient)->send(new SendMailWithAttachment($data, $attachmentPath, $subject));
        }

        $this->info('Weekly email sent successfully!');
    }
}
