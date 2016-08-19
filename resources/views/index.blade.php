@extends('layouts.main')

@section('title','Index')
@section('dialog')
@endsection


@section('content')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script>
	var boo = 0;

	$(document).ready(function(){

		$('#welcome').fadeIn("slow",function(){
			$('#welcome2').fadeIn("slow");
		});

		$('.scroll-link').on('click',function(event){
			event.preventDefault();
			var offset = 50;
			var targetOffset = $('#page2').offset().top - offset;
			$('html,body').animate({scrollTop:targetOffset},750);
		});


});
</script>

<style>

body {
    width: 100%;
    height: 100%;
}

html {
    width: 100%;
    height: 100%;
}

.page-section {
	width:100%;
	height: 100%;

	border-bottom: 10px solid #fff;
}

#page2 {
	background-color: #3c76e7;
}

</style>

	@if (Auth::guest())

	<br>
	<div id="page1" class="page-section">
		<div class="col-md-8 col-md-offset-2">
			<div style="display:none" id="welcome" class="row">
				<img class="img-responsive center-block" src="{{ asset('logo2.png') }}"></img>
			</div>
			<br><br><br>
			<div style="display:none" id="welcome2" class="row">
				<div class="col-md-4">
					<div class="panel panel-default">
						<div style="color:#ecf0f1; background-color:#3c76e7;max-height:150px" class="panel-heading">
							<h3 class="text-center"><i class="icon-quote-left"></i> 讓大學生活更精采 <i class="icon-quote-right"></i></h3>
						</div>
						<div class="panel-body">
							<p style="font-size:18px">在臺科，每天平均會舉辦四個活動，Mission Life提供一個平台，所有校園活動一目瞭然，讓你不會在錯過任何一個美好的活動或是工讀機會，大學生活更加精采！</p>
						</div>
					</div>
				</div>

				<div class="col-md-4">
					<div class="panel panel-default">
						<div style="color:#ecf0f1; background-color:#3c76e7;max-height:150px" class="panel-heading">
							<h3 class="text-center"><i class="icon-quote-left"></i> 校園解謎遊戲 <i class="icon-quote-right"></i></h3>
						</div>
						<div class="panel-body">
							<p style="font-size:18px">每一季，我們會推出一系列的校園解謎活動，在參加完校園活動後，與朋友們一起腦力激盪，挑戰解出Mission Life給予的謎題吧！也許會發現校園中美麗而不為人知的角落！</p>
						</div>
					</div>
				</div>
				<div class="col-md-4">
					<div class="panel panel-default">
						<div style="color:#ecf0f1; background-color:#3c76e7;max-height:150px" class="panel-heading">
							<h3 class="text-center"><i class="icon-quote-left"></i> 提供社團一個活動平台 <i class="icon-quote-right"></i></h3>
						</div>
						<div class="panel-body">
							<p style="font-size:18px">除了全校信、Talk版以外，Mission Life也是一個提供社團宣傳的好管道！無論是成果發表會、展覽或是社團營隊，都可以使用此系統來管理活動。</p>
						</div>
					</div>
				</div>
				<div style="height:80px" class="col-md-4 col-md-offset-4">
						<button data-id="page2" style="background-color:#3c76e7;font-size:24px;height:100%; width:100%" class="btn btn-primary scroll-link">立刻加入！</button>
				</div>
			</div>
		</div>
	</div>
	<div id="page2" class="page-section">
	123
	</div>

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

