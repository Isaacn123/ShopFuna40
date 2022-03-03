<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ApplyJobs extends Mailable
{
    use Queueable, SerializesModels;
    public $application;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($application)
    {
        //
        $this->application = $application;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {

        $url = "https://res.cloudinary.com/ivhfizons/image/upload/v1639074703";
        $data = array(
            'name'      => $this->application['firstName'] + $this->application['lastName'],
            'email'     => $this->application['email'],
            'phone'     => $this->application['phoneNumber'],
            'message'     => $this->application['description'],
            'file'     => $this->application['resume'],
            'job_title' => $this->application['jobTitle'],
        );
        return $this->markdown('emails.application')
        ->attach($url,[
            'as' => $data['file'],
            'mime'     => 'application/pdf'
        ])
        ->with([
            'name' => $data['name'],
            'email'     => $data['email'],
            'phone' => $data['phone'],
            'message' => $data['message'],
            'job' => $data['job_title']

        ]);
    }
}