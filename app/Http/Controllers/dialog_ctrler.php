<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use DB;

class dialog_ctrler extends Controller
{
	public function showDia()
	{
		$dialogs = DB::table('dialog')->orderBy('ocassion')->get();
		return view('diamanage',['dialogs'=>$dialogs]);
	}

	public function manageDia($ocassion)
	{
		$dialogs = DB::table('dialog')->orderBy('ocassion')->get();
		return view('diamanage',['dialogs'=>$dialogs]);
	}
}
