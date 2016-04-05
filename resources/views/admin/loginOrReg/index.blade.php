<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>系统后台登录</title>
    <link href="/assets/css/app.css" rel="stylesheet">
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    <script type="text/javascript" src="bower_components/jquery/jquery.min.js"></script>
</head>
<body>

{{-- 顶部 --}}
<nav class="navbar navbar-default">
    <div class="container-fluid">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                {{--<span class="sr-only">Toggle Navigation</span>--}}
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            {{--<a class="navbar-brand" href="#">Laravel</a>--}}
        </div>

        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">
                {{--<li><a href="">Home</a></li>--}}
                <li><a href="">后台登陆</a></li>
            </ul>

            <ul class="nav navbar-nav navbar-right">
                {{--<li><a href="">Login</a></li>--}}
                {{--<li><a href="">Register</a></li>--}}
                {{--<li><a href="/admin/login">登陆</a></li>--}}
                {{--<li><a href="/admin/register">注册</a></li>--}}
                {{--<li class="dropdown">--}}
                    {{--<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><span class="caret"></span></a>--}}
                    {{--<ul class="dropdown-menu" role="menu">--}}
                    {{--</ul>--}}
                {{--</li>--}}
            </ul>
        </div>
    </div>
</nav>
{{-- 顶部 --}}

@yield('content')

</body>
</html>
