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

// 首頁
Route::get('/', function () {
    $dialogs = DB::table('dialog')->where('ocassion','first_time')->get();

    return view('index',['dialogs' => $dialogs]);
});

// 回報距離日期
Route::get('/howfar/{date}','QuestController@howfar');

// 更新「近期通知」的function
Route::get('/update','message@update');

// 對話內容控制
Route::get('/diamanage','dialog_ctrler@showDia');
Route::get('/diamanage/{ocassion}','dialog_ctrler@manageDia')->name('manageDia');
Route::get('/diamanage/{ocassion}/{ordered}/up','dialog_ctrler@orderUp');
Route::get('/diamanage/{ocassion}/{ordered}/down','dialog_ctrler@orderDown');
Route::get('/diamanage/{ocassion}/{id}/delete','dialog_ctrler@diaDel');

// 新對話
Route::post('/newdia','mission@store')->name('newdia');
Route::get('/newdia','mission@create');

// NPC增加新任務
Route::get('/newquest','QuestController@showNewquest');
Route::post('/newquest','QuestController@store');

// NPC管理任務
Route::get('/questmanage','QuestController@showQuestmanage');
Route::get('/questmanage/{id}','QuestController@showTrail');

// NPC修改任務
Route::get('/questmanage/{id}/update','QuestController@showQuestUpdate');
Route::post('/questmanage/{id}/update','QuestController@quest_update');

// NPC指派任務給使用者
Route::get('/questmanage/{quest_id}/{user_id}','QuestController@pointQuest');

// 任務指令頁面
Route::get('/questcommand/{quest_id}','QuestController@showQuestCommand');
Route::post('/questcommand/{quest_id}','QuestController@storeQuestCommand');

// 使用者資料
Route::get('/account','UserController@showAccount');
Route::patch('/account/{id}','UserController@update');

// 更換大頭貼
Route::get('/account/change_img','UserController@showChangeimg');
Route::post('/account/change_img/{id}','UserController@change_img');

// 修改密碼
Route::get('/account/change_pwd','UserController@showChangepwd');
Route::patch('/account/change_pwd/{id}','UserController@update_pwd');

// 任務大廳
Route::get('/quest','QuestController@showQuestlobby');

// 「工讀」介面
Route::get('/work',['as'=>'work','uses'=>'QuestController@showWork']);  // 顯示
Route::get('/work/get/{id}','UmController@getwork');  // 接取
Route::get('/work/cancel/{id}','UmController@cancelwork');  // 取消

// 「活動」介面
Route::get('/activity','QuestController@showActivity');
Route::get('/activity/get/{id}','UmController@getactivity');
Route::get('/activity/cancel/{id}','UmController@cancelactivity');

// 「講座」介面
Route::get('/conf','QuestController@showConf');
Route::get('/conf/get/{id}','UmController@getconf');
Route::get('/conf/cancel/{id}','UmController@cancelconf');
Route::get('/confQRcode/{id}','QuestController@confQRcode_generate');
Route::get('/checkconf/{id}','UmController@checkconf');

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

Route::auth();