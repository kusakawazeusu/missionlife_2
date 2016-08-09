<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Http\Requests;
use Auth;

class message extends Controller
{
    public function update()
    {
    	DB::table('message')->where('user_id',Auth::user()->id)->update(['read'=>1]);
    	return redirect()->back();
    }
}
