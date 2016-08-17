@extends('person.main')
@section('content')
    <div class="per_body" style="border:0;height:700px;background:0;">
        @include('person.partials.top')
        <div class="per_list">
            <p class="title">消息列表 <a href="{{DOMAIN}}person/message/create">发送消息</a></p>
            <div class="list">
                @if(count($datas))
                    @foreach($datas as $data)
                <div class="message">
                    <textarea disabled>&nbsp;&nbsp;{{ $data->intro }}</textarea>
                    <p>来自 {{ $data->userName() }} &nbsp;&nbsp;&nbsp;&nbsp; 发表于 {{ $data->createTime() }} <0></p>
                </div>
                    @endforeach
                @endif
                <div class="message">
                    <textarea disabled>&nbsp;&nbsp;消息内容消息内容消息内容消息内容消息内容消息内容消息内容消息内容消息内容消息内容消息内容消息内容消息内容消息内容消息内容消息内容</textarea>
                    <p>来自 某某 &nbsp;&nbsp;&nbsp;&nbsp; 某年某月 <0></p>
                </div>
            </div>
        </div>
        @include('person.user.head')
    </div>
@stop