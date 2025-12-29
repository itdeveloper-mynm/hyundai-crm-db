<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class RecordDetailsMail extends Mailable
{
    use Queueable, SerializesModels;

    public $record;

    /**
     * Create a new message instance.
     *
     * @param array $record
     * @return void
     */
    public function __construct($record)
    {
        $this->record = $record;
    }

    public function build()
    {
        return $this->view('emails.record_details')
                    ->subject("Hyundai {$this->record['Category']} Lead Customer")
                    ->with('record', $this->record);
    }


}
