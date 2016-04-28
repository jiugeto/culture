@extends('admin.main')
@section('content')
<link rel="stylesheet" href="/assets/css/admin_cus.css">

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
                    <td>{{ $data->id }}</td>
                </tr>
                <tr>
                    <td class="am-hide-sm-only">信息名称 / Name：</td>
                    <td>{{ $data->name }}</td>
                </tr>
            @if($data->cname)
                <tr>
                    <td class="am-hide-sm-only">公司名称 / Company Name：</td>
                    <td>{{ $data->cname }}</td>
                </tr>
            @else
                <tr>
                    <td colspan="2">此为默认记录</td>
                </tr>
            @endif
                <tr>
                    <td class="am-hide-sm-only">信息类型 / Type：</td>
                    <td>{{ $data->type ? $data->type() : '' }}</td>
                </tr>
                <tr>
                    <td class="am-hide-sm-only">内容 / Introduce：</td>
                    <td><div class="admin_show_con">{!! $data->intro !!}</div></td>
                </tr>
                <tr>
                    <td class="am-hide-sm-only">排序 / Sort：</td>
                    <td>{{ $data->sort }}</td>
                </tr>
                <tr>
                    <td class="am-hide-sm-only">图片 / Picture：</td>
                    <td>
                        @if($data->pic && isset($data->pics) && $data->pics)
                            @foreach($data->pics as $vpic)
                                {{ $vpic ? $data->pic($vpic)->name : '' }}<br>
                                <img src="{{ $vpic ? $data->pic($vpic)->url : '' }}">
                            @endforeach
                        @endif
                    </td>
                </tr>
                <tr>
                    <td class="am-hide-sm-only">是否置顶 / Top：</td>
                    <td>{{ $data->istop ? '置顶' : '不置顶' }}</td>
                </tr>
                <tr>
                    <td class="am-hide-sm-only">前台是否显示 / Show：</td>
                    <td>{{ $data->isshow ? '显示' : '不显示' }}</td>
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