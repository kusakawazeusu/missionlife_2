@extends('layouts.master')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-body">
                    @if (Auth::guest())
                    <h3 class="text-center">哈囉，您尚未登入，若要報到的話，請先登入喔！</h3>
                    @elseif(Auth::user()->active_key == $key)
                    <h3 class="text-center text-warning">請正確填寫資料來完成報到。</h3><br>
                    <form class="form-horizontal" role="form" method="POST" action="{{ url('/active_check') }}">
                        <div class="form-group{{ $errors->has('gender') ? ' has-error' : '' }}">
                            <label for="gender" class="col-md-2 col-md-offset-2 control-label">性別</label>
                            <div class="col-md-6">
                                <input id="gender" class="form-control" name="gender">
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('department') ? ' has-error' : '' }}">
                            <label for="department" class="col-md-2 col-md-offset-2 control-label">就讀系所</label>
                            <div class="col-md-6">
                                <input id="department" class="form-control" name="department">
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    <i class="fa fa-btn fa-sign-in"></i><span class="glyphicon glyphicon-ok"></span> 報到
                                </button>
                            </div>
                        </div>
                    </form>
                    @else
                        <h3 class="text-center">哈囉，你不是這個人= =</h3>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>


@endsection