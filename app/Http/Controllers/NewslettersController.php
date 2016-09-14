<?php

namespace App\Http\Controllers;


use App\Jobs\SendNewsletter;
use App\Lists;
use App\Newsletters;
use App\Senders;
use App\Subscribers;
use App\Subscribtions;
use Illuminate\Mail\Mailer;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Validator;


class NewslettersController extends Controller
{

    public function __construct()
    {

    }


    public function index(){
        $newsletters=DB::table('newsletters')->orderBy('id')->get();
        return View::make('newsletters')->with('newsletters',$newsletters);
    }

    public function add_sender(){
        return View::make('sender_add');
    }



    public function verify_sender(){
        $rules = array(
            'email' => 'required|email|unique:senders', // make sure the email is an actual email
            'name' => 'required',
            'designation'=> 'required'
        );

        $validator = Validator::make(Input::all(), $rules);

        if ($validator->fails()) {
            return Redirect::to('/sender/add')
                ->withErrors($validator)// send back all errors to the login form
                ->withInput(Input::all()); // send back the input (not the password) so that we can repopulate the form
        } else {
            $sender = array(
                'name'=> Input::get('name'),
                'email' => Input::get('email'),
                'designation' => Input::get('designation'),
                'selected'=> false
            );

            Senders::create($sender);
            return Redirect::to('sender/add')->with('message', 'New Sender Added');

        }
    }

    public function change_sender(){
        $senders=Senders::all();
        return View::make('sender_change')->with('senders', $senders);
    }

    public function changesender(){

        $sender_id=(Input::get('sender'));

        $senders=Senders::all();
        foreach ( $senders as $sender){
            if($sender->id == $sender_id['0']){
                $sender->selected=true;

            }else{
                $sender->selected=false;
            }
            $sender->save();
        }
        return Redirect::to('sender/change')->with('message', 'Sender Changed');


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
        return Redirect::back()->with('message_edit','Newsletter Edited');
    }

    public function delete($id){
        $newsletter = Newsletters::find($id);
        $newsletter->delete();

        return Redirect::back()->with('message_delete','Newsletter Deleted');
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
           return Redirect::back()->with('message_list', 'No Lists Seleted');
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
        return Redirect::back()->with('message_sent', 'Newsletter Sent');


    }

    public function preview($id){
        $newsletter = Newsletters::find($id);
        return View::make('preview')->with('content',$newsletter->body)
                                                ->with('name', 'Tyrion Lannister');
    }

    public function create(){
        $rules = array(
            'subject' => 'required', // make sure the email is an actual email
            'body' => 'required',
        );

        $validator = Validator::make(Input::all(), $rules);

        if ($validator->fails()) {
            return Redirect::to('/newsletter/new')
                ->withErrors($validator)// send back all errors to the login form
                ->withInput(Input::all()); // send back the input (not the password) so that we can repopulate the form
        } else {
            $newsletter = array(
                'subject'=> Input::get('subject'),
                'body' => Input::get('body'),
                'template_id' => 1,
            );

            Newsletters::create($newsletter);
            return Redirect::to('newsletters')->with('newsletter_add', 'New Newsletter Added');

        }
    }

    public function new_newsletter(){
        return View::make('newsletter_new');
    }

    public function sender_edit($id){
        $sender=Senders::find($id);
        return View::make('sender_edit')->with('sender',$sender);
    }

    public function senderEdit(){
        $id = Input::get('id');
        $sender = Senders::find($id);
        $sender->name = Input::get('name');
        $sender->email = Input::get('email');
        $sender->designation=Input::get('desig');
        $sender->save();
        return Redirect::back()->with('message','Sender Edited');
    }


    public function sender_delete($id){
        $sender = Senders::find($id);
        $sender->delete();
        return Redirect::back()->with('message_del','Sender Deleted');
    }

}
