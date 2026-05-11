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
    public $subject;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($data, $subject)
    {
        $this->data = $data;
        $this->subject = $subject;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    // public function build()
    // {
    //     return $this->markdown('emails.graph_template')
    //                 ->subject($this->subject)
    //                 ->with('data', $this->data)
    //                 ->attach($this->attachment);
    // }

    public function build()
    {

        $email = $this->markdown('emails.graph_template')
                      ->subject($this->subject)
                      ->with('data', $this->data);

        foreach ($this->data['files'] as $attachment) {
            $email->attach($attachment);
        }

        return $email;
    }
}
