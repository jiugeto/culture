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
                    <td class="am-hide-sm-only">广告名称 / Ad Name：</td>
                    <td>{{$data['name']}}</td>
                </tr>
                <tr>
                    <td class="am-hide-sm-only">所在广告位 / Ad Place：</td>
                    <td>{{$data['adplaceName']}}</td>
                </tr>
                <tr>
                    <td class="am-hide-sm-only">广告说明 / Introduce：</td>
                    <td><textarea cols="50" rows="10" readonly class="textarea_show">{{$data['intro']}}</textarea></td>
                </tr>
                <tr>
                    <td class="am-hide-sm-only">显示图片 / Thumb：</td>
                    <td>{{$data['img']}}</td>
                </tr>
                <tr>
                    <td class="am-hide-sm-only">跳转链接 / Link：</td>
                    <td>{{$data['link']}}</td>
                </tr>
                <tr>
                    <td class="am-hide-sm-only">有效时间 / Period：</td>
                    <td>{{$data['fromTimeName']}} - {{$data['toTimeName']}}</td>
                </tr>
                <tr>
                    <td class="am-hide-sm-only">使用的企业 / Company：</td>
                    <td>{{ComNameByUid($data['uid'])}}</td>
                </tr>
                <tr>
                    <td class="am-hide-sm-only">状态 / Period：</td>
                    <td>{{$data['period']}}</td>
                </tr>
                <tr>
                    <td class="am-hide-sm-only">是否显示 / Is Show：</td>
                    <td>{{$data['isshowName']}}</td>
                </tr>
                <tr>
                    <td class="am-hide-sm-only">是否启用 / Is Use：</td>
                    <td>{{$data['isuseName']}}</td>
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
            <button class="am-btn am-btn-primary" onclick="history.go(-1);">返回</button>
        </div>
    </div>
@stop