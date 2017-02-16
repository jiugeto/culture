@extends('member.main')
@section('content')
    {{--@include('member.common.crumb')--}}
    <div class="mem_crumb">
        <a href="{{DOMAIN}}member">会员后台</a> /
        <a href="{{DOMAIN}}member/wallet">会员福利</a> / 签到记录
    </div>
    <div class="mem_tab">
        <ul>
            <a href="{{DOMAIN}}member/wallet"><li>返回</li></a>
            <li> <span style="color:lightgrey;"> | </span> </li>
            <a href="{{DOMAIN}}person/sign"><li>去签到</li></a>
        </ul>
    </div>
    <div class="hr_tab"></div>
    <div class="list_kongbai">&nbsp;</div>
    <div class="list">
        <table class="list_tab" style="text-align:center;">
            <tr>
                <td>用户名</td>
                <td>奖励个数</td>
                <td>签到时间</td>
            </tr>
        @if(count($datas))
            @foreach($datas as $data)
            <tr>
                <td>{{ UserNameById($data['uid']) }}</td>
                <td>{{ $data['reward'] }}</td>
                <td>{{ $data['createTime'] }}</td>
            </tr>
            @endforeach
        @else <tr><td colspan="10" style="text-align:center;">没有记录</td></tr>
        @endif
        </table>
        @include('member.common.page2')
    </div>
@stop