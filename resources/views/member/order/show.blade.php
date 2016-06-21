@extends('member.main')
@section('content')
    @include('member.common.crumb')

    <h3 class="center">{{$lists['func']['name']}}详情页</h3>
    <table class="table_create table_show" cellspacing="0" cellpadding="0">
        <tr>
            <td class="field_name" style="width:100px;">订单名称：</td>
            <td>{{ $data->name }}</td>
        </tr>
        <tr>
            <td class="field_name">类型：</td>
            <td>{{ $data->genreName() }}</td>
        </tr>
        <tr>
            <td class="field_name">供应方：</td>
            <td>{{ $data->sellerName }}</td>
        </tr>
        <tr>
            <td class="field_name">需求方：</td>
            <td>{{ $data->buyerName }}</td>
        </tr>
        <tr>
            <td class="field_name">状态：</td>
            <td>{{ $data->status() }}</td>
        </tr>

    @if($data->status>1)
        @if(in_array($data->genre,[1,2]))
        <tr>
            <td class="field_name">创意交易价格：</td>
            <td class="statusbtn">
                @if($data->status==2 && $data->seller==$userid)
                    <input type="text" placeholder="0代表免费" pattern="^\d+$" name="money"> 元
                @elseif($data->status>2 && $data->money)
                    {{ $data->money ? $data->money.'元' : '免费' }}
                @endif
                &nbsp;&nbsp;<a href="/member/idea/{{ $data->fromid }}" target="_blank">查看创意</a>
            </td>
        </tr>
        @elseif(in_array($data->genre,[3,4]))
        <tr>
            <td class="field_name">分镜交易价格：</td>
            <td class="statusbtn">
                @if($data->status==2 || $data->seller==$userid)
                    <input type="text" placeholder="0代表免费" pattern="^\d+$" name="storyMoney"> 元
                @elseif($data->status>2 && $data->money)
                    {{ $data->money ? $data->money.'元' : '免费' }}
                @endif
                &nbsp;&nbsp;<a href="/member/storyboard/{{ $data->fromid }}" target="_blank">查看分镜</a>
            </td>
        </tr>
        @elseif(in_array($data->genre,[5,6]))
        <tr>
            <td class="field_name">分期首款：</td>
            <td class="statusbtn">
                @if($data->status==2 || $data->seller==$userid)
                    <input type="text" placeholder="一期收费" pattern="^([1-9])|([1-9]\d+)$" required name="realMoney1"> 元 &nbsp;
                @elseif($data->status>2)
                    {{ $data->realMoney1 }}元
                @endif
                @if($data->status==3)
                    <span class="orange">效果协商中</span>
                @elseif($data->status>3)
                    <span class="green">效果已协商</span>
                @endif
            </td>
        </tr>
        <tr>
            <td class="field_name">二期付款：</td>
            <td class="statusbtn">
                @if($data->status==4 || $data->seller==$userid)
                    <input type="text" placeholder="二期收费" pattern="^([1-9])|([1-9]\d+)$" required name="realMoney2"> 元
                @elseif($data->status>4)
                    {{ $data->realMoney2 }}元
                @else 无
                @endif
                @if($data->status==5)
                    <span class="orange">效果待确定</span>
                @elseif($data->status>5)
                    <span class="green">效果已确定</span>
                @endif
            </td>
        </tr>
        <tr>
            <td class="field_name">三期付款：</td>
            <td class="statusbtn">
                @if($data->status==6 || $data->seller==$userid)
                    <input type="text" placeholder="三期收费" pattern="^([1-9])|([1-9]\d+)$" required name="realMoney3"> 元
                @elseif($data->status>6)
                    {{ $data->realMoney3 }}元
                @else 无
                @endif
                @if($data->status==7)
                    <span class="orange">成片待确定</span>
                @elseif($data->status>7)
                    <span class="green">成片已确定</span>
                @endif
            </td>
        </tr>
        <tr>
            <td class="field_name">分期尾款：</td>
            <td class="statusbtn">
                @if($data->status==8 || $data->seller==$userid)
                    <input type="text" placeholder="四期收费" pattern="^([1-9])|([1-9]\d+)$" required name="realMoney4"> 元
                @elseif($data->status>8)
                    {{ $data->realMoney4 }}元
                @else 无
                @endif
                @if($data->status==9)
                    <span class="orange">待出片</span>
                @elseif($data->status>9)
                    <span class="green">已出片</span>
                @endif
            </td>
        </tr>
        @endif
    @endif

        <tr>
            <td class="field_name">创建时间：</td>
            <td>{{ $data->created_at }}</td>
        </tr>
        <tr>
            <td class="field_name">更新时间：</td>
            <td>{{ $data->updated_at ? '未更新' : $data->updated_at }}</td>
        </tr>
    </table>

    <table class="table_create table_show" cellspacing="0" cellpadding="0">
        <tr>
            <td class="status_line">
                <div class="title">订单状态线：
                    <span id="statustext0">
                        @if(in_array($data->genre,[1,2,3,4]))
                            {{ $model['status1s'][$data->status] }}
                        @elseif(in_array($data->genre,[5,6]))
                            {{ $model['status2s'][$data->status] }}
                        @elseif(in_array($data->genre,[7,8,9,10,11,12]))
                            {{ $model['status3s'][$data->status] }}
                        @endif
                    </span>
                </div>
                <div class="con">
                    <div class="pos">
                    @if(in_array($data->genre,[1,2,3,4]))
                        @foreach($model['status1s'] as $kstatus=>$status)
                        <a id="status{{ $kstatus-1 }}">
                            <div style="background:{{$data->status==$kstatus?'rgba(255,0,255,1)':'rgba(220,220,220,1)'}};"></div>
                            <span id="statustext{{ $kstatus-1 }}" style="display:{{$data->status==$kstatus?'block':'none'}};">{{ $status }}</span>
                        </a>
                        @endforeach
                    @elseif(in_array($data->genre,[5,6]))
                        @foreach($model['status2s'] as $kstatus=>$status)
                        <a id="status2_{{ $kstatus-1 }}">
                            <div style="background:{{$data->status==$kstatus?'rgba(255,0,255,1)':'rgba(220,220,220,1)'}};"></div>
                            <span id="statustext2_{{ $kstatus-1 }}" style="display:{{$data->status==$kstatus?'block':'none'}};">{{ $status }}</span>
                        </a>
                        @endforeach
                    @elseif(in_array($data->genre,[6,7,8,9,10,11,12]))
                        @foreach($model['status3s'] as $kstatus=>$status)
                        <a id="status2_{{ $kstatus-1 }}">
                            <div style="background:{{$data->status==$kstatus?'rgba(255,0,255,1)':'rgba(220,220,220,1)'}};"></div>
                            <span id="statustext2_{{ $kstatus-1 }}" style="display:{{$data->status==$kstatus?'block':'none'}};">{{ $status }}</span>
                        </a>
                        @endforeach
                    @endif
                    </div>
                </div>
            </td>
        </tr>
    </table>

    <table class="table_create table_show" cellspacing="0" cellpadding="0">
        <tr><td class="center" colspan="2" style="border:0;cursor:pointer;">
                <button class="companybtn" onclick="history.go(-1)">返 &nbsp;回</button>
                @if(in_array($data->genre,[1,2,3,4]))
                <a id="tostatus" title="{{ $data->statusbtn() }}">
                    <button class="companybtn">{{ $data->statusbtn() }}</button></a>
                @endif
                @if(in_array($data->status,[5,10]))
                <a id="finish" title="{{ $data->statusbtn() }}">
                    <button class="companybtn">完成订单</button></a>
                @endif
                <a id="false" title="{{ $data->statusbtn() }}失败">
                    <button class="companybtn">订单失败</button></a>
            </td></tr>
    </table>
    <input type="hidden" name="id" value="{{ $data->id }}">
    <input type="hidden" name="status" value="{{ $data->status }}">

    <script>
        $(document).ready(function(){
            var id = $("input[name='id']").val();
            //订单流程：创意、分镜、视频
            var status = $("input[name='status']").val();
            $("#tostatus").click(function(){
                if (status==1) {
                    window.location.href = "/member/order/"+id+"/status/"+2;
                } else if (status==2) {
                    var ideaMoney = $("input[name='ideaMoney']").val();
                    if(ideaMoney==''){ alert("创意价格必填！"); return; }
                    window.location.href = "/member/order/"+id+"/idea/"+ideaMoney;
                }
            });
            //订单完成
            $("#finish").click(function(){
                window.location.href = "/member/order/"+id+"/status/"+20;
            });
            //订单成功
            $("#true").click(function(){
                window.location.href = "/member/order/"+id+"/status/"+20;
            });
            //订单失败
            $("#false").click(function(){
                var ideaMoney = $("input[name='ideaMoney']").val();
                var storyMoney = $("input[name='storyMoney']").val();
                var realMoney1 = $("input[name='realMoney1']").val();
                var realMoney2 = $("input[name='realMoney2']").val();
                var realMoney3 = $("input[name='realMoney3']").val();
                var realMoney4 = $("input[name='realMoney4']").val();
                if (ideaMoney || storyMoney || realMoney1 || realMoney2 || realMoney3 || realMoney4) {
                    alert("对不起，已产生交易价格，不能取消订单！"); return;
                }
                window.location.href = "/member/order/"+id+"/status/"+21;
            });

            $("#status1").mouseover(function(){ $("#statustext1").show(); }).mouseout(function(){ $("#statustext1").hide(); });
            $("#status2").mouseover(function(){ $("#statustext2").show(); }).mouseout(function(){ $("#statustext2").hide(); });
            $("#status3").mouseover(function(){ $("#statustext3").show(); }).mouseout(function(){ $("#statustext3").hide(); });
            $("#status4").mouseover(function(){ $("#statustext4").show(); }).mouseout(function(){ $("#statustext4").hide(); });
            $("#status5").mouseover(function(){ $("#statustext5").show(); }).mouseout(function(){ $("#statustext5").hide(); });
            $("#status6").mouseover(function(){ $("#statustext6").show(); }).mouseout(function(){ $("#statustext6").hide(); });
            $("#status7").mouseover(function(){ $("#statustext7").show(); }).mouseout(function(){ $("#statustext7").hide(); });
            $("#status8").mouseover(function(){ $("#statustext8").show(); }).mouseout(function(){ $("#statustext8").hide(); });
        });
    </script>
@stop