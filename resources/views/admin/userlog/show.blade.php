@extends('admin.main')
@section('content')
<div class="admin-content">
    @include('admin.common.crumb')
    <div class="am-g">
        {{--@include('admin.common.menu')--}}
        <div class="am-u-sm-12 am-u-md-6">
            <div class="am-btn-toolbar">
                <div class="am-btn-group am-btn-group-xs">
                    <a href="{{DOMAIN}}admin/userlog">
                        <button type="button" class="am-btn am-btn-default">
                            <img src="{{PUB}}assets/images/files.png" class="icon"> 返回会员日志
                        </button>
                    </a>
                    <a href="{{DOMAIN}}admin/adminlog">
                        <button type="button" class="am-btn am-btn-default">
                            <img src="{{PUB}}assets/images/files.png" class="icon"> 返回管理员日志
                        </button>
                    </a>
                </div>
            </div>
        </div>
    </div>
    <hr/>

    <div class="am-g">
        @include('admin.common.info')
        <div class="am-u-sm-12 am-u-md-8 am-u-md-pull-4">
            <table class="am-table am-table-striped am-table-hover table-main">
                <tbody id="tbody-alert">
                <tr>
                    <td class="am-hide-sm-only">编号 / Id：</td>
                    <td>{{ $data->id }}</td>
                </tr>
                <tr>
                    <td class="am-hide-sm-only">{{$crumb['category']['url']=='userlog'?'用户':'管理员'}}名称 / Uname：</td>
                    <td>{{ $data->uname }}</td>
                </tr>
                <tr>
                    <td class="am-hide-sm-only">用户ip / Ip：</td>
                    <td>{{ $data->serial }}</td>
                </tr>
                <tr>
                    <td class="am-hide-sm-only">ip地址 / Ip Address：</td>
                    <td>{{ $data->ipaddress }}</td>
                </tr>
                <tr>
                    <td class="am-hide-sm-only">序列号 / Serial：</td>
                    <td>{{ $data->serial }}</td>
                </tr>
                <tr>
                    <td class="am-hide-sm-only">登录时间 / Login：</td>
                    <td>{{ $data->loginTime() }}</td>
                </tr>
                <tr>
                    <td class="am-hide-sm-only">退出时间 / Logout：</td>
                    <td>{{ $data->logoutTime() }}</td>
                </tr>
                <tr>
                    <td class="am-hide-sm-only">创建时间 / Create Time：</td>
                    <td>{{ $data->createTime() }}</td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>
@stop