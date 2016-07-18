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
		$dialogs = DB::table('dialog')->where('ocassion',$ocassion)->orderBy('ordered')->get();
		return view('diachange',['dialogs'=>$dialogs]);
	}

	public function orderUp($ocassion,$ordered)
	{
		$id_1 = DB::table('dialog')->where('ordered',$ordered)->value('id');
		$id_2 = DB::table('dialog')->where('ordered',$ordered-1)->value('id');

		DB::table('dialog')->where('id',$id_1)->update(['ordered'=>$ordered-1]);
		DB::table('dialog')->where('id',$id_2)->update(['ordered'=>$ordered]);

		$dialogs = DB::table('dialog')->where('ocassion',$ocassion)->orderBy('ordered')->get();

		return redirect()->route('manageDia',['ocassion'=>$ocassion]);
	}
	
	public function orderDown($ocassion,$ordered)
	{
		$id_1 = DB::table('dialog')->where('ordered',$ordered)->value('id');
		$id_2 = DB::table('dialog')->where('ordered',$ordered+1)->value('id');

		DB::table('dialog')->where('id',$id_1)->update(['ordered'=>$ordered+1]);
		DB::table('dialog')->where('id',$id_2)->update(['ordered'=>$ordered]);

		$dialogs = DB::table('dialog')->where('ocassion',$ocassion)->orderBy('ordered')->get();

		return redirect()->route('manageDia',['ocassion'=>$ocassion]);
	}

	public function diaDel($ocassion,$ordered)
	{
		$times = DB::table('dialog')->where('ocassion',$ocassion)->max('ordered') - $ordered;

		DB::table('dialog')->where('ordered',$ordered)->delete();

		if($ordered != DB::table('dialog')->where('ocassion',$ocassion)->max('ordered'))
		{
			for($i=1;$i<=$times;$i++)
				DB::table('dialog')->where('ordered',$ordered+$i)->update(['ordered'=> $ordered+$i-1]);
		}
		return redirect()->route('manageDia',['ocassion'=>$ocassion]);
	}
	
}
