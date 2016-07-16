@extends('layouts.main')

@section('title','新增對話')

@section('content')
<!--This page is made to add some dialogs.-->

<div class="container">
	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<div class="panel panel-default">
				<div class="panel-heading">新增對話</div>
				<div class="panel-body">
					<form class="form-horizontal" role="form" method="POST" action="{{ url('/newdia') }}">
						{{ csrf_field() }}
						<div class="form-group{{ $errors->has('ocassion') ? ' has-error' : '' }}">
							<label for="ocassion" class="col-md-4 control-label">對話場合：</label>
							<div class="col-md-6">
								<input id="ocassion" type"text" class="form-control" name="ocassion"></input>

								@if ($errors->has('ocassion'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('ocassion') }}</strong>
                                    </span>
                                @endif

							</div>
						</div>
						<div class="form-group">
							<label for="pic_path" class="col-md-4 control-label">圖片路徑：</label>
							<div class="col-md-6">
								<input id="pic_path" type"text" class="form-control" name="pic_path"></input>
							</div>
						</div>

						<div class="form-group">
							<label for="name" class="col-md-4 control-label">ＮＰＣ名字：</label>
							<div class="col-md-6">
								<input id="name" type"text" class="form-control" name="name"></input>
							</div>
						</div>

						<div class="form-group{{ $success==1 ? ' has-success' : '' }}">
							<label for="context" class="col-md-4 control-label">對話內容：</label>
							<div class="col-md-6">
								<textarea id="context" rows="5" type"text" class="form-control" name="context"></textarea>
								@if ($success == 1)
                        		<span class="help-block">
                            		<strong>對話已經存進資料庫囉！</strong>
                        		</span>
                        		@endif
							</div>
						</div>

						<div class="form-group">
							<div class="col-md-6 col-md-offset-4">
								<button type="submit" class="btn btn-primary">送出</button>
							</div>
						</div>

					</form>
				</div>
			</div>
		</div>
	</div>
</div>


@endsection

@section('dialog')
@endsection