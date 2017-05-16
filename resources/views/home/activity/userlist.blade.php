@extends('home.main')
@section('content')
    <div class="s_crumb">
        <div class="crumb">
            <div class="right">
                <a href="/">首页</a> / 最新活动
            </div>
        </div>
    </div>
    <div class="cre_content">
        <p class="floor">
            <span class="floor_text2">&nbsp; 当前活动：{{$genreName}}</span>
            <span title="返回上一页" style="color:#ff4466;cursor:pointer;" onclick="history.go(-1);">返回</span>
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            <span style="color:#000000;">以下是活动中的用户</span>
            {{--<span style="color:#ff4466;">剩下 00 </span>--}}
        </p>
        <table width="100%" class="active_tb">
            <tr>
                <th>类型名</th>
                <th>用户名</th>
                <th>返利数</th>
                <th>操作时间</th>
            </tr>
            @foreach($datas as $data)
            <tr>
                <td>{{$data['genreName']}}</td>
                <td>{{UserNameById($data['uid'])}}</td>
                <td>{{$data['gold']}}</td>
                <td>{{$data['createTime']}}</td>
            </tr>
            @endforeach
        </table>
        <div style="height:20px;"></div>
        @include('home.common.page2')
    </div>
@stop