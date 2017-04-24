@extends('company.main')
@section('content')
    <div class="com_firm">
        <div class="title"><div>{{count($datas)?$datas[0]['moduleName']:''}}</div></div>
        <p>{{count($datas)?$datas[0]['moduleIntro']:''}}</p>
        <div class="com_recruit_con">
            <table cellspacing="0">
                <tr>
                    <td class="left">职位</td>
                    <td class="second">人数</td>
                    <td>要求</td>
                    <td class="four">更新时间</td>
                </tr>
                @if(count($datas))
                    @foreach($datas as $data)
                    <tr>
                        <td>{{$data['name']}}</td>
                        <td>{{$data['small']}}</td>
                        <td><div class="admin_show_con">{{$data['intro']}}</div></td>
                        <td class="four_text">{{$data['updateTime']}}</td>
                    </tr>
                    @endforeach
                @else <tr><td colspan="10" style="text-align:center;">没有记录</td></tr>
                @endif
            </table>
            <p>
                <b>{{$company['name']}}</b>的邮箱是
                <span style="color:#0e90d2;">{{$company['email']}}</span>。<br>
                请发简历至<b>{{$company['name']}}</b>邮箱！
            </p>
        </div>
    </div>
@stop