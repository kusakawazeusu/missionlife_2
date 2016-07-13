<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Mission Life - @yield('title') </title>

    <!-- Bootstrap Core CSS -->
    <link href="{{ asset('bootstrap/dist/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('mycss/style.css') }}" rel="stylesheet">
    <link href="{{ asset('mycss/full.css') }}" rel="stylesheet">

    <link href="{{ asset('bootstrap/dist/css/datepicker.css') }}" rel="stylesheet">


    <!-- Custom CSS -->
    <style>
    body {
        padding-top: 30px;
        /* Required padding for .navbar-fixed-top. Remove if using .navbar-static-top. Change if height of navigation changes. */
    }

    </style>

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->


</head>

<body>

    <!-- Navigation -->
    <nav class="navbar navbar-default navbar-fixed-top" role="navigation">
        <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="{{ url('/') }}">Mission Life</a>
            </div>
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                @if(Auth::Guest() == false && Auth::user()->auth == '0')
                <ul class="nav navbar-nav navbar-left">
                    <li>
                        <a href="{{ url('/quest') }}">任務大廳</a>
                    </li>
                    <li>
                        <a href="{{ url('/account') }}">冒險者資料</a>
                    </li>
                </ul>
                @elseif(Auth::Guest() == false && Auth::user()->auth == '1')
                <ul class="nav navbar-nav navbar-left">
                    <li>
                        <a href="{{ url('/newquest') }}">發佈新任務</a>
                    </li>
                    <li>
                        <a href="{{ url('/questmanage') }}">管理已發佈任務</a>
                    </li>
                    <li>
                        <a href="{{ url('/pastquest') }}">歷史資料</a>
                    </li>
                </ul>
                @endif
                <ul class="nav navbar-nav navbar-right">
                    @if(Auth::Guest())
                    <li>
                        <a href="{{ url('/login') }}">Login</a>
                    </li>
                    @else
                    <li>
                        <a href="{{ url('/logout') }}">Logout</a>
                    </li>
                    @endif
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
    </nav>

    <!-- Page Content -->


    @section('content')
    <p> This is mainbody</p>
    @show
    @section('dialog')
    <h1 class="text-center">對話框顯示區</h1>
    @show


    <!-- /.container -->

    <!-- jQuery Version 1.11.1 -->
    <script src="{{ asset('jquery/dist/jquery.min.js') }}"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="{{ asset('bootstrap/dist/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('bootstrap/dist/js/datepicker.js') }}"></script>
</body>

</html>
