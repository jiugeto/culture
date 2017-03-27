<!DOCTYPE html>
<html>
<head>
    <title>做视频</title>
    <meta charset="utf-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" type="image/png" href="{{PUB}}assets/images/icon.png">
    <link rel="stylesheet" type="text/css" href="{{PUB}}assets-home/css/home.css">
    <link rel="stylesheet" type="text/css" href="{{PUB}}assets-home/css/member.css">
    <link rel="stylesheet" type="text/css" href="{{PUB}}assets/css/video.css">
    <link rel="stylesheet" type="text/css" href="{{PUB}}assets-home/css/creation.css">
    <script src="{{PUB}}assets/js/jquery-1.10.2.min.js"></script>
</head>
<body>
    @include('layout.header')
    @include('layout.navigate')
    <div class="mem_con">
        @include('member.common.menu')

        <!-- 中间内容 -->
        <div class="mem_float">
            <div class="mem_right">
                <div class="mem_win">
                    @yield('content')
                </div>
                <!-- 空白 -->
                <div class="content_kongbai" style="height:150px;">&nbsp;</div>
            </div>
        </div>
        <!-- 中间内容 -->
    </div>
    @include('layout.footer')

    @include('layout.qqchat')
</body>
</html>