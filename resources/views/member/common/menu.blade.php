{{-- 会员后台左侧菜单列表模板 --}}

<div class="mem_float">
    <div class="mem_left">
        <ul class="mem_leftmenus">
        @foreach($memberMenus as $memberMenu)
            @if($memberMenu['pid']==0)
            <a href="{{DOMAIN}}member/{{$memberMenu['url']}}">
                <li class="a_li {{$memberMenu['name']=='账户首页'?"li_home":"li_one"}}">
                    <img src="{{PUB}}assets/images/{{$memberMenu['name']=='账户首页'?'home':'tool'}}.png"> {{ $memberMenu['name'] }}
                    @if(isset($lists['func']) && $lists['func']['name']==$memberMenu['name']) ✔ @endif
                </li>
            </a>
                @if($memberMenu['child'])
                    @foreach($memberMenu['child'] as $subMenu)
                    <a href="{{DOMAIN}}{{$subMenu['platUrl']}}/{{$subMenu['url']}}" @if($subMenu['url']=='home')target="_blank" @endif>
                            <li class="a_li li_sub">
                                {{ $subMenu['name'] }}
                                @if(isset($lists['func']) && $lists['func']['name']==$subMenu['name']) ✔ @endif
                            </li>
                    </a>
                    @endforeach
                @endif
            @endif
        @endforeach
            {{--以下是主页链接--}}
        @if(Session::has('user'))
            <a href="javascript:;">
                <li class="a_li li_one"><img src="{{PUB}}assets/images/home.png"> 我的主页</li>
            </a>
            <a href="{{DOMAIN}}person/s" target="_blank">
                <li class="a_li li_sub"> 个人主页</li>
            </a>
            @if(Session::get('user.cid'))
            <a href="{{DOMAIN}}c/{{Session::get('user.cid')}}">
                <li class="a_li li_sub"> 企业主页</li>
            </a>
            <a href="{{DOMAIN}}com/back">
                <li class="a_li li_sub"> 企业后台</li>
            </a>
            @endif
        @endif
        </ul>
    </div>
</div>