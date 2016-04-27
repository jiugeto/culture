@extends('company.admin.main')
@section('content')
    {{--@include('company.common.crumb')--}}

    <div class="com_admin_list">
        <h3 class="center pos">{{ $curr_list['show']['name'] }}详情页</h3>
        <table class="table_create" cellspacing="0" cellpadding="0">
            @if(isset($data->jobs) && isset($data->jobRequires) && $data->jobs && $data->jobRequires)
                @foreach($data->jobs as $kjob=>$job)
                <tr>
                    <td class="field_name">{{ $job }}：</td>
                    <td>{{ $data->jobRequires[$kjob] }} <br>需{{ $data->nums[$kjob] }}人</td>
                    <td>
                        <a href="/company/admin/job/{{$data->id}}-{{ $kjob }}/edit">修改</a>
                        <a href="/company/admin/job/{{$data->id}}-{{ $kjob }}/del">删除</a>
                    </td>
                </tr>
                @endforeach
                <tr><td colspan="2">&nbsp;</td><td><a href="/company/admin/job/create/{{$data->id}}">新加岗位</a></td></tr>
            @else <tr><td colspan="2">无招聘需求</td><td><a href="/company/admin/job/create/{{$data->id}}">新加岗位</a></td></tr>
            @endif

            <tr><td class="center" colspan="3" style="border:0;cursor:pointer;">
                    {{--<a href="/company/admin/job/{{$data->id}}/edit">--}}
                        {{--<button class="companybtn">修&nbsp;&nbsp;改</button></a>--}}
                    <a><button class="companybtn" onclick="history.go(-1)">返&nbsp;&nbsp;回</button></a>
                </td></tr>
        </table>
    </div>
@stop

