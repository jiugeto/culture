@extends('member.main')
@section('content')
    {{--@include('member.common.crumb')--}}
    <div class="mem_crumb">
        <a href="{{DOMAIN}}member">会员后台</a> / 会员福利
    </div>

    <h3 class="center">福利中心</h3>
    <table class="table_create table_show" cellspacing="0" cellpadding="0">
        @if(!$data->ispay())
        <tr>
            <td class="field_name" width="200">新用户福利：</td>
            <td>
                <a href="{{DOMAIN}}member/wallet/gettip/1/200" class="list_btn">未领取？去签到</a>
            </td>
        </tr>
        @endif
        <tr>
            <td class="field_name" width="200">签到奖励总数：</td>
            <td>{{ $data->sign }} 个 &nbsp;
                <a href="{{DOMAIN}}person/sign" target="_blank" class="list_btn">去领取</a>
            </td>
        </tr>
        <tr>
            <td class="field_name" style="width:100px;">金币总数：</td>
            <td>{{ $data->gold }} 个 &nbsp;
                <a href="{{DOMAIN}}member/gold" target="_blank" class="list_btn">金币列表</a>
            </td>
        </tr>
        <tr>
            <td class="field_name" width="200">红包总额：</td>
            <td>{{ $data->tip }} 元 &nbsp;
                <a href="{{DOMAIN}}member/tip" target="_blank" class="list_btn">红包列表</a>
            </td>
        </tr>
        <tr>
            <td class="field_name">福利额度：</td>
            <td>{{ $data->weal }} 元
                <small style="color:lightgrey;font-size:12px;">(用于消费，不可套现)</small>
            </td>
        </tr>
        <tr>
            <td class="field_name">签到兑换福利：</td>
            <td width="500">
                <input type="text" style="width:100px" placeholder="{{$data->sign}}签到起" name="signToWeal">×{{$data->signByWeal}}个签到
                <input type="hidden" name="sign" value="{{ $data->sign }}">
                <input type="hidden" name="signByWeal" value="{{ $data->signByWeal }}">
                &nbsp;&nbsp;
                <a class="list_btn" onclick="getWealBySign()">确定兑换</a>
                <br><small style="color:lightgrey;font-size:12px;">(每{{$data->signByWeal}}签到兑换1元福利，{{$data->sign}}个签到可兑换)</small>
            </td>
        </tr>
        <tr>
            <td class="field_name">金币兑换福利：</td>
            <td width="500">
                <input type="text" style="width:100px" placeholder="{{$data->gold}}金币起" name="goldToWeal">×{{$data->goldByWeal}}个签到
                <input type="hidden" name="gold" value="{{ $data->gold }}">
                <input type="hidden" name="goldByWeal" value="{{ $data->goldByWeal }}">
                &nbsp;&nbsp;
                <a class="list_btn" onclick="getWealByGold()">确定兑换</a>
                <br><small style="color:lightgrey;font-size:12px;">(每{{$data->goldByWeal}}签到兑换1元福利，{{$data->gold}}个金币可兑换)</small>
            </td>
        </tr>
        <tr>
            <td class="field_name">红包兑换福利：</td>
            <td width="500">
                <input type="text" style="width:100px" placeholder="{{$data->tip}}金币起" name="goldToWeal">×{{$data->tipByWeal}}个签到
                <input type="hidden" name="tip" value="{{ $data->tip }}">
                <input type="hidden" name="tipByWeal" value="{{ $data->tipByWeal }}">
                &nbsp;&nbsp;
                <a class="list_btn" onclick="getWealByTip()">确定兑换</a>
                <br><small style="color:lightgrey;font-size:12px;">(每{{$data->tipByWeal}}签到兑换1元福利，{{$data->tip}}个金币可兑换)</small>
            </td>
        </tr>
        <tr>
            <td class="field_name">创建时间：</td>
            <td>{{ $data->createTime() }}</td>
        </tr>
        <tr>
            <td class="field_name">更新时间：</td>
            <td>{{ $data->updateTime() }}</td>
        </tr>
        {{--<tr><td class="center" colspan="2" style="border:0;cursor:pointer;">--}}
                {{--<a class="list_btn" onclick="history.go(-1)">返回</a>--}}
                {{--<button class="companybtn" onclick="history.go(-1)">返 &nbsp;回</button>--}}
            {{--</td></tr>--}}
    </table>

    <script>
        function getWealBySign(){
            var sign = $("input[name='sign']").val();
            var signToWeal = $("input[name='signToWeal']").val();
            var signByWeal = $("input[name='signByWeal']").val();
            var signCount = signToWeal*signByWeal;
            if (signToWeal=='') {
                alert('兑换的签到数字必填！');return;
            } else if (signCount>sign) {
                alert('签到数量不足！');return;
            }
            window.location.href = '{{DOMAIN}}member/wallet/signtoweal/'+signCount;
        }
        function getWealByGold(){
            var gold = $("input[name='gold']").val();
            var goldToWeal = $("input[name='goldToWeal']").val();
            var goldByWeal = $("input[name='goldByWeal']").val();
            var goldCount = goldToWeal*goldByWeal;
            if (goldToWeal=='') {
                alert('兑换的金币数字必填！');return;
            } else if (goldCount>gold) {
                alert('金币数量不足！');return;
            }
            window.location.href = '{{DOMAIN}}member/wallet/goldtoweal/'+goldCount;
        }
        function getWealByTip(){
            var tip = $("input[name='tip']").val();
            var tipToWeal = $("input[name='tipdToWeal']").val();
            var tipByWeal = $("input[name='tipByWeal']").val();
            var tipCount = tipToWeal*tipByWeal;
            if (tipToWeal=='') {
                alert('兑换的红包数字必填！');return;
            } else if (tipCount>tip) {
                alert('红包数量不足！');return;
            }
            window.location.href = '{{DOMAIN}}member/wallet/tiptoweal/'+tipCount;
        }
    </script>
@stop

