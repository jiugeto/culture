@extends('admin.main')
@section('content')
<link rel="stylesheet" href="/assets/css/admin_cus.css">

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
                    <td class="am-hide-sm-only">模块名称 / Name：</td>
                    <td>{{ $data->name }}</td>
                </tr>
                <tr>
                    <td class="am-hide-sm-only">公司名称 / Company Name：</td>
                    <td>{{ $data->company() }}</td>
                </tr>
                <tr>
                    <td class="am-hide-sm-only">模块类型 / Genre：</td>
                    <td>{{ $data->genre() }}</td>
                </tr>
                <tr>
                    <td class="am-hide-sm-only">内容 / Introduce：</td>
                    <td><div class="admin_show_con">{!! $data->intro !!}</div></td>
                </tr>
                <tr>
                    <td class="am-hide-sm-only">排序 / Sort：</td>
                    <td>{{ $data->sort }}</td>
                </tr>
                <tr>
                    <td class="am-hide-sm-only">前台是否显示 / Show：</td>
                    <td>{{ $data->isshow ? '显示' : '不显示' }}</td>
                </tr>
                <tr>
                    <td class="am-hide-sm-only">创建时间 / Create Time：</td>
                    <td>{{ $data->created_at }}</td>
                </tr>
                <tr>
                    <td class="am-hide-sm-only">修改时间 / Update Time：</td>
                    <td>{{ $data->updated_at!='0000-00-00 00:00:00' ? $data->updated_at : '未修改' }}</td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>
@stop