@extends('member.main')
@section('content')
    @include('member.common.crumb')

    <form data-am-validator method="POST" action="/member/productattr/{{ $data->id }}" enctype="multipart/form-data">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <input type="hidden" name="_method" value="POST">
        <table class="table_create">
            <tr>
                <td class="field_name"><label>名称：</label></td>
                <td><input type="text" class="field_value" placeholder="至少2个字符" minlength="2" required name="name" value="{{ $data->name }}"/></td>
            </tr>
            {{--<tr><td></td></tr>--}}

            <tr>
                <td class="field_name"><label>类样式名称：</label></td>
                <td><input type="text" placeholder="至少2个字符，英文、拼音、字母或数字组合" pattern="^[a-zA-Z0-9_-]+$" required name="style_name" value="{{ $data->style_name }}"/></td>
            </tr>
            {{--<tr><td></td></tr>--}}

            <tr>
                <td class="field_name"><label>产品名称：</label></td>
                <td>
                    <select name="productid" required>
                    @if(count($model->products()))
                        @foreach($model->products() as $product)
                            <option value="{{ $product->name }}" {{ $data->productid==$product->id ? 'selected' : '' }}>{{ $product->name }}</option>
                        @endforeach
                    @endif
                    </select>
                    &nbsp;<a href="/member/product" class="star">产品列表</a>
                </td>
            </tr>
            {{--<tr><td></td></tr>--}}

            <tr>
                <td class="field_name"><label>外边距：</label></td>
                <td class="td_border">
                    边距类型：
                    <select name="ismargin" required>
                        @if(count($model['marginTypes']))
                            @foreach($model['marginTypes'] as $kmarginType=>$marginType)
                                <option value="{{ $kmarginType }}" {{ $attrs['ismargin']==$kmarginType ? 'selected' : '' }}>{{ $marginType }}</option>
                            @endforeach
                        @endif
                    </select>
                    <div id="margin1" style="display:{{$attrs['ismargin']==3?'block':'none'}};">
                        左右：<input type="text" style="width:100px;" name="margin2" value="{{ $attrs['margin2'] }}"> px
                    </div>
                    <div id="margin2" style="display:{{$attrs['ismargin']==4?'block':'none'}};">
                        上下：<input type="text" style="width:100px;" name="margin1" value="{{ $attrs['margin1'] }}"> px
                    </div>
                    <div id="margin3" style="display:{{$attrs['ismargin']==5?'block':'none'}};">
                        上：<input type="text" style="width:100px;" name="margin3" value="{{ $attrs['margin3'] }}"> px
                        下：<input type="text" style="width:100px;" name="margin4" value="{{ $attrs['margin4'] }}"> px
                        <br>
                        上：<input type="text" style="width:100px;" name="margin5" value="{{ $attrs['margin5'] }}"> px
                        下：<input type="text" style="width:100px;" name="margin6" value="{{ $attrs['margin6'] }}"> px
                    </div>
                </td>
            </tr>
            {{--<tr><td></td></tr>--}}
            <script>
                $(document).ready(function(){
                    var margin1 = $("#margin1");
                    var margin2 = $("#margin2");
                    var margin3 = $("#margin3");
                    $("select[name='ismargin']").change(function(){
                        if(this.value<=2){ margin1.hide(); margin2.hide(); margin3.hide(); }
                        if(this.value==3){ margin1.show(); margin2.hide(); margin3.hide(); }
                        if(this.value==4){ margin1.hide(); margin2.show(); margin3.hide(); }
                        if(this.value==5){ margin1.hide(); margin2.hide(); margin3.show(); }
                    });
                });
            </script>

            <tr>
                <td class="field_name"><label>内边距：</label></td>
                <td class="td_border">
                    边距类型：
                    <select name="ispadding" required>
                        @if(count($model['marginTypes']))
                            @foreach($model['marginTypes'] as $kmarginType=>$marginType)
                                <option value="{{ $kmarginType }}" {{ $attrs['ispadding']==$kmarginType ? 'selected' : '' }}>{{ $marginType }}</option>
                            @endforeach
                        @endif
                    </select>
                    <div id="padding1" style="display:{{$attrs['ispadding']==3?'block':'none'}};">
                        左右：<input type="text" style="width:100px;" name="padding2" value="{{ $attrs['padding2'] }}"> px
                    </div>
                    <div id="padding2" style="display:{{$attrs['ispadding']==4?'block':'none'}};">
                        上下：<input type="text" style="width:100px;" name="padding1" value="{{ $attrs['padding1'] }}"> px
                    </div>
                    <div id="padding3" style="display:{{$attrs['ispadding']==5?'block':'none'}};">
                        上：<input type="text" style="width:100px;" name="padding3" value="{{ $attrs['padding3'] }}"> px
                        下：<input type="text" style="width:100px;" name="padding4" value="{{ $attrs['padding4'] }}"> px
                        <br>
                        上：<input type="text" style="width:100px;" name="padding5" value="{{ $attrs['padding5'] }}"> px
                        下：<input type="text" style="width:100px;" name="padding6" value="{{ $attrs['padding6'] }}"> px
                    </div>
                </td>
            </tr>
            {{--<tr><td></td></tr>--}}
            <script>
                $(document).ready(function(){
                    var padding1 = $("#padding1");
                    var padding2 = $("#padding2");
                    var padding3 = $("#padding3");
                    $("select[name='ispadding']").change(function(){
                        if(this.value<=2){
                            padding1.hide(); padding2.hide(); padding3.hide();
                        }
                        if(this.value==3){
                            padding1.show(); padding2.hide(); padding3.hide();
                        }
                        if(this.value==4){
                            padding1.hide(); padding2.show(); padding3.hide();
                        }
                        if(this.value==5){
                            padding1.hide(); padding2.hide(); padding3.show();
                        }
                    });
                });
            </script>

            <tr>
                <td class="field_name"><label>宽度：(单位px)</label></td>
                <td><input type="text" placeholder="样式宽度" pattern="\d+" name="width" value="{{ $attrs['width'] }}"/> px</td>
            </tr>
            {{--<tr><td></td></tr>--}}

            <tr>
                <td class="field_name"><label>高度：(单位px)</label></td>
                <td><input type="text" placeholder="样式高度" pattern="\d+" name="height" value="{{ $attrs['height'] }}"/> px</td>
            </tr>
            {{--<tr><td></td></tr>--}}

            <tr>
                <td class="field_name"><label>边框：</label></td>
                <td class="td_border">
                    边框方向：
                    <select name="border1">
                        @foreach($model['borderDirectionNames'] as $kborderDirection=>$borderDirectionName)
                            <option value="{{ $kborderDirection }}" {{ $attrs['border1']==$kborderDirection ? 'selected' : '' }}>{{ $borderDirectionName }}</option>
                        @endforeach
                    </select>
                    <div id="border_attr" style="display:none;">
                        <div style="height:5px;">{{--间距--}}</div>
                        边框宽度：<input type="text" placeholder="边框宽度，单位px" pattern="\d+" name="border2" value="{{ $attrs['border2'] }}"/> px
                        <div style="height:5px;">{{--间距--}}</div>
                        边框类型：
                        <select name="border3">
                            @foreach($model['borderTypeNames'] as $kborder=>$borderTypeName)
                                <option value="{{ $kborder }}" {{ $attrs['border3']==$kborder ? 'selected' : '' }}>{{ $borderTypeName }}</option>
                            @endforeach
                        </select>
                        <div style="height:5px;">{{--间距--}}</div>
                        边框颜色：<input type="color" title="点击更改颜色" name="border4" value="{{ $attrs['border4'] }}">
                    </div>
                </td>
            </tr>
            {{--<tr><td></td></tr>--}}
            <script>
                $(document).ready(function(){
                    var border_attr = $("#border_attr");
                    $("select[name='border1']").change(function(){
                        if(this.value==0){ border_attr.hide(); }
                        if(this.value>0){ border_attr.show(); }
                    });
                });
            </script>

            <tr>
                <td class="field_name"><label>颜色：</label></td>
                <td><input type="color" title="点击更改颜色" name="color" value="{{ $attrs['color'] }}"></td>
            </tr>
            {{--<tr><td></td></tr>--}}

            <tr>
                <td class="field_name"><label>字体大小：(单位px)</label></td>
                <td><input type="text" placeholder="字体大小" pattern="\d+" name="font_size" value="{{ $attrs['font_size'] }}"/> px</td>
            </tr>
            {{--<tr><td></td></tr>--}}

            <tr>
                <td class="field_name"><label>字间距：(单位px)</label></td>
                <td><input type="text" placeholder="字间距" pattern="\d+" name="word_spacing" value="{{ $attrs['word_spacing'] }}"/> px</td>
            </tr>
            {{--<tr><td></td></tr>--}}

            <tr>
                <td class="field_name"><label>行高：(单位px)</label></td>
                <td><input type="text" placeholder="行高" pattern="\d+" name="line_height" value="{{ $attrs['line_height'] }}"/> px</td>
            </tr>
            {{--<tr><td></td></tr>--}}

            <tr>
                <td class="field_name"><label>字体变换：</label></td>
                <td>
                    <select name="text_transform">
                    @foreach($model['textTransformTypeNames'] as $ktextTransformType=>$textTransformTypeName)
                        <option value="{{ $ktextTransformType }}" {{ $attrs['text_transform']==$ktextTransformType ? 'selected' : '' }}>{{ $textTransformTypeName }}</option>
                    @endforeach
                    </select>
                </td>
            </tr>
            {{--<tr><td></td></tr>--}}

            <tr>
                <td class="field_name"><label>水平对齐方式：</label></td>
                <td>
                    <select name="text_align">
                    @foreach($model['textAlignTypeNames'] as $ktextAlignType=>$textAlignTypeName)
                        <option value="{{ $ktextAlignType }}" {{ $attrs['text_align']==$ktextAlignType ? 'selected' : '' }}>{{ $textAlignTypeName }}</option>
                    @endforeach
                    </select>
                </td>
            </tr>
            {{--<tr><td></td></tr>--}}

            <tr>
                <td class="field_name"><label>背景：</label></td>
                <td><input type="color" title="点击更改颜色" name="background" value="{{ $attrs['background'] }}"></td>
            </tr>
            {{--<tr><td></td></tr>--}}

            <tr>
                <td class="field_name"><label>水平对齐方式：</label></td>
                <td>
                    <select name="position">
                        @foreach($model['positionTypeNames'] as $kpositionAlignType=>$positionAlignTypeName)
                            <option value="{{ $kpositionAlignType }}" {{ $attrs['position']==$kpositionAlignType ? 'selected' : '' }}>{{ $positionAlignTypeName }}</option>
                        @endforeach
                    </select>
                </td>
            </tr>
            {{--<tr><td></td></tr>--}}

            <tr>
                <td class="field_name"><label>左边距离：(单位px)</label></td>
                <td><input type="text" placeholder="左边距离" pattern="\d+" name="left" value="{{ $attrs['left'] }}"/> px</td>
            </tr>
            {{--<tr><td></td></tr>--}}

            <tr>
                <td class="field_name"><label>顶部距离：(单位px)</label></td>
                <td><input type="text" placeholder="顶部距离" pattern="\d+" name="top" value="{{ $attrs['top'] }}"/> px</td>
            </tr>
            {{--<tr><td></td></tr>--}}

            <tr>
                <td class="field_name"><label>裁剪方式：</label></td>
                <td>
                    <select name="overflow">
                        @foreach($model['overflowTypeNames'] as $koverflowAlignType=>$overflowAlignTypeName)
                            <option value="{{ $koverflowAlignType }}" {{ $attrs['overflow']==$koverflowAlignType ? 'selected' : '' }}>{{ $overflowAlignTypeName }}</option>
                        @endforeach
                    </select>
                </td>
            </tr>
            {{--<tr><td></td></tr>--}}

            <tr>
                <td class="field_name"><label>透明度：</label></td>
                <td><input type="text" placeholder="0透明，100不透明" pattern="\d+" name="opacity" value="{{ $attrs['opacity'] }}"/></td>
            </tr>
            {{--<tr><td></td></tr>--}}

            <tr>
                <td class="field_name"><label>简介：</label></td>
                <td><textarea name="intro" cols="40" rows="5">{{ $data->intro }}</textarea></td>
            </tr>
            {{--<tr><td></td></tr>--}}

            <tr><td colspan="2" style="text-align:center;">
                    <button class="companybtn" onclick="history.go(-1)">返 &nbsp;&nbsp;&nbsp;回</button>
                    <button type="submit" class="companybtn">保存修改</button>
                </td></tr>
        </table>
    </form>
@stop

