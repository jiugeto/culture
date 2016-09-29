@extends('online.main')
@section('content')
    {{--  在线创建窗口 --}}
    <div class="online_win">
        <div class="frame_title">
            <span class="left" onclick="back()"><b>返回大厅</b></span>
            {{--{{$data->uid?'我的动画':'动画大厅'}} - --}}{{$data->name}}
            @if(Session::has('user') && Session::get('user.uid')==$data->uid)
            <span class="right" onclick="myworks()"><b>我的作品</b></span>
            @endif
        </div>
        <iframe src="{{DOMAIN}}online/pro/play/{{$data->id}}" frameborder="0" width="720" height="438" scrolling="no" allowtransparency="true"></iframe>

        <a class="getpro">
            @if (!$data->uid)
            <div class="frame_title" onclick="getProduct({{$data->id}})">获 取</div>
            @else
            <div class="frame_title" onclick="editProduct({{$data->id}})">编 辑</div>
            @endif
        </a>

        @if(Session::has('user') && Session::get('user.uid')==$data->uid)
        <div class="render">
            <div class="title">渲染设置</div>
            <div class="con"><span style="font-size:12px;">注意：这里统一16/9格式</span></div>
            <form action="">
                <table>
                    <tr>
                        <td width="100">记录修改：</td>
                        <td width="200">0个</td>
                        <td>修改计价：<span id="editMoney"></span></td>
                    </tr>
                    <tr>
                        <td>输出格式：</td>
                        <td>
                            <select name="format" style="width:150px;">
                                @foreach($orderProModel['formatNames'] as $kformat=>$formatName)
                                    <option value="{{ $kformat }}">{{ $formatName }}</option>
                                @endforeach
                            </select>
                        </td>
                        <td>渲染计价：<span id="renderMoney">{{$orderProModel['formatMoneys'][1]}}</span> 元</td>
                    </tr>
                    {{--<tr>--}}
                        {{--<td>背景音乐：</td>--}}
                        {{--<td>--}}
                            {{--<label><input type="radio" class="radio" name="isbgsound" value="0">去掉&nbsp;</label>--}}
                            {{--<label><input type="radio" class="radio" name="isbgsound" value="1" checked>加上&nbsp;</label>--}}
                        {{--</td>--}}
                        {{--<td>背景音计价：<span id="soundMoney">0</span> 元</td>--}}
                    {{--</tr>--}}
                    <tr>
                        <td>总价计算：</td>
                        <td colspan="2">修改总价格+渲染价格=<span id="orderProMoney">{{$orderProModel['formatMoneys'][1]}}</span> 元</td>
                        <td>支付二维码：<img src=""> </td>
                    </tr>
                    <tr>
                        <td colspan="3">
                            <button type="submit" class="submit">确定下单</button>
                        </td>
                    </tr>
                </table>
            </form>
        </div>
        @endif
    </div>
    <input type="hidden" name="uid" value="{{ Session::has('user')?Session::get('user.uid'):0 }}">
    <input type="hidden" name="productid" value="{{$data->id}}">

    <script>
        function back(){ window.location.href = '{{DOMAIN}}online'; }
        function myworks(){
            var productid = $("input[name='productid']").val();
            window.location.href = '{{DOMAIN}}online/u/product';
        }
        function getProduct(id){
            var uid = $("input[name='uid']").val();
            if (uid==0) {
                alert('你还没有登录！');
                window.location.href = '{{DOMAIN}}login';
            } else {
                window.location.href = '{{DOMAIN}}online/u/product/getpro/'+id;
            }
        }
        function editProduct(id){ window.location.href = '{{DOMAIN}}online/u/'+id+'/frame'; }
    </script>
@stop