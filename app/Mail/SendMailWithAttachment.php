<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class SendMailWithAttachment extends Mailable
{
    use Queueable, SerializesModels;

    public $data;
    public $attachment;
    public $subject;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($data, $attachment, $subject)
    {
        $this->data = $data;
        $this->attachment = $attachment;
        $this->subject = $subject;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.graph_template')
                    ->subject($this->subject)
                    ->with('data', $this->data)
                    ->attach($this->attachment);
    }
}
