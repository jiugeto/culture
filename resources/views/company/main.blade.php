<!DOCTYPE html>
<html>
<head>
    <title>微文化-企业{{ Session::has('user.cid')?unserialize(Session::get('user.company'))['name']:'' }}页面</title>
    <meta charset="utf-8">
    <link rel="icon" type="image/png" href="/assets/images/icon.png">
    <link rel="stylesheet" type="text/css" href="/assets-home/css/home.css">
    <link rel="stylesheet" type="text/css" href="/assets-home/css/company.css">
    <link rel="stylesheet" type="text/css" href="/assets/css/video.css">
    <script src="/assets/js/jquery-1.10.2.min.js"></script>
</head>
<body>
    @include('layout.header')
    @include('layout.visitTimer')
    @include('company.partials.top')
    <div class="content_kongbai" style="height:100px;">&nbsp;</div>
    <div class="mem_con">
        <!-- 中间内容 -->
        <div class="mem_float">
            <div class="mem_right">
                <div class="mem_win">
                    <div class="com_body">@yield('content')</div>
                </div>
                <!-- 空白 -->
                <div class="content_kongbai">&nbsp;</div>
            </div>
        </div>
        <!-- 中间内容 -->
    </div>
    @include('company.partials.footer')
</body>
</html>