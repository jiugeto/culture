@extends('admin.main')
@section('content')
    <div class="admin-content">
        @include('admin.common.crumb')

        <div class="am-g">
            @include('admin.common.info')
            <div class="am-u-sm-12 am-u-md-8 am-u-md-pull-4">
                <table class="am-table am-table-striped am-table-hover table-main">
                    <tbody id="tbody-alert">
                    @if(is_object($data))
                    <tr>
                        <td class="am-hide-sm-only">编号 / Id：</td>
                        <td>{{ $data->id }}</td>
                    </tr>
                    <tr>
                        <td class="am-hide-sm-only">链接名称 / Link Name：</td>
                        <td>{{ $data->name }}</td>
                    </tr>
                    <tr>
                        <td class="am-hide-sm-only">鼠标移动提示 / Title：</td>
                        <td>{{ $data->title }}</td>
                    </tr>
                    <tr>
                        <td class="am-hide-sm-only">添加时间 / Create Time：</td>
                        <td>{{ $data->created_at }}</td>
                    </tr>
                    <tr>
                        <td class="am-hide-sm-only">更新时间 / Update Time：</td>
                        <td>{{ $data->updated_at }}</td>
                    </tr>
                    @else @include('admin.common.norecord')
                    @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@stop