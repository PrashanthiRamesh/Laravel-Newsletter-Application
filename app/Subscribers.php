<?php

namespace App;

use Illuminate\Database\Eloquent;

Class Subscribers extends Eloquent\Model{
    protected $table = 'subscribers';
    protected $fillable = array('email');
}