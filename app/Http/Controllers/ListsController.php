<?php

namespace App\Http\Controllers;

use App\Lists;
use App\Subscribtions;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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
       return View::make('lists')->with('lists',$lists);
   }

   public function create(){
       $list= new Lists();
       $list->name= Input::get('name');
       $list->description=Input::get('desc');
       $list->save();
       return Redirect::to('lists');
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
       return Redirect::to('lists');
   }

   public function delete_show($id){
       $list = Lists::find($id);
       $list->delete();
       Subscribtions::where('list_id', $id)->delete();
       return Redirect::to('lists');
   }
}
