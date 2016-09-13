<?php

namespace App\Http\Controllers;

use App\Jobs\ForgotPasswordEmail;
use App\User;
use App\Http\Requests;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\View;


class UserController extends Controller
{
    public function get(){
        $user_id=Auth::user()->id;
        $user= User::where('id', $user_id)->first();
        return View::make('user_settings')->with('user',$user);
    }

    public function saveUser(){
        $id = Input::get('id');
        $user = User::find($id);
        $user->name = Input::get('name');
        $user->email = Input::get('email');
        $user->save();
        echo "<script>alert('User Settings edited successfully'); window.location.href='/settings/user';</script>";
    }

    public function getqueue(){
        return View::make('queue_settings');
    }

    public function forgotPassword($id){

        $user =User::find($id);
        $job = (new ForgotPasswordEmail($id, $user->name, $user->email));
        $this->dispatch($job);
        echo "<script>alert('Mail sent successfully'); window.location.href='/logout';</script>";

    }

    public function changePassword(){
        $user=User::find(Input::get('id'));
        dd(Input::get('id'));
        return View::make('forgot_password')->with('user',$user);
    }

    public function change($id){
        $rules = array(
            'new_password' => 'min:6|required',// make sure the email is an actual email
            'confirm_password' => 'min:6|required|same:new_password', // password can only be alphanumeric and has to be greater than 3 characters
        );

        $validator = Validator::make(Input::all(), $rules);
        if ($validator->fails()) {
            return Redirect::to('/password/change/{id}')
                ->withErrors($validator); // send back the input (not the password) so that we can repopulate the form
        } else{

        }
    }
}
