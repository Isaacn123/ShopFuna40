<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class WelcomeMail extends Mailable 

{
    use Queueable, SerializesModels;

    public $datamail;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($datamail)
    {
        //
        $this->datamail = $datamail;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $data = array(
            'name'      => $this->datamail['name'],
            'email'     => $this->datamail['email'],
        );

        return $this->markdown('emails.welcome')->with([
            'name' => $data['name'],
            'link' => '/inboxes/'
        ]);
    }
}
