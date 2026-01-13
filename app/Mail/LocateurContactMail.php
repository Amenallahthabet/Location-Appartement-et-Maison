<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class LocateurContactMail extends Mailable
{
    use Queueable, SerializesModels;

    public $messageClient;
    /**
     * Create a new message instance.
     */
    public function __construct($messageClient)
    {
        $this->messageClient = $messageClient;
    }

    /**
     * Build the message.
     */
    public function build()
    {
        return $this->subject('Message d\'un client')
                    ->view('emails.locateur_contact') 
                    ->with([
                        'messageClient' => $this->messageClient,
                    ]);
    }
}
