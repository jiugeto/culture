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
                    <td class="am-hide-sm-only" width="200">编号 / Id：</td>
                    <td>{{ $data->id }}</td>
                </tr>
                <tr>
                    <td class="am-hide-sm-only">名称 / Name：</td>
                    <td>{{ $data->name }}</td>
                </tr>
                <tr>
                    <td class="am-hide-sm-only">用户 / User：</td>
                    <td>{{ $data->getUName() }}</td>
                </tr>
                <tr>
                    <td class="am-hide-sm-only">缩略图 / Thumb：</td>
                    <td>{{ $data->getPicName() }}</td>
                </tr>
                <tr>
                    <td class="am-hide-sm-only">视频链接 / Link：</td>
                    <td>{{ $data->url.'?'.$data->url2 }}</td>
                </tr>
                <tr>
                    <td class="am-hide-sm-only">简介 / Introduce：</td>
                    <td>{{ $data->intro }}</td>
                </tr>
                <tr>
                    <td class="am-hide-sm-only">宽度 / Width：(单位px)</td>
                    <td>{{ $data->width }}</td>
                </tr>
                <tr>
                    <td class="am-hide-sm-only">高度 / Height：(单位px)</td>
                    <td>{{ $data->height }}</td>
                </tr>
                <tr>
                    <td class="am-hide-sm-only">是否删除 / Del：</td>
                    <td>{{ $data->del ? '删除' : '未删除' }}</td>
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