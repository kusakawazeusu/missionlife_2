@extends('layouts.main')

@section('title','冒險者資料')

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
				<!-- <li><a href="{{ url('/quest') }}">任務大廳</a></li> -->
				<li class="active">冒險者資料</li>
			</ol>
			<!-- <div class="row">
				<div class="col-md-12">
					<img style="height:120px;weight:120px;" src="default.png" class="img-rounded center-block">
					<h3 class="text-center">{{ Auth::user()->name }}</h3>
				</div>
			</div>
			<br> -->
			<div class="row">
			<div class="col-xs-12">
				<ul class="nav nav-tabs">
  					<li class="active"><a data-toggle="tab" href="#home">個人資料</a></li>
  					<li><a data-toggle="tab" href="#m1">成就列表</a></li>
  					<li><a data-toggle="tab" href="#m2">技能列表</a></li>
  					<li><a data-toggle="tab" href="#m3">道具欄</a></li>
  					<li><a data-toggle="tab" href="#m4">進行中任務</a></li>
				</ul>

				<div class="tab-content">
				
					<div id="home" class="tab-pane fade in active">
						<div class="row">
						<div class="col-xs-6">
							<br>
							<img  src="{{asset('personal_img/'.Auth::user()->picture_path)}}" class="img-rounded img-responsive center-block" alt="personal_image" style="max-height:400px;">
							<br>
							<div class="row">
								<div class="col-xs-6 col-xs-offset-3 col-sm-4 col-sm-offset-4">
								<a href="{{url('/account/change_img')}}" class="btn btn-warning btn-block" role="button">更換大頭貼</a>
								</div>
							</div>
						</div>

						<div class="col-xs-6">
							<br>
							<h4>姓名：{{ Auth::user()->name }}</h4>
							<h4>email：{{ Auth::user()->email }}</h4>
							<h4>冒險點數：{{ Auth::user()->point }}點</h4>
							@if(Auth::user()->gender==1)
							<h4>性別：男</h4>
							@else
							<h4>性別：女</h4>
							@endif
							<h4>系所：{{ Auth::user()->department->name }}</h4>
							<h4>聲望：{{ Auth::user()->fame }}</h4>
							<div class="row">
								<div class="col-xs-6 col-sm-5 col-md-4">
								<a href="#" class="btn btn-warning btn-block" data-toggle="modal" data-target="#myModal" role="button">修改個人資料</a>
                                <a href="{{url('/account/change_pwd')}}" class="btn btn-warning btn-block" role="button">修改密碼</a>
								</div>
							</div>
							
						</div>
						</div> <!-- row -->
					</div>
					<div id="m1" class="tab-pane fade">
						<h3>成就列表</h3>
					</div>
					<div id="m2" class="tab-pane fade">
						<h3>技能列表</h3>
					</div>
					<div id="m3" class="tab-pane fade">
						<h3>道具欄</h3>
					</div>
					<div id="m4" class="tab-pane fade">
						@if( $no_quest == 0 )
						<h3>進行中任務</h3>
						<table class="table table-hover table-bordered">
							<thead>
							<tr>
								<th>任務標題</th>
								<th>發布單位</th>
								<th>開始時間</th>
								<th>結束時間</th>
								<th>獎勵冒險點數</th>
								<th>薪資</th>
								<th>需要人數</th>
							</tr>
							</thead>
						<tbody>
  							@for($i=0; $i < count($quests); $i++)
  							<tr>
  								<td>{{ $quests[$i]->name }}</td>
  								<td>{{ $quests[$i]->creator }}</td>
  								<td>{{ $quests[$i]->start_at }}</td>
  								<td>{{ $quests[$i]->end_at }}</td>
  								<td>{{ $quests[$i]->point }}</td>
  								<td>{{ $quests[$i]->salary }}</td>
  								<td>{{ $quests[$i]->workforce }}</td>
  							</tr>
							@endfor
						</tbody>
						</table>
						@else
						<h3>目前尚無進行中任務，趕快踏出你的第一步吧！</h3>
						@endif
					</div>
					
				</div>
			</div>
			</div>
			<!-- Modal -->
  <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title text-center">修改個人資料</h4>
        </div>
        <div class="modal-body"><!--<div class="modal-body">-->
            <form class="form-horizontal" role="form" method="POST" action="{{ url('/account/'.Auth::user()->id) }}">
            			{{ method_field('PATCH') }}
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('name') ? ' has-error has-feedback' : '' }}">
                          <div class="row">
                            <label for="name" class="col-xs-offset-3 col-xs-1 col-sm-4 col-sm-offset-0 control-label">姓名</label>
                            <div class="col-xs-offset-0 col-xs-4 col-sm-6 col-sm-offset-0">
                                <input id="name" type="text" class="form-control" name="name" value="{{Auth::user()->name}}">

                                @if ($errors->has('name'))
                                    <span class="glyphicon glyphicon-remove form-control-feedback"></span>
                                    <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                          </div>
                        </div>
       
                        <div class="form-group">
                          <div class="row">
                            <label class="col-xs-offset-3 col-xs-1 col-sm-4 col-sm-offset-0 control-label">性別</label>
                            <div class="col-xs-offset-0 col-xs-4 col-sm-6 col-sm-offset-0">
                                @if (Auth::user()->gender==1)
                                <label class="radio-inline">
                                    <input type="radio" name="gender" value="1" checked>男
                                </label>
                                <label class="radio-inline">
                                    <input type="radio" name="gender" value="0">女
                                </label>
                                @else
                                <label class="radio-inline">
                                    <input type="radio" name="gender" value="1">男
                                </label>
                                <label class="radio-inline">
                                    <input type="radio" name="gender" value="0" checked>女
                                </label>
                                @endif
                            </div>
                          </div>
                        </div>
                                            
                        <div class="form-group">
                          <div class="row">
                            <label class="col-xs-offset-3 col-xs-1 col-sm-4 col-sm-offset-0 control-label" for="department_id">系別</label>
                            <div class="col-xs-offset-0 col-xs-4 col-sm-6 col-sm-offset-0">
                                <select class="form-control" id="department_id" name="department_id">
                                    <optgroup label="工程學院">
                                        <option value="0">自動化及控制研究所</option>
                                        <option value="1">機械工程系(所)</option>
                                        <option value="2">材料科學與工程系(所)</option>
                                        <option value="3">營建工程系(所)</option>
                                        <option value="4">化學工程系(所)</option>
                                    </optgroup>
                                    <optgroup label="電資學院">
                                        <option value="5">電子工程系(所)</option>
                                        <option value="6">電機工程系(所)</option>
                                        <option value="7">資訊工程系(所)</option>
                                        <option value="8">光電工程研究所</option>
                                    </optgroup>
                                    <optgroup label="管理學院">
                                        <option value="9">管理研究所</option>
                                        <option value="10">工業管理系(所)</option>
                                        <option value="11">企業管理系(所)</option>
                                        <option value="12">財務金融研究所</option>
                                        <option value="13">資訊管理系(所)</option>
                                        <option value="14">管理學院MBA</option>
                                        <option value="15">EMBA暨管研所博士班</option>
                                    </optgroup>
                                    <optgroup label="設計學院">
                                        <option value="16">建築系(所)</option>
                                        <option value="17">工商業設計系(所)</option>
                                    </optgroup>
                                    <optgroup label="人文社會學院">
                                        <option value="18">數位學習與教育研究所</option>
                                        <option value="19">應用外語系(所)</option>
                                    </optgroup>
                                    <optgroup label="應用科技學院(精誠榮譽學院)">
                                        <option value="20">應用科技研究所</option>
                                        <option value="21">全校不分系學士班</option>
                                        <option value="22">醫學工程研究所</option>
                                        <option value="23">色彩與照明科技研究所</option>
                                        <option value="24">應用科技學士學位學程</option>
                                    </optgroup>
                                    <optgroup label="智慧財產學院">
                                        <option value="25">科技管理研究所</option>
                                        <option value="26">專利研究所</option>
                                        <option value="27">科技管理學士學位學程</option>
                                        <option value="28">智慧財產學士學位學程</option>
                                    </optgroup>
                                </select>
                            </div>
                           </div>
                        </div>

                        <div class="form-group">
	                        <div class="row"></div>
	                        <div class="col-xs-6 col-xs-offset-4">
	                          <button type="submit" class="btn btn-primary">
	                             送出資料
	                          </button>
	                          <button type="button" class="btn btn-danger" data-dismiss="modal">取消</button>
	                        </div>
	                        </div>
                        </div>
                    </form> 
        </div><!--<div class="modal-body"> END-->
      </div> <!-- <div class="modal-content"> END-->
      
    </div>
  </div> <!-- <div class="modal fade" id="myModal" role="dialog"> END-->
		</div>
<script type="text/javascript">
	document.getElementById("department_id").selectedIndex = "{{Auth::user()->department_id}}";
</script>
	@endif



@endsection