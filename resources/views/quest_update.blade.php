@extends('layouts.main')

@section('title','修改任務')

@section('dialog')
@endsection

@section('content')
@if(!Auth::Guest() && Auth::user()->auth=='1' && Auth::user()->name == $quest->creator)
<div class="container">
		<div class="row">
		<div class="col-sm-8 col-sm-offset-2">
		<div class="panel panel-default">
	      	<div class="panel-heading text-center">修改任務</div>
	        <div class="panel-body">
	      	<!-- form開始 -->
	      	<div class="row">
	      	<div class="col-sm-10 col-sm-offset-1">
	      	<form class="form-horizontal" role="form" method="POST" action="{{ url('/questmanage/'.$quest->id.'/update') }}">
	      		{{csrf_field()}}
	      		<div class="form-group{{ $errors->has('title') ? ' has-error  has-feedback' : '' }}">
	      			<label class="control-label col-sm-5" for="title">
	      				任務名稱
	      			</label>
	      			<div class="col-sm-7">
	      			@if ($errors->isEmpty())
	      			<input type="text" name="title" id="title" class="form-control" value="{{$quest->name}}">
	      			@else
	      			<input type="text" name="title" id="title" class="form-control" value="{{old('title')}}">
	      			@endif
	      			@if ($errors->has('title'))
                        <span class="glyphicon glyphicon-remove form-control-feedback"></span>
                        <span class="help-block">
                            <strong>{{ $errors->first('title') }}</strong>
                        </span>
                    @endif
	      			</div>
	      		</div>

	      		<div class="form-group{{ $errors->has('start_date') ? ' has-error  has-feedback' : '' }}">
 	               	<label for="start_date" class="col-sm-5 control-label">報名開始日期</label>
 	               	<div class="col-sm-7">
 	               		<input data-provide="datepicker" data-date-format="yyyy/mm/dd" data-date-autoclose="true" id="start_date" class="form-control" name="start_date" value="{{$errors->isEmpty() ? $quest->start_at : old('start_date')}}">
                          @if ($errors->has('start_date'))
                                <span class="help-block">
                                <strong>{{ $errors->first('start_date') }}</strong>
                                </span>
                          @endif
 	           		</div>
             	</div>

             	<div class="form-group{{ $errors->has('end_date') ? ' has-error  has-feedback' : '' }}">
 	               	<label for="end_date" class="col-sm-5 control-label">報名截止日期</label>
 	               	<div class="col-sm-7">
 	               		<input data-provide="datepicker" data-date-format="yyyy/mm/dd" data-date-autoclose="true" id="end_date" class="form-control" name="end_date" value="{{$errors->isEmpty() ? $quest->end_at : old('end_date')}}">
                          @if ($errors->has('end_date'))
                                <span class="help-block">
                                <strong>{{ $errors->first('end_date') }}</strong>
                                </span>
                          @endif
 	           		</div>
             	</div>

             	<div class="form-group{{ $errors->has('description') ? ' has-error  has-feedback' : '' }}">
	             	<label for="description" class="col-sm-5 control-label">任務描述</label>
	             	<div class="col-sm-7">
	             		<textarea id="description" rows="5" class="form-control" name="description">{{$errors->isEmpty() ? $quest->description : old('description')}}</textarea>
	             		<!-- 為了防止學校人員打了一大堆description結果validation沒過被全部清掉而爆氣，因此上面這行加了條件式 -->
	             		@if ($errors->has('description'))
	                      <span class="help-block">
	                      <strong>{{ $errors->first('description') }}</strong>
	                      </span>
	                      @endif
	             	</div>
             	</div>

             	<div class="form-group{{ $errors->has('salary') ? ' has-error  has-feedback' : '' }}">
             		<label for="salary" class="col-sm-5 control-label">給予薪資</label>
             		<div class="col-sm-6">
             			<input type="number" id="salary" class="form-control" name="salary" value="{{$errors->isEmpty() ? $quest->salary : old('salary')}}">
             			@if ($errors->has('salary'))
	                    <span class="help-block">
	                    <strong>{{ $errors->first('salary') }}</strong>
	                    </span>
	                    @endif
             		</div>
             		<label for="salary" class="col-sm-1 control-label">元</label>
             	</div>

             	<div class="form-group{{ $errors->has('workforce') ? ' has-error  has-feedback' : '' }}">
             		<label for="workforce" class="col-sm-5 control-label">需要人數</label>
             		<div class="col-sm-7">
             			<input type="number" id="workforce" class="form-control" name="workforce" value="{{$errors->isEmpty() ? $quest->workforce : old('workforce')}}">
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
	      		<a href="{{ url('/questmanage/'.$quest->id) }}" class="btn btn-success" role="button">返回</a>
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