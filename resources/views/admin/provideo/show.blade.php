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
                    <td>{{$data['id']}}</td>
                </tr>
                <tr>
                    <td class="am-hide-sm-only">名称 / Name：</td>
                    <td>{{$data['name']}}</td>
                </tr>
                <tr>
                    <td class="am-hide-sm-only">类型 / Genre：</td>
                    <td>{{$data['genreName']}}</td>
                </tr>
                <tr>
                    <td class="am-hide-sm-only">类别 / Category：</td>
                    <td>{{$data['cateName']}}</td>
                </tr>
                <tr>
                    <td class="am-hide-sm-only">修改要求 / Introduce：</td>
                    <td><textarea cols="80" rows="5" readonly class="textarea_show">{{$data['intro']}}</textarea>
                    </td>
                </tr>
                <tr>
                    <td class="am-hide-sm-only">用户名称 / User Name：</td>
                    <td>{{UserNameById($data['uid'])}}</td>
                </tr>
                <tr>
                    <td class="am-hide-sm-only">缩略图 / Thumb：</td>
                    <td>@if($data['thumb'])<img src="{{$data['thumb']}}" width="300">@endif</td>
                </tr>
                <tr>
                    <td class="am-hide-sm-only">视频链接类型 / Link Type：</td>
                    <td>{{$data['linkTypeName']}}</td>
                </tr>
                <tr>
                    <td class="am-hide-sm-only">视频链接 / Link：</td>
                    <td>{{$data['link']}}</td>
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