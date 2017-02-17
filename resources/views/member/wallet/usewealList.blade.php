@extends('member.main')
@section('content')
    <div class="mem_crumb">
        <a href="{{DOMAIN}}member">会员后台</a> /
        <a href="{{DOMAIN}}member/wallet">会员福利</a> / 福利使用记录
    </div>
    <div class="mem_tab">
        <ul>
            <a href="{{DOMAIN}}member/wallet"><li>返回</li></a>
            <a href="{{DOMAIN}}member/wallet/useweal/1" class="{{$o==1?'curr':''}}" style="border:0;"><li>在线订单</li></a>
            <a href="{{DOMAIN}}member/wallet/useweal/2" class="{{$o==2?'curr':''}}" style="border:0;"><li>主订单</li></a>
        </ul>
    </div>
    <div class="hr_tab"></div>
    <div class="list_kongbai">&nbsp;</div>
    <div class="list">
        <table class="list_tab" style="text-align:center;">
            <tr>
                <td>用户名</td>
                <td>额度</td>
                <td>使用时间</td>
            </tr>
        @if(count($datas))
            @foreach($datas as $data)
            <tr>
                <td>{{$data['uname']}}</td>
                <td>{{$data['weal']}}</td>
                <td>{{$data['createTime']}}</td>
            </tr>
            @endforeach
        @else <tr><td colspan="10" style="text-align:center;">没有记录</td></tr>
        @endif
        </table>
        @include('member.common.page2')
    </div>
@stop