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

/*
 * Newsletters
 */

Route::get('newsletters', 'NewslettersController@index');

/*
 * Lists
 */

Route::get('lists', 'ListsController@index');

//test

Route::get('test','TestController@index');
