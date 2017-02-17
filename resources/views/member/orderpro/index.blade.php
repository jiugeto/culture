@extends('member.main')
@section('content')
    @include('member.common.crumb')
    <div class="hr_tab"></div>
    <!-- 空白 -->
    <div class="list_kongbai">&nbsp;</div>
    <div class="list">
        <table class="list_tab">
            <tr>
                <td>订单名称</td>
                <td>类型</td>
                <td>总价格(元)</td>
                <td>福利(元)</td>
                <td>需支付(元)</td>
                <td>状态</td>
                <td>创建时间</td>
                <td>操作</td>
            </tr>
        @if(count($datas))
            @foreach($datas as $data)
            <tr>
                <td>{{$data['pname']}}</td>
                <td>{{$data['cateName']}}</td>
                <td>{{$data['money']}}</td>
                <td>{{$data['weal']}}</td>
                <td>{{$data['money1']}}</td>
                <td>{{$data['statusName']}}</td>
                <td>{{$data['createTime']}}</td>
                <td>
                    <a href="{{DOMAIN}}member/orderpro/{{ $data['id'] }}" class="list_btn">查看</a>
                    @if($data->status<=2)
                    <a href="{{DOMAIN}}member/orderpro/{{ $data->id }}/destroy" class="list_btn">删除</a>
                    @endif
                    @if(in_array($data->status,[2,3]))
                        <div style="height:10px;"></div>
                        <a onclick="getPayCode({{$data->id}})" class="list_btn">支付码</a>
                    @elseif($data->status==5)
                        <a onclick="getComment({{$data->id}})" class="list_btn">去评价</a>
                    @endif
                </td>
            </tr>
            @endforeach
        @else <tr><td colspan="10" style="text-align:center;">没有记录</td></tr>
        @endif
        </table>
        {{--<p>注意：总价格 = 渲染价格 + 修改价格，下单-》定价-》付款-》制作-》成交-》评价-》本站返利</p>--}}
        @include('member.common.page2')
    </div>

    {{--弹出框：支付的二维码、设置评价--}}
    {{--@if($data['uid']==Session::get('user.uid'))--}}
        {{--<div class="popup_bg">&nbsp;</div>--}}
        {{--<div class="popup3" id="paycode" style="width:400px;height:350px;top:200px;display:none;">--}}
            {{--<img src="{{PUB}}assets-home/images/cul_paycode.png">--}}
            {{--<p style="margin:0;text-align:center;">斯塔克(科幻-视效控)</p>--}}
            {{--<div class="close">确 定</div>--}}
            {{--<a class="tshow close">X</a>--}}
        {{--</div>--}}
        {{--<div class="popup3" id="comment" style="width:400px;height:160px;top:200px;display:none;">--}}
            {{--<p style="height:30px;"><b>订单后评价</b></p>--}}
            {{--<p style="margin-bottom:10px;">--}}
                {{--<label><input type="radio" class="radio" name="comment1" onclick="setComment(0)"> 不满意&nbsp;&nbsp;</label>--}}
                {{--<label><input type="radio" class="radio" name="comment1" onclick="setComment(1)" checked> 满意</label>--}}
                {{--<span class="star">&nbsp;&nbsp;&nbsp;&nbsp;增加<b id="backGold">5</b>个金币</span>--}}
                {{--<input type="hidden" name="status" value="{{ $data['status'] }}">--}}
                {{--<input type="hidden" name="comment" value="1">--}}
                {{--<input type="hidden" name="id">--}}
            {{--</p>--}}
            {{--<div class="close" id="getComment">确 定</div>--}}
            {{--<a class="tshow close">X</a>--}}
        {{--</div>--}}
    {{--@endif--}}
    <script>
        function getPayCode(id){
            $('#paycode').show(); $('.popup_bg').show();
        }
        function getComment(id){
            $('#comment').show(); $('.popup_bg').show();
            $("input[name='id']")[0].value = id;
        }
        function setComment(comment){
            if (comment==0) {
                $('#backGold').html(0); $("input[name='comment']")[0].value = comment;
            } else if (comment==1) {
                $('#backGold').html(5); $("input[name='comment']")[0].value = comment;
            }
        }
        $(".close").click(function(){
            $(".popup_bg").hide(); $(".popup3").hide();
        });
        $("#getComment").click(function(){
            var id = $("input[name='id']").val();
            var status = $("input[name='status']").val();
            var comment = $("input[name='comment']").val();
            var backGold = $("#backGold").html();
            if (status==5) {
                window.location.href = '{{DOMAIN}}member/orderpro/comment/'+id+'/'+comment+'/'+backGold*1;
            }
        });
    </script>
@stop