<!DOCTYPE html>
<html>
<head>
    <title>微文化-个人页面</title>
    <meta charset="utf-8">
    <link rel="icon" type="image/png" href="{{PUB}}assets/images/icon.png">
    <link rel="stylesheet" type="text/css" href="{{PUB}}assets-home/css/home.css">
    <link rel="stylesheet" type="text/css" href="{{PUB}}assets-home/css/person.css">
    <script src="{{PUB}}assets/js/jquery-1.10.2.min.js"></script>
</head>
<body>
    @include('layout.header')
    {{--@include('layout.navigate')--}}
    <div class="mem_con">
        <!-- 中间内容 -->
        <div class="mem_float">
            <div class="mem_right">
                <div class="mem_win">
                    @yield('content')
                </div>
                <!-- 空白 -->
                <div class="content_kongbai">&nbsp;</div>
            </div>
        </div>
        <!-- 中间内容 -->
    </div>
    @include('layout.footer')
</body>
</html>