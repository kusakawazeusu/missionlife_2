@extends('layouts.main')

@section('title','任務大廳 - 工讀')

@section('dialog')
@endsection

@section('content')
	
	@if (Auth::guest())
		<div class="container-fluid">
			<!--<img class="img-responsive center-block" style="width:100%" alt="Responsive image" src="http://i.imgur.com/WL6lmMz.jpg"></img>-->
			<br>
			@include('layouts.partials.dialog',['dialogs' => $dialogs])
		</div>
	@elseif (Auth::user()->activation == 'false')
		<div class="alert alert-danger">
			唔喔！還沒完成「認證」的話，無法使用完整的Mission Life喔！點擊<a href="{{ url('/active') }}">這裡</a>完成認證吧！
		</div>
	@else
    <?php $cou = 1; ?>
    <!-- cou用在任務需求編號 -->

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>

    <script>
      //jquery here 拿來控制通知視窗
      $(document).ready(function(){

        @if(session()->has('action'))
          @if( session('action') == 'success' )
            $("#suc").fadeIn().delay(2000).animate({left:'-=400px',opacity:'0'},"slow");
          @elseif ( session('action') == 'failed' )
            $("#fail").fadeIn().delay(2000).animate({left:'-=400px',opacity:'0'},"slow");
          @elseif(session('action') == 'search_work_not_found')
            $("#not_found").fadeIn().delay(2000).animate({left:'-=400px',opacity:'0'},"slow");
          @endif
        @endif

      });
    </script>

    <div style="position:absolute;display:none;z-index:1" id="suc" class="col-md-3">
      <div class="alert alert-info">
        <i class="icon-thumbs-up icon-large"></i> 任務接取成功，請稍候審核！
      </div>
    </div>

    <div style="position:absolute;display:none;z-index:1" id="fail" class="col-md-3">
    <!-- 加了搜索任務按鈕後發現通知訊息會被breadcrumb連結蓋掉 因此加了z-index移到上層-->
      <div class="alert alert-danger">
        <i class="icon-frown icon-large"></i> 任務接取失敗！
      </div>
    </div>

    <div style="position:absolute;display:none;z-index:1" id="not_found" class="col-md-3">
      <div class="alert alert-danger">
        <i class="icon-question icon-large"></i> 找不到任務！
      </div>
    </div>

		@for($i=0; $i < count($quests); $i++)
		<div class="modal fade" id="quest{{$i}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
			<div class="modal-dialog" role="document">
    			<div class="modal-content">
      				<div class="modal-header">
        				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        				<h3 class="modal-title text-center" id="myModalLabel">任務詳細資訊</h3>
      				</div>
      				<div class="modal-body">	
      					<table class="table ">
      						<tr>
      							<td class="col-md-2">任務標題</td>
      							<td>{{ $quests[$i]->name }}</td>
      						</tr>
      						<tr>
      							<td>發佈單位</td>
      							<td>{{ $quests[$i]->creator }}</td>
      						</tr>
      						<tr>
      							<td>開始時間</td>
      							<td>{{ $quests[$i]->start_at }}</td>
      						</tr>
      						<tr>
      							<td>截止時間</td>
      							<td>{{ $quests[$i]->end_at }}</td>
      						</tr>
      						<tr>
      							<td>任務描述</td>
      							<td>{{ $quests[$i]->description }}</td>
      						</tr>
                  <tr>
                    <td>任務需求</td>
                    <td>

                      @for($j=0;$j<count($mission_require);$j++)
                        @if( $quests[$i]->id == $mission_require[$j]->mission_id && $mission_require[$j]->require_catalog != 'custom' ) <!-- custom是自訂義的意思? -->
                          {{ $cou++ }}.{{ $mission_require[$j]->require_catalog }} : {{ $mission_require[$j]->require_parameter }}<br>
                        @elseif( $quests[$i]->id == $mission_require[$j]->mission_id && $mission_require[$j]->require_catalog == 'custom' )
                          {{ $cou++ }}.{{ $mission_require[$j]->require_parameter }}<br>
                        @endif
                      @endfor
                      <?php $cou = 1; ?>

                    </td>
                  </tr>
      						<tr>
      							<td>薪資待遇</td>
      							<td>新台幣{{ $quests[$i]->salary }}元</td>
      						</tr>
      						<tr>
      							<td>獎勵點數</td>
      							<td>{{ $quests[$i]->point }}點</td>
      						</tr>
      						<tr>
      							<td>人數需求</td>
      							<td>{{ $quests[$i]->workforce }}人</td>
      						</tr>
      					</table>
      				</div>
      				<div class="modal-footer">
                @for($j=0; $j < count($ums) && $ums[$j]->quest_id != $quests[$i]->id; $j++)
                @endfor
                @if($j < count($ums))
                  @if($ums[$j]->status == 1)
                    <button type="button" class="btn btn-info">已完成此任務</button>
                  @else
                    <a href="/work/cancel/{{$quests[$i]->id}}"><button type="button" class="btn btn-danger">放棄此任務</button></a>
                  @endif
                @else
        				  <a class="btn btn-danger" href="/work/get/{{$quests[$i]->id}}">接下此任務</a>
                @endif
        				<button type="button" class="btn btn-default" data-dismiss="modal">關閉</button>
    				</div>
   				</div>
			</div>
		</div>
		@endfor

		<div class="container">
    <div class="row">
      <div class="col-sm-10">
        <ol class="breadcrumb">
        <li><a href="{{ url('/') }}">首頁</a></li>
        <li><a href="{{ url('/quest') }}">任務大廳</a></li>
        <li class="active">工讀任務</li>
        </ol>
      </div>
      <div class="col-sm-2">
        <a class="btn btn-success btn-block" href="{{url('/work/search')}}" role="button">搜尋任務</a>
      </div>
    </div>
    
    {{ $quests->links() }}
			<table class="table table-hover table-bordered">
				<thead>
					<tr>
						<th>任務標題</th>
						<th>發布單位</th>
						<th>開始時間</th>
						<th>結束時間</th>
						<th>獎勵冒險點數</th>
						<th>薪資</th>
						<th>需要人數</th>
					</tr>
				</thead>
				<tbody>
  				@for($i=0; $i < count($quests); $i++)
  					<tr data-toggle="modal" data-target="#quest{{$i}}">
  						<td>{{ $quests[$i]->name }}</td>
  						<td>{{ $quests[$i]->creator }}</td>
  						<td>{{ $quests[$i]->start_at }}</td>
  						<td>{{ $quests[$i]->end_at }}</td>
  						<td>{{ $quests[$i]->point }}</td>
  						<td>{{ $quests[$i]->salary }}</td>
  						<td>{{ $quests[$i]->workforce }}</td>
  					</tr>
				@endfor
				</tbody>
			</table>
      {{ $quests->links() }}
      
      
      <!-- 
      打上$quests->appends(['var'=>'1'])->links()會將var傳回controller 只是不知道該怎麼把quests傳回去controller
      打上$quests->fragment('yes')->links() 會使新頁面直接導引到id為yes的地方
      <h1>no~</h1>
      <h1>no~</h1>
      <h1>no~</h1>
      <h1>no~</h1>
      <h1>no~</h1>
      <h1>no~</h1>
      <h1>no~</h1>
      <h1>no~</h1>
      <h1>no~</h1>
      <h1>no~</h1>
      <h1>no~</h1>
      <h1>no~</h1>
      <h1 id="yes">yes~</h1> -->
		</div>

	@endif


@endsection