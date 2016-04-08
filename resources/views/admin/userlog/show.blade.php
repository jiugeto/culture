@extends('admin.main')
@section('content')
<div class="admin-content">
    @include('admin.common.crumb')
    <div class="am-g">
        @include('admin.common.menu')
        {{--@include('admin.type.search')--}}
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
                    <td class="am-hide-sm-only">平台类型 / Plat：</td>
                    <td>{{ $data->plat==1 ? '管理员' : '用户' }}</td>
                </tr>
                <tr>
                    <td class="am-hide-sm-only">用户名 / Uname：</td>
                    <td>{{ $data->uname }}</td>
                </tr>
                <tr>
                    <td class="am-hide-sm-only">序列号 / Serial：</td>
                    <td>{{ $data->serial }}</td>
                </tr>
                <tr>
                    <td class="am-hide-sm-only">登录时间 / Login：</td>
                    <td>{{ $data->loginTime }}</td>
                </tr>
                <tr>
                    <td class="am-hide-sm-only">退出时间 / Logout：</td>
                    <td>{{ $data->logoutTime }}</td>
                </tr>
                <tr>
                    <td class="am-hide-sm-only">创建时间 / Create Time：</td>
                    <td>{{ $data->created_at }}</td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>
@stop