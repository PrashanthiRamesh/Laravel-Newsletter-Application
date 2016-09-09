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

/*
 * Authentication
 */


Route::get('login', array('uses' => 'HomeController@showLogin'));

Route::post('login', array('uses' => 'HomeController@doLogin'));

Route::get('logout', array('uses' => 'HomeController@doLogout'));

/*
 * Home Page
 */

Route::get('home', function () {
    return view('home');
});

/*
 * Subscribers
 */

Route::get('subscribers', 'SubscribersController@get');
Route::get('subscribe', 'SubscribersController@index');

Route::post('subscribe/submit', 'SubscribersController@submit');

Route::get('/subscriber/edit/{id}',[
    'uses' => 'SubscribersController@edit_show',
    'as'   => 'subscriber_edit'
]);

Route::post('/subscriber/edit/{id}',[
    'uses' => 'SubscribersController@edit',
    'as'   => 'subscriber_edit'
]);

Route::get('subscriber/delete/{id}', [
    'uses' => 'SubscribersController@delete_show',
    'as' => 'subscriber_delete'
]);



/*
 * Newsletters
 */

Route::get('/newsletters', 'NewslettersController@index');

Route::get('newsletter/new', 'NewslettersController@new_newsletter');
Route::post('newsletter/new', 'NewslettersController@create');

Route::get('/newsletter/edit/{id}',[
    'uses' => 'NewslettersController@edit_show',
    'as'   => 'newsletter_edit'
]);

Route::post('/newsletter/edit/{id}',[
    'uses' => 'NewslettersController@edit',
    'as'   => 'newsletter_edit'
]);

Route::get('/newsletter/send/{id}',[
    'uses' => 'NewslettersController@send',
    'as'   => 'newsletter_send'
]);

Route::post('/newsletter/send',[
    'uses' => 'NewslettersController@send_mail',
    'as'   => 'newsletter_sendmail'
]);

Route::get('/newsletter/preview/{id}',[
    'uses' => 'NewslettersController@preview',
    'as'   => 'newsletter_preview'
]);

Route::get('/newsletter/delete/{id}',[
    'uses' => 'NewslettersController@delete',
    'as'   => 'newsletter_delete'
]);

/*
 * Lists
 */

Route::get('lists', 'ListsController@index');

Route::get('list/new', 'ListsController@newlist');

Route::post('list/new', 'ListsController@create');

Route::get('/list/edit/{id}',[
    'uses' => 'ListsController@edit_show',
    'as'   => 'lists_edit'
]);

Route::post('/list/edit/{id}',[
    'uses' => 'ListsController@edit',
    'as'   => 'list_edit'
]);

Route::get('list/delete/{id}', [
    'uses' => 'ListsController@delete_show',
    'as' => 'list_delete'
]);

//test

Route::get('test','TestController@index');
