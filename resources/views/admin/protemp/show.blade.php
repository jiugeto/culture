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
                    <td>{{$data['id']}}</td>
                </tr>
                <tr>
                    <td class="am-hide-sm-only">模板名称 / Name：</td>
                    <td>{{$data['name']}}</td>
                </tr>
                <tr>
                    <td class="am-hide-sm-only">类型 / Category：</td>
                    <td>{{$data['cateName']}}</td>
                </tr>
                <tr>
                    <td class="am-hide-sm-only">序号 / Serial：</td>
                    <td>{{$data['serial']}}</td>
                </tr>
                <tr>
                    <td class="am-hide-sm-only">缩略图 / Picture：</td>
                    <td><img src="{{$data['thumb']}}" width="300"></td>
                </tr>
                <tr>
                    <td class="am-hide-sm-only">介绍 / Introduce：</td>
                    <td><textarea cols="50" rows="10" readonly class="textarea_show">{{$data['intro']}}</textarea></td>
                </tr>
                <tr>
                    <td class="am-hide-sm-only">视频链接类型 / Video Link Type：</td>
                    <td>{{$data['linkTypeName']}}</td>
                </tr>
                <tr>
                    <td class="am-hide-sm-only">视频链接 / Video Link：</td>
                    <td><div style="width:500px;">{{$data['link']}}</div></td>
                </tr>
                <tr>
                    <td class="am-hide-sm-only">创建时间 / Create Time：</td>
                    <td>{{$data['createTime']}}</td>
                </tr>
                <tr>
                    <td class="am-hide-sm-only">修改时间 / Update Time：</td>
                    <td>{{$data['updateTime']}}</td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>
@stop