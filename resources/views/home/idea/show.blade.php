@extends('home.main')
@section('content')
    <div class="s_crumb">
        <div class="crumb">
            <div class="right">
                <a href="/">首页</a> /
                <a href="{{DOMAIN}}idea">创意</a> / 详情
            </div>
        </div>
    </div>

    <div class="idea_show">
        <span class="idea_left">
            <div class="idea_con">
                <p class="title">{{$data['name']}}</p>
                <p>报价：{{$data['money']}}元</p>
                <p>{{$data['intro']}} &nbsp;</p>
            </div>
        </span>
        <span class="idea_right">
            @if($userInfo)
            <div class="userinfo">
                <p class="title"></p>
                <p>地址：{{str_limit($userInfo['address,20)'])}}</p>
                <p>发布时间：{{$userInfo['createTime']}}</p>
            </div>
            @endif
        </span>
    </div>
    <input type="hidden" name="_token" value="{{csrf_token()}}">
    <input type="hidden" name=genre"" value="{{$data['genre']}}">

    {{--<div class="laymsg">--}}
        {{--<h4 style="text-align:center;">查看限制</h4>--}}
        {{--<p id="msgcon"></p>--}}
        {{--<p id="toOrder" style="display:none;"><a class="toOrder">申请下单</a></p>--}}
        {{--<p id="toSure"><a href="">确定</a></p>--}}
        {{--<a class="close" onclick="$('.laymsg').hide();"> X </a>--}}
    {{--</div>--}}
    <div class="layback">
        <h4 style="text-align:center;">订单申请</h4>
        <p id="backcon"></p>
        <p><a href="{{DOMAIN}}member/order">进入订单列表</a></p>
        <a class="close" onclick="$('.layback').hide();"> X </a>
    </div>

    {{--<script>--}}
        {{--$(document).ready(function(){--}}
            {{--//订单申请--}}
            {{--$.ajaxSetup({headers : {'X-CSRF-TOKEN':$('input[name="_token"]').val()}});--}}
            {{--$(".toOrder").click(function(){--}}
{{--//                window.location.href = '{{DOMAIN}}}member/order/create/idea-'+$("input[name='id']").val();--}}
                {{--//1创意供应，2创意需求，3分镜供应，4分镜需求，5商品供应，6商品需求，7娱乐供应，8娱乐需求，9演员供应，10演员需求，1租赁供应，12租赁需求--}}
                {{--var id = $("input[name='id']").val();--}}
                {{--var genre0 = $("input[name='genre']").val();--}}
                {{--var genre;--}}
                {{--if (genre0===1) { genre = 1; } else if (genre0==2) { genre = 1; }--}}
                {{--$.ajax({--}}
                    {{--type: 'POST',--}}
                    {{--url: '{{DOMAIN}}member/order/create',--}}
                    {{--data: {'genre':genre,'id':id},--}}
                    {{--dataType: 'json',--}}
                    {{--success: function(data) {--}}
                        {{--$(".laymsg").hide(); $(".layback").show(); $("#backcon").html(data.message);--}}
                    {{--}--}}
                {{--});--}}
            {{--});--}}
        {{--});--}}
    {{--</script>--}}
@stop