{{-- 前台页面菜单导航栏 --}}


<!-- navigate菜单导航栏 -->
<div class="nav">
    <hr>
    <div class="nav_body">
        <div><a href="/"><img src="/assets-home/images/logo.png" class="logo"></a></div>
        <div class="nav_qiehuan" style="display:{{explode('/',$_SERVER['REQUEST_URI'])[1]?'block':'none'}};">
            <img src="/assets/images/daohang.png" class="imgMiniSize"> 导航
        </div>
        <div class="nav_qh">
            <div class="nav_hide">
                @foreach($navigates as $navigate)
                    <a href="{{ $navigate->link }}" class="@if(isset($curr_menu) && $curr_menu==$navigate->link) curr @else nav_a @endif" title="{{ $navigate->title }}">{{ $navigate->name }}</a>
                @endforeach
                {{--@foreach($menus as $kmenu=>$menu)--}}
                {{--<a href="/{{$kmenu}}" class="@if(isset($curr_menu) && $curr_menu==$kmenu) curr @else nav_a @endif">{{ $menu }}</a>--}}
                {{--@endforeach--}}
            </div>
        </div>
        <div class="search">
            <input type="text" class="search_input" name="global_search" placeholder="想要啥效果，赶紧找哦">
            <input type="submit" class="search_text" value="搜 索">
        </div>
        <div class="keyword_pos">搜索关键词：{{explode('/',$_SERVER['REQUEST_URI'])[1]}}</div>
        <div class="nav_right">
            <a href="/{{ Session::has('user.username') ? 'member' : 'login' }}">
                <img src="/assets/images/key.png" class="imgMiniSize">
                {{ Session::has('user.username') ? Session::get('user.username') : '登录/注册' }}</a>&nbsp;
            {{--<div class="login_hide">--}}
                {{--<a href="">资料</a><br>--}}
                {{--<a href="">退出</a>--}}
            {{--</div>--}}
            {{--<a href="/login"><img src="/assets/images/key.png" class="imgMiniSize">登陆/注册</a>&nbsp;--}}
            {{--<a href="/"><img src="/assets/images/msg.png" class="imgMiniSize">消息</a>&nbsp;--}}
            {{--<img src="/assets/images/record.png" class="imgMiniSize"><a href="/">记录</a>--}}
            &nbsp;&nbsp;<a href="/opinion" class="opinion" style="color:white;">用户意见</a>
        </div>
        <div class="navigate">
            <div class="navigate_a" style="display:{{explode('/',$_SERVER['REQUEST_URI'])[1]?'none':'block'}};">
                @foreach($navigates as $navigate)
                    @if($navigate->id<10)
                    <a href="/{{ $navigate->link }}" class="@if(isset($curr_menu) && $curr_menu==$navigate->link) curr @else nav_a @endif" title="{{ $navigate->title }}">{{ $navigate->name }}</a>
                    @endif
                @endforeach
            {{--@foreach($menus as $kmenu=>$menu)--}}
                {{--@if(in_array($kmenu,['home','product','creation','supply','demand','entertain','rent','design','about']))--}}
                {{--<a href="/{{$kmenu}}" class="@if(isset($curr_menu) && $curr_menu==$kmenu) curr @else nav_a @endif">{{ $menu }}</a>--}}
                {{--@endif--}}
            {{--@endforeach--}}
            </div>
        </div>
    </div>
</div>
<!-- navigate菜单导航栏 -->


<script>
    $(document).ready(function(){
        //菜单栏切换
        var nav_qiehuan = $(".nav_qiehuan");
        var nav_qh = $(".nav_qh");
        var nav_hide = $(".nav_hide");
        nav_qiehuan.mouseover(function(){
            nav_hide.show();
            nav_qiehuan.css('border-bottom','0');
        });
        nav_qh.mouseleave(function(){
            nav_hide.hide();
            nav_qiehuan.css('border-bottom','1px solid lightgray');
        });
        nav_qiehuan.click(function(){
            nav_hide.toggle();
        });
        //根据浏览器宽度设置菜单位置
        var clientWidth = document.body.clientWidth;
//        alert(clientWidth);
        nav_qiehuan.css('position','fixed');
        nav_qiehuan.css('left',(clientWidth-1000)/2+200+'px');
        nav_qh.css('position','fixed');
        nav_qh.css('left',(clientWidth-1000)/2+20+'px');
    });
</script>