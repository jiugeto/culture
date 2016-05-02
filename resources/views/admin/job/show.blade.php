@extends('admin.main')
@section('content')
<div class="admin-content">
    @include('admin.common.crumb')
    <div class="am-g">
        {{--@include('admin.common.menu')--}}
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
                    <td class="am-hide-sm-only">招聘名称 / Name：</td>
                    <td>{{ $data->name }}</td>
                </tr>
                <tr>
                    <td class="am-hide-sm-only">简介 / Introduce：</td>
                    <td>{{ $data->intro }}</td>
                </tr>
                <tr>
                    <td class="am-hide-sm-only">发布企业 / Company：</td>
                    <td>{{ $data->company() ? $data->company()->name : '初始默认记录' }}</td>
                </tr>
                <tr>
                    <td class="am-hide-sm-only">工作名称 / Job：</td>
                    <td>{{ $data->job }}</td>
                </tr>
                <tr>
                    <td class="am-hide-sm-only">工作数量 / Number：</td>
                    <td>{{ $data->num }}</td>
                </tr>
                <tr>
                    <td class="am-hide-sm-only">工作要求 / Require：</td>
                    <td>{{ $data->require }}</td>
                </tr>
                <tr>
                    <td class="am-hide-sm-only">是否置顶 / Is Top：</td>
                    <td>{{ $data->istop ? '置顶' : '不置顶' }}</td>
                </tr>
                <tr>
                    <td class="am-hide-sm-only">用户企业控制是否置顶 / Is Top：</td>
                    <td>{{ $data->istop2 ? '置顶' : '不置顶' }}</td>
                </tr>
                <tr>
                    <td class="am-hide-sm-only">排序 / Sort：</td>
                    <td>{{ $data->sort }}</td>
                </tr>
                <tr>
                    <td class="am-hide-sm-only">用户企业控制排序 / Sort：</td>
                    <td>{{ $data->sort2 }}</td>
                </tr>
                <tr>
                    <td class="am-hide-sm-only">前台列表是否显示 / Is Show：</td>
                    <td>{{ $data->isshow ? '显示' : '不显示' }}</td>
                </tr>
                <tr>
                    <td class="am-hide-sm-only">用户企业控制企业前台列表是否显示 / Is Show：</td>
                    <td>{{ $data->isshow2 ? '显示' : '不显示' }}</td>
                </tr>
                <tr>
                    <td class="am-hide-sm-only">创建时间 / Create Time：</td>
                    <td>{{ $data->created_at }}</td>
                </tr>
                <tr>
                    <td class="am-hide-sm-only">修改时间 / Update Time：</td>
                    <td>{{ $data->updated_at!='0000-00-00 00:00:00' ? $data->updated_at : '未修改' }}</td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>
@stop