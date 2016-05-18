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
                    <td class="am-hide-sm-only">作品名称 / Name：</td>
                    <td>{{ $data->name }}</td>
                </tr>
                <tr>
                    <td class="am-hide-sm-only">片源类型 / Genre：</td>
                    <td>{{ $data->genre() }}</td>
                </tr>
                <tr>
                    <td class="am-hide-sm-only">产品主体 / Type：</td>
                    <td>{{ $data->type() }}</td>
                </tr>
                <tr>
                    <td class="am-hide-sm-only">分类 / Category：</td>
                    <td>{{ $data->cate() }}</td>
                </tr>
                <tr>
                    <td class="am-hide-sm-only">鼠标移动显示 / Title：</td>
                    <td>{{ $data->title }}</td>
                </tr>
                <tr>
                    <td class="am-hide-sm-only">图片 / Picture：</td>
                    <td>{{ $data->pic() ? $data->pic()->name : '无' }}</td>
                </tr>
                <tr>
                    <td class="am-hide-sm-only">视频 / Video：</td>
                    <td>{{ $data->video() ? $data->video()->name : '无' }}</td>
                </tr>
                <tr>
                    <td class="am-hide-sm-only">简介 / Introduce：</td>
                    <td>{{ $data->intro ? $data->intro : '无' }}</td>
                </tr>
                <tr>
                    <td class="am-hide-sm-only">发布人 / User：</td>
                    <td>{{ $data->uname ? $data->uname : '无' }}</td>
                </tr>
                <tr>
                    <td class="am-hide-sm-only">是否推荐 / Recommend：</td>
                    <td>{{ $data->recommend() }}</td>
                </tr>
                <tr>
                    <td class="am-hide-sm-only">排序 / Sort：</td>
                    <td>{{ $data->sort }}</td>
                </tr>
                <tr>
                    <td class="am-hide-sm-only">是否推荐 / Isshow：</td>
                    <td>{{ $data->isshow() }}</td>
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