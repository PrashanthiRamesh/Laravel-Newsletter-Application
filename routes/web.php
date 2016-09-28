<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/


Route::group(['domain'=>'{subdomain}.syliuscommerce.com','middleware' => ['auth']], function () {


    /*
     * Home Page
     */

    Route::get('/', [
        'uses' => 'HomeController@get',
        'as' => 'sub'
    ]);
    /*
     * Settings
     */

    Route::get('settings/user', 'UserController@get');

    Route::post('settings/user', 'UserController@saveUser');

    Route::get('edit/user/{id}', [
        'uses' => 'UserController@forgotPassword',
        'as' => 'forgot_password'
    ]);


    Route::get('settings/queue', 'UserController@getqueue');

    /*
     * Subscribers
     */

    Route::get('subscribers', 'SubscribersController@get');
    Route::get('subscribe', 'SubscribersController@index');

    Route::post('subscribe/submit', 'SubscribersController@submit');

    Route::get('/subscriber/edit/{id}', [
        'uses' => 'SubscribersController@edit_show',
        'as' => 'subscriber_edit'
    ]);

    Route::post('/subscriber/edit/{id}', [
        'uses' => 'SubscribersController@edit',
        'as' => 'subscriber_edit_post'
    ]);

    Route::get('subscriber/delete/{id}', [
        'uses' => 'SubscribersController@delete_show',
        'as' => 'subscriber_delete'
    ]);


    /*
     * Senders
     */

    Route::get('sender/add', 'NewslettersController@add_sender');

    Route::post('sender/add', 'NewslettersController@verify_sender');

    Route::get('sender/change', 'NewslettersController@change_sender');

    Route::post('sender/change', 'NewslettersController@changesender');

    Route::get('sender/edit/{id}', [
        'uses' => 'NewslettersController@sender_edit',
        'as' => 'sender_edit'
    ]);

    Route::post('sender/edit', [
        'uses' => 'NewslettersController@senderEdit',
        'as' => 'sender_edit_post'
    ]);

    Route::get('/sender/delete/{id}', [
        'uses' => 'NewslettersController@sender_delete',
        'as' => 'sender_delete'
    ]);

    /*
     * Newsletters
     */

    Route::get('/newsletters', 'NewslettersController@index');

    Route::get('newsletter/new', 'NewslettersController@new_newsletter');
    Route::post('newsletter/new', 'NewslettersController@create');

    Route::get('/newsletter/edit/{id}', [
        'uses' => 'NewslettersController@edit_show',
        'as' => 'newsletter_edit'
    ]);

    Route::post('/newsletter/edit/{id}', [
        'uses' => 'NewslettersController@edit',
        'as' => 'newsletter_edit'
    ]);

    Route::get('/newsletter/send/{id}', [
        'uses' => 'NewslettersController@send',
        'as' => 'newsletter_send'
    ]);

    Route::post('/newsletter/send', [
        'uses' => 'NewslettersController@send_mail',
        'as' => 'newsletter_sendmail'
    ]);

    Route::get('/newsletter/preview/{id}', [
        'uses' => 'NewslettersController@preview',
        'as' => 'newsletter_preview'
    ]);

    Route::get('/newsletter/delete/{id}', [
        'uses' => 'NewslettersController@delete',
        'as' => 'newsletter_delete'
    ]);

    /*
     * Lists
     */

    Route::get('lists', 'ListsController@index');

    Route::get('list/new', 'ListsController@newlist');

    Route::post('list/new', 'ListsController@create');

    Route::get('/list/edit/{id}', [
        'uses' => 'ListsController@edit_show',
        'as' => 'lists_edit'
    ]);

    Route::post('/list/edit/{id}', [
        'uses' => 'ListsController@edit',
        'as' => 'list_edit'
    ]);

    Route::get('list/delete/{id}', [
        'uses' => 'ListsController@delete_show',
        'as' => 'list_delete'
    ]);



});



/*
 *  Fetch from queue and send mail
 */
Route::get('sendmail', 'HomeController@sendMail');

/*
 * Password Change
 */

Route::get('password/change/{id}', [
    'uses' => 'UserController@changePassword',
    'as' => 'change_password'
]);

Route::post('password/change/{id}', [
    'uses' => 'UserController@change',
    'as' => 'change_password'
]);


/**
 * Register User/Tenant
 */


Route::group(['middleware' => 'main'],function (){

    Route::get('register', function () {
        if(\DB::connection()->getDatabaseName())
        {
            echo "Connected sucessfully to database ".\DB::connection()->getDatabaseName().".";
        }
        return \Illuminate\Support\Facades\View::make('register');
    });

    Route::post('register', 'UserController@register');

    Route::get('subdomain', function (){
        $user_id = \Illuminate\Support\Facades\Auth::user()->id;
        $user = \App\User::where('id', $user_id)->first();
        $username = $user->username;
         return redirect()->route('sub', ['subdomain' => $username]);
    });


    /*
     * Authentication
     */


    Route::get('login', array('uses' => 'HomeController@showLogin'));

    Route::post('login', array('uses' => 'HomeController@doLogin'));

    Route::get('logout', array('uses' => 'HomeController@doLogout'));



});