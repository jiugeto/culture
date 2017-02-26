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
                    <td class="am-hide-sm-only">创意名称 / Name：</td>
                    <td>{{$data['name']}}</td>
                </tr>
                <tr>
                    <td class="am-hide-sm-only">供求类型 / Genre：</td>
                    <td>{{$data['genreName']}}</td>
                </tr>
                <tr>
                    <td class="am-hide-sm-only">创意类型 / Category：</td>
                    <td>{{$data['cateName']}}</td>
                </tr>
                <tr>
                    <td class="am-hide-sm-only">简介 / Introduce：</td>
                    <td>{{$data['intro']}}</td>
                </tr>
                <tr>
                    <td class="am-hide-sm-only">详情是否显示 / Is Detail：</td>
                    <td>{{$data['isdetailName']}}</td>
                </tr>
                <tr>
                    <td class="am-hide-sm-only">简介 / Introduce：</td>
                    <td>{{$data['detail']}}</td>
                </tr>
                <tr>
                    <td class="am-hide-sm-only">价格(元) / Price：</td>
                    <td>{{$data['money']}}</td>
                </tr>
                <tr>
                    <td class="am-hide-sm-only">浏览次数 / Reads：</td>
                    <td>{{$data['read']}}</td>
                </tr>
                <tr>
                    <td class="am-hide-sm-only">发布人 / User：</td>
                    <td>{{UserNameById($data['uid'])}}</td>
                </tr>
                <tr>
                    <td class="am-hide-sm-only">前台列表是否显示 / Is Show：</td>
                    <td>{{$data['isshowName']}}</td>
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