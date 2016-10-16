<!doctype html>
<html class="no-js">
<head>
  <meta charset="utf-8">
  <title>做视频--系统后台管理</title>
  <link rel="icon" type="image/png" href="{{PUB}}assets/images/icon.png">
  <link rel="stylesheet" href="{{PUB}}assets/css/amazeui.min.css"/>
  <link rel="stylesheet" href="{{PUB}}assets/css/admin.css">
  <link rel="stylesheet" href="{{PUB}}assets/css/admin_cus.css">
  <link rel="stylesheet" type="text/css" href="{{PUB}}assets/css/video.css">
  <script src="{{PUB}}assets/js/jquery-1.10.2.min.js"></script>
</head>
<body>
<!--[if lte IE 9]>
<p class="browsehappy">你正在使用<strong>过时</strong>的浏览器，Amaze UI 暂不支持。 请 <a href="http://browsehappy.com/" target="_blank">升级浏览器</a>
  以获得更好的体验！</p>
<![endif]-->

@include('admin.partials.header')

<div class="am-cf admin-main">
  <!-- sidebar start -->
  <div class="admin-sidebar am-offcanvas" id="admin-offcanvas">
    <div class="am-offcanvas-bar admin-offcanvas-bar">
      @include('admin.partials.menu')

      <div class="am-panel am-panel-default admin-sidebar-panel">
        <div class="am-panel-bd">
          <p><span class="am-icon-bookmark"></span> 公告</p>
          {{--<p>时光静好，与君语；细水流年，与君同。—— Amaze UI</p>--}}
          <p>梦想还是要有的，万一成功了呢！</p>
        </div>
      </div>

      <div class="am-panel am-panel-default admin-sidebar-panel">
        <div class="am-panel-bd">
          <p><span class="am-icon-tag"></span> wiki</p>
          {{--<p>Welcome to the Amaze UI wiki!</p>--}}
          <p>Welcome to MicroCulture!</p>
        </div>
      </div>
    </div>
  </div>
  <!-- sidebar end -->

  @yield('content')
</div>

<a href="#" class="am-show-sm-only admin-menu" data-am-offcanvas="{target: '#admin-offcanvas'}">
  <span class="am-icon-btn am-icon-th-list"></span>
</a>

@include('admin.partials.footer')

<script src="/assets/js/jquery.js"></script>
<script src="/assets/js/amazeui.js"></script>
<script src="/assets/js/app.js"></script>
</body>
</html>
