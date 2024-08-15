<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Mail\CareerEmail;
use Illuminate\Support\Facades\Mail;

class CareerEmailJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
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
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        Mail::to("shahrukh.aptech16@gmail.com")//$engineer->email
            ->cc("sharukh.aslam1311@gmail.com")
            ->send(new CareerEmail($this->resume,$this->user,$this->job_title));
    }
}
