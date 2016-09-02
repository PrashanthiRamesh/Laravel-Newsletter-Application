<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Subscribers;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\View;

class SubscribersController extends Controller
{
    public function index() {

        return View::make('subscribe_form');
    }

    public function get(){
        $subscribers=DB::table('subscribers')->orderBy('id')->get();
        return View::make('subscribers')->with('subscribers',$subscribers);
    }

    public function submit(Request $request) {

       //TODO: check ajax requests
            $validation = Validator::make(Input::all(), array(
                    //email field should be required, should be in an email//format, and should be unique
                    'email' => 'required|email|unique:subscribers,email'
                )
            );

            if($validation->fails()) {
                return $validation->errors()->first();
            } else {

                $create = Subscribers::create(array(
                    'email' => Input::get('email')
                ));

                //If successful, we will be returning the '1' so the form//understands it's successful
                //or if we encountered an unsuccessful creation attempt,return its info
                return Redirect::to('subscribers');
            }




    }
}
