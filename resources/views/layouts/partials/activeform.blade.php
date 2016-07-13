@extends('layouts.master')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-body">
                    @if (Auth::Guest())
                        <h3 class="text-center">哈囉，您尚未登入，若要報到的話，請先登入喔！</h3>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>


@endsection