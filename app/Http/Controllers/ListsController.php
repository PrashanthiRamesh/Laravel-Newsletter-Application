<?php

namespace App\Http\Controllers;

use App\Lists;
use App\Subscribtions;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\View;



class ListsController extends Controller
{

    public function __construct()
    {

    }


   public function index(){

       $lists=DB::table('lists')->orderBy('id')->get();
       Config::set('database.default', 'mysql');
       DB::reconnect();
       $user_id=Auth::user()->id;
       $user= User::where('id', $user_id)->first();
       $username=$user->username;
       Config::set('database.connections.mysql_tenant.database', $user->username);
       Config::set('database.default', 'mysql_tenant');
       DB::reconnect('mysql_tenant');
       return View::make('lists')->with('lists',$lists)->with('username',$username);;
   }

   public function create()
   {
       $list = new Lists();
       $list->name = Input::get('name');
       $list->description = Input::get('desc');
       $list->save();
       return Redirect::to('lists')->with('success', 'List Created');
   }

   public function newlist(){
       return View::make('list_new');
   }

    public function edit_show($id)
    {
        $list = Lists::find($id);

        return View::make('list_edit')->with('list', $list);

    }

   public function edit(){

       $id = Input::get('id');
       $list = Lists::find($id);
       $list->name = Input::get('name');
       $list->description = Input::get('desc');
       $list->save();
       return Redirect::back()->with('message','List Edited');
   }

   public function delete_show($id){
       $list = Lists::find($id);
       $list->delete();
       Subscribtions::where('list_id', $id)->delete();
       return Redirect::back()->with('message','List Deleted');
   }
}
