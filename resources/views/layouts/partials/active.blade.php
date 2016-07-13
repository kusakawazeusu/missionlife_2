@extends('layouts.master')

@section('content')

<div class="container">
	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<div id="myCarousel" class="carousel" data-ride="carousel" data-interval="false" data-wrap="false">
  				<div class="carousel-inner" role="listbox">
    				<div class="item active">
        				<div class="panel panel-default">
        					<div class="panel-body">
        						<img src="http://i.imgur.com/Qjy5Pnx.jpg" class="img-rounded"  style="float:left"></img>
        						<div class="container">
        							<h3>敦義</h3><br>
        							<h4>「看你的樣子，就知道你是個冒險者，<br>&nbsp;&nbsp;&nbsp;&nbsp;怎麼樣，還習慣忙碌的生活嗎？」_</h4>
        						</div>
        					</div>
        				</div>
    				</div>

    				<div class="item">
        				<div class="panel panel-default">
        					<div class="panel-body">
        						<img src="http://i.imgur.com/Qjy5Pnx.jpg" class="img-rounded"  style="float:left"></img>
        						<div class="container">
        							<h3>敦義</h3><br>
        							<h4>「咦？<br>&nbsp;&nbsp;&nbsp;&nbsp;你身上沒有<mark>冒險者徽章</mark>，是還沒完成報到的新人嗎？」_</h4>
        						</div>
        					</div>
        				</div>
    				</div>

    				<div class="item">
        				<div class="panel panel-default">
        					<div class="panel-body">
        						<img src="http://i.imgur.com/C8auNgC.png" class="img-rounded"  style="float:left"></img>
        						<div class="container">
        							<h3>敦義</h3><br>
        							<h4>「哈哈哈哈，真是個菜逼巴！<br>&nbsp;&nbsp;&nbsp;&nbsp;我的下面有一個發信按鈕，按下去之後就去你的信箱找到信件<br>&nbsp;&nbsp;&nbsp;&nbsp;照著裡面說的做就可以完成報到手續了！」_</h4>
        							<div class="col-md-offset-2"><a class="btn btn-primary">寄送認證信</a></div>
        						</div>
        					</div>
        				</div>
    				</div>
  				</div>

		</div>
	</div>
	<div class="row">
		<div class="col-md-8 col-md-offset-2">
	<a class="btn btn-default" href="#myCarousel" data-slide="prev"><span class="glyphicon glyphicon-arrow-left"></span> Previous</a>
	<a class="btn btn-default" style="float:right" href="#myCarousel" data-slide="next">Next <span class="glyphicon glyphicon-arrow-right"></span></a>
		</div>
	</div>
</div>
<!--
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
        	<div class="panel panel-info">
        		<div class="panel-body">
        			{{ $users[0]->name }}
        		</div>
        	</div>
        </div>
    </div>
    <div class="col-md-8 col-md-offset-2">
		<a class="btn btn-default"><span class="glyphicon glyphicon-arrow-left"></span> Previous</a>
		<a class="btn btn-default" style="float:right">Next <span class="glyphicon glyphicon-arrow-right"></span></a>
	</div>
</div>
-->

<!--
<div class="container">
	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<div class="panel panel-default">
				<div class="panel-body">
					<div id="myCarousel" class="carousel" data-ride="carousel" data-interval="false" data-wrap="false">
  						<div class="carousel-inner" role="listbox">
    						<div class="item active">
    							@include('layouts.partials.dialog',['num' => $users[0]->name])
    						</div>

    						<div class="item">
    							{{ $users[1]->name }}
    						</div>

    						<div class="item">
    							{{ $users[2]->name }}
    						</div>
    						<div class="item">
    							{{ $users[3]->name }}
    						</div>
  						</div>
  					</div>
  				</div>
  			</div>
		</div>

	</div>
	<div class="row">
		<div class="col-md-8 col-md-offset-2">
	<a class="btn btn-default" href="#myCarousel" data-slide="prev"><span class="glyphicon glyphicon-arrow-left"></span> Previous</a>
	<a class="btn btn-default" style="float:right" href="#myCarousel" data-slide="next">Next <span class="glyphicon glyphicon-arrow-right"></span></a>
		</div>
	</div>
</div>
-->
<!--
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
        	<div class="panel panel-info">
        		<div class="panel-heading"><h3 class="text-center">冒險者報到處</h3></div>
        		<div class="panel-body">
        			<div class="col-md-5 col-md-offset-4">
        				<h4>- 報到手續 -</h4>
        				<li>點擊下面「發送報到信」按鈕</li>
        				<li>到註冊的信箱中收信</li>
        				<li>點擊信件裡的報到連結，並填寫資料</li>
        				<li><h5>完成報到！<h5></li>
        				<div class="col-md-4 col-md-offset-1">
        					<a class="btn btn-info btn-lg">發送報到信</a>
        				</div>
        			</div>

        		</div>
        	</div>
        </div>
    </div>
</div>
-->
@endsection