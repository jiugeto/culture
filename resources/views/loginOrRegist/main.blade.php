<!DOCTYPE html>
<html>
<head>
    <title>做视频</title>
    <meta charset="utf-8">
    <link rel="icon" type="image/png" href="/assets/images/icon.png">
    <link rel="stylesheet" type="text/css" href="/assets-home/css/home.css">
    <link rel="stylesheet" type="text/css" href="/assets-home/css/login.css">
    <script src="/assets/js/jquery-1.10.2.min.js"></script>
</head>
<body>
@include('layout.header')

<div class="login">
    <table>
        <tr>
            <td><img src="/assets-home/images/register-login-left.png"></td>
            <td>
                <table class="login_right">
                    <tr>
                        <td class="login_text">
                            <a href="/regist" class="{{$_SERVER['REQUEST_URI']=='/regist'?'a_curr':''}}">注册</a>
                            <a href="/login" class="{{$_SERVER['REQUEST_URI']=='/login'?'a_curr':''}}">登陆</a>
                        </td>
                    </tr>
                    <tr><td>@yield('content')</td></tr>
                </table>
            </td>
        </tr>
    </table>
</div>

@include('layout.footer')

<script src="/assets/js/jquery.js"></script>
<script src="/assets/js/amazeui.js') }}"></script>
<script src="/assets/js/app.js"></script>
</body>
</html>