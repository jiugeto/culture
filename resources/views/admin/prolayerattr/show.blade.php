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
                    <td class="am-hide-sm-only">产品名称 / Product：</td>
                    <td>{{ $data->product() }}</td>
                </tr>
                <tr>
                    <td class="am-hide-sm-only">属性统称 / Attr：</td>
                    <td>{{ $data->attrname() }}</td>
                </tr>
                <tr>
                    <td class="am-hide-sm-only">动画名称 / Layer：</td>
                    <td>{{ $data->layer() }}</td>
                </tr>
                <tr>
                    <td class="am-hide-sm-only">动画属性 / LayerAttr：</td>
                    <td>{{ $data->layerAttr() }}</td>
                </tr>
                <tr>
                    <td class="am-hide-sm-only">动画点 / Per：</td>
                    <td>{{ $data->per }}</td>
                </tr>
                <tr>
                    <td class="am-hide-sm-only">动画值 / Per：</td>
                    <td>{{ $data->val }}</td>
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