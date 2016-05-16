@extends('member.main')
@section('content')
    @include('member.common.crumb')

    <form data-am-validator method="POST" action="/member/productlayer/{{ $data->id }}" enctype="multipart/form-data">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <input type="hidden" name="_method" value="POST">
        <table class="table_create">
            <tr>
                <td class="field_name"><label>名称：</label></td>
                <td><input type="text" class="field_value" placeholder="至少2个字符" minlength="2" required name="name" value="{{ $data->name }}"/></td>
            </tr>
            {{--<tr><td></td></tr>--}}

            <tr>
                <td class="field_name"><label>产品名称：</label></td>
                <td>
                    <select name="productid">
                    @if(count($model->products()))
                        @foreach($model->products() as $product)
                            <option value="{{ $product->id }}" {{ $data->productid==$product->id ? 'selected' : '' }}>{{ $product->name }}</option>
                        @endforeach
                    @endif
                    </select>
                    &nbsp;<a href="/member/product" class="star">产品列表</a>
                </td>
            </tr>
            {{--<tr><td></td></tr>--}}

            <tr>
                <td class="field_name"><label>属性名称：</label></td>
                <td>
                    <select name="attrid">
                    @if(count($model->attrs()))
                        @foreach($model->attrs() as $attr)
                            <option value="{{ $attr->id }}" {{ $data->attrid==$attr->id ? 'selected' : '' }}>{{ $attr->name }}</option>
                        @endforeach
                    @endif
                    </select>
                </td>
            </tr>
            {{--<tr><td></td></tr>--}}

            <tr>
                <td class="field_name"><label>动画名称：</label></td>
                <td><input type="text" class="field_value" placeholder="至少2个字符" pattern="^[a-zA-Z0-9-_]+$" required name="animation_name" value="{{ $data->animation_name }}"/></td>
            </tr>
            {{--<tr><td></td></tr>--}}

            <tr>
                <td class="field_name"><label>时长：</label></td>
                <td><input type="text" class="field_value" placeholder="" pattern="^\d+$" required name="duration" value="{{ $data->duration }}"/></td>
            </tr>
            {{--<tr><td></td></tr>--}}

            <tr>
                <td class="field_name"><label>速度曲线：</label></td>
                <td>
                    <select name="function">
                        @foreach($model['functionNames'] as $kfunction=>$functionName)
                            <option value="{{ $kfunction }}" {{ $data->function==$kfunction ? 'selected' : '' }}>{{ $functionName }}</option>
                        @endforeach
                    </select>
                </td>
            </tr>
            {{--<tr><td></td></tr>--}}

            <tr>
                <td class="field_name"><label>延时秒数：</label></td>
                <td><input type="text" class="field_value" placeholder="" pattern="^\d+$" required name="delay" value="{{ $data->delay }}"/></td>
            </tr>
            {{--<tr><td></td></tr>--}}

            <tr>
                <td class="field_name"><label>播放次数：</label></td>
                <td><input type="text" class="field_value" placeholder="" pattern="^([1-9])|([1-9]\d+)$" required name="count" value="{{ $data->count }}"/></td>
            </tr>
            {{--<tr><td></td></tr>--}}

            <tr>
                <td class="field_name"><label>播放方向：</label></td>
                <td>
                    <select name="direction">
                        @foreach($model['directionNames'] as $kdirection=>$directionName)
                            <option value="{{ $kdirection }}" {{ $data->direction==$kdirection ? 'selected' : '' }}>{{ $directionName }}</option>
                        @endforeach
                    </select>
                </td>
            </tr>
            {{--<tr><td></td></tr>--}}

            <tr>
                <td class="field_name"><label>播放状态：</label></td>
                <td>
                    <select name="state">
                        @foreach($model['stateNames'] as $kstate=>$stateName)
                            <option value="{{ $kstate }}" {{ $data->state==$kstate ? 'selected' : '' }}>{{ $stateName }}</option>
                        @endforeach
                    </select>
                </td>
            </tr>
            {{--<tr><td></td></tr>--}}

            <tr>
                <td class="field_name"><label>播放模式：</label></td>
                <td>
                    <select name="mode">
                        @foreach($model['modeNames'] as $kmode=>$modeName)
                            <option value="{{ $kmode }}" {{ $data->mode==$kmode ? 'selected' : '' }}>{{ $modeName }}</option>
                        @endforeach
                    </select>
                </td>
            </tr>
            {{--<tr><td></td></tr>--}}

            <tr>
                <td class="field_name"><label>动画值处理：</label><br>(横向是属性名，<br>纵向是动画点和属性值)</td>
                <td>
                    <div class="td_border" style="height:200px;overflow:auto;">
                        属性名称：<input type="text" class="field_value" style="width:200px;" placeholder="属性名称" pattern="^[a-zA-Z0-9-_]+$" required name="field"/>
                        <input type="hidden" name="dh" value="1">
                        <a class="companybtn addDH">增加值</a>
                        <div class="dh">
                            属性值1：<input type="text" class="field_value" style="width:110px;" placeholder="动画点，0%~100%" pattern="^\d+$" required name="per1"/>&nbsp;&nbsp;
                            动画点1：<input type="text" class="field_value" style="width:110px;" placeholder="动画值" pattern="^[a-zA-Z0-9-_]++$" required name="val1"/>
                        </div>
                        {{--<input type="hidden" name="attr_val" value="1">--}}
                        {{--<a class="companybtn addAttr">增加属性</a>--}}
                        {{--<div style="height:2px;border-bottom:1px dashed gainsboro;"></div>--}}
                    </div>
                </td>
            </tr>
            {{--<tr><td></td></tr>--}}
            <script>
                $(document).ready(function(){
                    var dh = $("input[name='dh']");
                    $(".addDH").click(function(){
                        dh[0].value = dh.val() * 1 + 1;
                        $(".dh").append('<br>属性值'+dh.val()+'：<input type="text" class="field_value" style="width:110px;" placeholder="动画点，0%~100%" pattern="^\\d+$" required name="per'+dh.val()+'"/>&nbsp;&nbsp;&nbsp;动画点'+dh.val()+'：<input type="text" class="field_value" style="width:110px;" placeholder="动画值" pattern="^[a-zA-Z0-9-_]++$" required name="val'+dh.val()+'"/>');
                    });
                });
            </script>

            <tr>
                <td class="field_name"><label>简介：</label></td>
                <td><textarea name="intro" cols="40" rows="5">{{ $data->intro }}</textarea></td>
            </tr>
            {{--<tr><td></td></tr>--}}

            <tr><td colspan="2" style="text-align:center;">
                    <button class="companybtn" onclick="history.go(-1)">返 &nbsp;&nbsp;&nbsp;回</button>
                    <button type="submit" class="companybtn">保存添加</button>
                </td></tr>
        </table>
    </form>
@stop

