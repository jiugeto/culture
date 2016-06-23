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
                {{--&nbsp;&nbsp;<a href="/member/idea/{{ $data->fromid }}" target="_blank">查看创意</a>--}}
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
                {{--&nbsp;&nbsp;<a href="/member/storyboard/{{ $data->fromid }}" target="_blank">查看分镜</a>--}}
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
    @if(in_array($data->genre,[1,2,3,4]))
        <tr>
            <td class="field_name">更新时间：</td>
            <td>{{ $data->updated_at=='0000-00-00 00:00:00' ? '未更新' : $data->updated_at }}</td>
        </tr>
    @elseif(in_array($data->genre,[5,6]))
        @if($data->status==2)
        <tr>
            <td class="field_name">首款时间：</td>
            <td>{{ $data->realMoney1=='0000-00-00 00:00:00' ? '未更新' : $data->realMoney1 }}</td>
        </tr>
        @elseif($data->status==4)
        <tr>
            <td class="field_name">二期付款时间：</td>
            <td>{{ $data->realMoney2=='0000-00-00 00:00:00' ? '未更新' : $data->realMoney2 }}</td>
        </tr>
        @elseif($data->status==6)
        <tr>
            <td class="field_name">三期付款时间：</td>
            <td>{{ $data->realMoney3=='0000-00-00 00:00:00' ? '未更新' : $data->realMoney3 }}</td>
        </tr>
        @elseif($data->status==7)
        <tr>
            <td class="field_name">尾款时间：</td>
            <td>{{ $data->realMoney4=='0000-00-00 00:00:00' ? '未更新' : $data->realMoney4 }}</td>
        </tr>
        @endif
    @endif
    </table>

    <table class="table_create table_show" cellspacing="0" cellpadding="0">
        <tr><td colspan="2"><b>{{ $data->buyer==$userid ? '供应方' : '需求方' }}联系方式</b>：</td></tr>
        <tr>
            <td class="field_name">供应方名称：</td>
            <td>{{ $userInfo->username }}</td>
        </tr>
        <tr>
            <td class="field_name">联系方式：</td>
            <td>{{ $userInfo->mobile }}</td>
        </tr>
        <tr>
            <td class="field_name">QQ：</td>
            <td>{{ $userInfo->qq }}</td>
        </tr>
        <tr>
            <td class="field_name">地址：</td>
            <td>{{ $userInfo->address }}</td>
        </tr>
        @if($userInfo->company)
        <tr>
            <td class="field_name">需求方公司：</td>
            <td>{{ $userInfo->company->name }}</td>
        </tr>
        @endif
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
                        <a id="status{{ $kstatus }}">
                            <div style="background:{{$data->status==$kstatus?'rgba(255,0,255,1)':'rgba(220,220,220,1)'}};"></div>
                            <span id="statustext{{ $kstatus }}" style="display:{{$data->status==$kstatus?'block':'none'}};">{{ $status }}</span>
                        </a>
                        @endforeach
                    @elseif(in_array($data->genre,[5,6]))
                        @foreach($model['status2s'] as $kstatus=>$status)
                        <a id="status2_{{ $kstatus }}">
                            <div style="background:{{$data->status==$kstatus?'rgba(255,0,255,1)':'rgba(220,220,220,1)'}};"></div>
                            <span id="statustext2_{{ $kstatus }}" style="display:{{$data->status==$kstatus?'block':'none'}};">{{ $status }}</span>
                        </a>
                        @endforeach
                    @elseif(in_array($data->genre,[6,7,8,9,10,11,12]))
                        @foreach($model['status3s'] as $kstatus=>$status)
                        <a id="status2_{{ $kstatus }}">
                            <div style="background:{{$data->status==$kstatus?'rgba(255,0,255,1)':'rgba(220,220,220,1)'}};"></div>
                            <span id="statustext3_{{ $kstatus }}" style="display:{{$data->status==$kstatus?'block':'none'}};">{{ $status }}</span>
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
                    @if($data->status<=6)
                <a id="tostatus" title="{{ $data->statusbtn() }}">
                    <button class="companybtn">
                        @if($data->status==2)提交价格
                        @elseif(in_array($data->status,[3,4]))办理订单
                        @elseif($data->status==5)确认收到
                        @elseif($data->status==6)订单成功
                        @endif
                    </button></a>
                    @endif
                @endif
                @if($data->status<=6)
                <a id="false" title="{{ $data->statusbtn() }}失败">
                    <button class="companybtn">订单失败</button></a>
                @elseif($data->status==11)
                <a id="next"><button class="companybtn">继续流程</button></a>
                @endif
            </td></tr>
    </table>
    <input type="hidden" name="id" value="{{ $data->id }}">
    <input type="hidden" name="genre" value="{{ $data->genre }}">
    <input type="hidden" name="status" value="{{ $data->status }}">
    <input type="hidden" name="money" value="{{ $data->money }}">
    <input type="hidden" name="realMoney1" value="{{ $data->realMoney1 }}">
    <input type="hidden" name="realMoney2" value="{{ $data->realMoney2 }}">
    <input type="hidden" name="realMoney3" value="{{ $data->realMoney3 }}">
    <input type="hidden" name="realMoney4" value="{{ $data->realMoney4 }}">
    {{--弹出窗口--}}
    <div class="popup">
        <a href="" id="story">分镜流程</a>
        <a href="" id="video">视频流程</a>
        <a class="close" onclick="$('.popup').hide();">X</a>
    </div>

    <script>
        $(document).ready(function(){
            var id = $("input[name='id']").val();
            var genre = $("input[name='genre']").val();
            var status = $("input[name='status']").val();
            //订单流程：创意、分镜、视频
            $("#tostatus").click(function(){
                if (status==1 || status==3 || status==4 || status==5 || status==6) {
                    window.location.href = "/member/order/"+id+"/"+status;
                } else if (status==2) {
                    var money = $("input[name='money']").val();
                    if(genre==1 || genre==2){
                        genreName = '创意'; genreUrl = 'idea';
                    } else if(genre==3 || genre==4){
                        genreName = '分镜'; genreUrl = 'story';
                    }
                    if(money==''){
                        var genreName =''; var genreUrl = '';
                        alert(genreName+"价格必填！"); return;
                    }
                    window.location.href = "/member/order/"+id+"/"+genreUrl+"/"+money;
                }
            });
            //订单成功
            $("#true").click(function(){
                window.location.href = "/member/order/"+id+"/"+11;
            });
            //订单失败
            $("#false").click(function(){
                var money = $("input[name='money']").val();
                var realMoney1 = $("input[name='realMoney1']").val();
                var realMoney2 = $("input[name='realMoney2']").val();
                var realMoney3 = $("input[name='realMoney3']").val();
                var realMoney4 = $("input[name='realMoney4']").val();
                if (money || realMoney1 || realMoney2 || realMoney3 || realMoney4) {
                    alert("对不起，已产生交易价格，不能取消订单！"); return;
                }
                window.location.href = "/member/order/"+id+"/"+12;
            });
            //订单下一步：弹窗
            $("#next").click(function(){
                $(".popup").show(); $("#story").show(); $("#video").show();
//                window.location.href = "/member/order/"+id+"/next/"+1;
            });
            $(".close").click(function(){ $("popup").hide(); });

            //订单流程线
            $("#status1").mouseover(function(){ $("#statustext1").show(); }).mouseout(function(){ $("#statustext1").hide(); });
            $("#status2").mouseover(function(){ $("#statustext2").show(); }).mouseout(function(){ $("#statustext2").hide(); });
            $("#status3").mouseover(function(){ $("#statustext3").show(); }).mouseout(function(){ $("#statustext3").hide(); });
            $("#status4").mouseover(function(){ $("#statustext4").show(); }).mouseout(function(){ $("#statustext4").hide(); });
            $("#status5").mouseover(function(){ $("#statustext5").show(); }).mouseout(function(){ $("#statustext5").hide(); });
            $("#status6").mouseover(function(){ $("#statustext6").show(); }).mouseout(function(){ $("#statustext6").hide(); });
            $("#status11").mouseover(function(){ $("#statustext11").show(); }).mouseout(function(){ $("#statustext11").hide(); });
            $("#status12").mouseover(function(){ $("#statustext12").show(); }).mouseout(function(){ $("#statustext12").hide(); });
        });
    </script>
@stop