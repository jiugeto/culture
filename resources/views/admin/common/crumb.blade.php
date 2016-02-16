{{-- 系统后台面包屑导航 --}}


{{-- 面包屑名称 --}}
<div class="am-cf am-padding">
    <div class="am-fl am-cf">
        <strong class="am-text-primary am-text-lg">{{ $crumb['main']['name'] }}</strong> /
        {{--<small>Action Add</small>--}}
        <strong class="am-text-primary am-text-lg">{{ $crumb['category']['name'] }}</strong> /
        <strong class="am-text-primary am-text-lg">{{ $crumb['function']['name'] }}</strong> /
    </div>
</div>