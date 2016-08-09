{{-- 面包屑导航 --}}


<div class="mem_crumb">
    <a href="/member">会员后台</a>
    @if(isset($lists['func'])) / @endif
    {{--功能模块--}}
    @if(isset($lists['func']))
        <a href="/member/{{$lists['func']['url']}}"> {{ $lists['func']['name'] }} </a>
    @endif

    {{--具体操作页--}}
    @if(in_array($curr,['create','edit','show','pre'])) {{ ' / '.$lists[$curr]['name'] }} @endif
    @if($curr['url']=='') {{ ' / '.$lists['']['name'] }} @endif
    @if($curr['url']=='trash') {{ ' / '.$lists['trash']['name'] }} @endif
</div>