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
                    <td class="am-hide-sm-only">娱乐标题 / Title：</td>
                    <td>{{$data['title']}}</td>
                </tr>
                <tr>
                    <td class="am-hide-sm-only">内容 / Content：</td>
                    <td>{{$data['intro']}}</td>
                </tr>
                <tr>
                    <td class="am-hide-sm-only">艺人 / Actor：</td>
                    <td>{{$data['staffStr']}}</td>
                </tr>
                <tr>
                    <td class="am-hide-sm-only">作品 / Works：</td>
                    <td>{{$data['workStr']}}</td>
                </tr>
                <tr>
                    <td class="am-hide-sm-only">发布者 / User Name：</td>
                    <td>{{$data['uname']}}</td>
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