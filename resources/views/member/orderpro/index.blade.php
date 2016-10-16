@extends('member.main')
@section('content')
    @include('member.common.crumb')
    {{--<div class="mem_tab">@include('member.common.lists')</div>--}}
    <div class="hr_tab"></div>
    <!-- 空白 -->
    <div class="list_kongbai">&nbsp;</div>
    <div class="list">
        <table class="list_tab">
            <tr>
                {{--<td>编号</td>--}}
                <td>订单名称</td>
                <td>类型</td>
                {{--<td>发布方</td>--}}
                <td width="60">总价格</td>
                <td>福利</td>
                <td>需支付(元)</td>
                <td>状态</td>
                {{--<td>支付码</td>--}}
                <td width="80">创建时间</td>
                <td width="150">操作</td>
            </tr>
        @if($datas->total())
            @foreach($datas as $data)
            <tr>
                {{--<td>{{ $data->id }}</td>--}}
                <td><a href="{{DOMAIN}}member/{{$data->genre==1?'product':'proVideo'}}/{{$data->productid}}"
                       title="查看该产品信息" target="_blank" style="color:rgb(14,144,210);">
                        {{ $data->getProductName() }}</a>
                </td>
                <td>{{ $data->getGenreName() }}</td>
                {{--<td>{{ $data->getSellerName() }}</td>--}}
                <td>
                    @if($data->status==1) <span style="color:orangered;">? 待定价</span>
                    @elseif($data->status>1) {{ $data->getMoney() }}
                    @endif
                    </td>
                <td>{{ $data->getWeal() }}</td>
                <td>{{ $data->getRealmoney() }} <br>
                    @if($data->status==2) <span style="color:orangered;">? 未付款</span>
                    @elseif($data->status==3) <span style="color:red;">× 付错款</span>
                    @elseif($data->status>3) <span style="color:green;">√ 已付款</span>
                    @endif
                    </td>
                {{--<td></td>--}}
                <td>{{ $data->getStatusName() }}</td>
                <td style="font-size:12px;">{{ date('Y年m月d日',$data->created_at) }}</td>
                <td>
                    <a href="{{DOMAIN}}member/orderpro/{{ $data->id }}" class="list_btn">查看</a>
                    @if($data->status<=2)
                    <a href="{{DOMAIN}}member/orderpro/{{ $data->id }}/destroy" class="list_btn">删除</a>
                    @endif
                    @if(in_array($data->status,[2,3]))
                    <div style="height:10px;"></div>
                    <a onclick="$('.popup3').show();$('.popup_bg').show();" class="list_btn">支付码</a>
                    @endif
                </td>
            </tr>
            @endforeach
        @else @include('member.common.norecord')
        @endif
        </table>
        <p>注意：总价格 = 渲染价格 + 修改价格，下单-》定价-》付款-》制作-》成交-》评价-》本站返利</p>
        @include('member.common.page')
    </div>
    {{--支付的二维码--}}
    @if($data->uid==Session::get('user.uid'))
        <div class="popup_bg">&nbsp;</div>
        <div class="popup3" style="width:400px;height:400px;display:none;">
            <img src="{{PUB}}assets-home/images/cul_paycode.png">
            <p style="margin:0;text-align:center;">斯塔克(科幻-视觉控)</p>
            <div class="close">确 定</div>
            <a class="tshow close" onclick="$('.popup').hide();">X</a>
        </div>
        <script>
            $(".close").click(function(){
                $(".popup_bg").hide(); $(".popup3").hide();
            });
        </script>
    @endif
@stop