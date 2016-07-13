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

@endsection