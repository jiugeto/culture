@extends('member.main')
@section('content')
    @include('member.common.crumb')
    <div class="p_style">供求类型：
        <a href="{{DOMAIN}}member/talk" style="color:{{$lists['func']['url']=='talk'?'red':'grey'}};"><b>我发布的</b></a>&nbsp;
        <a href="{{DOMAIN}}member/talk/click" style="color:{{$lists['func']['url']=='talk/click'?'red':'grey'}};"><b>我点赞的</b></a>&nbsp;
        <a href="{{DOMAIN}}member/talk/collect" style="color:{{$lists['func']['url']=='talk/collect'?'red':'grey'}};"><b>我收藏的</b></a>&nbsp;
        <a href="{{DOMAIN}}member/talk/follow" style="color:{{$lists['func']['url']=='talk/follow'?'red':'grey'}};"><b>我关注的</b></a>&nbsp;
        <a href="{{DOMAIN}}member/talk/reply" style="color:{{$lists['func']['url']=='talk/reply'?'red':'grey'}};"><b>我回复的</b></a>&nbsp;
        <a href="{{DOMAIN}}member/talk/share" style="color:{{$lists['func']['url']=='talk/share'?'red':'grey'}};"><b>我分享的</b></a>&nbsp;
        <a href="{{DOMAIN}}member/talk/thank" style="color:{{$lists['func']['url']=='talk/thank'?'red':'grey'}};"><b>我感谢的</b></a>&nbsp;
    </div>
    {{--<div class="mem_tab"></div>--}}
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