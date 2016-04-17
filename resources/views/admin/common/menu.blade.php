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
                @if(!in_array($crumb['category']['url'],['action','menus','admin','role','link']))
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
        </div>
        {{--<div class="am-btn-group am-btn-group-xs">
            @if(array_key_exists('trash',$crumb))
                @if($crumb['function']['url']=='')
                    <a href="/admin/{{$crumb['category']['url']}}/create">
                        <button type="button" class="am-btn am-btn-default">
                            <img src="/assets/images/add.png" class="icon">
                            @if($crumb['category']['url']=='action') 新增0级操作
                            @else 添加
                            @endif
                        </button>
                    </a>
                @endif
                <a href="/admin/{{$crumb['trash']['url']}}">
                    <button type="button" class="am-btn am-btn-default">
                        <img src="/assets/images/del.png" class="icon">
                        {{ $crumb['trash']['name'] }}
                    </button>
                </a>
            @else
                @if($crumb['category']['url']=='type')
                <a onclick="history.go(-1)">
                    <button type="button" class="am-btn am-btn-default">
                        <img src="/assets/images/files.png" class="icon">返回上页
                    </button>
                </a>&nbsp;
                @endif
                <a href="/admin/{{$crumb['category']['url']}}">
                    <button type="button" class="am-btn am-btn-default">
                        <img src="/assets/images/files.png" class="icon">
                        返回{{ $crumb['category']['name'] }}
                    </button>
                </a>
            @endif
        </div>--}}
    </div>
</div>