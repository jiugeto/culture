@extends('company.admin.main')
@section('content')
    @include('company.admin.common.crumb')

    <div class="com_admin_list">
        <h3 class="center pos">{{$lists['func']['name']}}详情页</h3>
        <table class="table_create" cellspacing="0" cellpadding="0">
            <tr>
                <td class="field_name">链接名称：</td>
                <td>{{$data['name']}}</td>
            </tr>
            <tr>
                <td class="field_name">鼠标移动显示：</td>
                <td>{{$data['title']}}</td>
            </tr>
            <tr>
                <td class="field_name">类型：</td>
                <td>{{$data['typeName']}}</td>
            </tr>
            <tr>
                <td class="field_name">缩略图：</td>
                <td><img src="{{$data['thumb']}}" width="100"></td>
            </tr>
            <tr>
                <td class="field_name">内容：</td>
                <td><div class="admin_show_con">{{$data['intro']}}</div></td>
            </tr>
            <tr>
                <td class="field_name">链接地址：</td>
                <td>{{$data['link']}}</td>
            </tr>
            <tr>
                <td class="field_name">创建时间：</td>
                <td>{{$data['createTime']}}</td>
            </tr>
            <tr>
                <td class="field_name">更新时间：</td>
                <td>{{$data['updateTime']}}</td>
            </tr>

            <tr><td class="center" colspan="3" style="border:0;cursor:pointer;">
                    <button class="companybtn" onclick="history.go(-1)">返&nbsp;回</button>
                </td></tr>
        </table>
    </div>
@stop

