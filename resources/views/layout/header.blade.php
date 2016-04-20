{{-- 前台首页头模板 --}}

<!-- header头 -->
<div class="header">
    <div class="header_text text_color">
      <span>
        <div class="head_left">欢迎来逛逛</div>
        <div class="head_left">
            @if(Session::has('user.username'))
                <a href="/member">{{ Session::get('user.username') }}</a>
                <a href="/member">会员中心</a>
                <a href="/login/dologout">退出</a>
            @else
                <a href="/regist">免费注册</a>
            @endif
        </div>
      </span>
      <span class="header_right">
        <div class="head_right"><a href="/" style="color:red;">淘文化首页</a></div>
        <div class="head_right"><a href="">新手点这里</a></div>
      </span>
    </div>
</div>
<!-- header头 -->