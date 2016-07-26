<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Um;
use App\Http\Requests;
use Auth;
use DB;

class UmController extends Controller
{
    //確認否登入狀態
	public function __construct()
	{
    	$this->middleware('auth');
	}

    public function getwork($id)
    {
    	$um = new Um;
    	$um->user_id = Auth::user()->id;
    	$um->quest_id = $id;
    	$um->status = 0;
    	$um->save();
    	return redirect('/work');
    }
    public function cancelwork($id)
    {
    	DB::table('um')->where('user_id', Auth::user()->id)->where('quest_id', $id)->delete();
    	return redirect('/work');
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
