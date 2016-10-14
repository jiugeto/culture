@extends('member.main')
@section('content')
    {{--@include('member.common.crumb')--}}
    <div class="mem_crumb">
        <a href="{{DOMAIN}}member">会员后台</a> /
        <a href="{{DOMAIN}}member/wallet">会员福利</a> / 金币列表
    </div>
    <div class="mem_tab">
        <ul>
            <a href="{{DOMAIN}}member/wallet"><li>返回</li></a>
        </ul>
    </div>
    <div class="hr_tab"></div>
    <div class="list_kongbai">&nbsp;</div>
    <div class="list">
        <table class="list_tab">
            <tr>
                <td>奖励类型</td>
                <td>奖励个数</td>
                <td>创建时间</td>
            </tr>
        @if(count($datas))
            @foreach($datas as $data)
            <tr>
                <td>{{ $data->genreName() }}</td>
                <td>{{ $data->gold }}</td>
                <td>{{ $data->createTime() }}</td>
            </tr>
            @endforeach
        @else @include('member.common.norecord')
        @endif
        </table>
        @include('member.common.page')
    </div>
@stop