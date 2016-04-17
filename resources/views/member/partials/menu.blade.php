{{-- 会员后台左侧菜单列表模板 --}}

<div class="mem_float">
    <div class="mem_left">
        <ul class="mem_leftmenus">
        @foreach($memberMenus as $memberMenu)
            @if($memberMenu->pid==0)
            <a href="/member/{{$memberMenu->url}}">
                <li class="a_li {{$memberMenu->name=='账户首页'?"li_home":"li_one"}}">
                    {{--@if($menus['func']['url']==explode('/',$_SERVER['REQUEST_URI'])[2]) a_orange @endif--}}
                    <img src="/assets/images/{{$memberMenu->name=='账户首页'?'home':'tool'}}.png"> {{ $memberMenu->name }}
                    @if($lists['func']['name']==$memberMenu->name) ✔ @endif
                </li>
            </a>
                @if($memberMenu->child)
                    @foreach($memberMenu->child as $subMenu)
                    <a href="/{{$subMenu->platUrl}}/{{$subMenu->url}}">
                            <li class="a_li li_sub">{{ $subMenu->name }} @if($lists['func']['name']==$subMenu->name) ✔ @endif</li>
                    </a>
                    @endforeach
                @endif
            @endif
        @endforeach
        </ul>
    </div>
</div>