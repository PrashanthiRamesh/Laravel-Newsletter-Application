<?php

namespace App\Http\Controllers;


use App\Jobs\SendNewsletter;
use App\Lists;
use App\Newsletters;
use App\Subscribers;
use App\Subscribtions;
use Illuminate\Mail\Mailer;
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

    public function send($id){
        $lists = Lists::all();
        return View::make('newsletter_send')->with('newsletterid',$id)
            ->with('lists',$lists);
    }

    public function send_mail(Mailer $mailer){
       $lists=Input::get('list');
        $newsletter_id=Input::get('newsletter_id');
       if(empty($lists)){
            echo "<script>alert('No lists were selected.'); window.location.href='/newsletters';</script>";
        }else{

                //save all the subscribtions with list_id=$list
                $subscribtions = Subscribtions::whereIn('list_id', $lists)->get() ;

           $subscribers_id = array();
           $count=0;
           foreach ($subscribtions as $subscribtion) {
               $subscribers_id[$count++] = $subscribtion->subscribers_id; // Get unique country by code.
           }

           //got the subscriber's id to send mail
           $subscribers=Subscribers::find($subscribers_id);

           foreach ($subscribers as $subscriber) {

               $job = (new SendNewsletter($subscriber->email, $subscriber->name, $newsletter_id));
               $this->dispatch($job);
           }

       }
        echo "<script>alert('Newsletter sent successfully'); window.location.href='/newsletters';</script>";


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
