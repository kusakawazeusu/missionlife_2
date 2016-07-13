@extends('layouts.main')

@section('title','任務大廳 - 講座')

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
        				<button type="button" class="btn btn-danger">接下此任務</button>
        				<button type="button" class="btn btn-default" data-dismiss="modal">關閉</button>
    				</div>
   				</div>
			</div>
		</div>
		@endfor

		<div class="container">
			<ol class="breadcrumb">
				<li><a href="{{ url('/') }}">首頁</a></li>
				<li><a href="{{ url('/quest') }}">任務大廳</a></li>
				<li class="active">講座任務</li>
			</ol>

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

  			

			

		</div>

	@endif


@endsection