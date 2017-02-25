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
                    <td class="am-hide-sm-only">设计名称 / Name：</td>
                    <td>{{$data['name']}}</td>
                </tr>
                <tr>
                    <td class="am-hide-sm-only">供求类型  / Genre：</td>
                    <td>{{$data['genreName']}}</td>
                </tr>
                <tr>
                    <td class="am-hide-sm-only">设计类型 / Category：</td>
                    <td>{{$data['cateName']}}</td>
                </tr>
                <tr>
                    <td class="am-hide-sm-only">设计简介 / Introduce：</td>
                    <td>{{$data['intro']}}</td>
                </tr>
                <tr>
                    <td class="am-hide-sm-only">设计详情 / Detail：</td>
                    <td>{{$data['detail']}}</td>
                </tr>
                <tr>
                    <td class="am-hide-sm-only">缩略图 / Thumb：</td>
                    <td>
                        @if($data['thumb'])<img src="{{$data['thumb']}}" width="300">
                        @else /
                        @endif
                    </td>
                </tr>
                <tr>
                    <td class="am-hide-sm-only">价格(元) / Price：</td>
                    <td>{{$data['money']}}</td>
                </tr>
                <tr>
                    <td class="am-hide-sm-only">发布方 / User Name：</td>
                    <td>{{UserNameById($data['uid'])}}</td>
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