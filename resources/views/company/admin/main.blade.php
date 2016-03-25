<!DOCTYPE html>
<html>
<head>
    <title>微文化-企业管理页面</title>
    <meta charset="utf-8">
    <link rel="icon" type="image/png" href="/assets/images/icon.png">
    <link rel="stylesheet" type="text/css" href="/assets-home/css/home.css">
    <link rel="stylesheet" type="text/css" href="/assets-home/css/company.css">
    <link rel="stylesheet" type="text/css" href="/assets-home/css/companyadmin.css">
    <script src="/assets/js/jquery-1.10.2.min.js"></script>
</head>
<body>
    @include('layout.header')
    @include('company.admin.partials.top')
    <div class="content_kongbai" style="height:100px;">&nbsp;</div>
    <div class="com_admin_con">
        @include('company.admin.partials.left')

        <div class="com_admin_right">@yield('content')</div>

        <div class="content_kongbai">&nbsp;</div>
    </div>
    @include('company.partials.footer')
</body>
</html>