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
                    <td class="am-hide-sm-only">广告名称 / Ad Name：</td>
                    <td>{{ $data->username }}</td>
                </tr>
                <tr>
                    <td class="am-hide-sm-only">所在广告位 / Ad Place：</td>
                    <td>{{ $data->getAdplaceName() }}</td>
                </tr>
                <tr>
                    <td class="am-hide-sm-only">广告说明 / Introduce：</td>
                    <td>{{ $data->intro }}</td>
                </tr>
                <tr>
                    <td class="am-hide-sm-only">显示图片 / Thumb：</td>
                    <td>{{ $data->getPicUrl() }}</td>
                </tr>
                <tr>
                    <td class="am-hide-sm-only">跳转链接 / Link：</td>
                    <td>{{ $data->link }}</td>
                </tr>
                <tr>
                    <td class="am-hide-sm-only">有效时间 / Period：</td>
                    <td>{{ $data->fromTime() }} - {{ $data->toTime() }}</td>
                </tr>
                <tr>
                    <td class="am-hide-sm-only">使用的企业 / Company：</td>
                    <td>{{ $data->getUName() }}</td>
                </tr>
                <tr>
                    <td class="am-hide-sm-only">状态 / Period：</td>
                    <td>{{ $data->period() }}</td>
                </tr>
                <tr>
                    <td class="am-hide-sm-only">是否显示 / Is Show：</td>
                    <td>{{ $data->isshow() }}</td>
                </tr>
                <tr>
                    <td class="am-hide-sm-only">是否启用 / Is Use：</td>
                    <td>{{ $data->isuse() }}</td>
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
            <button class="am-btn am-btn-primary" onclick="history.go(-1);">返回</button>
        </div>
    </div>
@stop