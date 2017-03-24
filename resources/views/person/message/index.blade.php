@extends('person.main')
@section('content')
    <div class="per_body" style="border:0;height:700px;background:0;">
        @include('person.common.top')
        <div class="per_list">
            <p class="title">消息列表
                @if($menu==1) / 发件箱 @else / 草稿箱 @endif
                <a href="{{DOMAIN}}person/message/create" title="点击去发送消息">发送消息</a>
            </p>
            <div class="list" style="width:748px;@if($pagelist['total']<2)height:240px;@endif">
                @if(count($datas))
                    @foreach($datas as $data)
                <div class="message">
                    <textarea disabled>&nbsp;&nbsp;{{str_limit($data['intro'],100)}}</textarea>
                    <p class="right">
                        @if($data['status']==1)
                        <a href="{{DOMAIN}}person/message/{{$data['id']}}/edit">编辑</a>
                        @endif
                        <a href="{{DOMAIN}}person/message/{{$data['id']}}">查看</a> &nbsp;&nbsp;&nbsp;&nbsp;
                        来自 {{UserNameById($data['sender'])}} &nbsp;&nbsp;&nbsp;&nbsp;
                        发表于 {{$data['getSenderTime']}} &nbsp;&nbsp;&nbsp;&nbsp;
                        (<span class="red">{{$data['id']}}</span>)
                    </p>
                </div>
                    @endforeach
                @else <div class="message" style="text-align:center;line-height:60px;">没有记录</div>
                @endif
                @include('person.common.page2')
            </div>
        </div>

        @include('person.common.head')
        <div class="per_right_head">
            <p class="title">消息菜单</p>
            <div class="menu {{$menu==1 ? 'm_curr' : ''}}" onclick="getMenu(1)">收件箱</div>
            <div class="menu {{$menu==2 ? 'm_curr' : ''}}" onclick="getMenu(2)">发件箱</div>
            <div style="height:10px;"></div>
        </div>
    </div>

    <script>
        function getMenu(menu){
            if (menu==1) {
                window.location.href = "{{DOMAIN}}person/message";
            } else {
                window.location.href = "{{DOMAIN}}person/message/s/"+menu;
            }
        }
    </script>
@stop