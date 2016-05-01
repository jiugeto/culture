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
                    <td>{{ $data->id }}</td>
                </tr>
            @if($data->company())
                <tr>
                    <td class="am-hide-sm-only">公司名称 / Company Name：</td>
                    <td>{{ $data->company()->name }}</td>
                </tr>
            @else
                <tr>
                    <td colspan="2">此为默认记录</td>
                </tr>
            @endif
                <tr>
                    <td class="am-hide-sm-only">图片 /  Picture：</td>
                    <td>
                        {{ $data->pic()?$data->pic()->name:'无' }}<br>
                        @if($data->pic()) <img src="{{ $data->pic()->url}}"> @endif
                    </td>
                </tr>
                <tr>
                    <td class="am-hide-sm-only">鼠标移动显示 / OverMouse：</td>
                    <td>{{ $data->title }}</td>
                </tr>
                <tr>
                    <td class="am-hide-sm-only">链接 / Url：</td>
                    <td>{{ $data->url }}</td>
                </tr>
                <tr>
                    <td class="am-hide-sm-only">排序 / Sort：</td>
                    <td>{{ $data->sort }}</td>
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