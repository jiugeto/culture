@extends('member.main')
@section('content')
    @include('member.common.crumb')

    <form data-am-validator method="POST" action="/member/productattr" enctype="multipart/form-data">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <input type="hidden" name="index" value="{{ $index }}">
        <table class="table_create">
            <tr>
                <td class="field_name"><label>名称：</label></td>
                <td><input type="text" class="field_value" placeholder="至少2个字符" minlength="2" required name="name"/></td>
            </tr>
            {{--<tr><td></td></tr>--}}

            {{--<tr>--}}
                {{--<td class="field_name"><label>类样式名称：</label></td>--}}
                {{--<td><input type="text" placeholder="至少2个字符，英文、拼音、字母或数字组合" pattern="^[a-zA-Z0-9_-]+$" required name="style_name"/></td>--}}
            {{--</tr>--}}
            {{--<tr><td></td></tr>--}}

            <tr>
                <td class="field_name"><label>产品名称：</label></td>
                <td>
                    <select name="productid" required>
                    @if(count($model->products()))
                        @foreach($model->products() as $product)
                            <option value="{{ $product->id }}">{{ $product->name }}</option>
                        @endforeach
                    @endif
                    </select>
                    &nbsp;<a href="/member/product" class="star">产品列表</a>
                </td>
            </tr>
            {{--<tr><td></td></tr>--}}

            <tr>
                <td class="field_name"><label>简介：</label></td>
                <td><textarea name="intro" cols="40" rows="5"></textarea></td>
            </tr>
            {{--<tr><td></td></tr>--}}

            <tr>
                <td class="field_name"><label></label></td>
                <td><b>以下是一级样式</b></td>
            </tr>
            {{--<tr><td></td></tr>--}}

            <tr>
                <td class="field_name"><label>样式开关：</label></td>
                <td>
                    <label><input type="radio" class="radio" name="switch" value="0"> 不启用&nbsp;&nbsp;&nbsp;</label>
                    <label><input type="radio" class="radio" name="switch" value="1" checked> 启用&nbsp;&nbsp;&nbsp;</label>
                </td>
            </tr>
            {{--<tr><td></td></tr>--}}
            <script>
                $(document).ready(function(){
                    $("input[name='switch']").click(function(){
                        if(this.value==0){ $(".attrs").hide(); }
                        else { $(".attrs").show(); }
                    });
                });
            </script>
        </table>

        <table class="table_create attrs">
            <tr>
                <td class="field_name"><label>外边距：</label></td>
                <td class="td_border">
                    边距类型：
                    <select name="ismargin" required>
                        @if(count($model['marginTypes']))
                            @foreach($model['marginTypes'] as $kmarginType=>$marginType)
                                <option value="{{ $kmarginType }}">{{ $marginType }}</option>
                            @endforeach
                        @endif
                    </select>
                    <div id="margin1" style="display:none;">
                        左右：<input type="text" style="width:100px;" name="margin2"> px
                    </div>
                    <div id="margin2" style="display:none;">
                        上下：<input type="text" style="width:100px;" name="margin1"> px
                    </div>
                    <div id="margin3" style="display:none;">
                        上：<input type="text" style="width:100px;" name="margin3"> px
                        下：<input type="text" style="width:100px;" name="margin4"> px
                        <br>
                        上：<input type="text" style="width:100px;" name="margin5"> px
                        下：<input type="text" style="width:100px;" name="margin6"> px
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
                                <option value="{{ $kmarginType }}">{{ $marginType }}</option>
                            @endforeach
                        @endif
                    </select>
                    <div id="padding1" style="display:none;">
                        左右：<input type="text" style="width:100px;" name="padding2"> px
                    </div>
                    <div id="padding2" style="display:none;">
                        上下：<input type="text" style="width:100px;" name="padding1"> px
                    </div>
                    <div id="padding3" style="display:none;">
                        上：<input type="text" style="width:100px;" name="padding3"> px
                        下：<input type="text" style="width:100px;" name="padding4"> px
                        <br>
                        上：<input type="text" style="width:100px;" name="padding5"> px
                        下：<input type="text" style="width:100px;" name="padding6"> px
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
                <td><input type="text" placeholder="样式宽度" pattern="\d+" name="width"/> px</td>
            </tr>
            {{--<tr><td></td></tr>--}}

            <tr>
                <td class="field_name"><label>高度：(单位px)</label></td>
                <td><input type="text" placeholder="样式高度" pattern="\d+" name="height"/> px</td>
            </tr>
            {{--<tr><td></td></tr>--}}

            <tr>
                <td class="field_name"><label>边框：</label></td>
                <td class="td_border">
                    边框方向：
                    <select name="border1">
                        @foreach($model['borderDirectionNames'] as $kborderDirection=>$borderDirectionName)
                            <option value="{{ $kborderDirection }}">{{ $borderDirectionName }}</option>
                        @endforeach
                    </select>
                    <div id="border_attr" style="display:none;">
                        <div style="height:5px;">{{--间距--}}</div>
                        边框宽度：<input type="text" placeholder="边框宽度，单位px" pattern="\d+" name="border2"/> px
                        <div style="height:5px;">{{--间距--}}</div>
                        边框类型：
                        <select name="border3">
                            @foreach($model['borderTypeNames'] as $kborder=>$borderTypeName)
                                <option value="{{ $kborder }}">{{ $borderTypeName }}</option>
                            @endforeach
                        </select>
                        <div style="height:5px;">{{--间距--}}</div>
                        边框颜色：<input type="color" title="点击更改颜色" name="border4">
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
                <td>
                    <label><input type="radio" class="radio" name="iscolor" value="0" checked> 无&nbsp;&nbsp;</label>
                    <label><input type="radio" class="radio" name="iscolor" value="1"> 有&nbsp;&nbsp;</label>
                    <input type="color" title="点击更改颜色" style="display:none;" id="color" name="color">
                </td>
            </tr>
            {{--<tr><td></td></tr>--}}
            <script>
                $(document).ready(function(){
                    var iscolor = $("input[name=iscolor]");
                    iscolor.click(function(){
                        if(this.value==0){ $("#color").hide(); }
                        else{ $("#color").show(); }
                    });
                });
            </script>

            <tr>
                <td class="field_name"><label>字体大小：(单位px)</label></td>
                <td><input type="text" placeholder="字体大小" pattern="\d+" name="font_size"/> px</td>
            </tr>
            {{--<tr><td></td></tr>--}}

            <tr>
                <td class="field_name"><label>字间距：(单位px)</label></td>
                <td><input type="text" placeholder="字间距" pattern="\d+" name="word_spacing"/> px</td>
            </tr>
            {{--<tr><td></td></tr>--}}

            <tr>
                <td class="field_name"><label>行高：(单位px)</label></td>
                <td><input type="text" placeholder="行高" pattern="\d+" name="line_height"/> px</td>
            </tr>
            {{--<tr><td></td></tr>--}}

            <tr>
                <td class="field_name"><label>字体变换：</label></td>
                <td>
                    <select name="text_transform">
                    @foreach($model['textTransformTypeNames'] as $ktextTransformType=>$textTransformTypeName)
                        <option value="{{ $ktextTransformType }}">{{ $textTransformTypeName }}</option>
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
                        <option value="{{ $ktextAlignType }}">{{ $textAlignTypeName }}</option>
                    @endforeach
                    </select>
                </td>
            </tr>
            {{--<tr><td></td></tr>--}}

            <tr>
                <td class="field_name"><label>背景：</label></td>
                <td>
                    <label><input type="radio" class="radio" name="isbackground" value="0" checked> 无&nbsp;&nbsp;</label>
                    <label><input type="radio" class="radio" name="isbackground" value="1"> 有&nbsp;&nbsp;</label>
                    <input type="color" title="点击更改颜色" style="display:none;" id="background" name="background">
                </td>
            </tr>
            {{--<tr><td></td></tr>--}}
            <script>
                $(document).ready(function(){
                    var isbackground = $("input[name=isbackground]");
                    isbackground.click(function(){
                        if(this.value==0){ $("#background").hide(); }
                        else{ $("#background").show(); }
                    });
                });
            </script>

            <tr>
                <td class="field_name"><label>裁剪方式：</label></td>
                <td>
                    <select name="overflow">
                        @foreach($model['overflowTypeNames'] as $koverflowAlignType=>$overflowAlignTypeName)
                            <option value="{{ $koverflowAlignType }}">{{ $overflowAlignTypeName }}</option>
                        @endforeach
                    </select>
                </td>
            </tr>
            {{--<tr><td></td></tr>--}}

            <tr>
                <td class="field_name"><label>透明度：</label></td>
                <td><input type="text" placeholder="0透明，100不透明" pattern="\d+" name="opacity"/></td>
            </tr>
            {{--<tr><td></td></tr>--}}

            <tr>
                <td class="field_name"><label>定位方式：</label></td>
                <td>
                    <select name="position">
                        @foreach($model['positionTypeNames'] as $kpositionAlignType=>$positionAlignTypeName)
                            <option value="{{ $kpositionAlignType }}">{{ $positionAlignTypeName }}</option>
                        @endforeach
                    </select>
                </td>
            </tr>
            {{--<tr><td></td></tr>--}}

            <tr>
                <td class="field_name"><label>左边距离：(单位px)</label></td>
                <td><input type="text" placeholder="左边距离" pattern="\d+" name="left"/> px</td>
            </tr>
            {{--<tr><td></td></tr>--}}

            <tr>
                <td class="field_name"><label>顶部距离：(单位px)</label></td>
                <td><input type="text" placeholder="顶部距离" pattern="\d+" name="top"/> px</td>
            </tr>
            {{--<tr><td></td></tr>--}}

            <tr>
                <td class="field_name"><label>二级样式/三级样式/<br>图片样式/文字样式 *：</label></td>
                <td>添加后，在列表样式2/样式3/图片样式/文字样式中编辑</td>
            </tr>
            {{--<tr><td></td></tr>--}}
        </table>

        <table class="table_create">
            <tr><td colspan="2" style="text-align:center;">
                    <button class="companybtn" onclick="history.go(-1)">返 &nbsp;&nbsp;&nbsp;回</button>
                    <button type="submit" class="companybtn">保存添加</button>
                </td></tr>
        </table>
    </form>
@stop

