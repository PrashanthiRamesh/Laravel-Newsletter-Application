<?php

namespace App\Http\Controllers;

use App\Jobs\ForgotPasswordEmail;
use App\User;
use App\Http\Requests;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\View;


class UserController extends Controller
{

    public function __construct()
    {

    }

    public function register(){
        //validate the tenant registration info
        $rules = array(
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'username' => 'required|unique:users',
            'password'=> 'required|alphaNum|min:6',
            'confirm'=>'required|alphaNum|min:6|same:password'
        );

        $validator = Validator::make(Input::all(), $rules);

        if ($validator->fails()) {

            return Redirect::to('/register')
                ->withErrors($validator)// send back all errors to the login form
                ->withInput(Input::all());
            // send back the input (not the password) so that we can repopulate the form

        } else {

            $tenant = array(
                'name'=> Input::get('name'),
                'email' => Input::get('email'),
                'password'=> Hash::make(Input::get('password')),
                'username' => Input::get('username'),

            );

            //if all ok, then create a db in the specified username & migrate
            User::create($tenant);
            DB::statement("CREATE USER '".Input::get("username")."'@'".env("DB_HOST")."' IDENTIFIED BY '".Input::get("password")."'");
            DB::statement('create database ' . Input::get('username'));
            DB::statement("GRANT ALL PRIVILEGES ON ".Input::get("username").".* TO '".Input::get("username")."'@'".env("DB_HOST")."'");
            Config::set('database.connections.mysql_tenant.database', Input::get('username'));
            Config::set('database.default', 'mysql_tenant');
            DB::reconnect('mysql_tenant');
//            if(!\Schema::hasTable('migrations')) {
//                Artisan::call('migrate:install');
//                Artisan::call('migrate', [
//                    '--path' => "database/migrations/main"
//                ]);
//
//            }
           $details=array(
                'name'=> Input::get('name'),
                'email' => Input::get('email'),
                'password'=> Hash::make(Input::get('password')),
                'username' => Input::get('username'),
            );

            User::create($details);
            return Redirect::to('/register')->with('message', 'New User Registered and Database Created');

        }
    }
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


    public function changePassword($id){
        $user=User::find($id);
        return View::make('forgot_password')->with('user',$user);
    }

    public function change(){
        $id=Input::get('id');
        $rules = array(
            'new_password' => 'min:6|required',// make sure the email is an actual email
            'confirm_password' => 'min:6|required|same:new_password', // password can only be alphanumeric and has to be greater than 3 characters
        );

        $validator = Validator::make(Input::all(), $rules);
        if ($validator->fails()) {
            return redirect()->action(
                'UserController@changePassword', ['id' => $id]
            )->withErrors($validator);

                 // send back the input (not the password) so that we can repopulate the form
        } else{
            $user=User::find($id);
            $user->password=Hash::make(Input::get('new_password'));
            $user->save();
            echo "<script>alert('User edited successfully'); window.location.href='/login';</script>";

        }
    }
}
