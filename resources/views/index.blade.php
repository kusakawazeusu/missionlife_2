@extends('layouts.main')

@section('title','Index')

@section('dialog')
@if (Auth::guest())
@include('layouts.partials.dialog',['dialogs' => $dialogs])
@endif
@endsection

@section('content')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script>
	var boo = 0;

	$(document).ready(function(){
		$('#myDropdown').on('show.bs.dropdown', function () {
			$(this).find('.dropdown-menu').first().slideDown();
		});

		$('#myDropdown').on('hide.bs.dropdown', function () {
			$(this).find('.dropdown-menu').first().slideUp();
		});


    	$("#btn").click(function(){
    		if( boo == 1 )
    		{
    			$("#test").animate({fontSize: '12px'});
    			boo = 0;
    		}
    		else
    		{
    			$("#test").animate({fontSize: '80px'});
    			boo = 1;
    		}
    	});
});
</script>

	@if (Auth::guest())

		<p style="position:relative;" id="test">This is another paragraph.</p>
		<a id="btn" class="btn btn-primary">Hide!</a>
		<br><br>

		<div id="myDropdown" class="dropdown">
  			<button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
    			Dropdown
    			<span class="caret"></span>
  			</button>

  		<a class="btn btn-success" href="#">
  		<i class="icon-shopping-cart icon-large"></i> Checkout</a>


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