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
                    <td class="am-hide-sm-only">分镜名称 / Name：</td>
                    <td>{{ $data->name }}</td>
                </tr>
                <tr>
                    <td class="am-hide-sm-only">供求类型 / Genre：</td>
                    <td>{{ $data->genreName() }}</td>
                </tr>
                <tr>
                    <td class="am-hide-sm-only">分镜类型 / Category：</td>
                    <td>{{ $data->getCateName() }}</td>
                </tr>
                <tr>
                    <td class="am-hide-sm-only">缩略图 / Small Picture：</td>
                    <td><img src="{{ $data->thumb() }}" style="width:100%;"></td>
                </tr>
                <tr>
                    <td class="am-hide-sm-only">详情 / Detail：</td>
                    <td>{!! $data->detail !!}</td>
                </tr>
                <tr>
                    <td class="am-hide-sm-only">用户 / User Name：</td>
                    <td>{{ $data->uname }}</td>
                </tr>
                <tr>
                    <td class="am-hide-sm-only">价格 / Money：</td>
                    <td>{{ $data->money() }}</td>
                </tr>
                <tr>
                    <td class="am-hide-sm-only">是否最新 / Is New：</td>
                    <td>{{ $data->isnew() }}</td>
                </tr>
                <tr>
                    <td class="am-hide-sm-only">是否最热 / Is Hot：</td>
                    <td>{{ $data->ishot() }}</td>
                </tr>
                <tr>
                    <td class="am-hide-sm-only">前台显示否 / Is Show：</td>
                    <td>{{ $data->isshow() }}</td>
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