@extends('admin.main')
@section('content')
<div class="admin-content">
    <div class="am-cf am-padding">
        <div class="am-fl am-cf"><strong class="am-text-primary am-text-lg">权限细节展示</strong> / <small>Action Detail</small></div>
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
                    <td class="am-hide-sm-only">权限名称 / Action Name：</td>
                    <td>{{ $data->name }}</td>
                </tr>
                <tr>
                    <td class="am-hide-sm-only">父id / Parent Id：</td>
                    <td>{{ $data->pid }}</td>
                </tr>
                <tr>
                    <td class="am-hide-sm-only">权限简介  / Intro：</td>
                    <td>{{ $data->intro }}</td>
                </tr>
                <tr>
                    <td class="am-hide-sm-only">命名空间 / Namespace：</td>
                    <td>{{ $data->namespace }}</td>
                </tr>
                <tr>
                    <td class="am-hide-sm-only">控制器名称 / Controller：</td>
                    <td>{{ $data->controller_prefix }}</td>
                </tr>
                <tr>
                    <td class="am-hide-sm-only">方法名称 / Action：</td>
                    <td>{{ $data->action }}</td>
                </tr>
                <tr>
                    <td class="am-hide-sm-only">class样式名称 / Class Name：</td>
                    <td>{{ $data->style_class }}</td>
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