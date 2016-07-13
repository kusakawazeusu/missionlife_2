<!DOCTYPE html>
<html lang="en">
<head>
  <title> MissionLife - @yield('title') </title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="{{ asset('bootstrap/dist/css/bootstrap.min.css') }}">
  <script src="{{ asset('jquery/dist/jquery.min.js') }}"></script>
  <script src="{{ asset('bootstrap/dist/js/bootstrap.min.js') }}"></script>
</head>
<body>

@section('header')
	@include('layouts.partials.header')
@show
<br><br>
@section('content')
	<p> This is mainbody</p>
@show



	

</body>
</html>