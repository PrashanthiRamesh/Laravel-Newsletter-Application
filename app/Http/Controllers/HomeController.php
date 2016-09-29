<?php

namespace App\Http\Controllers;

use App\Jobs\SendNewsletter;
use App\Lists;
use App\MailQueueData;
use App\Newsletters;
use App\Senders;
use App\Subscribers;
use App\Subscribtions;
use App\User;


use App\Http\Requests;
use Illuminate\Mail\Mailer;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\View;

class HomeController extends Controller
{

    protected $from_email;
    protected $from_name;
    protected $to_email;
    protected $to_name;
    protected $subject;


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
                $user_id = Auth::user()->id;
                $user = User::where('id', $user_id)->first();
                $username = $user->username;
                return redirect()->route('sub', ['subdomain' => $username]);
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
       // return Redirect::to('login')->withCookie($cookie);// redirect the user to the login screen
        return Redirect::to(URL::route('sub').'/login');
    }


    //Dashboard

    public function get()
    {
        $count = array(
            'subscribers' => Subscribers::count(),
            'subscribtions' => Subscribtions::count(),
            'lists' => Lists::count(),
            'newsletters' => Newsletters::count(),
            'senders' => Senders::count()
        );
        return View::make('home')->with('count', $count);
    }

    // Fetch 100 jobs from queue and send mail

    public function sendMail(Mailer $mailer)
    {

        $subscribers = MailQueueData::all()->take(100);

        if (!empty($subscribers->toArray())) {
            foreach ($subscribers as $subscriber) {

                $this->from_email = $subscriber->from_email;
                $this->from_name = $subscriber->company;
                $this->to_email = $subscriber->to_email;
                $this->to_name = $subscriber->to_name;
                $this->subject = $subscriber->subject;
//            //Create the Transport
//            $transport = \Swift_AWSTransport::newInstance( env('MAIL_USERNAME'), env('MAIL_PASSWORD') );
//            $message = \Swift_Message::newInstance();
//            $message->setTo(array(
//                $subscriber->to_email => $subscriber->to_name
//            ));
//            $message->setSubject($subscriber->subject);
//            $message->setBody($subscriber->content);
//            $message->setFrom($subscriber->from_email, $subscriber->company);
//            $mailer = \Swift_Mailer::newInstance($transport);
//            $mailer->send($message);
//            $subscriber->delete();
                $mailer->send('newsletter_template', ['content' => $subscriber->content, 'name' => $subscriber->from_name], function ($message) {

                    $message->from($this->from_email, $this->from_name);
                    $message->to($this->to_email, $this->to_name);
                    $message->subject($this->subject);
                });
                $subscriber->delete();
            }
        } else {
            return response()->json('No Newsletters');
        }

        return response()->json('Newsletters Sent');
    }

}
