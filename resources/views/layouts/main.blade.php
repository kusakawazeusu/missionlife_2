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

    <link href="http://netdna.bootstrapcdn.com/font-awesome/3.2.1/css/font-awesome.css" rel="stylesheet">

    <!-- Custom CSS -->
    <style>
    body {
        font-family: 'Noto Sans TC', sans-serif;
        padding-top: 30px;
        /* Required padding for .navbar-fixed-top. Remove if using .navbar-static-top. Change if height of navigation changes. */
    }


    .dropdown-menu { width:450px; }
    .dropdown-menu li { position:relative; margin:0 0 0 10px}
    .dropdown-menu li a { position:relative; display:inline-block; padding-left:35px;}
    .dropdown-menu li i { position:absolute; padding-right:25px; top:25%;}
    
    #icon > var {
      position:absolute;
      top:8px;
      right:4px;
      padding:3px 3px;
      background: red; color: white;
      border-radius:3px;
    }


    .achieve {
        display:none;
        top: 60%;
        left: 30%;
        position: absolute;
        height:10%;
        width:40%;
        background-color:#3c76e7;
        border-radius: 15px;
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

<?php if(!Auth::Guest()){ $read = DB::table('message')->where('user_id',Auth::user()->id)->where('read',0)->count(); }else{ $read=0; } ?>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script>
    $(document).ready(function(){

        $(document).ready(function(){
            //$('.achieve').delay(2000).fadeIn().delay(5000).fadeOut();
        });

        $("#icon > var").text({{ $read }});

        $('#myDropdown').on('show.bs.dropdown', function () {
            $(this).find('.dropdown-menu').first().slideDown();
        });

        $('#myDropdown').on('hide.bs.dropdown', function () {
            $(this).find('.dropdown-menu').first().slideUp(function(){
                $(document).load("/update");
                $("#icon > var").css("display","none");
            });

        });
    });
</script>


    <div class="achieve"></div>

    <!-- Navigation -->
    <nav class="navbar navbar-default navbar-fixed-top" role="navigation">
        <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <!--無障礙設備才看得到上面這行-->
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <!--手機的選項三條線-->
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
                @elseif(Auth::Guest() == false && Auth::user()->auth == '2')
                <ul class="nav navbar-nav navbar-left">
                    <li>
                        <a href="{{ url('/newdia') }}">新增對話</a>
                    </li>
                    <li>
                        <a href="{{ url('/diamanage') }}">管理對話</a>
                    </li>
                    <li>
                        <a href="{{ url('/usermanage') }}">使用者</a>
                    </li>
                </ul> 
                @endif
                <ul class="nav navbar-nav navbar-right">
                    @if(Auth::Guest())
                    <li>
                        <a>訪客</a>
                    </li>
                    <li>
                        <a href="{{ url('/login') }}">Login</a>
                    </li>
                    <li>
                        <a href="{{ url('/register') }}">Register</a>
                    </li>
                    @elseif(Auth::user()->auth=='0')
                    <li>
                        @if(Auth::user()->gender=='1')
                        <a href="{{ url('/account') }}"><i class="icon-male icon-large"> <strong>{{ Auth::user()->name }}</strong></i></a>
                        @else
                        <a href="{{ url('/account') }}"><i class="icon-female icon-large"> <strong>{{ Auth::user()->name }}</strong></i></a>
                        @endif
                    </li>

                    <?php if(!Auth::Guest()) {$message = DB::table('message')->where('user_id',Auth::user()->id)->get();} ?>

                    <li id="myDropdown" class="dropdown">
                        <a href="#"  class="dropdown-toggle" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                        <i id="icon" class="icon-meh icon-large">@if( $read != 0 )<var></var>@endif</span></i>
                        </a>
                        <ul class="dropdown-menu middle" aria-labelledby="dropdownMenu1">

                            <li class="dropdown-header">近期通知</li>
                            <li role="separator" class="divider"></li>
                            @for($i=count($message)-1;($i>=0 && $i>=count($message)-5);$i--)
                            <li>
                                <i class="icon-gift icon-2x"></i><a href="/{{$message[$i]->address}}">{!!html_entity_decode($message[$i]->content)!!}</a>
                            </li>
                            <li role="separator" class="divider"></li>
                            @endfor



                        </ul>
                    </li>
                    <li>
                        <a href="{{ url('/logout') }}">Logout</a>
                    </li>
                    @elseif(Auth::user()->auth=='1')
                    <li>
                        <a>NPC</a>
                    </li>
                    <li>
                        <a href="{{ url('/logout') }}">Logout</a>
                    </li>
                    @elseif(Auth::user()->auth=='2')
                    <li>
                        <a>GM</a>
                    </li>
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