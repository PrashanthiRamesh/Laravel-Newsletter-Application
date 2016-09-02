<?php

namespace App\Http\Controllers;


use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\View;

class NewslettersController extends Controller
{
    public function index(){

        $newsletters=DB::table('newsletters')->orderBy('id')->get();
        return View::make('newsletters')->with('newsletters',$newsletters);
    }
}
