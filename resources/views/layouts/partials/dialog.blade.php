@section('dialog')
<div class="container">
	<div class="row">
		<div class="col-md-7 col-md-offset-3">
			<div id="myCarousel" class="carousel" data-ride="carousel" data-interval="false" data-wrap="false">
  				<div class="carousel-inner" role="listbox">
  					@for($i=0; $i < count($dialogs); $i++)
    				<div class="item{{ $i== 0 ? ' active' : '' }}">
        				<div class="panel panel-default">
        					<div class="panel-body">
        						<img src="http://i.imgur.com/Qjy5Pnx.jpg" class="img-rounded"  style="float:left;width:15%"></img>
        						<div class="col-md-8 col-md-offset-1">
        							<h3>{{ $dialogs[$i]->name }}</h3>
        							<h4>「{{ $dialogs[$i]->context }}_」</h4>
        						</div>
        					</div>
        					<div class="panel-footer">
								<a class="btn btn-default" href="#myCarousel" data-slide="prev" style="float:left"><span class="glyphicon glyphicon-arrow-left"></span> Previous</a>	
        						<a class="btn btn-default" style="float:right" href="#myCarousel" data-slide="next">Next <span class="glyphicon glyphicon-arrow-right"></span></a>
        					</div>
        				</div>
    				</div>
    				@endfor

  				</div>

		</div>
	</div>
	<div class="row">
		<div class="col-md-8 col-md-offset-2">


		</div>
	</div>
</div>
@endsection