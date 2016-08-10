<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Quest;
use App\Http\Requests;
use Auth;
use DB;
use Carbon\Carbon;

class QuestController extends Controller
{
	//確認否登入狀態
	public function __construct()
	{
    	$this->middleware('auth');
	}
    //
    public function howfar($date)
    {
        $pieces = explode("-",$date);
        $diff = Carbon::today()->diffInDays(Carbon::create($pieces[0],$pieces[1],$pieces[2],0),false);
        return abs($diff);
    }
    public function showQuestCommand($quest_id)
    {
        $quest_data = DB::table('quest')
                        ->where('id',$quest_id)
                        ->first();

        $commands = DB::table('command')
                        ->where('quest_id',$quest_id)
                        ->join('users','command.author_id','=','users.id')
                        ->select('*','command.created_at as created_at')
                        ->get();

        $workers = DB::table('um')
                    ->where('quest_id',$quest_id)
                    ->where('status',1)
                    ->join('users','um.user_id','=','users.id')
                    ->get();

        return view('questcommand',['quest'=>$quest_data,'commands'=>$commands,'workers'=>$workers]);
    }
    public function storeQuestCommand($quest_id,Request $request)
    {
        DB::table('command')
            ->insert([
                "quest_id"=>$quest_id,
                "author_id"=>Auth::user()->id,
                "author_identity"=>Auth::user()->auth,
                "context"=>$request['command_text'],
                "created_at"=>Carbon::now()
                ]);

            /*
        $the_users = DB::table('um')
                        ->where('quest_id',$quest_id)
                        ->select('user_id')
                        ->get();

        foreach($the_users as $the_user)
        {
        DB::table('message')
            ->insert([
                "user_id"=>$the_user,
                "content"=>"任務有新通知！"
                ]);
        }
            */
        
        return redirect()->back();
    }

    public function pointQuest($quest_id,$user_id)
    {
        $the_mission = DB::table('quest')
                            ->where('id',$quest_id)
                            ->first();

        if(Auth::user()->name == $the_mission->creator)
        {
            $the_relationship = DB::table('um')
                                    ->where('user_id',$user_id)
                                    ->where('quest_id',$quest_id)
                                    ->update(['status'=>1]);

            DB::table('quest')
                ->where('id',$quest_id)
                ->update(['activation'=>2]);

           

            DB::table('message')->insert(
                ['user_id'=>$user_id, 'content'=>"恭喜！你已經通過任務<b>".$the_mission->name."</b>的審核！請稍待NPC下達任務指示！", 'read'=>'0']
                );
            
            return redirect()->back();
        }

    }
    public function showQuestmanage()
    {
        $now = Carbon::today();
        $quests_now = DB::table('quest')->where('creator',Auth::user()->name)->where('start_at','<=',$now)->get();
        $quests_before = DB::table('quest')->where('creator',Auth::user()->name)->where('start_at','>',$now)->get();
        $quests_finished = DB::table('quest')->where('creator',Auth::user()->name)->where('activation',0)->get();

        if(count($quests_now))
        {
            for($i=0;$i<count($quests_now);$i++)
                $applies[$quests_now[$i]->name] = DB::table('quest')
                                                ->where('id',$quests_now[$i]->id)
                                                ->join('um','quest.id','=','um.quest_id')
                                                ->where('um.status',0)
                                                ->count();
        }
        else
        {
            $applies = 0;
        }
        return view('questmanage',['quests_now'=>$quests_now,'quests_before'=>$quests_before,'quests_finished'=>$quests_finished,'applies'=>$applies]);
    }
    public function showQuestUpdate($id){
        $quest = Quest::find($id);
        return view('quest_update',['quest'=>$quest]);
    }
    public function quest_update(Request $request,$id){
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
        
        $quest = Quest::find($id);
        $quest->name = $request->title;
        $quest->start_at = $request->start_date;
        $quest->end_at = $request->end_date;
        $quest->description = $request->description;
        $quest->salary = $request->salary;
        $quest->workforce = $request->workforce;//人數
        $quest->save();
        
        return redirect('/questmanage/'.$id);
    }
    public function showTrail($id)
    {
        $quests = DB::table('quest')
                    ->where('quest.id',$id)
                    ->join('um','quest.id','=','um.quest_id')
                    ->join('users','um.user_id','=','users.id')
                    ->join('departments','users.department_id','=','departments.id')
                    ->select('*','quest.name as name','quest.id as quest_id','users.name as user_name','users.id as user_id','departments.name as user_department')
                    ->get();

        return view('questtrail',['quests'=>$quests]);
    }
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
