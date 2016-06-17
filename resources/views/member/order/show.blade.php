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
        @if($data->status==2)
        <tr>
            <td class="field_name">创意价格：</td>
            <td>@if($data->status>2 && $data->ideaMoney)
                    {{ $data->ideaMoney ? $data->ideaMoney.'元' : '免费' }}
                @elseif($data->status==2 && $data->seller==$userid)
                    <input type="text" style="padding:0 10px;" placeholder="确定价格，0代表免费" pattern="^\d+$" name="ideaMoney"> 元
                @endif
            </td>
        </tr>
        @endif
        @if($data->status==5)
        <tr>
            <td class="field_name">分镜价格：</td>
            <td>{{ $data->storyMoney ? $data->storyMoney.'元' : '免费' }}</td>
        </tr>
        @endif
        @if($data->realMoney1)
        <tr>
            <td class="field_name">分期首款：</td>
            <td>{{ $data->realMoney1 }}元</td>
        </tr>
        <tr>
            <td class="field_name">二期付款：</td>
            <td>{{ $data->realMoney2 }}元</td>
        </tr>
        <tr>
            <td class="field_name">三期付款：</td>
            <td>{{ $data->realMoney3 }}元</td>
        </tr>
        <tr>
            <td class="field_name">分期尾款：</td>
            <td>{{ $data->realMoney4 }}元</td>
        </tr>
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
                <div class="title">订单状态线：</div>
                <div class="con">
                    <div class="pos">
                        @if($data->genre<7)
                        @foreach($model['statuss'] as $kstatus=>$status)
                            @if($kstatus>11)
                            <a id="status{{ $kstatus-1 }}">
                                <div style="background:{{$data->status==$kstatus?'rgba(255,0,255,1)':'rgba(220,220,220,1)'}};"></div>
                                <span id="statustext{{ $kstatus-1 }}" style="display:{{$data->status==$kstatus?'block':'none'}};">{{ $status }}</span>
                            </a>
                            @elseif($kstatus<11)
                            <a id="status{{ $kstatus }}">
                                <div style="background:{{$data->status==$kstatus?'rgba(255,0,255,1)':'rgba(220,220,220,1)'}};"></div>
                                <span id="statustext{{ $kstatus }}" style="display:{{$data->status==$kstatus?'block':'none'}};">{{ $status }}</span>
                            </a>
                            @endif
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
                @if($data->status<6)
                <a id="tostatus" title="{{ $data->statusbtn() }}">
                    <button class="companybtn">
                        @if($data->status==1) 确定创意
                        @elseif($data->status==2) 交易创意
                        @elseif(in_array($data->status,[3,4])) 创意完成
                        @elseif($data->status==5) 交易分镜
                        @endif
                    </button></a>
                @endif
                @if(in_array($data->status,[5,10]))
                <a id="finish" title="{{ $data->statusbtn() }}">
                    <button class="companybtn">完成订单</button></a>
                @endif
            </td></tr>
    </table>
    <input type="hidden" name="id" value="{{ $data->id }}">
    <input type="hidden" name="status" value="{{ $data->status+1 }}">

    <script>
        $(document).ready(function(){
            var id = $("input[name='id']").val();
            $("input[name='ideaMoney']").change(function(){
                if($(this).val()==''){ alert("创意价格不能必填！"); return; }
                window.location.href = "/member/order/"+id+"/idea/"+$(this).val();
            });

            var status = $("input[name='status']").val();
            $("#tostatus").click(function(){
                if (status==2) {
                    var money = $("input[name='ideaMoney']").val();
                    if(money==''){ alert("创意价格不能必填！"); return; }
                    window.location.href = "/member/order/"+id+"/idea/"+money;
                } else if ($.inArray(status,[4,5])) {
                    window.location.href = "/member/order/"+id+"/status/"+5;
                } else if (status==6) {
                    window.location.href = "/member/order/"+id+"/status/"+6;
                }
            });
            $("#finish").click(function(){
                window.location.href = "/member/order/"+id+"/status/"+20;
            });

            $("#status1").mouseover(function(){ $("#statustext1").show(); }).mouseout(function(){ $("#statustext1").hide(); });
            $("#status2").mouseover(function(){ $("#statustext2").show(); }).mouseout(function(){ $("#statustext2").hide(); });
            $("#status3").mouseover(function(){ $("#statustext3").show(); }).mouseout(function(){ $("#statustext3").hide(); });
            $("#status4").mouseover(function(){ $("#statustext4").show(); }).mouseout(function(){ $("#statustext4").hide(); });
            $("#status5").mouseover(function(){ $("#statustext5").show(); }).mouseout(function(){ $("#statustext5").hide(); });
            $("#status6").mouseover(function(){ $("#statustext6").show(); }).mouseout(function(){ $("#statustext6").hide(); });
            $("#status7").mouseover(function(){ $("#statustext7").show(); }).mouseout(function(){ $("#statustext7").hide(); });
            $("#status8").mouseover(function(){ $("#statustext8").show(); }).mouseout(function(){ $("#statustext8").hide(); });
            $("#status9").mouseover(function(){ $("#statustext9").show(); }).mouseout(function(){ $("#statustext9").hide(); });
            $("#status10").mouseover(function(){ $("#statustext10").show(); }).mouseout(function(){ $("#statustext10").hide(); });
            $("#status11").mouseover(function(){ $("#statustext11").show(); }).mouseout(function(){ $("#statustext11").hide(); });
            $("#status12").mouseover(function(){ $("#statustext12").show(); }).mouseout(function(){ $("#statustext12").hide(); });
            $("#status13").mouseover(function(){ $("#statustext13").show(); }).mouseout(function(){ $("#statustext13").hide(); });
            $("#status14").mouseover(function(){ $("#statustext14").show(); }).mouseout(function(){ $("#statustext14").hide(); });
            $("#status15").mouseover(function(){ $("#statustext15").show(); }).mouseout(function(){ $("#statustext15").hide(); });
            $("#status16").mouseover(function(){ $("#statustext16").show(); }).mouseout(function(){ $("#statustext16").hide(); });
            $("#status17").mouseover(function(){ $("#statustext17").show(); }).mouseout(function(){ $("#statustext17").hide(); });
            $("#status18").mouseover(function(){ $("#statustext18").show(); }).mouseout(function(){ $("#statustext18").hide(); });
            $("#status19").mouseover(function(){ $("#statustext19").show(); }).mouseout(function(){ $("#statustext19").hide(); });
            $("#status20").mouseover(function(){ $("#statustext20").show(); }).mouseout(function(){ $("#statustext20").hide(); });
        });
    </script>
@stop

