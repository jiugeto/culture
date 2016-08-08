<!DOCTYPE html>
<html>
<head>
    <title>微文化</title>
    <meta charset="utf-8">
    <link rel="icon" type="image/png" href="/assets/images/icon.png">
    <link rel="stylesheet" type="text/css" href="/assets-home/css/home.css">
    <link rel="stylesheet" type="text/css" href="/assets-home/css/home_body.css">
    <link rel="stylesheet" type="text/css" href="/assets-home/css/product.css">
    <link rel="stylesheet" type="text/css" href="/assets-home/css/creation.css">
    <link rel="stylesheet" type="text/css" href="/assets-home/css/supply.css">
    <link rel="stylesheet" type="text/css" href="/assets-home/css/design.css">
    <link rel="stylesheet" type="text/css" href="/assets-home/css/about.css">
    <link rel="stylesheet" type="text/css" href="/assets-home/css/opinion.css">
    <link rel="stylesheet" type="text/css" href="/assets-home/css/talk.css">
    <script src="/assets/js/jquery-1.10.2.min.js"></script>
</head>
<body>
{{--浏览器问题--}}
@include('layout.browser')
{{--浏览器问题--}}

    @include('layout.header')
    {{--@include('layout.navigate')--}}

    <!-- 空白 -->
    <div class="content_kongbai">&nbsp;</div>

    <!-- 中间内容 -->
    @yield('content')
    <!-- 中间内容 -->

    <!-- 空白 -->
    <div class="content_kongbai">&nbsp;</div>

    @include('layout.footer')
</body>
</html>