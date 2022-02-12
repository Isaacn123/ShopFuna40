<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
Use \Carbon\Carbon;

class ProductInquiry extends Mailable
{
    use Queueable, SerializesModels;
    public $inquiry;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($inquiry)
    {
        //
        $this->inquiry = $inquiry;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $mytime = Carbon::now();
        $data = array(
            'from'      => $this->inquiry['email'],
            'to'     => $this->inquiry['user_email'],
            'subject'     => $this->inquiry['subject'],
            'date'     => $mytime->toDateTimeString(),
            'message'     => $this->inquiry['description'],
        );
        return $this->markdown('emails.inquiry')->with([
            'from' => $data['from'],
            'to' => $data['to'],
            'subject'     => $data['subject'],
            'date'     => $data['date'],
            'message' => $data['message'],
            'link' => '/inboxes/'
        ]);
    }
}
