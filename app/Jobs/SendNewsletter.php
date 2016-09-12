<?php

namespace App\Jobs;

use App\Newsletters;
use App\Senders;
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
    protected $from_id;
    protected $from_name;
    protected $from_designation;
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
        $from=Senders::where('selected',true)->first()->toArray();
        $this->from_id=$from['email'];
        $this->from_name=$from['name'];
        $this->from_designation=$from['designation'];
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle(Mailer $mailer)
    {
        $newsletter=Newsletters::find($this->newsletter_id);
        $mailer->send('newsletter_template', ['content' => $newsletter->body, 'name'=> $this->name], function($message) {
            $newsletter=Newsletters::find($this->newsletter_id);
            $message->from($this->from_id, 'Flycart');
            $message->to($this->emailAddress, $this->name);
            //Add a subject
            $message->subject($newsletter->subject);
        });
    }
}
