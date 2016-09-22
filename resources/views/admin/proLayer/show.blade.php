@extends('admin.main')
@section('content')
<div class="admin-content">
    @include('admin.common.crumb')
    <div class="am-g">
        <div class="am-u-sm-12 am-u-md-6">
            <div class="am-btn-toolbar">
                <div class="am-btn-group am-btn-group-xs">
                    <a onclick="history.go(-1)">
                        <button type="button" class="am-btn am-btn-default">返回上一页</button>
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
                    <td class="am-hide-sm-only">名称 / Name：</td>
                    <td>{{ $data->name }}</td>
                </tr>
                <tr>
                    <td class="am-hide-sm-only">属性名称 / Attribute Name：</td>
                    <td>{{ $data->getAttrName() }}</td>
                </tr>
                <tr>
                    <td class="am-hide-sm-only">时长 / Time Long：(单位s)</td>
                    <td>{{ $data->timelong }}</td>
                </tr>
                <tr>
                    <td class="am-hide-sm-only">延时 / Delay：(单位s)</td>
                    <td>{{ $data->delay }}</td>
                </tr>
                <tr>
                    <td class="am-hide-sm-only">创建时间 / Create Time：</td>
                    <td>{{ $data->createTime() }}</td>
                </tr>
                <tr>
                    <td class="am-hide-sm-only">修改时间 / Update Time：</td>
                    <td>{{ $data->updateTime() }}</td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>
@stop