<?php

namespace App\Http\Controllers;

use App\Lists;
use App\Subscribtions;
use Illuminate\Http\Request;

use App\Subscribers;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\View;

class SubscribersController extends Controller
{
    public function index()
    {

        return View::make('subscribe_form');
    }

    public function get()
    {
        $subscribers = DB::table('subscribers')->orderBy('id')->get();
        return View::make('subscribers')->with('subscribers', $subscribers);
    }

    public function edit_show($id)
    {
        $subscriber = Subscribers::find($id);
        $subscribtions = Subscribtions::where('subscribers_id', $id)->get();
        $lists = Lists::all();
        return View::make('subscriber_edit')->with('subscriber', $subscriber)
            ->with('subscribtions', $subscribtions)
            ->with('lists', $lists);
    }

    public function delete_show($id)
    {
        $subscriber = Subscribers::find($id);
        $subscriber->delete();
        Subscribtions::where('subscribers_id', $id)->delete();
        return Redirect::to('subscribers');
    }

    public function edit()
    {

        $id = Input::get('id');
        $subscriber = Subscribers::find($id);
        $subscribtions = Subscribtions::where('subscribers_id', $id)->get();
        $subscriber->name = Input::get('name');
        $subscriber->email = Input::get('email');
        $subscriber->save();
        $lists = Input::get('list');
        if(empty($lists)){
            foreach ($subscribtions as $subscribtion) {
                    $subscribtion->delete();

            }
        }else {
            foreach ($lists as $list) {
                $subscribtion = $subscribtions->where('list_id', '=', $list)->first();
                if ($subscribtion === null) {
                    $sub = new Subscribtions();
                    $sub->subscribers_id = $id;
                    $sub->list_id = $list;
                    $sub->save();
                }
            }

            foreach ($subscribtions as $subscribtion) {
                if (!in_array($subscribtion->list_id, $lists)) {
                    //delete record
                    $subscribtion->delete();

                }

            }
        }
        return Redirect::to('subscribers');
    }


    public function submit(Request $request)
    {

        //TODO: check ajax requests
        $validation = Validator::make(Input::all(), array(
                //email field should be required, should be in an email//format, and should be unique
                'email' => 'required|email|unique:subscribers,email'
            )
        );

        if ($validation->fails()) {
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
