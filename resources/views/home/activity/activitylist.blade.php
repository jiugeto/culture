@extends('home.main')
@section('content')
    <div class="s_crumb">
        <div class="crumb">
            <div class="right">
                <a href="/">首页</a> /
                <a href="/active">最新活动</a> / {{$genreName}}
            </div>
        </div>
    </div>
    <div class="cre_content">
        <p class="floor">
            <span class="floor_text2">&nbsp; 活动类型：{{$genreName}}</span>
            <span title="返回上一页" style="color:#ff4466;cursor:pointer;" onclick="history.go(-1);">返回</span>
        </p>
        <table width="100%" class="active_tb">
            <tr>
                <th>活动名</th>
                <th>总数量</th>
                <th>剩余数量</th>
                <th>有效时间</th>
                <th>操作</th>
            </tr>
            @if(count($datas))
                @foreach($datas as $data)
            <tr title="点击查看 {{$data['name']}}">
                <td>{{$data['name']}}</td>
                <td>@if(in_array($data['genre'],[5,6]))不限@else{{$data['number']}}@endif</td>
                <td>@if(in_array($data['genre'],[5,6]))不限@else{{$data['number2']}}@endif</td>
                <td>{{$data['period']}}</td>
                <td><a href="{{DOMAIN}}member/active/apply/{{$data['id']}}" title="点击领取优惠">领取</a></td>
            </tr>
                @endforeach
            @else <tr><td colspan="10" style="text-align:center">没有记录</td></tr>
            @endif
        </table>
        <div style="height:20px;"></div>
        @include('home.common.page2')
    </div>
@stop