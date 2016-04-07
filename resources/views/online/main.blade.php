<!DOCTYPE html>
<html>
<head>
    <title>微文化-在线创作</title>
    <meta charset="utf-8">
    <link rel="icon" type="image/png" href="/assets/images/icon.png">
    <link rel="stylesheet" type="text/css" href="/assets-home/css/home.css">
    <link rel="stylesheet" type="text/css" href="/assets-home/css/online.css">
    <script src="/assets/js/jquery-1.10.2.min.js"></script>
</head>
<body>
@include('layout.header')
{{--@include('layout.navigate')--}}

<div class="online_bg">
    @yield('content')
</div>

@include('layout.footer')
</body>
</html>