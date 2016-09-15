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
            <td>{{ $data->statusName() }}</td>
        </tr>

    @if($data->status>1)
        @if(in_array($data->genre,[1,2]))
        <tr>
            <td class="field_name">创意交易价格：</td>
            <td class="statusbtn">
                @if($data->status==3 && $data->status<4)
                    @if($data->seller==$userid)
                        <input type="text" placeholder="0代表免费" pattern="^\d+$" name="money"> 元
                    @else <span class="star">双方实际定价中</span>
                    @endif
                @elseif($data->status>2 && $data->getMoney() && $data->status>=4)
                    {{ $data->getMoney() ? $data->getMoney().'元' : '免费' }}
                @endif
            </td>
        </tr>
        @elseif(in_array($data->genre,[3,4]))
        <tr>
            <td class="field_name">分镜交易价格：</td>
            <td class="statusbtn">
                @if($data->status==3 && $data->seller==$userid && $data->status<4)
                    <input type="text" placeholder="0代表免费" pattern="^\d+$" name="money"> 元
                    &nbsp;<a class="tshow" onclick="">价格确定</a>
                @elseif($data->status>2 && $data->getMoney() && $data->status>=4)
                    {{ $data->getMoney() ? $data->getMoney().'元' : '免费' }}
                @endif
            </td>
        </tr>
        @elseif(in_array($data->genre,[5,6]))
        <tr>
            <td class="field_name">分期首款：</td>
            <td class="statusbtn">
                @if($data->status==3 && $data->seller==$userid && $data->status<4)
                    <input type="text" placeholder="一期收费" pattern="^([1-9])|([1-9]\d+)$" required name="realMoney1"> 元 &nbsp;
                @elseif($data->status>2)
                    {{ $data->getMoney(0) }}元
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
                @if($data->status==4 && $data->seller==$userid && $data->status<4)
                    <input type="text" placeholder="二期收费" pattern="^([1-9])|([1-9]\d+)$" required name="realMoney2"> 元
                @elseif($data->status>4)
                    {{ $data->getMoney(1) }}元
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
                    {{ $data->getMoney(2) }}元
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
                    {{ $data->getMoney(3) }}元
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
            <td>{{ $data->getCreateTime() }}</td>
        </tr>
    @if(in_array($data->genre,[1,2,3,4]))
        <tr>
            <td class="field_name">更新时间：</td>
            <td>{{ $data->getCreateTime() }}</td>
        </tr>
    @elseif(in_array($data->genre,[5,6]))
        @if($data->status==2)
        <tr>
            <td class="field_name">首款时间：</td>
            <td>{{ $data->getCreateTime(0) }}</td>
        </tr>
        @elseif($data->status==4)
        <tr>
            <td class="field_name">二期付款时间：</td>
            <td>{{ $data->getCreateTime(1) }}</td>
        </tr>
        @elseif($data->status==6)
        <tr>
            <td class="field_name">三期付款时间：</td>
            <td>{{ $data->getCreateTime(2) }}</td>
        </tr>
        @elseif($data->status==7)
        <tr>
            <td class="field_name">尾款时间：</td>
            <td>{{ $data->getCreateTime(3) }}</td>
        </tr>
        @endif
    @endif
    </table>

    <p style="padding:0 20px;">
        <b>{{ $data->buyer==$userid ? '供应方' : '需求方' }}联系方式</b>：
        <a class="tshow" id="open" title="展开用户信息">[+]</a>
        <a class="tshow" id="close" style="display:none;" title="收起用户信息">[-]</a>
        <script>
            $(document).ready(function(){
                $("#open").click(function(){ $(this).toggle(); $("#close").toggle(); $("#userinfo").toggle(); });
                $("#close").click(function(){ $(this).toggle(); $("#open").toggle(); $("#userinfo").toggle(); });
            });
        </script>
    </p>
    <table class="table_create table_show" cellspacing="0" cellpadding="0" id="userinfo" style="display:none;">
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
        @if($userInfo->company($userInfo->id))
        <tr>
            <td class="field_name">需求方公司：</td>
            <td>{{ $userInfo->company($userInfo->id)->name }}</td>
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
                        <a class="tshow" id="status{{ $kstatus }}">
                            <div style="background:{{$data->status==$kstatus?'rgba(255,0,255,1)':'rgba(220,220,220,1)'}};"></div>
                            <span id="statustext{{ $kstatus }}" style="display:{{$data->status==$kstatus?'block':'none'}};">{{ $status }}</span>
                        </a>
                        @endforeach
                    @elseif(in_array($data->genre,[5,6]))
                        @foreach($model['status2s'] as $kstatus=>$status)
                        <a class="tshow" id="status2_{{ $kstatus }}">
                            <div style="background:{{$data->status==$kstatus?'rgba(255,0,255,1)':'rgba(220,220,220,1)'}};"></div>
                            <span id="statustext2_{{ $kstatus }}" style="display:{{$data->status==$kstatus?'block':'none'}};">{{ $status }}</span>
                        </a>
                        @endforeach
                    @elseif(in_array($data->genre,[6,7,8,9,10,11,12]))
                        @foreach($model['status3s'] as $kstatus=>$status)
                        <a class="tshow" id="status2_{{ $kstatus }}">
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
                @if($data->status==1)
                    <a class="tshow" id="sure" title="{{ $data->statusbtn() }}"><button class="companybtn">确认订单</button></a>
                    <a class="tshow" id="refuse" title="{{ $data->statusbtn() }}"><button class="companybtn">拒绝订单</button></a>
                @endif
                @if(in_array($data->genre,[1,2,3,4]))
                    @if(in_array($data->status,[2,4,5,6,7]))
                    <a class="tshow" id="tostatus" title="{{ $data->statusbtn() }}">
                        <button class="companybtn">
                            @if($data->status==2)提交价格
                            @elseif(in_array($data->status,[4,5]))办理订单
                            @elseif($data->status==6)确认收到
                            @elseif($data->status==7)订单成功
                            @endif
                        </button></a>
                    @endif
                @endif
                @if(in_array($data->status,[3,11]))
                    <a class="tshow" id="false" title="{{ $data->statusbtn() }}失败">
                        <button class="companybtn">订单失败</button></a>
                @elseif(in_array($data->status,[11]))
                    <a class="tshow" id="success" title="{{ $data->statusbtn() }}失败">
                        <button class="companybtn">订单成功</button></a>
                @elseif(in_array($data->status,[12,13]))
                    <a class="tshow" id="next"><button class="companybtn">继续流程</button></a>
                @endif
            </td></tr>
    </table>
    <input type="hidden" name="id" value="{{ $data->id }}">
    <input type="hidden" name="genre" value="{{ $data->genre }}">
    <input type="hidden" name="status" value="{{ $data->status }}">
    <input type="hidden" name="money" value="{{ $data->getMoney() }}">
    <input type="hidden" name="realMoney1" value="{{ $data->getMoney(0) }}">
    <input type="hidden" name="realMoney2" value="{{ $data->getMoney(1) }}">
    <input type="hidden" name="realMoney3" value="{{ $data->getMoney(2) }}">
    <input type="hidden" name="realMoney4" value="{{ $data->getMoney(3) }}">
    <input type="hidden" name="_token" value="{{csrf_token()}}">
    {{--弹出窗口--}}
    <div class="popup">
        @if(in_array($data->genre,[1,2]))
        <a class="tshow" href="/storyboard" id="story">分镜流程</a>
        @elseif(in_array($data->genre,[1,2,3,4]))
        <a class="tshow" href="/product" id="video">视频流程</a>
        @endif
        <a class="tshow close" onclick="$('.popup').hide();">X</a>
    </div>
    <div class="popup2">
        <textarea name="remarks" cols="35" rows="5"></textarea>
        <div id="torefuse">确定拒绝</div>
        <a class="tshow close" onclick="$('.popup').hide();">X</a>
    </div>

    <script>
        $(document).ready(function(){
            var id = $("input[name='id']").val();
            var genre = $("input[name='genre']").val();
            var status = $("input[name='status']").val();
            var remarks = $("textarea[name='remarks']");
            //确定价格，再异步调用二维码支付
            //订单流程：创意、分镜、视频
            $.ajaxSetup({headers : {'X-CSRF-TOKEN':$('input[name="_token"]').val()}});
                //确认、拒绝订单
            $("#sure").click(function(){ checkAjax(1); });
            $("#refuse").click(function(){ $(".popup2").show(); });
            $("#torefuse").click(function(){ checkAjax(0); });
            function checkAjax(tosure){
                $.ajax({
                    type: 'POST',
                    url: '/member/order/tosure',
                    data: {'id':id,'tosure':tosure,'remarks':remarks.val()},
                    dataType: 'json',
                    success: function(data) {
                        if (data.message<0) { alert(data.message); }
                        else { window.location.href = "{{DOMAIN}}member/order/"+id; }
                    }
                });
            }
                //走流程
            $("#tostatus").click(function(){
                if (status==2 && genre <= 4) {
                    var money = $("input[name='money']").val();
                    var genreName =''; var genreUrl = '';
                    if(genre==1 || genre==2){
                        genreName = '创意'; genreUrl = 'idea';
                    } else if(genre==3 || genre==4){
                        genreName = '分镜'; genreUrl = 'story';
                    }
//                    alert(money);return;
                    if(money==''){ alert(genreName+"价格必填！"); return; }
                    window.location.href = "{{DOMAIN}}member/order/"+id+"/"+genreUrl+"/"+money;
                } else if (status==4 || status==5 || status==6 || status==7 || status==12) {
                    window.location.href = "{{DOMAIN}}member/order/"+id+"/"+status;
                }
            });
                //订单成功
            $("#true").click(function(){
                window.location.href = "{{DOMAIN}}member/order/"+id+"/"+12;
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
                window.location.href = "{{DOMAIN}}member/order/"+id+"/"+13;
            });
                //订单下一步：弹窗
            $("#next").click(function(){
                $(".popup").show(); $("#story").show(); $("#video").show();
//                window.location.href = "{{DOMAIN}}member/order/"+id+"/next/"+1;
            });
            $(".close").click(function(){ $(".popup").hide(); $(".popup2").hide(); });

            //订单流程线
            $("#status1").mouseover(function(){ $("#statustext1").show(); }).mouseout(function(){ $("#statustext1").hide(); });
            $("#status2").mouseover(function(){ $("#statustext2").show(); }).mouseout(function(){ $("#statustext2").hide(); });
            $("#status3").mouseover(function(){ $("#statustext3").show(); }).mouseout(function(){ $("#statustext3").hide(); });
            $("#status4").mouseover(function(){ $("#statustext4").show(); }).mouseout(function(){ $("#statustext4").hide(); });
            $("#status5").mouseover(function(){ $("#statustext5").show(); }).mouseout(function(){ $("#statustext5").hide(); });
            $("#status6").mouseover(function(){ $("#statustext6").show(); }).mouseout(function(){ $("#statustext6").hide(); });
            $("#status7").mouseover(function(){ $("#statustext7").show(); }).mouseout(function(){ $("#statustext7").hide(); });
            $("#status12").mouseover(function(){ $("#statustext12").show(); }).mouseout(function(){ $("#statustext12").hide(); });
            $("#status13").mouseover(function(){ $("#statustext13").show(); }).mouseout(function(){ $("#statustext13").hide(); });
        });
    </script>
@stop