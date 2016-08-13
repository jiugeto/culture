{{-- 系统后台面包屑下的菜单模板 --}}


{{-- 链接 --}}
<div class="am-u-sm-12 am-u-md-6">
    <div class="am-btn-toolbar">
        <div class="am-btn-group am-btn-group-xs">
            @if(mb_substr($curr['name'],-2)=='列表')
                <a href="/admin/{{$crumb['category']['url']}}/{{$crumb['create']['url']}}">
                    <button type="button" class="am-btn am-btn-default">
                        <img src="/assets/images/add.png" class="icon">
                        {{ $crumb['create']['name'] }}
                    </button>
                </a>
                @if(!in_array($crumb['category']['url'],$crumb['notrash']))
                <a href="/admin/{{$crumb['category']['url']}}/{{$crumb['trash']['url']}}">
                    <button type="button" class="am-btn am-btn-default">
                        <img src="/assets/images/del.png" class="icon">
                        {{ $crumb['trash']['name'] }}
                    </button>
                </a>
                @endif
            @else
                <a href="/admin/{{$crumb['category']['url']}}">
                    <button type="button" class="am-btn am-btn-default">
                        <img src="/assets/images/files.png" class="icon">
                        返回{{ $crumb['']['name'] }}
                    </button>
                </a>
            @endif
            @if($crumb['category']['url']=='pic')
                <a onclick="history.go(-1)">
                    <button type="button" class="am-btn am-btn-default">返回上一页</button>
                </a>
            @endif
        </div>
    </div>
</div>