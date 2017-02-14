{{-- 这里是首页面包屑导航模板 --}}


<div class="s_crumb">
    <div class="crumb">
        <div class="right">
            <a href="/">首页</a> /
            {{--意见、话题等导航--}}
            @foreach($navigates as $navigate)
                @if($curr_menu==$navigate['link'])<a href="/{{$curr_menu}}">{{ $navigate['name'] }}</a>@endif
                @if($navigate['link']=='opinion' && $curr_menu=='opinion')
                    @if(!isset($isreply))
                        @if(isset($curr)&&$curr=='create')/ <a href="opinion/create">发布新意见</a>@endif
                        @if(isset($curr)&&$curr=='edit')/ 修改意见@endif
                        @if(isset($curr)&&$curr=='show')/ 详情@endif
                    @endif
                    {{ isset($isreply) ? ' / 意见'.$isreply.'的回复' : '' }}
                @endif
            @endforeach

            {{--模块名称--}}
            @if(isset($lists)&&array_key_exists($curr_menu,$lists))<a href="/{{ $curr_menu }}">{{ $lists[$curr_menu] }}</a>@endif

            {{--详情--}}
            {{ isset($curr_submenu) ? '/ '.$curr_submenu['name'] : ''   }}
        </div>
    </div>
</div>