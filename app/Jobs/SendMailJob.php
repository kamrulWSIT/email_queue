<?php

namespace App\Jobs;

use App\Mail\UserReportMail;
use App\Mail\WelcomeMail;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class SendMailJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $email;
    public $message;

    /**
     * Create a new job instance.
     */
    public function __construct($email, $message)
    {
        $this->email = $email;
        $this->message = $message;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        Mail::to($this->email)->send(new WelcomeMail($this->message));
        Mail::to('superadmin@gmail.com')->send(new UserReportMail());
    }


    public function failed($exception)
    {

        Mail::send([], [], function ($message) {
            // $message->from('john@johndoe.com', 'John Doe');
            // $message->sender('john@johndoe.com', 'John Doe');

            $message->to('john@johndoe.com', 'John Doe')

            // $message->cc('john@johndoe.com', 'John Doe');
            // $message->bcc('john@johndoe.com', 'John Doe');

            // $message->replyTo('john@johndoe.com', 'John Doe');

            ->subject('Money Tranfer Failed')
            ->html('Hi, Your money transfer failed');

            // $message->priority(3);

            // $message->attach('pathToFile');
        });

    }
}
