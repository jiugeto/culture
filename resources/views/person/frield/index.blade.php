@extends('person.main')
@section('content')
    <div class="per_body" style="border:0;height:700px;background:0;">
        @include('person.partials.top')
        <div class="per_list">
            <p class="title">@if($m==0)我的好友@elseif($m==1)新的申请@elseif($m==2)寻找好友@endif</p>
            <div class="list" style="height:700px;">
                @if(count($datas))
                    @foreach($datas as $data)
                <div class="frield">
                    <a href="">
                        <div class="left head"><img src=""></div>
                    </a>
                    <div class="left">
                        <p><span class="uname">{{ $data->getUName() }}</span>
                            <span class="level">等级</span></p>
                        <p>签名签名签名签名签名</p>
                    </div>
                </div>
                    @endforeach
                @endif

                @if(count($datas)<$datas->limit)
                    @for($i=0;$i<$datas->limit-count($datas);++$i)
                <div class="frield">
                    <a href="">
                        <div class="left head"><img src=""></div>
                    </a>
                    <div class="left">
                        <p><span class="uname">名称</span>
                            <span class="level">等级</span></p>
                        <p>签名签名签名签名签名</p>
                        <p class="toshow">
                            @if($m==1)
                                <a href="">同意</a>&nbsp;
                                <a href="">拒绝</a>&nbsp;
                            @endif
                            <a href="">查看</a>
                        </p>
                    </div>
                </div>
                    @endfor
                @endif

                <div style="clear:both;">@include('person.common.page')</div>
            </div>
        </div>
        @include('person.common.head')
        <div class="per_right_head">
            <p class="title">好友菜单</p>
            <div class="menu {{ $m==1 ? 'm_curr' : '' }}" onclick="window.location.href='{{DOMAIN}}person/frield/m/1';">新的申请</div>
            <div class="menu {{ $m==0 ? 'm_curr' : '' }}" onclick="window.location.href='{{DOMAIN}}person/frield';">我的好友</div>
            <div class="menu {{ $m==2 ? 'm_curr' : '' }}" onclick="window.location.href='{{DOMAIN}}person/frield/m/2';">寻找好友</div>
            {{--<div class="menu">黑名单</div>--}}
            <div style="height:10px;"></div>
        </div>
    </div>
@stop