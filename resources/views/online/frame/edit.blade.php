@extends('online.main')
@section('content')
    @include('online.common.style')
    @include('online.common.show')

    <div class="online_frame" style="@if(isset($footSwitch)&&!$footSwitch)bottom:30px;@endif">
        <div class="timeframe">
            <input type="hidden" name="productid" value="{{ $data->id }}">
            <div class="showtime">
                动画帧：
                @if(count($layers))
                @foreach($layers as $layer)
                    <a id="{{$layer->timeCurr?'timecurr':''}}" onclick="timecurr({{$layer->id}})">{{ $layer->delay.'s~'.$layer->duration.'s' }}</a>
                @endforeach
                @endif
                <a id="finish" onclick="finish()">完成</a>
                <script>
                    var productid = $("input[name='productid']").val();
                    function timecurr(v){
                        window.location.href = "/online/"+productid+"/frame/timecurr/"+v;
                    }
                    function finish(){
                        window.location.href = "/online/"+productid;
                    }
                </script>
            </div>
        </div>
        <div class="frame">
            {{--属性修改--}}
            <div class="menus">
                <a><div class="title" id="title1">样式修改</div></a>
            </div>
            <div class="menus oneframe" id="style" style="display:none;"></div>

            {{--动画内容修改--}}
            <div class="menus">
                <a><div class="title star" id="title2" style="color:red;">动画内容修改</div></a>
            </div>
            <div class="menus oneframe" id="con">
                @if(count($cons))
                @foreach($cons as $con)
                    @if($con->layer() && $con->layer()->timeCurr)
                <table>
                    <tr><td style="width:50%;">
                        <span id="pic_{{$con->id}}" style="display:{{$con->genre==1?'block':'none'}};">
                            图片选择：
                            <select name="pic_id_{{$con->id}}">
                                <option value="">选择图片</option>
                            @if(count($pics))
                            @foreach($pics as $pic)
                                <option value="{{ $pic->id }}" {{ $con->pic_id==$pic->id ? 'selected' : '' }}>{{ $pic->name }}</option>
                            @endforeach
                            @endif
                            </select>
                        </span>
                        <span id="text_{{$con->id}}" style="display:{{$con->genre==2?'block':'none'}};">
                            文字填写：
                            <input type="text" placeholder="填写文字" minlength="2" required name="con_name_{{$con->id}}" value="{{ $con->name }}">
                        </span>
                        </td>
                        <td>内容类型：
                            <label onclick="genre1({{$con->id}})"><input type="radio" name="genre_{{$con->id}}" value="1" {{ $con->genre==1 ? 'checked' : '' }}> 图片&nbsp;</label>
                            <label onclick="genre2({{$con->id}})"><input type="radio" name="genre_{{$con->id}}" value="2" {{ $con->genre==2 ? 'checked' : '' }}> 文字&nbsp;</label>
                        </td>
                        <script>
                            function genre1(v){ $("#pic_"+v).show(); $("#text_"+v).hide(); }
                            function genre2(v){ $("#pic_"+v).hide(); $("#text_"+v).show(); }
                        </script>
                    </tr>
                </table>
                    @endif
                @endforeach
                @endif
            </div>

            {{--动画帧修改--}}
            <div class="menus">
                <a><div class="title" id="title3">动画单帧修改</div></a>
            </div>
            <div class="menus oneframe" id="layerAttr" style="display:none;">
                @if(count($layerAttrs))
                @foreach($layerAttrs as $layerAttr)
                    @if($layerAttr->getLayer() && $layerAttr->getLayer()->timeCurr)
                <table class="layer">
                    <tr><td style="width:20%;">
                            属性名：{{ $layerAttr->layerAttrName() }}
                        </td>
                        <td style="width:30%;">
                            百分比(%)/时长(s)：<input type="text" name="per_{{$layerAttr->id}}" value="{{ $layerAttr->per }}">/{{ $layerAttr->getLayer()->duration }}
                        </td>
                        <td>
                            参数值：<input type="text" name="val_{{$layerAttr->id}}" value="{{ $layerAttr->val }}">
                        </td>
                    </tr>
                </table>
                    @endif
                @endforeach
                @endif
            </div>

            {{--动画设置修改--}}
            <div class="menus">
                <a><div class="title" id="title4">动画设置</div></a>
            </div>
            <div class="menus oneframe" id="layer" style="display:none;">
                @if(count($layers))
                @foreach($layers as $layer)
                    <table class="layer">
                        <tr><td style="width:30%;">
                                动画名称：<input type="text" style="width:100px;" name="layer_name_{{ $layer->id }}" value="{{ $layer->name }}">
                            </td>
                            <td>
                                开始时间(s)：<input type="text" name="layer_delay_{{ $layer->id }}" value="{{ $layer->delay }}"></td>
                            <td>动画时长(s)：<input type="text" name="layer_duration_{{ $layer->id }}" value="{{ $layer->duration }}"></td>
                            <td></td>
                        </tr>
                    </table>
                @endforeach
                @endif
            </div>
        </div>
        <div style="height:100px;">{{--空白--}}</div>
    </div>

    <script>
        $(document).ready(function(){
            var style = $("#style");
            var con = $("#con");
            var layerAttr = $("#layerAttr");
            var layer = $("#layer");
            $("#title1").click(function(){
                style.show(200); con.hide(200); layerAttr.hide(200); layer.hide(200);
                $("#title1").css('color','red'); $("#title2").css('color','darkgrey');
                $("#title3").css('color','darkgrey'); $("#title4").css('color','darkgrey');
            });
            $("#title2").click(function(){
                style.hide(200); con.show(200); layerAttr.hide(200); layer.hide(200);
                $("#title1").css('color','darkgrey'); $("#title2").css('color','red');
                $("#title3").css('color','darkgrey'); $("#title4").css('color','darkgrey');
            });
            $("#title3").click(function(){
                style.hide(200); con.hide(200); layerAttr.show(200); layer.hide(200);
                $("#title1").css('color','darkgrey'); $("#title2").css('color','darkgrey');
                $("#title3").css('color','red'); $("#title4").css('color','darkgrey');
            });
            $("#title4").click(function(){
                style.hide(200); con.hide(200); layerAttr.hide(200); layer.show(200);
                $("#title1").css('color','darkgrey'); $("#title2").css('color','darkgrey');
                $("#title3").css('color','darkgrey'); $("#title4").css('color','red');
            });
        });
    </script>
@stop