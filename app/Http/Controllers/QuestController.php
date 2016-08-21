<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Collection;
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
    public function confQRcode_generate($id){
        $quest = DB::table('quest')->where('id',$id)->get();
        $url = url('checkconf',$id);
        return view('confQRcode',['url'=>$url,'quest'=>$quest]);
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
    public function showSearchWork(){
        return view('search_work');
    }
    public function SearchWorkResult(Request $request){

        $messages = [
            // 'point.required_with' => '兩個欄位必需同時填入！',
            'required_with' => '兩個欄位必需同時填入！',
            'integer' => '請輸入整數！',
            'min' => '請輸入「大於等於」:min的數字！',
            'point.max' => '請輸入「小於等於」另一個欄位的數字！',
            'max' => '請輸入「小於等於」:max的數字！',
            'after_equal'=>'必須在前一項之後(含當天)！'
        ];
        $this->validate($request,[
            'point' => 'required_with:point_2|integer|min:0|max:'.$request->point_2,
            'point_2' => 'required_with:point|integer|min:0|max:1000',
            'start_date' => 'required_with:start_date_2',
            'start_date_2' => 'required_with:start_date|after_equal:start_date',
            'end_date' => 'required_with:end_date_2',
            'end_date_2' => 'required_with:end_date|after_equal:end_date'
            ],$messages);

        // $quests=collect([]);

        // echo '標題     = '.$request->title.'<br>';
        // echo '發佈單位 = '.$request->creator.'<br>';
        // echo "開始時間 = ".$request->start_date.'~'.$request->start_date_2.'<br>';
        // echo "結束時間 = ".$request->end_date.'~'.$request->end_date_2.'<br>';
        // echo "描述     = ".$request->description.'<br>';
        // echo "點數     = ".$request->point.'~'.$request->point_2.'<br>';
        // echo "page = ".$request->page.'<br>';

                // test pagination
        // $search_pattern = '%'.$request->description.'%';
        // $quests=Quest::where('description','like',$search_pattern)->paginate(10);
                // return $quests->count(); 10
        // $quests->lastPage();
        // return view('search_work_result',['quests'=>$quests]);  
// if ($request->page == 0) {
        $quests = Quest::where('catalog',0)->get();
        if ($quests->isEmpty()) {
                return redirect()->route('work')->with('action','search_work_not_found');
            }

        if($request->has('title')){
            /*$search_pattern = '%'.$request->title.'%';
            $quests=Quest::where('name','like',$search_pattern)->get();*/
            $quests = $quests->filter(function($quest) use ($request){
                if(stripos($quest->name, $request->title)===false){
                    return false;
                }
                else{
                    return true;
                }
            });
            // echo('title有輸入<br>');
            if ($quests->isEmpty()) {
                //執行到這裡代表完全找不到結果
                // return '找不到結果';
                return redirect()->route('work')->with('action','search_work_not_found');
            }
            
            /*//使用chunk是為了以後如果quest很大量，可以分批執行避免等database等太久
            Quest::where('name','like',$search_pattern)->chunk(200,function($quests){
            foreach ($quests as $quest) {
                echo $quest->name."<br>";
            }    
            });*/    
        }
        else{
            // echo ("標題空白"."<br>");
        }

        if ($request->has('creator')) {
            /*if ($quests->isEmpty()) {
                $search_pattern = '%'.$request->creator.'%';
                $quests=Quest::where('creator','like',$search_pattern)->get();
                echo('creator之前都沒輸入<br>');
                if ($quests->isEmpty()) {
                    //執行到這裡代表完全找不到結果 
                    return '找不到結果';
                }
            }*/
            //else{//filter是collection class的method,return true代表要這個data
                $quests = $quests->filter(function($quest) use ($request){
                    if(stripos($quest->creator, $request->creator)===false){
                        return false;
                    }
                    else{
                        return true;
                    }
                });
                // echo('creator有輸入<br>');
                if ($quests->isEmpty()) {
                    //執行到這裡代表完全找不到結果
                    return redirect()->route('work')->with('action','search_work_not_found');
                }
            //}
        }
        else{
            // echo ("發佈單位空白"."<br>");
        }

        if ($request->has('start_date')) {
            /*if ($quests->isEmpty()) {
                $quests = Quest::where([
                    ['start_at','>=',$request->start_date.''],
                    ['start_at','<=',$request->start_date_2.'']
                ])->get();
                echo ("start_date之前沒輸入<br>");
                if ($quests->isEmpty()) {
                    //執行到這裡代表完全找不到結果
                    return '找不到結果';
                }
            }
            else{*/
                $start_date = Carbon::createFromFormat('Y/m/d',$request->start_date);
                $start_date_2 = Carbon::createFromFormat('Y/m/d',$request->start_date_2);
                $quests = $quests->filter(function($quest) use ($start_date,$start_date_2){
                    $start_at = Carbon::createFromFormat('Y-m-d',$quest->start_at);
                    return ($start_at->between($start_date,$start_date_2));
                });//終於知道怎麼把變數傳進function...
                //時間比較會出錯 因為$request傳進來的是斜線 但是$quest裡的是'-' 因此改用carbon來比較
                //如果最後有效能問題再改view的格式吧 改成yyyy-mm-dd
                // echo ("start_date有輸入<br>");
                if ($quests->isEmpty()) {
                    //執行到這裡代表完全找不到結果
                    return redirect()->route('work')->with('action','search_work_not_found');
                }
            //}
        }
        else{
            // echo ("開始日期空白"."<br>");
        }

        if ($request->has('end_date')) {
            // if ($quests->isEmpty()) {
            //     $quests = Quest::where([
            //         ['end_at','>=',$request->end_date.''],
            //         ['end_at','<=',$request->end_date_2.'']
            //     ])->get();
            //     echo ("end_date之前沒輸入<br>");
            //     if ($quests->isEmpty()) {
            //         //執行到這裡代表完全找不到結果
            //         return '找不到結果';
            //     }
            // }
            // else{
                $end_date = Carbon::createFromFormat('Y/m/d',$request->end_date);
                $end_date_2 = Carbon::createFromFormat('Y/m/d',$request->end_date_2);
                $quests = $quests->filter(function($quest) use ($end_date,$end_date_2){
                    $end_at = Carbon::createFromFormat('Y-m-d',$quest->end_at);
                    return ($end_at->between($end_date,$end_date_2));
                });//終於知道怎麼把變數傳進function...
                //時間比較會出錯 因為$request傳進來的是斜線 但是$quest裡的是'-' 因此改用carbon來比較
                //如果最後有效能問題再改view的格式吧 改成yyyy-mm-dd
                // echo ("end_date有輸入<br>");
                if ($quests->isEmpty()) {
                    //執行到這裡代表完全找不到結果
                    return redirect()->route('work')->with('action','search_work_not_found');
                }
            // }
        }
        else{
            // echo ("結束日期空白"."<br>");
        }

        if($request->has('description')){
            // $search_pattern = '%'.$request->description.'%';
            // if ($quests->isEmpty()) {
            //     $quests=Quest::where('description','like',$search_pattern)->get();
            //     // $quests = $quests->forPage($_GET['page'],10);
            //     // return view('search_work_result',['quests'=>$quests]);
                
            //     // test pagination
            //     // $quests=Quest::where('description','like',$search_pattern)->paginate(10);
            //     // return $quests->count(); 10
            //     // return view('search_work_result',['quests'=>$quests]);             

            //     echo('description之前都沒輸入<br>');
            //     if ($quests->isEmpty()) {
            //         //執行到這裡代表完全找不到結果 要加這個是避免後面的程式碼以為description沒輸入
            //         return '找不到結果';
            //     }
            // }
            // else{
                $quests = $quests->filter(function($quest) use ($request){
                    if(stripos($quest->description, $request->description)===false){
                        return false;
                    }
                    else{
                        return true;
                    }
                });
                // echo('description有輸入<br>');
                if ($quests->isEmpty()) {
                    //執行到這裡代表完全找不到結果
                    return redirect()->route('work')->with('action','search_work_not_found');
                }
            // }
        }
        else{
            // echo ("描述空白"."<br>");
        }
        if($request->has('point')){
            // if ($quests->isEmpty()) {
            //     $quests=Quest::where([
            //         ['point','>=',$request->point.''],
            //         ['point','<=',$request->point_2.'']
            //     ])->get();
            //     echo ("point之前沒輸入<br>");
            //     if ($quests->isEmpty()) {
            //         //執行到這裡代表完全找不到結果
            //         return '找不到結果';
            //     }
            // }
            // else{
                $quests = $quests->filter(function($quest) use ($request){
                    return (($quest->point >= $request->point) && ($quest->point <= $request->point_2));
                });//終於知道怎麼把變數傳進function...
                // echo ("point有輸入<br>");
                if ($quests->isEmpty()) {
                    //執行到這裡代表完全找不到結果
                    return redirect()->route('work')->with('action','search_work_not_found');
                }
            // }
        }
        else{
            // echo ("點數空白"."<br>");
        }

        // $quests = $quests->forPage(4,10); //forPage拿來做pagination用的 不過目前遇到瓶頸..
        $quests = $quests->values();
        //values()是拿來將collection reindex，因為之前的filter會造成index不連續
        $mission_require = DB::table('mission_require')->get();  // 從資料庫抓取工讀條件
        $ums = DB::table('um')->where('user_id',Auth::user()->id)->get();  // 從資料庫抓取使用者-工讀資料

        return view('search_work_result',[
            'quests'=>$quests,
            'ums'=>$ums,
            'mission_require'=>$mission_require]);
        
        foreach ($quests as $quest) {
            echo '<span style="color:red">name</span> = '.$quest->name."<br>"
            .'<span>creator</span> = '.$quest->creator."<br>"
            .'<span style="color:rgb(102, 153, 153)">start_at</span> = '.$quest->start_at."<br>"
            .'<span style="color:brown">end_at</span> = '.$quest->end_at."<br>"
            .'<span style="color:green">description</span> = '.$quest->description."<br>"
            .'<span style="color:orange">point</span> = '.$quest->point."<br>"
            .'<span style="color:blue">catalog</span> = '.$quest->catalog."<br>"
            ."<br>";
        }//顯示搜尋結果

        return 'count = '.$quests->count().'<br>success';
        // return redirect('/work/search/result/show',['quests'=>$quests]);
        // return redirect()->action('QuestController@showSearchWorkResult', ['quests' => $quests]);
        // return redirect()->route('showsearchresult',['quests'=>$quests]);
    }
}
