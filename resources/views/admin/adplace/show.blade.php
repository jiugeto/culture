@extends('admin.main')
@section('content')
<div class="admin-content">
    @include('admin.common.crumb')
    <div class="am-g">
        @include('admin.common.menu')
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
                    <td class="am-hide-sm-only">广告位名称 / Name：</td>
                    <td>{{ $data->name }}</td>
                </tr>
                <tr>
                    <td class="am-hide-sm-only">介绍 / Introduce：</td>
                    <td>{{ $data->intro }}</td>
                </tr>
                <tr>
                    <td class="am-hide-sm-only">宽度 / Width：(单位：px)</td>
                    <td>{{ $data->width }}</td>
                </tr>
                <tr>
                    <td class="am-hide-sm-only">高度 / Height：(单位：px)</td>
                    <td>{{ $data->height }}</td>
                </tr>
                <tr>
                    <td class="am-hide-sm-only">价格 / Price：(单位：元)</td>
                    <td>{{ $data->price }}</td>
                </tr>
                <tr>
                    <td class="am-hide-sm-only">数量 / Number：(单位：个)</td>
                    <td>{{ $data->number }}</td>
                </tr>
                <tr>
                    <td class="am-hide-sm-only">修改时间 / Update Time：</td>
                    <td>{{ $data->updateTime() }}</td>
                </tr>
                </tbody>
            </table>
            <button class="am-btn am-btn-primary" onclick="history.go(-1);">返回</button>
        </div>
    </div>
@stop