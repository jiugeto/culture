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
                <tr>
                    <td class="am-hide-sm-only">名称 / Name：</td>
                    <td>{{ $data->name }}</td>
                </tr>
                <tr>
                    <td class="am-hide-sm-only">类型 / Genre：</td>
                    <td>{{ $data->getGenreName() }}</td>
                </tr>
                <tr>
                    <td class="am-hide-sm-only">类别 / Category：</td>
                    <td>{{ $data->getCate() }}</td>
                </tr>
                <tr>
                    <td class="am-hide-sm-only">修改要求 / Introduce：</td>
                    <td>{{ $data->intro }}</td>
                </tr>
                <tr>
                    <td class="am-hide-sm-only">用户名称 / User Name：</td>
                    <td>{{ $data->uname }}</td>
                </tr>
                @if($data->genre==1)
                    <tr>
                        <td class="am-hide-sm-only">缩略图 / Thumb：</td>
                        <td><a href="{{DOMAIN}}admin/proVideo/pre/{{$data->id}}" target="_blank">
                                <img src="{{ $data->getPicUrl() }}" width="200">
                            </a>
                        </td>
                    </tr>
                @elseif($data->genre==2)
                    <tr>
                        <td class="am-hide-sm-only">外部视频链接 / Link：</td>
                        <td>{{ $data->link }}</td>
                    </tr>
                @endif
                <tr>
                    <td class="am-hide-sm-only">创建时间 / Create Time：</td>
                    <td>{{ $data->createTime() }}</td>
                </tr>
                <tr>
                    <td class="am-hide-sm-only">修改时间 / Update Time：</td>
                    <td>{{ $data->updateTime() }}</td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>
@stop