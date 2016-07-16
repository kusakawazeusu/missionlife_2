@extends('layouts.main')

@section('title','Index')

@section('dialog')
@if (Auth::guest())
@include('layouts.partials.dialog',['dialogs' => $dialogs])
@endif
@endsection

@section('content')
	
	@if (Auth::guest())

	@elseif (Auth::user()->activation == 'false')
		<div class="alert alert-danger">
			唔喔！還沒完成「認證」的話，無法使用完整的Mission Life喔！點擊<a href="{{ url('/active') }}">這裡</a>完成認證吧！
		</div>
	@elseif (Auth::user()->auth == '1')
		<div class="container">
			<h3>您現在登入的身份是：{{ Auth::user()->name }}</h3>
		</div>
	@elseif (Auth::user()->auth == '2')
		<div class="container">
			<h3>您現在登入的身份是：網站管理員</h3>
		</div>
	@endif


@endsection