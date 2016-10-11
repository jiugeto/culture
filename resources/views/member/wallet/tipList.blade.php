@extends('member.main')
@section('content')
    {{--@include('member.common.crumb')--}}
    <div class="mem_crumb">
        <a href="{{DOMAIN}}member">会员后台</a> /
        <a href="{{DOMAIN}}member/wallet">会员福利</a> / 红包列表
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
                <td>红包类型</td>
                <td>额度</td>
                <td>是否使用</td>
                <td>创建时间</td>
                <td>操作</td>
            </tr>
        @if(count($datas))
            @foreach($datas as $data)
            <tr>
                <td>{{ $data->getTypeName() }}</td>
                <td>{{ $data->tip }}</td>
                <td>{{ $data->getIsUseName() }}</td>
                <td>{{ $data->createTime() }}</td>
                <td>
                    @if($data->is_use==1)
                    <a href="{{DOMAIN}}member/wallet/tipToWeal/{{ $data->id }}" class="list_btn">兑换</a>
                    @else /
                    @endif
                </td>
            </tr>
            @endforeach
        @else @include('member.common.norecord')
        @endif
        </table>
        @include('member.common.page')
    </div>
@stop