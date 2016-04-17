{{-- 这里是首页面包屑导航模板 --}}


<div class="s_crumb">
    <div class="crumb">
        <div class="right">
            <a href="/">首页</a> /
            {{--<a href="/{{$curr_menu}}">{{ $menus[$curr_menu] }}</a>--}}
            {{--@if(isset($menus['create']) && $menus['create']=='发布意见')--}}
                {{--@if($isreply==0)  / 发布新意见 @else {{ isset($reply) ? ' / 意见'.$reply.'的回复' : '' }} @endif--}}
            {{--@endif--}}
            {{--@if(isset($menus['edit']) && $menus['edit']=='修改意见')--}}
                {{--@if($data->isreply==0)  / 修改意见 @else {{ isset($data->reply) ? ' / 意见'.$data->reply.'的回复' : '' }} @endif--}}
            {{--@endif--}}
            {{--{{ isset($menus['show']) ? ' / '.$menus['show'] : '' }}--}}
            @foreach($navigates as $navigate)
                @if($curr_menu==$navigate->link)<a href="/{{$curr_menu}}">{{ $navigate->name }}</a>@endif
                @if($navigate->link=='opinion' && $curr_menu=='opinion')
                    @if(!isset($isreply))
                        @if(isset($curr)&&$curr=='create')/ <a href="opinion/create">发布新意见</a>@endif
                        @if(isset($curr)&&$curr=='edit')/ 修改意见@endif
                        @if(isset($curr)&&$curr=='show')/ 详情@endif
                    @endif
                    {{ isset($isreply) ? ' / 意见'.$isreply.'的回复' : '' }}
                @endif
            @endforeach
        </div>
    </div>
</div>