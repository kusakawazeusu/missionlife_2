@extends('layouts.master')

@section('title','Index')

@section('header')
    @parent
@endsection

@section('content')
	
	@if (Auth::guest())
	@elseif (Auth::user()->activation == 'false')
		<div class="alert alert-danger">
			唔喔！還沒完成「認證」的話，無法使用完整的Mission Life喔！點擊<a href="{{ url('/active') }}">這裡</a>完成認證吧！
		</div>
	@endif

    <div class="col-md-4 col-md-offset-4">
    	<h1 class="text-center">這是首頁</h1>
    	<img src="http://i.imgur.com/frKqGEl.jpg"></img>
    </div>
@endsection