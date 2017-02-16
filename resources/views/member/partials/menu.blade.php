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
        </ul>
    </div>
</div>