{{-- 会员后台左侧菜单列表模板 --}}

<div class="mem_float">
    <div class="mem_left">
        <ul class="mem_leftmenus">
        @foreach($memberMenus as $memberMenu)
            @if($memberMenu->pid==0)
            <a href="/member/{{$memberMenu->url}}">
                <li class="a_li {{$memberMenu->name=='账户首页'?"li_home":"li_one"}}">
                    <img src="/assets/images/{{$memberMenu->name=='账户首页'?'home':'tool'}}.png"> {{ $memberMenu->name }}
                </li>
            </a>
                @if($memberMenu->child)
                    @foreach($memberMenu->child as $subMenu)
                    <a href="/member/{{$memberMenu->url}}">
                            <li class="a_li li_sub">{{ $subMenu->name }}</li>
                    </a>
                    @endforeach
                @endif
            @endif
        @endforeach
        </ul>
    </div>
</div>