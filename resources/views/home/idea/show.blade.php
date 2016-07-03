@extends('home.main')
@section('content')
    <div class="idea_show">
        <span class="idea_left">
            <div class="idea_con">
                <p class="title">{{ $data->name }}</p>
                @if($data->money)<p>价格：{{ $data->money }}元</p>@endif
                <p>{{ $data->intro }} &nbsp;
                    <a id="lookopen">点击查看详情</a>
                    <a id="lookclose" style="display:none;">收起</a>
                    <input type="hidden" name="iscon" value="{{ $data->iscon }}">
                    <input type="hidden" name="id" value="{{ $data->id }}">
                    <div id="con">@if($data->iscon){!! $data->content !!}@endif</div>
                </p>
            </div>
        </span>
        <span class="idea_right">
            @if($userInfo = $data->user())
            <div class="userinfo">
                <p class="title">{{ $userInfo->company ? $userInfo->company->name.'的' : '' }}{{ $userInfo->username }}</p>
                <p>地址：{{ $userInfo->address }}</p>
                <p>发布时间：{{ $userInfo->created_at }}</p>
            </div>
            @endif
        </span>
    </div>

    <input type="hidden" name="_token" value="{{csrf_token()}}">
    <div class="laymsg">
        <h4 style="text-align:center;">查看限制</h4>
        <p>您没有查看权限，查看创意详情请先下订单！</p>
        <p><a class="toOrder">申请下单</a></p>
        <a class="close" onclick="$('.laymsg').hide();"> X </a>
    </div>
    <div class="layback">
        <h4 style="text-align:center;">订单申请</h4>
        <p id="backcon"></p>
        <p><a href="/member/order">进入订单列表</a></p>
        <a class="close" onclick="$('.layback').hide();"> X </a>
    </div>

    <script>
        $(document).ready(function(){
            var iscon = $("input[name='iscon']");
            $("#lookopen").click(function(){
                if (iscon.val()==0) {
                    $(".laymsg").show();return;
                } else if (iscon.val()==1) {
                    $(this).hide(); $("#lookclose").show(); $("#con").show();
                }
            });
            $("#lookclose").click(function(){
                if(iscon.val()){
                    $(this).hide(); $("#lookopen").show(); $("#con").hide();
                }
            });

            //订单申请
            $.ajaxSetup({headers : {'X-CSRF-TOKEN':$('input[name="_token"]').val()}});
            var id = $("input[name='id']").val();
            $(".toOrder").click(function(){
//                window.location.href = '/member/order/create/idea-'+$("input[name='id']").val();
                //1创意供应，2创意需求，3分镜供应，4分镜需求，5商品供应，6商品需求，7娱乐供应，8娱乐需求，9演员供应，10演员需求，1租赁供应，12租赁需求
                $.ajax({
                    type: 'POST',
                    url: '/member/order/create',
                    data: {'genre':1,'id':id},
                    dataType: 'json',
                    success: function(data) {
                        $(".laymsg").hide(); $(".layback").show(); $("#backcon").html(data.message);
                    }
                });
            });
        });
    </script>
@stop