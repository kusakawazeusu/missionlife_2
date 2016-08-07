<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Um;
use App\Http\Requests;
use Auth;
use DB;
use Carbon\Carbon;

class UmController extends Controller
{
    //確認否登入狀態
	public function __construct()
	{
    	$this->middleware('auth');
	}

    public function getwork($id)
    {        
        $pieces = explode("-",DB::table('quest')->where('id',$id)->value('start_at'));
        $diff = Carbon::today()->diffInDays(Carbon::create($pieces[0],$pieces[1],$pieces[2],0),false);

        $end = explode("-",DB::table('quest')->where('id',$id)->value('end_at'));
        $diff_end = Carbon::today()->diffInDays(Carbon::create($end[0],$end[1],$end[2],0),false);

        if( $diff > 0 )
        {
            echo "<script>alert('目前還不能承接這個任務唷！距離報名日期還有".$diff."天呢！');location.href = '/work';</script>";
        }
        else if ( $diff_end < 0 )
        {
            echo "<script>alert('這個任務已經不能承接囉！在".abs($diff_end)."天之前就已經過期了呢！');location.href = '/work';</script>";
        }
        else
        {
    	   $um = new Um;
    	   $um->user_id = Auth::user()->id;
    	   $um->quest_id = $id;
    	   $um->status = 0;
    	   $um->save();

           $content = "「".DB::table('quest')->where('id',$id)->value('name')."」任務接洽成功囉！請稍待NPC審核！";
           DB::table('message')->insert(['user_id'=>Auth::user()->id,'content'=>$content,'read'=>0,'address'=>'account']);

    	   return redirect()->route('work')->with('action','success');
        }
    }
    public function cancelwork($id)
    {
    	DB::table('um')->where('user_id', Auth::user()->id)->where('quest_id', $id)->delete();
    	return redirect()->route('work')->with('action','failed');
    }

    public function getactivity($id)
    {
    	$um = new Um;
    	$um->user_id = Auth::user()->id;
    	$um->quest_id = $id;
    	$um->status = 0;
    	$um->save();
    	return redirect('/activity');
    }
    public function cancelactivity($id)
    {
    	DB::table('um')->where('user_id', Auth::user()->id)->where('quest_id', $id)->delete();
    	return redirect('/activity');
    }

    public function getconf($id)
    {
    	$um = new Um;
    	$um->user_id = Auth::user()->id;
    	$um->quest_id = $id;
    	$um->status = 0;
    	$um->save();
    	return redirect('/conf');
    }
    public function cancelconf($id)
    {
    	DB::table('um')->where('user_id', Auth::user()->id)->where('quest_id', $id)->delete();
    	return redirect('/conf');
    }
}
