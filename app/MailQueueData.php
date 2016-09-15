<?php

namespace App;

use Illuminate\Database\Eloquent;

Class MailQueueData extends Eloquent\Model{
    protected $table = 'mail_queue_data';
    protected $fillable= array(
        'company',
        'content',
        'to_name',
        'to_email',
        'from_name',
        'from_email',
        'from_designation',
        'subject'
        );
}