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
use Carbon\Carbon;

//Mail::raw('Laravel with Mailgun is easy!', function($message)
//{
//    $message->to('foo@example.com');
//});
Route::get('/time', function () {
    $pieces = explode("-",DB::table('quest')->where('id',57)->value('start_at'));
    $diff = Carbon::today()->diffInDays(Carbon::create($pieces[0],$pieces[1],$pieces[2],0),false);

    if( $diff > 0 )
    {
        echo "<script>alert('目前還不能承接這個任務唷！距離報名日期還有".$diff."天呢！');</script>";
        //return redirect('/work');
    }

    return $diff;
});

Route::get('/update',function(){
    DB::table('message')->where('user_id',Auth::user()->id)->update(['read'=>1]);
    return redirect()->back();
});



Route::get('/diamanage','dialog_ctrler@showDia');
Route::get('/diamanage/{ocassion}','dialog_ctrler@manageDia')->name('manageDia');
Route::get('/diamanage/{ocassion}/{ordered}/up','dialog_ctrler@orderUp');
Route::get('/diamanage/{ocassion}/{ordered}/down','dialog_ctrler@orderDown');
Route::get('/diamanage/{ocassion}/{id}/delete','dialog_ctrler@diaDel');

Route::get('/quest', function () {
    return view('quest');
});

Route::get('/newquest', function () {
    return view('newquest');
});
Route::post('/newquest','QuestController@store');



Route::get('/account', function () {
    
    $ums = DB::table('um')->where('user_id',Auth::user()->id)->get();

    if( count($ums) == 0 )
    {
        return view('account',['ums' => $ums,'no_quest'=>'1']);
    }
    else
    {
        for($i=0;$i<count($ums);$i++)
        {
            $quests = DB::table('quest')->where('id',$ums[$i]->quest_id)->get();
        }
    
        return view('account',['ums' => $ums,'quests'=>$quests,'no_quest'=>'0']);
    }
});
Route::patch('/account/{id}','UserController@update');

Route::get('/account/change_img',function(){
    return view('change_img');
});
Route::post('/account/change_img/{id}','UserController@change_img');

Route::get('/work',['as'=>'work', function () {
    $quests = DB::table('quest')->where('catalog','0')->get();
    $mission_require = DB::table('mission_require')->get();
    $ums = DB::table('um')->where('user_id',Auth::user()->id)->get();
    return view('work',['quests' => $quests, 'ums' => $ums, 'mission_require' => $mission_require]);
}]);

Route::get('/work/get/{id}','UmController@getwork');
Route::get('/work/cancel/{id}','UmController@cancelwork');


Route::get('/activity', function () {
    $quests = DB::table('quest')->where('catalog','1')->get();
    $ums = DB::table('um')->where('user_id',Auth::user()->id)->get();
    return view('activity',['quests' => $quests, 'ums' => $ums]);
});

Route::get('/activity/orderbytitle', function () {
    $quests = DB::table('quest')->where('catalog','1')->orderBy('name')->get();
    $ums = DB::table('um')->where('user_id',Auth::user()->id)->get();
    return view('activity',['quests' => $quests, 'ums' => $ums]);
});

Route::get('/activity/orderbynpc', function () {
    $quests = DB::table('quest')->where('catalog','1')->orderBy('creator')->get();
    $ums = DB::table('um')->where('user_id',Auth::user()->id)->get();
    return view('activity',['quests' => $quests, 'ums' => $ums]);
});

Route::get('/activity/orderbystart', function () {
    $quests = DB::table('quest')->where('catalog','1')->orderBy('start_at')->get();
    $ums = DB::table('um')->where('user_id',Auth::user()->id)->get();
    return view('activity',['quests' => $quests, 'ums' => $ums]);
});

Route::get('/activity/orderbyend', function () {
    $quests = DB::table('quest')->where('catalog','1')->orderBy('end_at')->get();
    $ums = DB::table('um')->where('user_id',Auth::user()->id)->get();
    return view('activity',['quests' => $quests, 'ums' => $ums]);
});

Route::get('/activity/orderbypoint', function () {
    $quests = DB::table('quest')->where('catalog','1')->orderBy('point')->get();
    $ums = DB::table('um')->where('user_id',Auth::user()->id)->get();
    return view('activity',['quests' => $quests, 'ums' => $ums]);
});

Route::get('/activity/orderbysalary', function () {
    $quests = DB::table('quest')->where('catalog','1')->orderBy('salary')->get();
    $ums = DB::table('um')->where('user_id',Auth::user()->id)->get();
    return view('activity',['quests' => $quests, 'ums' => $ums]);
});

Route::get('/activity/get/{id}','UmController@getactivity');
Route::get('/activity/cancel/{id}','UmController@cancelactivity');

Route::get('/conf', function () {
    $quests = DB::table('quest')->where('catalog','2')->get();
    $ums = DB::table('um')->where('user_id',Auth::user()->id)->get();
    return view('conf',['quests' => $quests, 'ums' => $ums]);
});
Route::get('/conf/get/{id}','UmController@getconf');
Route::get('/conf/cancel/{id}','UmController@cancelconf');

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

Route::post('/newdia','mission@store')->name('newdia');
Route::get('/newdia','mission@create');


Route::get('/about/{id}',['as' => 'about.id', function ($id) {
    return 'Hello'.$id;
}]);

Route::auth();

Route::get('/home', 'HomeController@index');

