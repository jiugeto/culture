@extends('person.main')
@section('content')
    <div class="per_body" style="border:0;height:700px;background:0;">
        @include('person.partials.top')
        <div class="per_list">
            <p class="title">消息列表
                @if($m==1) @elseif($m==2)/ 发件箱 @elseif($m==3)/ 草稿箱 @elseif($m==4)/ 回收站 @endif
                <a href="{{DOMAIN}}person/message/create">发送消息</a>
            </p>
            <div class="list" @if(count($datas)<2)style="height:240px;"@endif>
                {{--<p id="search">--}}
                    {{--时间选择--}}
                    {{--<select name="time">--}}
                        {{--<option value="0">所有</option>--}}
                        {{--<option value="1">一天内</option>--}}
                        {{--<option value="2">一周内</option>--}}
                        {{--<option value="3">一月内</option>--}}
                        {{--<option value="4">更早</option>--}}
                    {{--</select>--}}
                {{--</p>--}}
                @if(count($datas))
                    @foreach($datas as $data)
                <div class="message">
                    <textarea disabled>&nbsp;&nbsp;{{ str_limit($data->intro,100) }}</textarea>
                    <p class="right">
                        @if($data->status==1)
                        <a href="{{DOMAIN}}person/message/{{ $data->id }}/edit">编辑</a>
                        @endif
                        <a href="{{DOMAIN}}person/message/{{ $data->id }}">查看</a> &nbsp;&nbsp;&nbsp;&nbsp;
                        来自 {{ $data->senderName() }} &nbsp;&nbsp;&nbsp;&nbsp;
                        发表于 {{ $data->createTime() }} &nbsp;&nbsp;&nbsp;&nbsp;
                        (<span class="red">{{ $data->id }}</span>)
                    </p>
                </div>
                    @endforeach
                @else <div class="message" style="text-align:center;line-height:60px;">没有记录</div>
                @endif
                {{--<div class="message">--}}
                    {{--<textarea disabled>&nbsp;&nbsp;消息内容消息内容消息内容消息内容消息内容消息内容消息内容消息内容消息内容消息内容消息内容消息内容消息内容消息内容消息内容消息内容</textarea>--}}
                    {{--<p class="right">来自 某某 &nbsp;&nbsp;&nbsp;&nbsp; 某年某月 (<span class="red">0</span>)</p>--}}
                {{--</div>--}}
                <div style="height:50px;">@include('person.common.page')</div>
            </div>
        </div>

        @include('person.common.head')
        <div class="per_right_head">
            <p class="title">消息菜单</p>
            <div class="menu {{ $m==1 ? 'm_curr' : '' }}" id="inbox">收件箱</div>
            <div class="menu {{ $m==2 ? 'm_curr' : '' }}" id="outbox">发件箱</div>
            <div class="menu {{ $m==3 ? 'm_curr' : '' }}" id="draft">草稿箱</div>
            <div class="menu {{ $m==4 ? 'm_curr' : '' }}" id="trash">回收站</div>
            <div style="height:10px;"></div>
        </div>
    </div>

    {{--<input type="hidden" name="menu" value="{{ $m }}">--}}
    <script>
        //m代表菜单检索
        $("#inbox").click(function(){ window.location.href = '{{DOMAIN}}person/message'; });
        $("#outbox").click(function(){ window.location.href = '{{DOMAIN}}person/message/m/2'; });
        $("#draft").click(function(){ window.location.href = '{{DOMAIN}}person/message/m/3'; });
        $("#trash").click(function(){ window.location.href = '{{DOMAIN}}person/message/m/4'; });
        {{--//时间检索--}}
        {{--$("select[name='time']").change(function(){--}}
            {{--var t = $(this).val();--}}
            {{--var m = $("input[name='menu']").val();--}}
            {{--if (t==0 && m==1) {--}}
                {{--window.location.href = '{{DOMAIN}}person/message';--}}
            {{--} else {--}}
                {{--window.location.href = '{{DOMAIN}}person/message/m/'+m+'/'+t;--}}
            {{--}--}}
        {{--});--}}
    </script>
@stop