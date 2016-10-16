@extends('layouts.main')

@section('title','發佈活動任務')

@section('dialog')
@endsection

@section('content')
	@if(!Auth::Guest() && Auth::user()->auth=='1')
            <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
            <script>
            $(document).ready(function(){
                  
            });
            
            </script>

		<div id="wtf" class="container">
			<div class="col-md-8 col-md-offset-2">
				<div class="panel panel-default">
					<div class="panel-body">
						<h2 class="text-center">發佈新活動</h2>
            	 <form id="pb" class="form-horizontal" role="form" method="POST" action="{{ url('/newactivity') }}"> <!-- 這裡還沒加 -->
                                    {{csrf_field()}}
            	        	     <!--  <div   class="form-group">
             	                      <label for="catalog" class="col-md-2 col-md-offset-2 control-label">任務分類</label>
             	                            <div class="col-md-6">
            	        			            <select id="catalog" name="catalog" class="form-control">
								    		<option value="0">工讀</option>
										<option value="1">活動</option>
										<option value="2">講座</option>
									</select>
							     </div>
						</div> -->
            	            <div class="form-group">
             	               <label for="name" class="col-md-2 col-md-offset-2 control-label">活動標題</label>
             	               <div class="col-md-6">
             	                   <input id="name" class="form-control" name="name" value="{{old('name')}}">
                                     @if ($errors->has('name'))
                                          <span class="help-block">
                                          <strong>{{ $errors->first('name') }}</strong>
                                          </span>
                                     @endif
             	               </div>
             	            </div>
            	            <div class="form-group">
             	               	<label for="apply_start_at" class="col-md-2 col-md-offset-2 control-label">報名開始日期</label>
             	               	<div class="col-md-6">
             	               		<input data-provide="datepicker" data-date-format="yyyy/mm/dd" data-date-autoclose="true" id="apply_start_at" class="form-control" name="apply_start_at" value="{{old('apply_start_at')}}">
                                          @if ($errors->has('apply_start_at'))
                                                <span class="help-block">
                                                <strong>{{ $errors->first('apply_start_at') }}</strong>
                                                </span>
                                          @endif
             	           		</div>
             	          	</div>
            	            <div class="form-group">
             	               	<label for="apply_end_at" class="col-md-2 col-md-offset-2 control-label">報名截止日期</label>
             	               	<div class="col-md-6">
             	               		<input data-provide="datepicker" data-date-format="yyyy/mm/dd" data-date-autoclose="true" id="apply_end_at" class="form-control" name="apply_end_at" value="{{old('apply_end_at')}}">
                                          @if ($errors->has('apply_end_at'))
                                          <span class="help-block">
                                          <strong>{{ $errors->first('apply_end_at') }}</strong>
                                          </span>
                                          @endif
             	           		</div>
             	          	</div>
                              <div class="form-group">
                                    <label for="execute_start_at" class="col-md-2 col-md-offset-2 control-label">活動開始日期</label>
                                    <div class="col-md-6">
                                          <input data-provide="datepicker" data-date-format="yyyy/mm/dd" data-date-autoclose="true" id="execute_start_at" class="form-control" name="execute_start_at" value="{{old('execute_start_at')}}">
                                          @if ($errors->has('execute_start_at'))
                                          <span class="help-block">
                                          <strong>{{ $errors->first('execute_start_at') }}</strong>
                                          </span>
                                          @endif
                                    </div>
                              </div>
                              <div class="form-group">
                                    <label for="execute_end_at" class="col-md-2 col-md-offset-2 control-label">活動結束日期</label>
                                    <div class="col-md-6">
                                          <input data-provide="datepicker" data-date-format="yyyy/mm/dd" data-date-autoclose="true" id="execute_end_at" class="form-control" name="execute_end_at" value="{{old('execute_end_at')}}">
                                          @if ($errors->has('execute_end_at'))
                                          <span class="help-block">
                                          <strong>{{ $errors->first('execute_end_at') }}</strong>
                                          </span>
                                          @endif
                                    </div>
                              </div>
                              <div class="form-group">
                                    <label for="place" class="col-md-2 col-md-offset-2 control-label">活動地點</label>
                                    <div class="col-md-6">
                                          <textarea id="place" rows="1" class="form-control" name="place">{{old('place')}}</textarea>
                                          @if ($errors->has('place'))
                                          <span class="help-block">
                                          <strong>{{ $errors->first('place') }}</strong>
                                          </span>
                                          @endif
                                    </div>
                              </div>
            	            <div class="form-group">
             	               	<label for="description" class="col-md-2 col-md-offset-2 control-label">活動描述</label>
             	               	<div class="col-md-6">
             	               		<textarea id="description" rows="5" class="form-control" name="description">{{old('description')}}</textarea>
                                  @if ($errors->has('description'))
                                  <span class="help-block">
                                  <strong>{{ $errors->first('description') }}</strong>
                                  </span>
                                  @endif
             	           		</div>
             	          	</div>
            	            <div class="form-group">
             	               	<label for="admission_fee" class="col-md-2 col-md-offset-2 control-label">參加費用</label>
             	               	<div class="col-md-5">
             	               		<textarea id="admission_fee" rows="2" class="form-control" name="admission_fee">{{old('admission_fee')?old('admission_fee'):'無'}}</textarea>
                                  @if ($errors->has('admission_fee'))
                                  <span class="help-block">
                                  <strong>{{ $errors->first('admission_fee') }}</strong>
                                  </span>
                                  @endif
             	           		  </div>
             	           		<label for="admission_fee" class="col-md-3">(免費則填 無)</label>
             	          	</div>

                          <div class="form-group">
                              <label for="participate_award" class="col-md-2 col-md-offset-2 control-label">活動參加獎勵</label>
                              <div class="col-md-5">
                                <textarea id="participate_award" rows="2" class="form-control" name="participate_award">{{old('participate_award')?old('participate_award'):'無'}}</textarea>
                                  @if ($errors->has('participate_award'))
                                  <span class="help-block">
                                  <strong>{{ $errors->first('participate_award') }}</strong>
                                  </span>
                                  @endif
                              </div>
                            <label for="participate_award" class="col-md-3">(沒有則填 無)</label>
                          </div>


                              <div class="form-group">
                                    <label for="point" class="col-md-2 col-md-offset-2 control-label">冒險點數</label>
                                    <div class="col-md-3">
                                          <input id="point" type="number" class="form-control" name="point" value="{{old('point')}}">
                                          @if ($errors->has('point'))
                                          <span class="help-block">
                                          <strong>{{ $errors->first('point') }}</strong>
                                          </span>
                                          @endif
                                    </div>
                                    <label for="point" class="col-md-1 control-label">點</label>
                              </div>
                          
            	            <div class="form-group">
             	               	<label for="max_people" class="col-md-2 col-md-offset-2 control-label">活動人數上限</label>
             	               	<div class="col-md-3">
             	               		<input id="max_people" type="number" class="form-control" name="max_people" value="{{old('max_people')}}">
                                          @if ($errors->has('max_people'))
                                          <span class="help-block">
                                          <strong>{{ $errors->first('max_people') }}</strong>
                                          </span>
                                          @endif
             	           		</div>
             	           		<label for="max_people" class="col-md-1 control-label">人</label>
             	          	</div>
                          <div class="form-group">
                            <label for="other_description" class="col-md-2 col-md-offset-2 control-label">其它說明</label>
                            <div class="col-md-6">
                              <textarea id="other_description" rows="5" class="form-control" name="other_description">{{old('other_description')}}</textarea>
                                @if ($errors->has('other_description'))
                                  <span class="help-block">
                                    <strong>{{ $errors->first('other_description') }}</strong>
                                  </span>
                                @endif
                            </div>
                          </div>
                              
                        	<div id="btn" class="form-group">
                        	    <div class="col-md-6 col-md-offset-4">
                        	        <button type="submit" class="btn btn-primary">
                         	           <i class="fa fa-btn fa-sign-in"></i><span class="glyphicon glyphicon-ok"></span> 送出
                         	       </button>
                            	    </div>
                        	</div>
                    	</form>
                	</div>
            	</div>
        	</div>
		</div> <!-- container -->

	@endif
@endsection