{{--这里是渲染设置模板--}}


<div class="render">
    <div class="title">渲染设置</div>
    <div class="con"><span style="font-size:12px;">注意：这里统一16/9格式</span></div>
    <form action="">
        <table>
            <tr>
                <td width="100">记录修改：</td>
                <td width="300">
                    动画设置：<span class="red">
                        @if(count($data->getProLayers()['records']) && $records=$data->getProLayers()['records'])
                            {{ count($records) }}
                        @else 0
                        @endif </span>个
                    &nbsp;&nbsp;
                    产品样式：<span class="red">
                        @if(count($data->getProAttrs()) && $records=$data->getProAttrs())
                            {{ count($records) }}
                        @else 0
                        @endif </span>个
                    <br>
                    产品内容：<span class="red">
                        @if(count($data->getProCons()) && $records=$data->getProCons())
                            {{ count($records) }}
                        @else 0
                        @endif </span>个
                    &nbsp;&nbsp;
                    关键帧：<span class="red">
                        @if(count($data->getProLayerAttrs()) && $records=$data->getProLayerAttrs())
                            {{ count($records) }}
                        @else 0
                        @endif </span>个
                </td>
                <td>修改计价：<span id="editMoney" class="red">
                                {{ (count($data->getProLayers()['records'])+count($data->getProAttrs())+count($data->getProCons())+count($data->getProLayerAttrs()))*$data->editMoney }}
                            </span> 元 ({{$data->editMoney}}元/个)</td>
            </tr>
            <tr>
                <td width="100">记录添加：</td>
                <td width="300">
                    动画设置：<span class="red">
                        @if(count($data->getProLayers()['adds']) && $adds=$data->getProLayers()['adds'])
                            {{ count($adds) }}
                        @else 0
                        @endif </span>个
                    &nbsp;&nbsp;
                    产品内容：<span class="red">
                        @if(count($data->getProCons()['adds']) && $conAdds=$data->getProCons()['adds'])
                            {{ count($adds) }}
                        @else 0
                        @endif </span>个
                    <br>
                    关键帧：<span class="red">
                        @if(count($data->getProLayerAttrs()['adds']) && $adds=$data->getProLayerAttrs()['adds'])
                            {{ count($adds) }}
                        @else 0
                        @endif </span>个
                </td>
                <td>添加计价：<span id="addMoney" class="red">
                                {{ (count($data->getProLayers()['adds'])+count($data->getProCons()['adds'])+count($data->getProLayerAttrs()['adds']))*$data->addMoney }}
                            </span> 元 ({{$data->addMoney}}元/个)</td>
            </tr>
            <tr>
                <td>输出格式：</td>
                <td>
                    <select name="format" style="width:150px;">
                        @foreach($orderProModel['formatNames'] as $kformat=>$formatName)
                            <option value="{{ $orderProModel['formatMoneys'][$kformat] }}">{{ $formatName }}</option>
                        @endforeach
                    </select>
                </td>
                <td>渲染计价：<span id="renderMoney" class="red">{{$orderProModel['formatMoneys'][1]}}</span> 元</td>
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
                <td colspan="2">修改总价+添加总价+渲染价格=
                    <span id="orderProMoney" class="red orderProMoney">{{ (count($data->getProLayers()['records'])+count($data->getProAttrs())+count($data->getProCons())+count($data->getProLayerAttrs()))*$data->editMoney + (count($data->getProLayers()['adds'])+count($data->getProCons()['adds'])+count($data->getProLayerAttrs()['adds']))*$data->addMoney + $orderProModel['formatMoneys'][1] }}</span> 元
                    <span style="font-size:12px">(用于支付的价格)</span>
                </td>
            </tr>
            <tr>
                <td>支付二维码：</td>
                <td><img src="{{PUB}}assets-home/images/cul_paycode.png" class="paycode" width="40" title="点击放大" onclick="$('.big_paycode').toggle(200);">
                    <span style="font-size:12px">(点击放大)</span>
                </td>
            </tr>
            <tr>
                <td colspan="3">
                    <button type="submit" class="submit" onclick="toRender()">确定渲染成片</button>
                </td>
            </tr>
        </table>
    </form>
</div>
<div class="big_paycode">
    <img src="{{PUB}}assets-home/images/cul_paycode.png" class="paycode">
    <div class="close" onclick="$('.big_paycode').hide(200);">关闭</div>
</div>


<script>
    //价格计算
    var editMoney = $("#editMoney").html();
    var addMoney = $("#addMoney").html();
    $("select[name='format']").change(function(){
        var renderMoney = $(this).val();
        $("#renderMoney").html(renderMoney);
        $("#orderProMoney").html(renderMoney*1+editMoney*1+addMoney*1);
    });
    //下单
    function toRender(){}
</script>