@extends('company.admin.main')
@section('content')
    @include('company.admin.common.crumb')

    <div class="com_admin_list">
        {{--<div class="search_type" style="color:grey;">--}}
            {{--&nbsp;用户访问记录，容错值 {{$visitRate}} 秒--}}
        {{--</div>--}}
        <table cellspacing="0">
            <tr>
                <td>序号</td>
                <td>用户名</td>
                <td>地区</td>
                <td width="150">创建时间</td>
                <td>操作</td>
            </tr>
            <tr><td colspan="10"></td></tr>
            @if(count($datas))
                @foreach($datas as $data)
            <tr>
                <td>{{$data['id']}}</td>
                <td><a href="{{DOMAIN}}company/admin/visit/{{$data['id']}}" class="list_a">
                        {{str_limit($data['getVisitName'],20)}}</a></td>
                <td>{{$data['ipaddress']}}</td>
                <td>{{$data['loginTime']}}</td>
                <td>
                    <a href="{{DOMAIN}}company/admin/visit/{{$data['id']}}" class="list_btn">查看</a>
                </td>
            </tr>
                @endforeach
            @else <tr><td colspan="10" style="text-align:center;"></td></tr>
            @endif
            <p></p>
        </table>
        @include('company.admin.common.page2')
    </div>
@stop