@extends('layouts.main')
@section('title','更換大頭貼')

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
		<li><a href="{{ url('/account') }}">冒險者資料</a></li>
		<li class="active">更換大頭貼</li>
	</ol>
	<div class="row">
		<div class="col-sm-12">
		<form class="form-horizontal" role="form" method="post" enctype="multipart/form-data" action="{{ url('/account/change_img/'.Auth::user()->id) }}">
			{{ csrf_field() }}
			<div class="form-group{{ $errors->has('input_image') ? ' has-error' : '' }}">
				<label class="control-label col-sm-3" for="input_image">選擇圖片:</label>
				<div class="col-sm-9">
			        <input type="file" id="input_image" name="input_image">
			        <br>
			        <input type="submit" class="btn btn-warning" value="上傳圖片" name="submit">
			    	@if ($errors->has('input_image'))
				        <span class="help-block">
				            <strong>{{ $errors->first('input_image') }}</strong>
				        </span>
				    @endif	
			    </div>
			</div>
		</form>	
		</div> <!-- col-sm-12 -->
	</div> <!-- row -->

</div> <!-- <div class="container"> END -->

@endif
@endsection