@extends('member.main')
@section('content')
    @include('member.common.crumb')
    {{--<div class="p_style">--}}
        {{--<a href="{{DOMAIN}}member/talk" style="color:{{$index==0?'red':'grey'}};"><b>我发布的</b></a>&nbsp;--}}
        {{--<a href="{{DOMAIN}}member/talk/i/1" style="color:{{$index==1?'red':'grey'}};"><b>我点赞的</b></a>&nbsp;--}}
        {{--<a href="{{DOMAIN}}member/talk/i/2" style="color:{{$index==2?'red':'grey'}};"><b>我收藏的</b></a>&nbsp;--}}
        {{--<a href="{{DOMAIN}}member/talk/i/3" style="color:{{$index==3?'red':'grey'}};"><b>我关注的</b></a>&nbsp;--}}
        {{--<a href="{{DOMAIN}}member/talk/i/4" style="{{$index==4?'red':'grey'}};"><b>我回复的</b></a>&nbsp;--}}
        {{--<a href="{{DOMAIN}}member/talk/i/5" style="color:{{$index==5?'red':'grey'}};"><b>我分享的</b></a>&nbsp;--}}
        {{--<a href="{{DOMAIN}}member/talk/i/6" style="color:{{$index==6?'red':'grey'}};"><b>我感谢的</b></a>&nbsp;--}}
    {{--</div>--}}
    <div class="mem_tab">
        <ul>
            <a href="{{DOMAIN}}member/talk" style="color:{{$index==0?'red':'grey'}};"><li><b>我发布的</b></li></a>
            <li>|</li>
            <a href="{{DOMAIN}}member/talk/i/1" style="color:{{$index==1?'red':'grey'}};"><li><b>我点赞的</b></li></a>
            <li>|</li>
            <a href="{{DOMAIN}}member/talk/i/2" style="color:{{$index==2?'red':'grey'}};"><li><b>我收藏的</b></li></a>
            <li>|</li>
            <a href="{{DOMAIN}}member/talk/i/3" style="color:{{$index==3?'red':'grey'}};"><li><b>我关注的</b></li></a>
            <li>|</li>
            <a href="{{DOMAIN}}member/talk/i/4" style="color:{{$index==4?'red':'grey'}};"><li><b>我回复的</b></li></a>
            <li>|</li>
            <a href="{{DOMAIN}}member/talk/i/5" style="color:{{$index==5?'red':'grey'}};"><li><b>我分享的</b></li></a>
            <li>|</li>
            <a href="{{DOMAIN}}member/talk/i/6" style="color:{{$index==6?'red':'grey'}};"><li><b>我感谢的</b></li></a>
        </ul>
    </div>
    <div class="hr_tab"></div>
    <!-- 空白 -->
    <div class="list_kongbai">&nbsp;</div>
    <div class="list">
        <table class="list_tab">
            <tr>
                <td>编号</td>
                <td>标题</td>
                <td>内容</td>
                <td>创建时间</td>
                <td>操作</td>
            </tr>
        @if($datas->total())
            @foreach($datas as $data)
            <tr>
                <td>{{ $data->id }}</td>
                <td><a href="{{DOMAIN}}member/talk/{{$data->id}}">{{ str_limit($data->name,10) }}</a></td>
                <td>{!! str_limit($data->content,40) !!}</td>
                <td>{{ $data->createTime() }}</td>
                <td>
                    <a href="{{DOMAIN}}member/talk/{{ $data->id }}" class="list_btn">查看</a>
                </td>
            </tr>
            @endforeach
        @else @include('member.common.norecord')
        @endif
        </table>
        @include('member.common.page')
    </div>
@stop