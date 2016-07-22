<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Quest;
use App\Http\Requests;
use Auth;

class QuestController extends Controller
{
	//確認否登入狀態
	public function __construct()
	{
    	$this->middleware('auth');
	}
    //
    public function store(Request $request)
    {
        $messages = [
            'required' => '這個欄位是必填的！',
            'integer' => '必須是整數！',
            'min' => '須大於:min！',
            'after_equal'=>'必須在報名開始日期(含)之後！',
        ];

        $this->validate($request,[
            'title'=>'required',
            'start_date'=>'required',
            'end_date'=>'required|after_equal:start_date',
            'salary'=>'required|integer|min:120',
            'workforce'=>'required|integer|min:1',
            ],$messages);

    	$quest = new Quest;
    	$quest->name = $request->title;
    	$quest->creator = Auth::user()->name;
    	$quest->start_at = $request->start_date;
    	$quest->end_at = $request->end_date;
    	$quest->description = $request->description;
    	$quest->salary = $request->salary;
    	$quest->point = 10;
    	$quest->activation = 1;
    	$quest->workforce = $request->workforce;//人數
    	$quest->catalog = $request->catalog;
    	$quest->save();
    	return redirect('/');
    }
}
