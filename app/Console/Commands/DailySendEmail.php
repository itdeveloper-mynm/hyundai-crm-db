<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendMailWithAttachment;
use App\Models\EmailSendingCriteria;

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
        $row = EmailSendingCriteria::where('type', 'Daily')->first();
        $subject = $row->subject ?? "Graph Email";
        $recipients = $row->emails ? explode(',', $row->emails) : [];
        $data = [
            'subject' => $subject,
            'message' => $row->body,
        ];
        $formattedDate = currdate();
        $attachmentPath = storage_path('app/public/pdf_graph/daily/'. $formattedDate .'-sale-graph.pdf');

        foreach ($recipients as $recipient) {
            Mail::to($recipient)->send(new SendMailWithAttachment($data, $attachmentPath, $subject));
        }

        $this->info('Daily email sent successfully!');
    }
}
