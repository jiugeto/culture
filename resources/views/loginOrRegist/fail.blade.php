<!DOCTYPE html>
<html>
<head>
    <title>微文化-注册失败</title>
    <meta charset="utf-8">
    <link rel="icon" type="image/png" href="/assets/images/icon.png">
    <link rel="stylesheet" type="text/css" href="/assets-home/css/home.css">
    <link rel="stylesheet" type="text/css" href="/assets-home/css/login.css">
    <script src="/assets/js/jquery-1.10.2.min.js"></script>
</head>
<body>
@include('layout.header')

<div class="login">
    <p style="margin:100px auto;text-align:center;font-size:20px;color:grey;">
        注册失败！ <br>
        <b style="color:black;" id="countdown">5</b>
        秒后，页面跳转到
        <a href="/" style="color:orangered;text-decoration:none;">首页</a>
    </p>
    <script>
        function count(){
            var number = $("#countdown");
            number1 = number.html() * 1 - 1;
            number.html(number1);
        }
        function jump(){
            window.location.href = '/';
        }
        //5秒倒计时
        window.setInterval("count()",1000);
        //5秒后跳转到首页
        window.setInterval("jump()",1000 * 5);
    </script>
</div>

@include('layout.footer')

<script src="/assets/js/jquery.js"></script>
<script src="/assets/js/amazeui.js') }}"></script>
<script src="/assets/js/app.js"></script>
</body>
</html>