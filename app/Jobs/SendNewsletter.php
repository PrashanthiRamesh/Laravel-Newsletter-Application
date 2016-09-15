<?php

namespace App\Jobs;

use App\MailQueueData;
use App\Newsletters;
use App\Senders;
use Illuminate\Bus\Queueable;
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
        $from = Senders::where('selected', true)->first()->toArray();
        $this->from_id = $from['email'];
        $this->from_name = $from['name'];
        $this->from_designation = $from['designation'];
    }


    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $newsletter = Newsletters::find($this->newsletter_id);
        $data = array(
            'company' => 'Flycart',
            'content' => $newsletter->body,
            'to_name' => $this->name,
            'from_email' => $this->from_id,
            'from_name' => $this->from_name,
            'to_email' => $this->emailAddress,
            'subject' => $newsletter->subject,
            'from_designation' => $this->from_designation
        );
        MailQueueData::create($data);
    }
}
