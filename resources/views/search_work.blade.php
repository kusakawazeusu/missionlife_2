@extends('layouts.main')

@section('title','任務大廳 - 搜尋任務')

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
		<div class="col-sm-10 col-sm-offset-1">
		<div class="panel panel-default">
	      	<div class="panel-heading text-center"><h4>搜尋任務<br>(搜尋符合以下<b style="color:red">所有</b>條件的任務，條件愈少，結果愈多。
	      	)</h4></div>
	        <div class="panel-body">
	      	<!-- form開始 -->
	      	<div class="row">
	      	<div class="col-sm-12">
	      	<form class="form-horizontal" role="form" method="GET" action="{{ url('/work/search/result') }}"> <!-- E -->
	      		{{csrf_field()}}
	      		<!-- <input type="number" name="page" id="page" value="0" hidden="hidden"> -->
	      		<div class="form-group{{ $errors->has('title') ? ' has-error  has-feedback' : '' }}">
	      			<label class="control-label col-sm-3" for="title">
	      				任務名稱
	      			</label>
	      			<div class="col-sm-7">
	      			<input type="text" name="title" id="title" class="form-control" value="{{old('title')}}">
	      			@if ($errors->has('title'))
                        <span class="glyphicon glyphicon-remove form-control-feedback"></span>
                        <span class="help-block">
                            <strong>{{ $errors->first('title') }}</strong>
                        </span>
                    @endif
	      			</div>
	      		</div>

	      		<div class="form-group{{ $errors->has('creator') ? ' has-error  has-feedback' : '' }}">
	      			<label class="control-label col-sm-3" for="creator">
	      				發佈單位
	      			</label>
	      			<div class="col-sm-7">
	      			<input type="text" name="creator" id="creator" class="form-control" value="{{old('creator')}}">
	      			@if ($errors->has('creator'))
                        <span class="glyphicon glyphicon-remove form-control-feedback"></span>
                        <span class="help-block">
                            <strong>{{ $errors->first('creator') }}</strong>
                        </span>
                    @endif
	      			</div>
	      		</div>

	      		<div class="form-group{{ $errors->has('start_date')||$errors->has('start_date_2') ? ' has-error  has-feedback' : '' }}">
 	               	<label for="start_date" class="col-sm-3 control-label">報名開始日期</label>
 	               	<div class="col-sm-3">
 	               		<input data-provide="datepicker" data-date-format="yyyy/mm/dd" data-date-autoclose="true" id="start_date" class="form-control" name="start_date" value="{{old('start_date')}}">
                          @if ($errors->has('start_date'))
                                <span class="help-block">
                                <strong>{{ $errors->first('start_date') }}</strong>
                                </span>
                          @endif
 	           		</div>
 	           		<label class="col-sm-1 text-center">～</label>
 	           		<div class="col-sm-3">
             			<input data-provide="datepicker" data-date-format="yyyy/mm/dd" data-date-autoclose="true" id="start_date_2" class="form-control" name="start_date_2" value="{{old('start_date_2')}}">
                          @if ($errors->has('start_date_2'))
                                <span class="help-block">
                                <strong>{{ $errors->first('start_date_2') }}</strong>
                                </span>
                          @endif
             		</div>
             	</div>

             	<div class="form-group{{ $errors->has('end_date')||$errors->has('end_date_2') ? ' has-error  has-feedback' : '' }}">
 	               	<label for="end_date" class="col-sm-3 control-label">報名結束日期</label>
 	               	<div class="col-sm-3">
 	               		<input data-provide="datepicker" data-date-format="yyyy/mm/dd" data-date-autoclose="true" id="end_date" class="form-control" name="end_date" value="{{old('end_date')}}">
                          @if ($errors->has('end_date'))
                                <span class="help-block">
                                <strong>{{ $errors->first('end_date') }}</strong>
                                </span>
                          @endif
 	           		</div>
 	           		<label class="col-sm-1 text-center">～</label>
 	           		<div class="col-sm-3">
             			<input data-provide="datepicker" data-date-format="yyyy/mm/dd" data-date-autoclose="true" id="end_date_2" class="form-control" name="end_date_2" value="{{old('end_date_2')}}">
                          @if ($errors->has('end_date_2'))
                                <span class="help-block">
                                <strong>{{ $errors->first('end_date_2') }}</strong>
                                </span>
                          @endif
             		</div>
             	</div>

             	<!-- <div class="form-group{{ $errors->has('end_date') ? ' has-error  has-feedback' : '' }}">
 	               	<label for="end_date" class="col-sm-5 control-label">報名截止日期</label>
 	               	<div class="col-sm-7">
 	               		<input data-provide="datepicker" data-date-format="yyyy/mm/dd" data-date-autoclose="true" id="end_date" class="form-control" name="end_date" value="{{old('end_date')}}">
                          @if ($errors->has('end_date'))
                                <span class="help-block">
                                <strong>{{ $errors->first('end_date') }}</strong>
                                </span>
                          @endif
 	           		</div>
             	</div> -->

             	<div class="form-group{{ $errors->has('description') ? ' has-error  has-feedback' : '' }}">
	             	<label for="description" class="col-sm-3 control-label">任務描述</label>
	             	<div class="col-sm-7">
	             		<textarea id="description" rows="5" class="form-control" name="description">{{old('description')}}</textarea>
	             		@if ($errors->has('description'))
	                      <span class="help-block">
	                      <strong>{{ $errors->first('description') }}</strong>
	                      </span>
	                      @endif
	             	</div>
             	</div>

             	<div class="form-group{{ $errors->has('point')||$errors->has('point_2') ? ' has-error' : '' }}">
             		<label for="point" class="col-sm-3 control-label">冒險點數範圍</label>
             		<div class="col-sm-3">
             			<input type="number" id="point" class="form-control" name="point" value="{{old('point')}}" placeholder="ex:5">
             			@if ($errors->has('point'))
	                    <span class="help-block">
	                    <strong>{{ $errors->first('point') }}</strong>
	                    </span>
	                    @endif
             		</div>
             		<label class="col-sm-1 text-center">～</label>
             		<div class="col-sm-3">
             			<input type="number" id="point_2" class="form-control" name="point_2" value="{{old('point_2')}}" placeholder="ex:20">
             			@if ($errors->has('point_2'))
	                    <span class="help-block">
	                    <strong>{{ $errors->first('point_2') }}</strong>
	                    </span>
	                    @endif
             		</div>
             		<label for="point_2" class="col-sm-1 control-label">點</label>
             	</div>

             	<!-- <div class="form-group{{ $errors->has('pointtt') ? ' has-error' : '' }}">
             		<label for="pointtt" class="col-sm-3 control-label">冒險點數範圍</label>
             		<div class="col-sm-3">
             			<input type="text" id="pointtt" class="form-control" name="pointtt" value="{{old('pointtt')}}">
             			@if ($errors->has('pointtt'))
	                    <span class="help-block">
	                    <strong>{{ $errors->first('pointtt') }}</strong>
	                    </span>
	                    @endif
             		</div>
             		<label for="pointtt" class="col-sm-1 control-label">點</label>
             	</div>
             	<div class="form-group{{ $errors->has('point2') ? ' has-error' : '' }}">
             		<label for="point2" class="col-sm-3 control-label">冒險點數範圍2</label>
             		<div class="col-sm-3">
             			<input type="number" id="point2" class="form-control" name="point2" value="{{old('point2')}}">
             			@if ($errors->has('point2'))
	                    <span class="help-block">
	                    <strong>{{ $errors->first('point2') }}</strong>
	                    </span>
	                    @endif
             		</div>
             		<label for="point2" class="col-sm-1 control-label">點</label>
             	</div> -->



             	<div class="form-group{{ $errors->has('salary') ? ' has-error  has-feedback' : '' }}">
             		<label for="salary" class="col-sm-3 control-label">給予薪資</label>
             		<div class="col-sm-7">
             			<input type="number" id="salary" class="form-control" name="salary" value="{{old('salary')}}">
             			@if ($errors->has('salary'))
	                    <span class="help-block">
	                    <strong>{{ $errors->first('salary') }}</strong>
	                    </span>
	                    @endif
             		</div>
             		<label for="salary" class="col-sm-1 control-label">元</label>
             	</div>

             	<div class="form-group{{ $errors->has('workforce') ? ' has-error  has-feedback' : '' }}">
             		<label for="workforce" class="col-sm-3 control-label">需要人數</label>
             		<div class="col-sm-7">
             			<input type="number" id="workforce" class="form-control" name="workforce" value="{{old('workforce')}}">
             			@if ($errors->has('workforce'))
	                    <span class="help-block">
	                    <strong>{{ $errors->first('workforce') }}</strong>
	                    </span>
	                    @endif
             		</div>
             	</div>
	      		<div class="text-center">
	      		<button type="submit" class="btn btn-danger">資料送出</button>
	      		<span>&nbsp&nbsp&nbsp</span>
	      		<a href="{{ url('/work')}}" class="btn btn-success" role="button">返回</a>
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