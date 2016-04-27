{{-- 这里是公司后台控制中心 --}}


{{--<div class="com_admin_crumb_bai">&nbsp;</div>--}}
<div class="com_admin_crumb">
    <p>首页
        @if(!in_array($lists['func']['url'],['home','auth','info','content']))
            / {{ $lists['func']['name'] }}
        @endif
        {{--@if(isset($lists['create'])) / {{ $lists['create']['name'] }} @endif--}}
        {{--@if(isset($lists['edit'])) / {{ $lists['edit']['name'] }} @endif--}}
        {{--@if(isset($lists['show'])) / {{ $lists['show']['name'] }} @endif--}}
        / {{ $curr['name'] }}
    </p>
</div>
{{--<div class="com_admin_crumb_bai">&nbsp;</div>--}}