{{-- 前台首页头模板 --}}

<!-- header头 -->
<div class="header">
    <div class="header_text text_color">
      <span>
        <div class="head_left">欢迎来逛逛</div>
        <div class="head_left">
            @if(Session::has('user.username'))
                <a href="/member">{{ Session::get('user.username') }}</a>
                <a href="/member" target="_blank">会员中心</a>
                <a href="/login/dologout">退出</a>
            @else
                <a href="/regist">免费注册</a>
                <a href="/login">登录</a>
            @endif
        </div>
      </span>
      <span class="header_right">
        <div class="head_right"><a href="/online">在线创作</a></div>
        <div class="head_right"><a href="/newuser">新手点这里</a></div>
        <div class="head_right">
            <a href="/" style="color:red;">淘文化首页</a>
            {{--<select name="urlType">--}}
                {{--<option value="/" {{explode($_SERVER['REQUEST_URI'],'/')[1]==''?'selected':''}}>淘文化首页</option>--}}
                {{--<option value="/member" {{ explode($_SERVER['REQUEST_URI'],'/')[1]=='member' ? 'selected' : '' }}>会员后台</option>--}}
                {{--<option value="/person/space" {{ explode($_SERVER['REQUEST_URI'],'/')[1]=='person' ? 'selected' : '' }}>个人后台</option>--}}
            {{--</select>--}}
            {{--<script>--}}
                {{--$("select[name='urlType']").change(function(){--}}
                    {{--window.location.href = $(this).val();--}}
                {{--});--}}
            {{--</script>--}}
        </div>
      </span>
    </div>
</div>
<!-- header头 -->