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
                    <td>{{$data['id']}}</td>
                </tr>
                <tr>
                    <td class="am-hide-sm-only">功能名称 / Name：</td>
                    <td>{{$data['name']}}</td>
                </tr>
                <tr>
                    <td class="am-hide-sm-only">公司名称 / Company Name：</td>
                    <td>{{ComNameById($data['cid'])}}</td>
                </tr>
                <tr>
                    <td class="am-hide-sm-only">功能类型 / Type：</td>
                    <td>{{$data['typeName']}}</td>
                </tr>
                {{--<tr>--}}
                    {{--<td class="am-hide-sm-only">类型 / Genre：</td>--}}
                    {{--<td>{{$data['genreName']}}</td>--}}
                {{--</tr>--}}
                <tr>
                    <td class="am-hide-sm-only">所属模块 / Genre：</td>
                    <td>{{$data['moduleName']}}</td>
                </tr>
                <tr>
                    <td class="am-hide-sm-only">内容 / Introduce：</td>
                    <td><div class="admin_show_con">{{$data['intro']}}</div></td>
                </tr>
                <tr>
                    <td class="am-hide-sm-only">小字 /  Small：</td>
                    <td>
                        @if($data['small'])
                            @foreach(explode('|',$data['small']) as $small) {{$small}} <br> @endforeach
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