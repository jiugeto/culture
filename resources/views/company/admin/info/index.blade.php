@extends('company.admin.main')
@section('content')
    @include('company.admin.common.crumb')

    <div class="com_admin_list">
        <h3 class="center pos">{{ $lists['func']['name'] }}详情页</h3>
        <table class="table_create" cellspacing="0" cellpadding="0">
            @if(is_object($data))
            <tr>
                <td class="field_name">简介标题：</td>
                <td>{{ $data->name }}</td>
            </tr>
            <tr>
                <td class="field_name">简介内容：</td>
                <td>{!! $data->intro !!}</td>
            </tr>
            <tr>
                <td class="field_name">图片：</td>
                <td><img src="{{ $data->pic_id ? $data->pic()->url : '' }}"></td>
            </tr>
            @endif

            <tr><td class="center" colspan="3" style="border:0;cursor:pointer;">
                    {{--<a href="/company/admin/job/{{$data->id}}/edit">--}}
                        {{--<button class="companybtn">修&nbsp;&nbsp;改</button></a>--}}
                    <a><button class="companybtn" onclick="history.go(-1)">返&nbsp;&nbsp;回</button></a>
                </td></tr>
        </table>
    </div>
@stop

