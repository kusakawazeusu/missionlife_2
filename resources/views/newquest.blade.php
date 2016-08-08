@extends('layouts.main')

@section('title','發佈新任務')

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
            });

            </script>

		<div id="wtf" class="container">
			<div class="col-md-8 col-md-offset-2">
				<div class="panel panel-default">
					<div  class="panel-body">
						<h2 class="text-center">發佈新任務</h2>
<<<<<<< HEAD
            	        <form id="pb" class="form-horizontal" role="form" method="POST" action="{{ url('/newquest') }}">
                          {{csrf_field()}}
            	        	<div class="form-group">
             	               <label for="catalog" class="col-md-2 col-md-offset-2 control-label">任務分類</label>
             	               <div class="col-md-6">
            	        			<select id="catalog" name="catalog" class="form-control">
										<option value="0">工讀</option>
=======
            	                  <form id="pb" class="form-horizontal" role="form" method="POST" action="{{ url('/newquest') }}">
                                    {{csrf_field()}}
            	        	      <div   class="form-group">
             	                      <label for="catalog" class="col-md-2 col-md-offset-2 control-label">任務分類</label>
             	                            <div class="col-md-6">
            	        			            <select id="catalog" name="catalog" class="form-control">
								    		<option value="0">工讀</option>
>>>>>>> ada4078c6f378695d428a48fed83db50c453b0cd
										<option value="1">活動</option>
										<option value="2">講座</option>
									</select>
							     </div>
						</div>
            	            <div class="form-group">
             	               <label for="title" class="col-md-2 col-md-offset-2 control-label">任務標題</label>
             	               <div class="col-md-6">
             	                   <input id="title" class="form-control" name="title">
                                     @if ($errors->has('title'))
                                          <span class="help-block">
                                          <strong>{{ $errors->first('title') }}</strong>
                                          </span>
                                     @endif
             	               </div>
             	            </div>
            	            <div class="form-group">
             	               	<label for="start_date" class="col-md-2 col-md-offset-2 control-label">報名開始日期</label>
             	               	<div class="col-md-6">
             	               		<input data-provide="datepicker" data-date-format="yyyy/mm/dd" data-date-autoclose="true" id="start_date" class="form-control" name="start_date">
                                          @if ($errors->has('start_date'))
                                                <span class="help-block">
                                                <strong>{{ $errors->first('start_date') }}</strong>
                                                </span>
                                          @endif
             	           		</div>
             	          	</div>
            	            <div class="form-group">
             	               	<label for="end_date" class="col-md-2 col-md-offset-2 control-label">報名截止日期</label>
             	               	<div class="col-md-6">
             	               		<input data-provide="datepicker" data-date-format="yyyy/mm/dd" data-date-autoclose="true" id="end_date" class="form-control" name="end_date">
                                          @if ($errors->has('end_date'))
                                          <span class="help-block">
                                          <strong>{{ $errors->first('end_date') }}</strong>
                                          </span>
                                          @endif
             	           		</div>
             	          	</div>
            	            <div class="form-group">
             	               	<label for="description" class="col-md-2 col-md-offset-2 control-label">任務描述</label>
             	               	<div class="col-md-6">
             	               		<textarea id="description" rows="5" class="form-control" name="description"></textarea>
                                          @if ($errors->has('description'))
                                          <span class="help-block">
                                          <strong>{{ $errors->first('description') }}</strong>
                                          </span>
                                          @endif
             	           		</div>
             	          	</div>
            	            <div class="form-group">
             	               	<label for="salary" class="col-md-2 col-md-offset-2 control-label">給予薪資</label>
             	               	<div class="col-md-2">
             	               		<input id="salary" class="form-control" name="salary" placeholder="120">
                                          @if ($errors->has('salary'))
                                          <span class="help-block">
                                          <strong>{{ $errors->first('salary') }}</strong>
                                          </span>
                                          @endif
             	           		</div>
             	           		<label for="salary" class="control-label">元</label>
             	          	</div>
            	            <div class="form-group">
             	               	<label for="workforce" class="col-md-2 col-md-offset-2 control-label">需要人數</label>
             	               	<div class="col-md-2">
             	               		<input id="workforce" class="form-control" name="workforce">
                                          @if ($errors->has('workforce'))
                                          <span class="help-block">
                                          <strong>{{ $errors->first('workforce') }}</strong>
                                          </span>
                                          @endif
             	           		</div>
             	           		<label for="workforce" class="control-label">人</label>
             	          	</div>
<<<<<<< HEAD
            	            <div id="requirement" class="form-group">
             	               	<label for="requirement" class="col-md-2 col-md-offset-2 control-label">任務條件</label>
             	               	<div class="col-md-4">
             	               		<input id="requirement" class="form-control" name="requirement">
             	           		</div>
                                    <a onClick="addElement()" class="btn btn-primary">
                                          <span class="glyphicon glyphicon-plus"></span>
                                    </a>
                              </div>
                        	<div id="submit" class="form-group">
=======
                              
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
>>>>>>> ada4078c6f378695d428a48fed83db50c453b0cd
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
		</div>

            <script>
                  function addElement() {
                        var cus_id = 0;
                        var element = document.getElementById("pb");
                        var sub = document.getElementById("submit");

                        var d_outer = document.createElement("div");
                        d_outer.className = "form-group";
                        d_outer.id = cus_id;

                        var lab = document.createElement("label");
                        lab.className = "col-md-2 col-md-offset-2 control-label";
                        lab.innerHTML = "任務條件";
                        lab.for = cus_id;
                        d_outer.appendChild(lab);

                        var d_inner = document.createElement("div");
                        d_inner.className = "col-md-4";
                        var inp = document.createElement("input");
                        inp.className = "form-control";
                        inp.id = cus_id;
                        d_inner.appendChild(inp);

                        d_outer.appendChild(d_inner);

                        element.insertBefore(d_outer,submit);
                  }
            </script>


	@endif
@endsection