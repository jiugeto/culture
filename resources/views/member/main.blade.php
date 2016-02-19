<!DOCTYPE html>
<html>
<head>
    <title>微文化</title>
    <meta charset="utf-8">
    <link rel="icon" type="image/png" href="assets/images/icon.png">
    <link rel="stylesheet" type="text/css" href="assets-home/css/home.css">
    <link rel="stylesheet" type="text/css" href="assets-home/css/home_body.css">
    <link rel="stylesheet" type="text/css" href="assets-home/css/creation.css">
</head>
<body>
    @include('layout.header')
    @include('layout.navigate')
        @include('member.partials.menu')
        <!-- 中间内容 -->
        @yield('content')
        <!-- 中间内容 -->
    @include('layout.footer')
</body>
</html>