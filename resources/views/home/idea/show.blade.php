@extends('home.main')
@section('content')
    <div class="idea_show">
        <span class="idea_left">
            <div class="idea_con">
                <p class="title">{{ $data->name }}</p>
                <p>{{ $data->intro }} &nbsp;
                    <a id="lookopen">点击查看详情</a>
                    <a id="lookclose" style="display:none;">收起</a>
                    <input type="hidden" name="iscon" value="{{ $data->iscon }}">
                    <input type="hidden" name="id" value="{{ $data->id }}">
                    <div id="con" style="display:none;">@if($data->iscon){!! $data->content !!}@endif</div>
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
    <div class="laymsg">
        <h4 style="text-align:center;">查看限制</h4>
        <p>您没有查看权限，请联系创意提供方！</p>
        <p id="toOrder">申请查看此创意</p>
        <input type="hidden" name="_token" value="{{csrf_token()}}">
        <a onclick="$('.laymsg').hide();"> X </a>
    </div>

    <script>
        $(document).ready(function(){
            var iscon = $("input[name='iscon']");
            $("#lookopen").click(function(){
                if(iscon.val()==0){ $(".laymsg").show(); return; }
                if(iscon.val()){ $(this).hide(); $("#lookclose").show(); $("#con").show(); }
            });
            $("#lookclose").click(function(){
                if(iscon.val()){
                    $(this).hide(); $("#lookopen").show(); $("#con").hide();
                }
            });

            //订单申请
            $.ajaxSetup({headers : {'X-CSRF-TOKEN':$('input[name="_token"]').val()}});
            var id = $("input[name='id']").val();
            $("#toOrder").click(function(){
//                window.location.href = '/member/order/create/idea-'+$("input[name='id']").val();
                $.ajax({
                    type: 'POST',
                    url: '/member/order/create',
                    data: {'genre':'idea','id':id},
                    dataType: 'json',
                    success: function($data) {
                        alert($data);
                    }
                });
            });
        });
    </script>
@stop