@extends('layouts.main')
@section('title','修改密碼')

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
		<div class="row">
		<div class="col-sm-8 col-sm-offset-2">
		<ol class="breadcrumb">
			<li><a href="{{ url('/') }}">首頁</a></li>
			<li><a href="{{ url('/account') }}">冒險者資料</a></li>
			<li class="active">修改密碼</li>
		</ol>
		<div class="panel panel-success">
	      	<div class="panel-heading text-center">修改密碼</div>
	        <div class="panel-body">
	      	<!-- form擺這裡 -->
	      	<div class="row">
	      	<div class="col-sm-10 col-sm-offset-1">
	      	<form class="form-horizontal" role="form" method="POST" action="{{ url('/account/change_pwd/'.Auth::user()->id) }}">
	      		{{method_field('PATCH')}}
	      		{{csrf_field()}}
	      		<div class="form-group{{ $errors->has('old_pwd') ? ' has-error  has-feedback' : '' }}">
	      			<label class="control-label col-sm-5" for="old_pwd">
	      				請輸入舊密碼
	      			</label>
	      			<div class="col-sm-7">
	      			<input type="password" name="old_pwd" id="old_pwd" class="form-control">
	      			@if ($errors->has('old_pwd'))
                        <span class="glyphicon glyphicon-remove form-control-feedback"></span>
                        <span class="help-block">
                            <strong>{{ $errors->first('old_pwd') }}</strong>
                        </span>
                    @endif
	      			</div>
	      		</div>
	      		<div class="form-group{{ $errors->has('new_pwd') ? ' has-error  has-feedback' : '' }}">
	      			<label class="control-label col-sm-5" for="new_pwd">
	      				請輸入新密碼
	      			</label>
	      			<div class="col-sm-7">
	      			<input type="password" name="new_pwd" id="new_pwd" class="form-control">
	      			@if ($errors->has('new_pwd'))
                        <span class="glyphicon glyphicon-remove form-control-feedback"></span>
                        <span class="help-block">
                            <strong>{{ $errors->first('new_pwd') }}</strong>
                        </span>
                    @endif
	      			</div>
	      		</div>
	      		<div class="form-group">

	      			<label class="control-label col-sm-5" for="new_pwd2">
	      				請再次輸入新密碼
	      			</label>
	      			<div class="col-sm-7">
	      			<input type="password" name="new_pwd_confirmation" id="new_pwd2" class="form-control">
	      			</div>
	      		</div>
	      		<div class="text-center">
	      		<button type="submit" class="btn btn-danger">資料送出</button>
	      		&nbsp&nbsp&nbsp
	      		<a href="{{ url('/account') }}" class="btn btn-success" role="button">返回</a>
	      		</div>
	      	</form>
	      	</div>
	      	</div>
	      	<!-- form結尾 -->
	        </div><!-- <div class="panel-body"> END-->
	    </div><!-- panel -->
		</div> <!-- col -->
		</div> <!-- row -->
	</div><!-- container -->
@endif



@endsection