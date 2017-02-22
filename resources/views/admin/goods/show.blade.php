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
                    <td>{{ $data['id'] }}</td>
                </tr>
                <tr>
                    <td class="am-hide-sm-only">作品名称 / Name：</td>
                    <td>{{ $data['name'] }}</td>
                </tr>
                <tr>
                    <td class="am-hide-sm-only">片源类型 / Genre：</td>
                    <td>{{ $data['genreName'] }}</td>
                </tr>
                <tr>
                    <td class="am-hide-sm-only">分类 / Category：</td>
                    <td>{{ $data['cateName'] }}</td>
                </tr>
                <tr>
                    <td class="am-hide-sm-only">图片 / Picture：</td>
                    <td>{{ $data['thumb'] }}</td>
                </tr>
                <tr>
                    <td class="am-hide-sm-only">视频链接 / Video Link：</td>
                    <td>{{ $data['link'] }}</td>
                </tr>
                <tr>
                    <td class="am-hide-sm-only">简介 / Introduce：</td>
                    <td>{{ $data['intro'] }}</td>
                </tr>
                <tr>
                    <td class="am-hide-sm-only">发布人 / User：</td>
                    <td>{{ $data['uname'] }}</td>
                </tr>
                <tr>
                    <td class="am-hide-sm-only">估价 / Money：(元)</td>
                    <td>{{ $data['money'] }}</td>
                </tr>
                <tr>
                    <td class="am-hide-sm-only">是否推荐 / Recommend：</td>
                    <td>{{ $data['recommendName'] }}</td>
                </tr>
                <tr>
                    <td class="am-hide-sm-only">是否最新 / Newest：</td>
                    <td>{{ $data['newestName'] }}</td>
                </tr>
                <tr>
                    <td class="am-hide-sm-only">排序 / Sort：</td>
                    <td>{{ $data['sort'] }}</td>
                </tr>
                <tr>
                    <td class="am-hide-sm-only">是否推荐 / Isshow：</td>
                    <td>{{ $data['isshowName'] }}</td>
                </tr>
                <tr>
                    <td class="am-hide-sm-only">创建时间 / Create Time：</td>
                    <td>{{ $data['createTime'] }}</td>
                </tr>
                <tr>
                    <td class="am-hide-sm-only">修改时间 / Update Time：</td>
                    <td>{{ $data['updateTime'] }}</td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>
@stop