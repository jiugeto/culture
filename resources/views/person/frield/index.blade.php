@extends('person.main')
@section('content')
    <div class="per_body" style="border:0;height:700px;background:0;">
        @include('person.partials.top')
        <div class="per_list">
            <p class="title">我的好友</p>
            <div class="list" style="height:600px;">
                @if(count($datas))
                    @foreach($datas as $data)
                <div class="frield">
                    <div class="left head">
                        <img src="">
                    </div>
                    <div class="left">
                        <p><span class="uname">{{ $data->getUName() }}</span>
                            <span class="level">等级</span></p>
                        <p>签名签名签名签名签名</p>
                    </div>
                </div>
                    @endforeach
                @endif
                <div class="frield">
                    <div class="left head"><img src=""></div>
                    <div class="left">
                        <p><span class="uname">名称</span>
                            <span class="level">等级</span></p>
                        <p>签名签名签名签名签名</p>
                    </div>
                </div>
            </div>
        </div>
        @include('person.common.head')
        <div class="per_right_head">
            <p class="title">好友菜单</p>
            <div class="menu">新申请的</div>
            <div class="menu">我的好友</div>
            <div class="menu">寻找好友</div>
            {{--<div class="menu">黑名单</div>--}}
            <div style="height:10px;"></div>
        </div>
    </div>
@stop