@extends('admin.main')
@section('content')
<div class="admin-content">
    <div class="am-cf am-padding">
        <div class="am-fl am-cf">
            <strong class="am-text-primary am-text-lg">企业功能详情</strong>
            {{--/ <small>Opinion Detail</small>--}}
        </div>
    </div>

    <div class="am-u-sm-12 am-u-md-3">
        <a onclick="history.go(-1)"><button type="button" class="am-btn am-btn-default">返&nbsp;&nbsp;回</button></a>
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
                    <td class="am-hide-sm-only">功能名称 / name：</td>
                    <td>{{ $data->name }}</td>
                </tr>
                <tr>
                    <td class="am-hide-sm-only">细节描述 / Detail：</td>
                    <td>{{ $data->detail }}</td>
                </tr>
                <tr>
                    <td class="am-hide-sm-only">小标题 / Title：</td>
                    <td>{{ $data->title }}</td>
                </tr>
                <tr>
                    <td class="am-hide-sm-only">内容 / Content：</td>
                    {{--<td><div class="div_content"></div></td>--}}
                    <td>{{ $data->intro }}</td>
                </tr>
                <tr>
                    <td class="am-hide-sm-only">小字 / Small：</td>
                    <td>{{ $data->small }}</td>
                </tr>
                <tr>
                    <td class="am-hide-sm-only">图片 / Picture：</td>
                    <td>{{ $data->pic_id }}</td>
                </tr>
                <tr>
                    <td class="am-hide-sm-only">是否为初始化功能 / Is Default：</td>
                    <td>{{ $data->isdefault==1 ? '初始化功能' : '扩展功能' }}</td>
                </tr>
                <tr>
                    <td class="am-hide-sm-only">创建时间 / Create Time：</td>
                    <td>{{ $data->created_at }}</td>
                </tr>
                <tr>
                    <td class="am-hide-sm-only">更新时间 / Update Time：</td>
                    <td>{{ $data->updated_at!='0000-00-00 00:00:00' ? $data->updated_at : '' }}</td>
                </tr>
                {{--<tr>--}}
                    {{--<td class="am-hide-sm-only" colspan="2">--}}
                        {{--<button class="backbtn" onclick="history.go(-1)">--}}
                            {{--返 &nbsp;&nbsp;&nbsp;回</button>--}}
                    {{--</td>--}}
                {{--</tr>--}}
                </tbody>
            </table>
        </div>
    </div>
@stop