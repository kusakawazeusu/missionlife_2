<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Http\Requests;

class mission extends Controller
{
    public function store(Request $request)
    {
        $messages = [
            'required' => '這個欄位是必填的！',
        ];

        $this->validate($request, [
        'ocassion'=> 'required',
    	],$messages);

        $order = DB::table('dialog')->where('ocassion',$request['ocassion'])->max('ordered');
        $order = $order + 1;

    	DB::table('dialog')->insert(
    		['ordered'=>$order,'ocassion'=>$request['ocassion'],'pic_path'=>$request['pic_path'],'name'=>$request['name'],'context'=>$request['context']]
    		);

    	return view('newdialog',['success'=>1]);
    }

    public function create($success=null)
    {
    	return view('newdialog',['success'=>0]);
    }
}
