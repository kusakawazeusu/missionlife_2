<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Activity;
use App\Http\Requests;
use Auth;

class ActivityController extends Controller
{
    //確認否登入狀態
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function showNewactivity()
    {
        return view('newactivity');
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
        
        $activity = new Activity;
        $activity->name = $request->name;
        $activity->creator = Auth::user()->name;
        $activity->apply_start_at = $request->apply_start_at;
        $activity->apply_end_at = $request->apply_end_at;
        $activity->execute_start_at = $request->execute_start_at;
        $activity->execute_end_at = $request->execute_end_at;
        $activity->place = $request->place;
        $activity->description = $request->description;
        $activity->admission_fee = $request->admission_fee;
        $activity->participate_award = $request->participate_award;
        $activity->point = $request->point;
        $activity->max_people = $request->max_people;
        $activity->now_apply_people = 0;
        $activity->actual_completed_people = 0;
        $activity->other_description = $request->other_description;
        $activity->status = 0;
        $activity->save();
        
        return redirect('/');
    }
}
