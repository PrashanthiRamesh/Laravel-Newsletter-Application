<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\View;


class ListsController extends Controller
{
   public function index(){
       $lists=DB::table('lists')->orderBy('id')->get();
       return View::make('lists')->with('lists',$lists);;
   }
}
