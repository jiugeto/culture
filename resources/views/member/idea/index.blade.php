@extends('member.main')
@section('content')
    @include('member.common.crumb')
    <div class="mem_tab">
        {{--@include('member.common.lists')--}}
        <ul>
            <a href="{{DOMAIN}}member/idea"><li class="{{$genre==1?'curr':''}}">供应</li></a>
            <a href="{{DOMAIN}}member/idea/s/2"><li class="{{$genre==2?'curr':''}}">需求</li></a>
        </ul>
        <div class="mem_create">
            <a href="{{DOMAIN}}member/{{$lists['func']['url']}}/create">{{$lists['create']['name']}}</a>
        </div>
    </div>
    <div class="hr_tab"></div>
    <!-- 空白 -->
    <div class="list_kongbai">&nbsp;</div>
    <div class="list">
        <table class="list_tab">
            <tr>
                <td>编号</td>
                <td>故事名称</td>
                <td>分类</td>
                <td>创建时间</td>
                <td>操作</td>
            </tr>
        @if(count($datas))
            @foreach($datas as $data)
            <tr>
                <td>{{$data['id']}}</td>
                <td>{{$data['name']}}</td>
                <td>{{$data['cateName']}}</td>
                <td>{{$data['createTime']}}</td>
                <td>
                    <a href="{{DOMAIN}}member/idea/{{$data['id']}}" class="list_btn">查看</a>
                    <a href="{{DOMAIN}}member/idea/{{$data['id']}}/edit" class="list_btn">编辑</a>
                </td>
            </tr>
            @endforeach
        @else <tr><td colspan="10" style="text-align:center;">没有记录</td></tr>
        @endif
        </table>
        @include('member.common.page2')
    </div>
@stop