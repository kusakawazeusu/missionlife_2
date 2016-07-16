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
		<div class="container">
			<ol class="breadcrumb">
				<li><a href="{{ url('/') }}">首頁</a></li>
				<li><a href="{{ url('/quest') }}">任務大廳</a></li>
				<li class="active">冒險者資料</li>
			</ol>
			<div class="row">
				<div class="col-md-2 col-md-offset-5">
					<img style="height:120px;weight:120px;" src="default.png" class="img-rounded center-block">
					<h3 class="text-center">{{ Auth::user()->name }}</h3>
				</div>
			</div>
			<br>
			<div class="row">
				<ul class="nav nav-tabs">
  					<li class="active"><a data-toggle="tab" href="#home">個人資料</a></li>
  					<li><a data-toggle="tab" href="#m1">成就列表</a></li>
  					<li><a data-toggle="tab" href="#m2">技能列表</a></li>
  					<li><a data-toggle="tab" href="#m3">道具欄</a></li>
  					<li><a data-toggle="tab" href="#m4">進行中任務</a></li>
				</ul>

				<div class="tab-content">
					<div id="home" class="tab-pane fade in active">
						<h3>個人資料</h3>
						
					</div>
					<div id="m1" class="tab-pane fade">
						<h3>成就列表</h3>
					</div>
					<div id="m2" class="tab-pane fade">
						<h3>技能列表</h3>
					</div>
					<div id="m3" class="tab-pane fade">
						<h3>道具欄</h3>
					</div>
					<div id="m4" class="tab-pane fade">
						<h3>進行中任務</h3>
					</div>
				</div>

			</div>
		</div>

	@endif


@endsection