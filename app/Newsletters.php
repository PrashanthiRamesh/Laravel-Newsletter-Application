<?php

namespace App;

use Illuminate\Database\Eloquent;

Class Newsletters extends Eloquent\Model{
    protected $table = 'newsletters';
    protected $fillable= array('subject','body','template_id');
}