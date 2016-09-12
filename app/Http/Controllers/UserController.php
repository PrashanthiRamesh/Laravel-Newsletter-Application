<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;


class UserController extends Controller
{
    public function get(){
        $user_id=Auth::user()->id;
        $user= User::where('id', $user_id)->first();
        return View::make('user_settings')->with('user',$user);
    }

    public function getqueue(){
        return View::make('queue_settings');
    }
}
