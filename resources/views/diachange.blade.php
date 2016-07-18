@extends('layouts.main')

@section('title','對話管理 '.$dialogs[0]->ocassion)

@section('content')

@include('layouts.partials.dialog',['dialogs' => $dialogs])

<div class="container">

	<table class="table table-hover table-bordered">
		<thead>
			<tr class="info">
				<th class="text-center">對話場景</th>
				<th class="text-center">圖片路徑</th>
				<th class="text-center">角色名稱</th>
				<th class="text-center">對話內容</th>
				<th class="text-center" style="width:200px">操作</th>
			</tr>
		</thead>
		<tbody>
		@for($i=0;$i<count($dialogs);$i++)
			<tr>
				<th>{{ $dialogs[$i]->ocassion }}</th>
				<th>{{ $dialogs[$i]->pic_path }}</th>
				<th>{{ $dialogs[$i]->name }}</th>
				<th>{{ $dialogs[$i]->context }}</th>
				<th>
					@if($i != 0)
					<a href="/diamanage/{{$dialogs[$i]->ocassion}}/{{$dialogs[$i]->ordered}}/up" class="btn btn-primary btn-success btn-sm"><span class="glyphicon glyphicon-arrow-up"></span></a>
					@else
					<a class="btn btn-primary btn-success btn-sm disabled"><span class="glyphicon glyphicon-arrow-up"></span></a>
					@endif
					<a class="btn btn-primary btn-sm">修改</a>
					<a href="/diamanage/{{$dialogs[0]->ocassion}}/{{$dialogs[$i]->ordered}}/delete" class="btn btn-danger btn-sm">刪除</a>
					@if($i != count($dialogs)-1)
					<a href="/diamanage/{{$dialogs[0]->ocassion}}/{{$dialogs[$i]->ordered}}/down" class="btn btn-primary btn-success btn-sm"><span class="glyphicon glyphicon-arrow-down"></span></a>
					@else
					<a class="btn btn-primary btn-success btn-sm disabled"><span class="glyphicon glyphicon-arrow-down"></span></a>
					@endif
				</th>
			</tr>
		@endfor


		<tbody>
	</table>
</div>


@endsection

@section('dialog')
@endsection