@extends('member.main')
@section('content')
    @include('member.common.crumb')
    <div class="mem_tab">
        {{--@include('member.common.lists')--}}
        <ul>
            <a href="{{DOMAIN}}member/message" style="color:{{$list==1?'red':'black'}};">
                <li>收件箱</li>
            </a>
            <li>|</li>
            <a href="{{DOMAIN}}member/message/list" style="color:{{$list==2?'red':'black'}};">
                <li>发件箱</li>
            </a>
            <li>|</li>
            <a @if($frieldId)href="{{DOMAIN}}member/message/chat/{{$frieldId}}" target="_blank"@endif><li>即时窗口</li></a>
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
                <td>消息类型</td>
                <td>{{$list==1?'发送人':'接收人'}}</td>
                <td>内容</td>
                <td>创建时间</td>
                {{--<td>操作</td>--}}
            </tr>
        @if($datas->total())
            @foreach($datas as $data)
            <tr>
                <td>{{ $data->id }}</td>
                <td>{{ $data->getTitle() }}</td>
                <td>{{ $data->getGenreName2() }}</td>
                <td>{{ $list==1?$data->senderName():$data->acceptName() }}</td>
                <td>{{ str_limit($data->intro,20) }}</td>
                <td>{{ $data->createTime() }}</td>
                {{--<td>--}}
                    {{--<a href="" class="list_btn">查看</a>--}}
                {{--</td>--}}
            </tr>
            @endforeach
        @else @include('member.common.norecord')
        @endif
        </table>
        @include('member.common.page')
    </div>
@stop