@extends('layouts.main')

@section('title','講座活動QRcode')

@section('dialog')
@endsection

@section('content')
      @if(!Auth::Guest() && Auth::user()->auth=='1')
            <div class="container">
                  <div class="col-md-8 col-md-offset-2">
                        {!! QrCode::size(200)->generate($url) !!}
                  <div class="col-md-6 col-md-offset-2">
                        <h3>在講座中，讓冒險者們<br>掃描QRcode就可以完成<p class="text-success"><strong>{{ $quest[0]->name }}</strong></p>講座活動的簽到囉！！</h3>
                  </div>
            </div>
      @endif


@endsection