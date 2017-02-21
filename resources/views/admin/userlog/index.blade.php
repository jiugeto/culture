@extends('admin.main')
@section('content')
    <div class="admin-content">
        @include('admin.common.crumb')
        <div class="am-g">
            <div class="am-u-sm-12 am-u-md-6">
                <div class="am-btn-toolbar">
                    <div class="am-btn-group am-btn-group-xs">
                        <a href="{{DOMAIN}}admin/userlog">
                            <button type="button" class="am-btn am-btn-default">
                                <img src="{{PUB}}assets/images/files.png" class="icon"> 会员日志
                            </button>
                        </a>
                        <a href="{{DOMAIN}}admin/adminlog">
                            <button type="button" class="am-btn am-btn-default">
                                <img src="{{PUB}}assets/images/files.png" class="icon"> 管理员日志
                            </button>
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <div class="am-g">
            <div class="am-u-sm-12">
                <table class="am-table am-table-striped am-table-hover table-main">
                    <thead>
                    <tr>
                        <th class="table-check"><input type="checkbox"/></th>
                        <th class="table-id">ID</th>
                        <th class="table-title">{{$crumb['category']['url']=='userlog'?'用户':'管理员'}}名称</th>
                        <th class="table-type">ip</th>
                        <th class="table-type">ip地址</th>
                        <th class="table-type">登陆时间</th>
                        <th class="table-date am-hide-sm-only">退出时间</th>
                        <th class="table-set">操作</th>
                    </tr>
                    </thead>
                    <tbody>
                @if(count($datas)>1)
                    @foreach($datas as $kdata=>$data)
                        @if(is_numeric($kdata))
                    <tr>
                        <td class="am-hide-sm-only"><input type="checkbox" /></td>
                        <td class="am-hide-sm-only">{{ $data['id'] }}</td>
                        <td class="am-hide-sm-only">{{ $data['username'] }}</td>
                        <td class="am-hide-sm-only">{{ $data['ip'] }}</td>
                        <td class="am-hide-sm-only">{{ $data['ipaddress'] }}</td>
                        <td class="am-hide-sm-only">{{ $data['loginTime'] }}</td>
                        <td class="am-hide-sm-only">{{ $data['logoutTime'] }}</td>
                        <td class="am-hide-sm-only">
                            <div class="am-btn-toolbar">
                                <div class="am-btn-group am-btn-group-xs">
                                    <a href="{{DOMAIN}}admin/{{$crumb['category']['url']}}/{{$data['id']}}"><button class="am-btn am-btn-default am-btn-xs am-hide-sm-only"><img src="{{PUB}}assets/images/show.png" class="icon"> 查看</button></a>
                                </div>
                            </div>
                        </td>
                    </tr>
                        @endif
                    @endforeach
                @else @include('admin.common.#norecord')
                @endif
                    </tbody>
                </table>
                @include('admin.common.page2')
            </div>
        </div>
    </div>
@stop