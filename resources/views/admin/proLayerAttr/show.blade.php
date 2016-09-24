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
                    <td class="am-hide-sm-only">动画设置名称 / Layer：</td>
                    <td>{{ $data->getLayerName() }}</td>
                </tr>
                <tr>
                    <td class="am-hide-sm-only">动画属性名称 / LayerAttr：</td>
                    <td>{{ $data->getAttrSelName() }}</td>
                </tr>
                <tr>
                    <td class="am-hide-sm-only">动画点 / Per：(单位%)</td>
                    <td>{{ $data->per }}</td>
                </tr>
                <tr>
                    <td class="am-hide-sm-only">动画值 / Value：</td>
                    <td>{{ $data->getVal() }}</td>
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