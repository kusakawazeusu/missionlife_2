<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Lecture;
use App\Http\Requests;
use Auth;

class LectureController extends Controller
{
    //
    //確認否登入狀態
	public function __construct()
	{
    	$this->middleware('auth');
	}
    public function showNewlecture()
    {
        return view('newlecture');
    }
    public function store(Request $request)
    {
        
        $messages = [
            'required' => '這個欄位是必填的！',
            'integer' => '必須是整數！',
            'min' => '須大於:min！',
            'after_equal'=>'必須在報名開始日期(含)之後！',
            'execute_end_at.after_equal'=>'必須在活動開始日期(含)之後！',
        ];

        $this->validate($request,[
            'name'=>'required',
            'speaker'=>'required',
            'apply_start_at'=>'required',
            'apply_end_at'=>'required|after_equal:apply_start_at',
            'execute_start_at'=>'required|after_equal:apply_start_at',
            'execute_end_at'=>'required|after_equal:execute_start_at',
            'place'=>'required',
            'description'=>'required',
            'admission_fee'=>'required',
            'participate_award'=>'required',
            'point'=>'required|integer|min:1',
            'max_people'=>'required|integer|min:1',
            ],$messages);
        
        $lecture = new Lecture;
        $lecture->name = $request->name;
        $lecture->creator = Auth::user()->name;
        $lecture->speaker = $request->speaker;
        $lecture->apply_start_at = $request->apply_start_at;
        $lecture->apply_end_at = $request->apply_end_at;
        $lecture->execute_start_at = $request->execute_start_at;
        $lecture->execute_end_at = $request->execute_end_at;
        $lecture->place = $request->place;
        $lecture->description = $request->description;
        $lecture->admission_fee = $request->admission_fee;
        $lecture->participate_award = $request->participate_award;
        $lecture->point = $request->point;
        $lecture->max_people = $request->max_people;
        $lecture->now_apply_people = 0;
        $lecture->actual_completed_people = 0;
        $lecture->other_description = $request->other_description;
        $lecture->status = 0;
        $lecture->save();
        
        return redirect('/');
    }
}
