<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class CareerEmail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public $resume;
    public $user;
    public $job_title;

    public function __construct($resume,$user,$job_title)
    {
        $this->resume = $resume;
        $this->user = $user;
        $this->job_title = $job_title;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Logon Broadband Job Application: '.$this->job_title)
        ->attachData($this->resume, $this->user->name.'.'.$this->user->extension, [
            'mime' => $this->user->mime,
        ])
        ->view('email.career',['user'=>$this->user,'job_title'=>$this->job_title]);
    }
}
