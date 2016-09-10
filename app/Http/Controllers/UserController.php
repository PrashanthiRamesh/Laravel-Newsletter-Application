<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\View;


class UserController extends Controller
{
    public function get(){
        return View::make('user_settings');
    }

    public function getqueue(){
        return View::make('queue_settings');
    }
}
