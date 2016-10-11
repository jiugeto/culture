@extends('member.main')
@section('content')
    {{--@include('member.common.crumb')--}}
    <div class="mem_crumb">
        <a href="{{DOMAIN}}member">会员后台</a> / 会员福利
    </div>

    <h3 class="center">福利中心</h3>
    <table class="table_create table_show" cellspacing="0" cellpadding="0">
        <tr>
            <td class="field_name" width="200">签到奖励总数：</td>
            <td>{{ $data->sign }} 个
                <a href="{{DOMAIN}}person/sign" target="_blank" class="list_btn">去签到</a>
            </td>
        </tr>
        <tr>
            <td class="field_name" width="200">已兑换红包总额：</td>
            <td>{{ $data->tip }} 元 &nbsp;
                <a href="{{DOMAIN}}member/wallet/tip" target="_blank" class="list_btn">红包列表</a>
            </td>
        </tr>
        {{--<tr>--}}
            {{--<td class="field_name" style="width:100px;">金币总数：</td>--}}
            {{--<td>{{ $data->gold }} 个</td>--}}
        {{--</tr>--}}
        <tr>
            <td class="field_name">福利额度：</td>
            <td>{{ $data->weal }} 元
                <small style="color:lightgrey;font-size:12px;">(用于消费，不可套现)</small>
            </td>
        </tr>
        <tr>
            <td class="field_name">签到兑换福利：</td>
            <td width="500">
                <input type="text" style="width:100px" placeholder="30签到起" name="signToWeal">×30个签到
                <input type="hidden" name="sign" value="{{ $data->sign }}">
                <input type="hidden" name="signByWeal" value="{{ $data->signByWeal }}">
                &nbsp;&nbsp;
                <a class="list_btn" onclick="getBoonBySign()">确定兑换</a>
                <br><small style="color:lightgrey;font-size:12px;">(每30签到兑换1元福利，{{$data->sign}}个签到可兑换)</small>
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
        function getBoonBySign(){
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
    </script>
@stop

