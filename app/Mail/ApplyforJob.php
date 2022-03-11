<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ApplyforJob extends Mailable
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
        // return $this->markdown('emails.jobapplication');
        // ->attach($url,[
        //     'as' => $data['file'],
        //     'mime'     => 'application/pdf'
        // ])
        $url = "https://res.cloudinary.com/ivhfizons/image/upload/v1639074703/".$this->application['resume'];
        $data = array(
            'name_first'      => $this->application['firstName'] ,
            'name_last' =>  $this->application['lastName'],
            'email'     => $this->application['email'],
            'phone'     => $this->application['phoneNumber'],
            'message'     => $this->application['description'],
            'file'     => $this->application['resume'],
            'job_title' => $this->application['jobTitle'],
            'pathfile'     => $this->application['path'],
        );
        return $this->markdown('emails.jobapplication')
        // ->replyTo('reply@example.com', 'Reply Guy') 
        ->with([
            'name' => $data['name_first'],
            'name_last' => $data['name_last'],
            'email'     => $data['email'],
            'phone' => $data['phone'],
            'message' => $data['message'],
            'job' => $data['job_title'],

        ])
        ->attach($data['pathfile']
        // ->attach(asset($data['file']), ['mime' => 'application/pdf']);"
        // ->attachData("https://res.cloudinary.com/ivhfizons/image/upload/v1639074703/uploads/poo7te9essqljbrqbjzz".".pdf",'resume.pdf',
        //  [
        //     'mime' => 'application/pdf'],
        // // ,[
        //     'as' => "resume.pdf",
        //     'mime'     => 'application/pdf'
        // ]
    );

        // dd($url."/".$data['file']);
    }
}
