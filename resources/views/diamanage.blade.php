@extends('layouts.main')

@section('title','對話管理')

@section('content')

<div class="container">
	@for($i=0;$i<count($dialogs);$i++)
	
	@continue($i != 0 && ($dialogs[$i]->ocassion == $dialogs[$i-1]->ocassion))

	<div style="text-align:center;" class="col-md-2">
		<div class="panel panel-default">
			<div class="panel-heading">場合：{{ $dialogs[$i]->ocassion }}</div>
			<div class="panel-body">
					<img class="img-responsive img-rounded center-block" style="height:70px;weight:70px" src="{{ $dialogs[$i]->pic_path }}"</img>
					<br><a href="/diamanage/{{$dialogs[$i]->ocassion}}" class="btn btn-danger btn-sm">管理</a>
			</div>
		</div>
	</div>
	@endfor

</div>


@endsection

@section('dialog')
@endsection