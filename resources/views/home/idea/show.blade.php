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
                    <input type="hidden" name="remarks" value="{{ $data->remarks }}">
                    <input type="hidden" name="id" value="{{ $data->id }}">
                    <div id="con">@if($data->iscon==3){!! $data->content !!}@endif</div>
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
    <input type="hidden" name=genre"" value="{{ $data->genre }}">

    <div class="laymsg">
        <h4 style="text-align:center;">查看限制</h4>
        <p id="msgcon"></p>
        <p id="toOrder" style="display:none;"><a class="toOrder">申请下单</a></p>
        <p id="toSure"><a href="">确定</a></p>
        <a class="close" onclick="$('.laymsg').hide();"> X </a>
    </div>
    <div class="layback">
        <h4 style="text-align:center;">订单申请</h4>
        <p id="backcon"></p>
        <p><a href="{{DOMAIN}}member/order">进入订单列表</a></p>
        <a class="close" onclick="$('.layback').hide();"> X </a>
    </div>

    <script>
        $(document).ready(function(){
            var iscon = $("input[name='iscon']");
            var remarks = $("input[name='remarks']");
            $("#lookopen").click(function(){
                if (iscon.val()==0) {
                    $(".laymsg").show(); $("#toOrder").show(); $("#toSure").hide();
                    $("#msgcon").html("您没有查看权限，查看创意详情请先下订单！");
                    return;
                } else if (iscon.val()==1) {
                    $(".laymsg").show(); $("#toOrder").hide(); $("#toSure").show();
                    $("#msgcon").html("您没有查看权限，订单未得到回复，请耐心等待！");
                    return;
                } else if (iscon.val()==2) {
                    $(".laymsg").show(); $("#toOrder").hide(); $("#toSure").show();
                    $("#msgcon").html("您没有查看权限，对方拒绝您的创意订单请求，理由："+remarks.val()+"！");
                    return;
                } else if (iscon.val()==3) {
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
            $(".toOrder").click(function(){
//                window.location.href = '{{DOMAIN}}}member/order/create/idea-'+$("input[name='id']").val();
                //1创意供应，2创意需求，3分镜供应，4分镜需求，5商品供应，6商品需求，7娱乐供应，8娱乐需求，9演员供应，10演员需求，1租赁供应，12租赁需求
                var id = $("input[name='id']").val();
                var genre0 = $("input[name='genre']").val();
                var genre;
                if (genre0===1) { genre = 1; } else if (genre0==2) { genre = 1; }
                $.ajax({
                    type: 'POST',
                    url: '{{DOMAIN}}member/order/create',
                    data: {'genre':genre,'id':id},
                    dataType: 'json',
                    success: function(data) {
                        $(".laymsg").hide(); $(".layback").show(); $("#backcon").html(data.message);
                    }
                });
            });
        });
    </script>
@stop