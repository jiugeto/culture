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
                    <td class="am-hide-sm-only">设备名称 / Name：</td>
                    <td>{{ $data->name }}</td>
                </tr>
                <tr>
                    <td class="am-hide-sm-only">记录类型  / Genre：</td>
                    <td>{{ $data->genre==1 ? '供应' : '需求' }}</td>
                </tr>
                <tr>
                    <td class="am-hide-sm-only">设备简介 / Introduce：</td>
                    <td>{{ $data->intro }}</td>
                </tr>
                <tr>
                    <td class="am-hide-sm-only">发布者 / User Name：</td>
                    <td>{{ $data->uid }}</td>
                </tr>
                <tr>
                    <td class="am-hide-sm-only">价格 / Price：</td>
                    <td>{{ $data->price }}</td>
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
        </div>
    </div>
@stop