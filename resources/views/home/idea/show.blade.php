@extends('home.main')
@section('content')
    <style>
        a#lookopen,a#lookclose { cursor:pointer; }
        a:hover#lookopen,a:hover#lookclose { color:red; }
    </style>

    {{--<div>创意细节</div>--}}
    <div class="idea_show">
        {{--<span class="idea_left">--}}
            {{--<div class="idea_con">--}}
                {{--<p class="title">标题</p>--}}
                {{--<p>内容</p>--}}
            {{--</div>--}}
        {{--</span>--}}
        {{--<span class="idea_right">--}}
            {{--<div class="userinfo">--}}
                {{--<p class="title">设计师/公司名称</p>--}}
                {{--<p>地址：</p>--}}
                {{--<p>发布时间：</p>--}}
            {{--</div>--}}
        {{--</span>--}}

        <span class="idea_left">
            <div class="idea_con">
                <p class="title">{{ $data->name }}</p>
                <p>{{ $data->intro }}
                    <a id="lookopen">点击查看详情</a>
                    <a id="lookclose" style="display:none;">收起</a>
                    <input type="hidden" name="iscon" value="{{ $data->iscon }}">
                    <div id="con" style="display:none;">{!! $data->content !!}</div>
                </p>
            </div>
        </span>
        <span class="idea_right">
            <div class="userinfo">
                <p class="title">设计师/公司名称</p>
                <p>地址：</p>
                <p>发布时间：</p>
            </div>
        </span>
    </div>

    <script>
        $(document).ready(function(){
            var iscon = $("input[name='iscon']");
            $("#lookopen").click(function(){
                if(iscon.val()==0){ alert('您没有查看权限，请联系创意提供方！'); }
                if(iscon.val()){ $(this).hide(); $("#lookclose").show(); $("#con").show(); }
            });
            $("#lookclose").click(function(){
                if(iscon.val()){
                    $(this).hide(); $("#lookopen").show(); $("#con").hide();
                }
            });
        });
    </script>
@stop