@extends('layouts.main')
@section('title','register')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading"><h4 class="text-center">新的冒險者加入了！</h4></div>
                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="POST" action="{{ url('/register') }}">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('name') ? ' has-error has-feedback' : '' }}">
                            <label for="name" class="col-md-4 control-label">姓名</label>
                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}">

                                @if ($errors->has('name'))
                                    <span class="glyphicon glyphicon-remove form-control-feedback"></span>
                                    <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('email') ? ' has-error has-feedback' : '' }}">
                            <label for="email" class="col-md-4 control-label">E-Mail</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}">

                                @if ($errors->has('email'))
                                    <span class="glyphicon glyphicon-remove form-control-feedback"></span>
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-4 control-label">性別</label>
                            <div class="col-md-8">
                                <label class="radio-inline">
                                    <input type="radio" name="gender" value="1" checked>男
                                </label>
                                <label class="radio-inline">
                                    <input type="radio" name="gender" value="0">女
                                </label>
                            </div>
                        </div>
                        <!--<div class="form-group">
                          <label class="col-md-4 control-label" for="sel1">系別</label>
                          <div class="col-md-6">
                              <select class="form-control" id="department_id">
                                <option disabled>1</option>
                                <option>2</option>
                                <option>3</option>
                                <option>4</option>
                              </select>
                          </div>
                        </div>-->                     
                        <div class="form-group">
                            <label class="col-md-4 control-label" for="department_id">系別</label>
                            <div class="col-md-6">
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
                        <div class="form-group{{ $errors->has('password') ? ' has-error  has-feedback' : '' }}">
                            <label for="password" class="col-md-4 control-label">密碼 (最少6個字元)</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control" name="password">

                                @if ($errors->has('password'))
                                    <span class="glyphicon glyphicon-remove form-control-feedback"></span>
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                            <label for="password-confirm" class="col-md-4 control-label">確認密碼 </label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation">

                                @if ($errors->has('password_confirmation'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password_confirmation') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-4 col-md-offset-4">
                                <a class="btn btn-warning" href="/">
                                    <i class="fa fa-btn fa-user"></i> 返回
                                </a>
                                    <button type="submit" class="btn btn-primary">
                                        <i class="fa fa-btn fa-user"></i> 送出資料
                                    </button>
                            </div>

                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
