@extends('member.main')
@section('content')
    @include('member.common.crumb')
    <div class="mem_tab">
        {{--@include('member.common.lists')--}}
        <ul>
            <a href="{{DOMAIN}}member/proCus"><li>片源列表</li></a>
            <li>|</li>
            <a href="{{DOMAIN}}member/proCus"><li>返回</li></a>
        </ul>
    </div>
    <div class="hr_tab"></div>
    <!-- 空白 -->
    <div class="list_kongbai">&nbsp;</div>
    <div class="list">
        <table class="list_tab">
            <tr>
                <td>编号</td>
                <td>片源名称</td>
                <td>供应方</td>
                <td>报价</td>
                <td>期限</td>
                <td>创建时间</td>
                <td>操作(只能选一个)</td>
            </tr>
        @if($datas->total())
            @foreach($datas as $data)
            <tr>
                <td>{{ $data->id }}</td>
                <td>{{ $data->getGoodCusName() }}</td>
                <td>{{ $data->getUName() }}</td>
                <td>{{ $data->getMoney() }}</td>
                <td>{{ $data->getPeriod() }}</td>
                <td>{{ $data->createTime() }}</td>
                <td>
                    {{--<a href="{{DOMAIN}}member/proCus/{{ $data->id }}" class="list_btn">查看</a>--}}
                    <a href="{{DOMAIN}}member/proCus/{{ $data->id }}/setCus" class="list_btn">确定供应方</a>
                    <a href="{{DOMAIN}}member/proCus/{{ $data->id }}/msg" class="list_btn">对话</a>
                </td>
            </tr>
            @endforeach
        @else @include('member.common.norecord')
        @endif
        </table>
        @include('member.common.page')
    </div>
@stop