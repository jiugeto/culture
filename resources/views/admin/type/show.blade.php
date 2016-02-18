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
                    <td class="am-hide-sm-only">类型名称 / Name：</td>
                    <td>{{ $data->name }}</td>
                </tr>
                <tr>
                    <td class="am-hide-sm-only">类型简介  / Introduce：</td>
                    <td>{{ $data->intro }}</td>
                </tr>
                <tr>
                    <td class="am-hide-sm-only">表id / Table Id：</td>
                    <td>{{ $data->table_id }}</td>
                </tr>
                <tr>
                    <td class="am-hide-sm-only">表名称 / Table Name：</td>
                    <td>{{ $data->table_name }}</td>
                </tr>
                <tr>
                    <td class="am-hide-sm-only">字段名称 / Field：</td>
                    <td>{{ $data->field }}</td>
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