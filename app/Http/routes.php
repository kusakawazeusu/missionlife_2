<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

//Mail::raw('Laravel with Mailgun is easy!', function($message)
//{
//    $message->to('foo@example.com');
//});

Route::get('/', function () {
    return view('index');
});

Route::get('/active', function () {
	$users = DB::table('users')->get();
    return view('layouts.partials.active',['users' => $users]);
});

Route::get('/active/{key}',['as' => 'active.key', function ($key) {
    return view('layouts.partials.activeform');
}]);


Route::get('/test', function () {
    return view('welcome');
});

Route::get('/about/{id}',['as' => 'about.id', function ($id) {
    return 'Hello'.$id;
}]);

Route::auth();

Route::get('/home', 'HomeController@index');

