{{-- 系统后台面包屑导航 --}}


{{-- 面包屑名称 --}}
<div class="am-cf am-padding">
    <div class="am-fl am-cf">
        <strong class="am-text-primary am-text-lg">{{ $crumb['main']['name'] }}</strong> /
        {{--<small>Action Add</small>--}}
        {{--<strong class="am-text-primary am-text-lg">{{ $crumb['category']['name'] }}</strong> /--}}
        <strong class="am-text-primary am-text-lg">{{ $curr['name'] }}</strong>
        {{--@if(isset($genre)) / <strong class="am-text-primary am-text-lg">{{ $genre==2?'效果定制':'动画定制' }}</strong>@endif--}}
        <strong class="am-text-primary am-text-lg" style="margin-left:20px;cursor:pointer;" onclick="history.go(-1);">返回</strong>
    </div>
</div>