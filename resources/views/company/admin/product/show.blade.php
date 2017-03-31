@extends('company.admin.main')
@section('content')
    @include('company.admin.common.crumb')

    <div class="com_admin_list">
        <h3 class="center pos">{{$lists['func']['name']}}详情页</h3>
        <table class="table_create" cellspacing="0" cellpadding="0">
            <tr>
                <td class="field_name">{{$lists['func']['name']}}名称：</td>
                <td>{{$data['name']}}</td>
            </tr>
            <tr>
                <td class="field_name">分类：</td>
                <td>{{$data['cateName']}}</td>
            </tr>
            <tr>
                <td class="field_name">简单介绍：</td>
                <td>{{$data['intro']}}</td>
            </tr>
            <tr>
                <td class="field_name">图片：</td>
                <td><img src="{{$data['thumb']}}" width="300"></td>
            </tr>
            <tr>
                <td class="field_name">视频地址：</td>
                <td>{{$data['link']}}</td>
            </tr>
            <tr>
                <td class="field_name">前台显示否：</td>
                <td>{{$data['isshowName']}}</td>
            </tr>

            <tr><td class="center" colspan="2" style="border:0;">
                    <a href="javascript:;">
                        <button class="companybtn" onclick="history.go(-1)">返&nbsp;&nbsp;回</button>
                    </a>
                </td></tr>
        </table>
    </div>
@stop

