<?php

namespace App;

use Illuminate\Database\Eloquent;

Class Senders extends Eloquent\Model{
    protected $table = 'senders';
    protected $fillable= array('name', 'email', 'designation', 'selected');
}