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
    return view('index');
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

/*
 * Lists
 */

Route::get('lists', 'ListsController@index');

//test

Route::get('test','TestController@index');
