<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Quest;
use App\Http\Requests;
use Auth;
use DB;

class QuestController extends Controller
{
	//確認否登入狀態
	public function __construct()
	{
    	$this->middleware('auth');
	}
    //
    public function showNewquest()
    {
        return view('newquest');
    }
    public function showQuestlobby()
    {
        return view('quest');
    }
    public function showWork()
    {
        $quests = DB::table('quest')->where('catalog','0')->get();  // 從資料庫抓取工讀資料
        $mission_require = DB::table('mission_require')->get();  // 從資料庫抓取工讀條件
        $ums = DB::table('um')->where('user_id',Auth::user()->id)->get();  // 從資料庫抓取使用者-工讀資料
        return view('work',['quests' => $quests, 'ums' => $ums, 'mission_require' => $mission_require]);
    }
    public function showActivity()
    {
        $quests = DB::table('quest')->where('catalog','1')->get();
        $ums = DB::table('um')->where('user_id',Auth::user()->id)->get();
        return view('activity',['quests' => $quests, 'ums' => $ums]);
    }
    public function showConf()
    {
        $quests = DB::table('quest')->where('catalog','2')->get();
        $ums = DB::table('um')->where('user_id',Auth::user()->id)->get();
        return view('conf',['quests' => $quests, 'ums' => $ums]);
    }

    public function store(Request $request)
    {

        //echo "<script>alert(".$request->re.")</script>";
        /*
        for($i=0;$i<count($request->require);$i++)
        {
            echo "Require[".$i."] = ".$request->require[$i]."<br>";
        }
        for($i=0;$i<count($request->eng_input);$i++)
        {
            echo "Eng_input[".$i."] = ".$request->eng_input[$i]."<br>";
        }
        for($i=0;$i<count($request->custom_input);$i++)
        {
            echo "Custom[".$i."] = ".$request->custom_input[$i]."<br>";
        }
        for($i=0;$i<count($request->jp_input);$i++)
        {
            echo "JP[".$i."] = ".$request->jp_input[$i]."<br>";
        }
        */
        
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

        for($i=0;$i<count($request->require);$i++)
        {
            if( $request->require[$i] == '多益TOEIC' || $request->require[$i] == '托福TOEFL' || $request->require[$i] == '雅思IELT' )
            {
                DB::table('mission_require')->insert([
                    'mission_id'=>DB::table('quest')->where('name',$request->title)->value('id'),
                    'require_catalog'=>$request->require[$i],
                    'require_parameter'=>$request->eng_input[$i]
                ]);
            }
            else if( $request->require[$i] == '日文檢定JLPT')
            {
                DB::table('mission_require')->insert([
                    'mission_id'=>DB::table('quest')->where('name',$request->title)->value('id'),
                    'require_catalog'=>$request->require[$i],
                    'require_parameter'=>$request->jp_input[$i]
                ]);
            }
            else if( $request->require[$i] == 'custom')
            {
                DB::table('mission_require')->insert([
                    'mission_id'=>DB::table('quest')->where('name',$request->title)->value('id'),
                    'require_catalog'=>$request->require[$i],
                    'require_parameter'=>$request->custom_input[$i]
                ]);
            }
        }

    	return redirect('/');
    }
}
