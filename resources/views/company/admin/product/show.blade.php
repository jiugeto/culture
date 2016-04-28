@extends('company.admin.main')
@section('content')
    @include('company.admin.common.crumb')

    <div class="com_admin_list">
        <h3 class="center pos">{{ $lists['func']['name'] }}详情页</h3>
        <table class="table_create" cellspacing="0" cellpadding="0">
            <tr>
                <td class="field_name">产品名称：</td>
                <td>{{ $data->name }}</td>
            </tr>
            <tr>
                <td class="field_name">分类：</td>
                <td>{{ $data->cate() ? $data->cate()->name : '' }}</td>
            </tr>
            <tr>
                <td class="field_name">简单介绍：</td>
                <td>{{ $data->intro }}</td>
            </tr>
            <tr>
                <td class="field_name">鼠标移动显示：</td>
                <td>{{ $data->title }}</td>
            </tr>
            <tr>
                <td class="field_name">图片：</td>
                <td>@if($data->pic()) <p>{{ $data->pic()->name }}</p><br><img src="{{ $data->pic()->url }}"> @endif</td>
            </tr>
            <tr>
                <td class="field_name">视频：</td>
                <td>
                    @if($data->pic())
                        <p>{{ $data->pic()->name }}<a href="" class="job">预览</a></p>
                        <br>{{ $data->pic()->url }}
                    @endif
                </td>
            </tr>
            <tr>
                <td class="field_name">前台显示否：</td>
                <td>{{ $data->isshow2 ? '显示' : '不显示' }}</td>
            </tr>

            <tr><td class="center" colspan="2" style="border:0;cursor:pointer;">
                    {{--<a href="/company/admin/job/{{$data->id}}/edit">--}}
                        {{--<button class="companybtn">修&nbsp;&nbsp;改</button></a>--}}
                    <a><button class="companybtn" onclick="history.go(-1)">返&nbsp;&nbsp;回</button></a>
                </td></tr>
        </table>
    </div>
@stop

