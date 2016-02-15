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

{{-- 链接 --}}
<div class="am-g">
    <div class="am-u-sm-12 am-u-md-6">
        <div class="am-btn-toolbar">
            <div class="am-btn-group am-btn-group-xs">
            @if($crumb['function']['url']=='')
                <a href="/admin/{{$crumb['category']['url']}}/create">
                    <button type="button" class="am-btn am-btn-default">
                        <img src="/assets/images/add.png" class="icon">
                        @if($crumb['category']['url']=='action') 新增0级操作
                        @else 添加
                        @endif
                    </button>
                </a>
            @else
                <a onclick="history.go(-1)">
                    <button type="button" class="am-btn am-btn-default">
                        <img src="/assets/images/files.png" class="icon">返回上页
                    </button>
                </a>&nbsp;
                <a href="/admin/{{$crumb['category']['url']}}">
                    <button type="button" class="am-btn am-btn-default">
                        <img src="/assets/images/files.png" class="icon">
                        返回{{ $crumb['category']['name'] }}
                    </button>
                </a>&nbsp;
                {{--<a href="/admin/{{$crumb['category']['url']}}/{{$crumb['function']['url']}}">--}}
                    {{--<button type="button" class="am-btn am-btn-default">--}}
                        {{--<img src="/assets/images/add.png" class="icon">--}}
                        {{--{{ $crumb['function']['name'] }}--}}
                    {{--</button>--}}
                {{--</a>&nbsp;--}}
            @endif
            </div>
        </div>
    </div>
    @include('admin.common.search')
</div>