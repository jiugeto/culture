{{-- 面包屑导航 --}}


<div class="mem_crumb">
    <a href="/member">会员后台</a>
    @if(isset($lists['func'])) / @endif
    {{--功能模块--}}
    <a href="/member/{{$lists['func']['url']}}">
    @if(isset($lists['func'])) {{ $lists['func']['name'] }} @endif
    </a>
    {{--@if(!isset($prefix_url) && isset($menus['create']['name']) && !is_numeric(explode('/',$_SERVER['REQUEST_URI'])[3])) {{ ' / '.$menus['create']['name'] }} @endif
    @if(isset(explode('/',$_SERVER['REQUEST_URI'])[3]) && is_numeric(explode('/',$_SERVER['REQUEST_URI'])[3])) {{ '/'.$menus['show']['name'] }} @endif--}}
    {{--具体操作页--}}
    @if(in_array($curr_list,['create','edit','show','pre'])) {{ ' / '.$lists[$curr_list]['name'] }} @endif
    @if($curr_list=='trash') {{ ' / '.$lists['trash'] }} @endif
</div>