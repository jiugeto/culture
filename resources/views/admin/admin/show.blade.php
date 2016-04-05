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
                    <td class="am-hide-sm-only">用户名 / User Name：</td>
                    <td>{{ $data->username }}</td>
                </tr>
                <tr>
                    <td class="am-hide-sm-only">真实名字 / Real Name：</td>
                    <td>{{ $data->realname }}</td>
                </tr>
                <tr>
                    <td class="am-hide-sm-only">密码 / Password：</td>
                    <td>{{ $data->password }}</td>
                </tr>
                <tr>
                    <td class="am-hide-sm-only">邮箱 / Email：</td>
                    <td>{{ $data->email }}</td>
                </tr>
                <tr>
                    <td class="am-hide-sm-only">角色组 / Role：</td>
                    <td>{{ $data->role() }}</td>
                </tr>
                <tr>
                    <td class="am-hide-sm-only">该管理员备注 / Introduce：</td>
                    <td>{{ $data->intro }}</td>
                </tr>
                <tr>
                    <td class="am-hide-sm-only">创建时间 / Create Time：</td>
                    <td>{{ $data->created_at }}</td>
                </tr>
                <tr>
                    <td class="am-hide-sm-only">修改时间 / Update Time：</td>
                    <td>{{ $data->updated_at!='0000-00-00' ? $data->updated_at : '未修改' }}</td>
                </tr>
                </tbody>
            </table>
            <button class="am-btn am-btn-primary" onclick="history.go(-1);">返回</button>
        </div>
    </div>
@stop