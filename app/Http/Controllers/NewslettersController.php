<?php

namespace App\Http\Controllers;


use App\Newsletters;
use App\Subscribtions;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\View;


class NewslettersController extends Controller
{
    public function index(){
        $newsletters=DB::table('newsletters')->orderBy('id')->get();
        return View::make('newsletters')->with('newsletters',$newsletters);
    }

    public function edit_show($id){
        $newsletter = Newsletters::find($id);

        return View::make('newsletter_edit')->with('newsletter', $newsletter);
    }

    public function edit(){
        $id = Input::get('id');
        $newsletter = Newsletters::find($id);
        $newsletter->subject = Input::get('subject');
        $newsletter->body = Input::get('body');
        $newsletter->template_id=1;
        $newsletter->save();
        return Redirect::to('newsletters');
    }

    public function delete($id){
        $newsletter = Newsletters::find($id);
        $newsletter->delete();

        return Redirect::to('newsletters');
    }

    public function send(){

    }

    public function preview(){

    }

    public function create(){
        $newsletter= new Newsletters();
        $newsletter->subject= Input::get('subject');
        $newsletter->body=Input::get('body');
        $newsletter->template_id=1;
        $newsletter->save();
        return Redirect::to('newsletters');
    }

    public function new_newsletter(){
        return View::make('newsletter_new');
    }

}
