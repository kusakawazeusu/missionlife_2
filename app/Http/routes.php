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

Route::get('/quest', function () {
    return view('quest');
});

Route::get('/newquest', function () {
    return view('newquest');
});

Route::get('/account', function () {
    return view('account');
});

Route::get('/work', function () {
    $quests = DB::table('quest')->where('catalog','0')->get();
    return view('work',['quests' => $quests]);
});

Route::get('/activity', function () {
    $quests = DB::table('quest')->where('catalog','1')->get();
    return view('activity',['quests' => $quests]);
});

Route::get('/conf', function () {
    $quests = DB::table('quest')->where('catalog','2')->get();
    return view('conf',['quests' => $quests]);
});

Route::get('/', function () {
    $dialogs = DB::table('dialog')->where('ocassion','first_time')->get();

    return view('index',['dialogs' => $dialogs]);
});

Route::post('/active_check','mission@user_active');

Route::get('/active', function () {
	$users = DB::table('users')->get();
    return view('layouts.partials.active',['users' => $users]);
});


Route::get('/active/{key}',function ($key) {
	if(Auth::user()->active_key == $key)
	{
		DB::table('users')->where('active_key',$key)->update(['activation'=>true]);
    }
    return view('layouts.partials.activeform',['key'=>$key]);
});


Route::get('/newdia', function () {
    return view('newdialog');
});

Route::get('/about/{id}',['as' => 'about.id', function ($id) {
    return 'Hello'.$id;
}]);

Route::auth();

Route::get('/home', 'HomeController@index');

