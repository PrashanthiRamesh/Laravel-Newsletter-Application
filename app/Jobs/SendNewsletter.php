<?php

namespace App\Jobs;

use App\Newsletters;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailer;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendNewsletter implements ShouldQueue
{
    use InteractsWithQueue, Queueable, SerializesModels;
    protected $emailAddress;
    protected $name;
    protected $newsletter_id;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($emailAddress, $name, $newsletter_id)
    {
        $this->emailAddress = $emailAddress;
        $this->name = $name;
        $this->newsletter_id = $newsletter_id;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle(Mailer $mailer)
    {
        $newsletter=Newsletters::find($this->newsletter_id);
        $mailer->send('newsletter_template', ['content' => $newsletter->body], function($message) {
            $newsletter=Newsletters::find($this->newsletter_id);
            $message->from(env('MAIL_FROM'), 'Flycart');
            $message->to($this->emailAddress, $this->name);
            //Add a subject
            $message->subject($newsletter->subject);
        });
    }
}
