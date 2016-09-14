<?php

namespace App\Http\Controllers;

use App\Lists;
use App\Newsletters;
use App\Senders;
use App\Subscribers;
use App\Subscribtions;
use App\User;


use App\Http\Requests;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\View;

class HomeController extends Controller
{

    public function __construct()
    {


    }


    public function showLogin()
    {
        // show the form
        return View::make('login');
    }

    public function doLogin()
    {
        // validate the info, create rules for the inputs
        $rules = array(
            'email' => 'required|email', // make sure the email is an actual email
            'password' => 'required|alphaNum|min:3' // password can only be alphanumeric and has to be greater than 3 characters
        );

        // run the validation rules on the inputs from the form
        $validator = Validator::make(Input::all(), $rules);

        // if the validator fails, redirect back to the form
        if ($validator->fails()) {
            return Redirect::to('login')
                ->withErrors($validator)// send back all errors to the login form
                ->withInput(Input::except('password')); // send back the input (not the password) so that we can repopulate the form
        } else {

            // create our user data for the authentication
            $userdata = array(
                'email' => Input::get('email'),
                'password' => Input::get('password')
            );

            // attempt to do the login
            if (Auth::attempt($userdata)) {

                // validation successful!

                return Redirect::to('home');

            } else {

                // validation not successful, send back to form
                return Redirect::to('login');

            }

        }
    }

    public function doLogout()
    {


        Auth::logout(); // log the user out of our application
        Session::flush();
        $rememberMeCookie = Auth::getRecallerName();
        $cookie = Cookie::forget($rememberMeCookie);
        return Redirect::to('home')->withCookie($cookie);// redirect the user to the login screen

    }


    //Dashboard

    public function get(){
        $count=array(
            'users' => User::count(),
            'subscribers' => Subscribers::count(),
            'subscribtions' => Subscribtions::count(),
            'lists' => Lists::count(),
            'newsletters' => Newsletters::count(),
            'senders'=> Senders::count()
        );
        return View::make('home')->with('count',$count);
    }
}
