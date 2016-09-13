<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailer;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class ForgotPasswordEmail implements ShouldQueue
{
    use InteractsWithQueue, Queueable, SerializesModels;

    protected $id;
    protected $name;
    protected $email;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($id,$name, $email)
    {
        $this->id=$id;
       $this->name=$name;
        $this->email=$email;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle(Mailer $mailer)
    {

        $mailer->send('forgot_password_mail', [
            'id'=>$this->id,
            'name' => $this->name,
            'content'=>'Follow the below link to change your password'

        ], function($message) {

            $message->from(env('MAIL_FROM'), 'Flycart');
            $message->to($this->email, $this->name);
            //Add a subject
            $message->subject('Change Password');
        });
    }
}
