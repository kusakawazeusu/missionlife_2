@extends('layouts.main')

@section('title','發佈新工讀任務')

@section('dialog')
@endsection

@section('content')
	@if(!Auth::Guest() && Auth::user()->auth=='1')
            <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
            <script>
            $(document).ready(function(){
                  $("#new").click(function(){
                        var $div = $('div[id^="insert_point"]:last');
                        var num = parseInt( $div.prop("id").match(/\d+/g),10 )+1;
                        var $ins = $div.clone(true).prop('id','insert_point'+num);
                        $ins.find("div[name^='input']").css("display","none");

                        $("#btn").before($ins);
                  });

                  $("select[name='require[]']").change(function(){

                        // 取得目前的Select的Index
                        var num = parseInt( $(this).parent().parent().attr('id').match(/\d+/g),10 );
                        var selected = $("#insert_point"+num+" select[name='require[]']").val();

                        if( selected == "多益TOEIC" || selected == "托福TOEFL" || selected == "雅思IELT" )
                        {
                              $("#insert_point"+num+" div[name^='input']").hide();
                              $("#insert_point"+num+" div[name='input']").fadeIn("fast");
                        }
                        else if( selected == "none" )
                        {
                              $("#insert_point"+num+" div[name^='input']").fadeOut("fast");
                        }
                        else if( selected == "日文檢定JLPT" )
                        {
                              $("#insert_point"+num+" div[name^='input']").hide();
                              $("#insert_point"+num+" div[name='input_jp']").fadeIn("fast");
                        }
                        else if( selected == "custom" )
                        {
                              $("#insert_point"+num+" div[name^='input']").hide();
                              $("#insert_point"+num+" div[name='input_area']").fadeIn("fast");
                        }
                  });
                  // alert({{old('salary_type')}});
                  if({{old('salary_type')}}!=null){
                    // $errors->has('salary_type')
                    // old('salary_type');
                    // alert('da');//確定可以進來
                    // $("[name=salary_type]").first().parent().css("background-color", "yellow");
                    // $("label").css({"color": "red", "border": "2px solid red"});
                    // var $radio_salary_type = $(":radio[name='salary_type'][value=1]");
                    // alert($radio_salary_type);
                    // $radio_salary_type.prop('checked',true);
                    $(":radio[name='salary_type'][value={{old('salary_type')}}]").prop('checked',true);
                    // $("input[name=salary_type][value=1]").prop("checked", "checked");
                   // $("input[name=salary_type][value=1]").css("background-color", "yellow");
                  }
                  if({{old('verification')}}!=null){
                    $(":radio[name='verification'][value={{old('verification')}}]").prop('checked',true);
                  }
            });
            
            </script>

		<div id="wtf" class="container">
			<div class="col-md-8 col-md-offset-2">
				<div class="panel panel-default">
					<div class="panel-body">
						<h2 class="text-center">發佈新工讀任務</h2>
            	                  <form id="pb" class="form-horizontal" role="form" method="POST" action="{{ url('/newquest_2') }}">
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
             	               <label for="name" class="col-md-2 col-md-offset-2 control-label">任務標題</label>
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
                                    <label for="execute_start_at" class="col-md-2 col-md-offset-2 control-label">工讀開始日期</label>
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
                                    <label for="execute_end_at" class="col-md-2 col-md-offset-2 control-label">工讀結束日期</label>
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
                                    <label for="place" class="col-md-2 col-md-offset-2 control-label">工讀地點</label>
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
             	               	<label for="description" class="col-md-2 col-md-offset-2 control-label">工讀描述</label>
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
             	               	<label for="salary" class="col-md-2 col-md-offset-2 control-label">給予薪資</label>
             	               	<div class="col-md-3">
             	               		<input id="salary" type="number" class="form-control" name="salary" placeholder="ex:200" value="{{old('salary')}}">
                                          @if ($errors->has('salary'))
                                          <span class="help-block">
                                          <strong>{{ $errors->first('salary') }}</strong>
                                          </span>
                                          @endif
             	           		</div>
             	           		<label for="salary" class="col-md-1 control-label">元</label>
                                    <label class="radio-inline control-label">
                                    <input type="radio" name="salary_type" value="0" checked>時薪
                                    </label>
                                    <label class="radio-inline control-label">
                                    <input type="radio" name="salary_type" value="1">日薪
                                    </label>
                                    <label class="radio-inline control-label">
                                          <input type="radio" name="salary_type" value="2">本次
                                    </label>
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
                                    <label class="col-md-2 col-md-offset-2 control-label">是否需要審核</label>
                                    <div class="col-md-4">
                                    <label class="radio-inline control-label">
                                    <input type="radio" name="verification" value="1" checked>是
                                    </label>
                                    <label class="radio-inline control-label">
                                    <input type="radio" name="verification" value="0">否
                                    </label>
                                    </div>
                              </div>
            	            <div class="form-group">
             	               	<label for="people_require" class="col-md-2 col-md-offset-2 control-label">需要人數</label>
             	               	<div class="col-md-2">
             	               		<input id="people_require" type="number" min="1" class="form-control" name="people_require" value="{{old('people_require')}}">
                                          @if ($errors->has('people_require'))
                                          <span class="help-block">
                                          <strong>{{ $errors->first('people_require') }}</strong>
                                          </span>
                                          @endif
             	           		</div>
             	           		<label for="people_require" class="control-label">人</label>
             	          	</div>
                              <div class="form-group">
                                    <label for="max_apply_people" class="col-md-2 col-md-offset-2 control-label">申請人數上限</label>
                                    <div class="col-md-2">
                                          <input type="number" min="1" id="max_apply_people" class="form-control" name="max_apply_people" value="{{old('max_apply_people')}}">
                                          @if ($errors->has('max_apply_people'))
                                          <span class="help-block">
                                          <strong>{{ $errors->first('max_apply_people') }}</strong>
                                          </span>
                                          @endif
                                    </div>
                                    <label for="max_apply_people" class="control-label">人</label>
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
                              
            	            <div id="insert_point0" class="form-group">
             	               	<label for="requirement" class="col-md-2 col-md-offset-2 control-label"><a id="new"><span class="glyphicon glyphicon-plus"></span></a> 任務條件</label>
             	               	<div class="col-md-3">
             	               		<select name="require[]" class="form-control">
                                                <option value="none">無</option>
                                                <optgroup label="語文類">
                                                      <option value="多益TOEIC">多益TOEIC</option>
                                                      <option value="托福TOEFL">托福TOEFL</option>
                                                      <option value="雅思IELT">雅思IELT</option>
                                                      <option value="日文檢定JLPT">日文檢定JLPT</option>
                                                </optgroup>
                                                <option value="custom">自定義</option>
                                          </select>
             	           		</div>
                                    <div style="display:none" name="input">
                                          <div class="col-md-2">
                                                <input name="eng_input[]" class="form-control"></input>
                                          </div>
                                          <label for="requirement" class="control-label">分</label>
             	          	      </div>
                                    <div  style="display:none" name="input_jp">
                                          <div class="col-md-2">
                                                <select name="jp_input[]" class="form-control">
                                                      <option value="N5">N5</option>
                                                      <option value="N4">N4</option>
                                                      <option value="N3">N3</option>
                                                      <option value="N2">N2</option>
                                                      <option value="N1">N1</option>
                                                </select>
                                          </div>
                                          <label for="requirement" class="control-label">以上</label>
                                    </div>
                                    <div style="display:none" name="input_area">
                                          <div class="col-md-5">
                                                <textarea name="custom_input[]" class="form-control" rows="8" ></textarea>
                                          </div>
                                          
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