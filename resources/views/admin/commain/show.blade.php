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
                    <td class="am-hide-sm-only">公司名称 / Company Name：</td>
                    <td>{{$data['name']}}</td>
                </tr>
                <tr>
                    <td class="am-hide-sm-only">logo / Logo：</td>
                    <td>@if($data['logo'])<img src="{{$data['logo']}}" width="300">@else/@endif</td>
                </tr>
                <tr>
                    <td class="am-hide-sm-only">皮肤 / Skin：</td>
                    <td>@if($data['skin'])<img src="{{$data['skin']}}" width="300">@else/@endif</td>
                </tr>
                <tr>
                    <td class="am-hide-sm-only">公司前台模块开关 / Layout：</td>
                    <td>@if($layouts=$data['layoutArr'])
                            @foreach($layouts as $layout) {{$layout}}<br> @endforeach
                        @else 默认
                        @endif
                    </td>
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