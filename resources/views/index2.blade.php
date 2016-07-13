<!DOCTYPE html>
<html lang="en">
<head>
  <title> MissionLife - @yield('title') </title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="bootstrap/dist/css/bootstrap.min.css">
  <script src="jquery/dist/jquery.min.js"></script>
  <script src="bootstrap/dist/js/bootstrap.min.js"></script>
</head>
<body>

@include('layout.partials.header')

<div class="page-header">
  <div class="container">
    <h1>Mission Life</h1>
  </div>
</div>

<div class="container">
  <div class="alert alert-danger fade in">
    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
    <strong>危險！</strong> Compiler成績出來啦！
  </div>
</div>

<div class="row">
  <div class="col-md-1"></div>
  <div class="col-md-5">
    <center><img src="http://i.imgur.com/aPeLAQk.gif" class="img-rounded" width="504" height="210"></img></center>
  </div>

  <div class="col-md-4">
      <form>
      <h3>帳號：<input type="text"></input></h3>
      <h3>密碼：<input type="text"></input></h3><br>
      <button class="btn btn-success btn-lg" type="submit"><span class="glyphicon glyphicon-log-in"></span> 登入</button>
      </form>
      </div>
</div>

</body>
</html>
