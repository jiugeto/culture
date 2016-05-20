@extends('admin.main')
@section('content')
    <div class="admin-content">
        @include('admin.common.crumb')
        <div class="am-g">
            @include('admin.common.menu')
            {{--@include('admin.type.search')--}}
        </div>
        <hr/>

        <div class="am-g">
            @include('admin.common.info')
            <div class="am-u-sm-12 am-u-md-8 am-u-md-pull-4">
                <form class="am-form" data-am-validator method="POST" action="/admin/productattr/{{ $data->id }}" enctype="multipart/form-data">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <input type="hidden" name="_method" value="POST">
                    <fieldset>
                        <div class="am-form-group">
                            <label>名称 / Name：</label>
                            <input type="text" placeholder="至少2个字符" minlength="2" required name="name" value="{{ $data->name }}"/>
                        </div>

                        <div class="am-form-group">
                            <label>类样式名称 / Name：</label>
                            <input type="text" placeholder="至少2个字符，英文、拼音、字母或数字组合" pattern="^[a-zA-Z0-9_-]+$" required name="style_name" value="{{ $data->style_name }}"/>
                        </div>

                        <div class="am-form-group">
                            <label>产品名称 / Name：</label>
                            <select name="productid">
                            @if($model->productAll())
                                @foreach($model->productAll() as $product)
                                    <option value="{{ $product->id }}" {{ $data->productid==$product->id ? 'selected' : '' }}>{{ $product->name }}</option>
                                @endforeach
                            @endif
                            </select>
                        </div>

                        <div class="am-form-group">
                            <label>简介 / Introduce：</label>
                            <textarea name="intro" cols="50" rows="5"> {{ $data->intro }}</textarea>
                        </div>

                        {{--总的样式属性--}}
                        <div class="am-form-group">
                            <label>总的样式属性</label>
                            <label><input type="radio" name="switch0" id="close" value="1" {{ $attrs['switch0']==0 ? 'checked' : '' }}> 关闭&nbsp;&nbsp;</label>
                            <label><input type="radio" name="switch0" id="open" value="0" {{ $attrs['switch0']==1 ? 'checked' : '' }}> 展开&nbsp;&nbsp;</label>
                        </div>
                        <script>
                            $(document).ready(function(){
                                var open = $("#open");
                                var close = $("#close");
                                var attrs = $(".attrs");
                                open.click(function(){ attrs.show(); });
                                close.click(function(){ attrs.hide(); });
                            });
                        </script>

                        <div class="am-form-group attrs" style="display:{{$attrs['switch0']==0?'none':'block'}};">
                            <label>外边距 / Margin：(单位px)</label>
                            <div class="admin_border">
                                外边距类型：
                                <select name="ismargin">
                                    @foreach($model['marginTypes'] as $kmarginType=>$marginType)
                                        <option value="{{ $kmarginType }}" {{ $attrs['ismargin']==$kmarginType ? 'selected' : '' }}>{{ $marginType }}</option>
                                    @endforeach
                                </select>
                                <div id="margin1" style="display:{{$attrs['ismargin']==3?'block':'none'}};">
                                    左右：(单位px)<input type="text" name="margin2" value="{{ $attrs['margin2'] }}">
                                </div>
                                <div id="margin2" style="display:{{$attrs['ismargin']==4?'block':'none'}};">
                                    上下：(单位px)<input type="text" name="margin1" value="{{ $attrs['margin1'] }}">
                                </div>
                                <div id="margin3" style="display:{{$attrs['ismargin']==5?'block':'none'}};">
                                    上：(单位px)<input type="text" name="margin3" value="{{ $attrs['margin3'] }}">
                                    下：(单位px)<input type="text" name="margin4" value="{{ $attrs['margin4'] }}">
                                    <br>
                                    上：(单位px)<input type="text" name="margin5" value="{{ $attrs['margin5'] }}">
                                    下：(单位px)<input type="text" name="margin6" value="{{ $attrs['margin6'] }}">
                                </div>
                            </div>
                        </div>
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

                        <div class="am-form-group attrs" style="display:{{$attrs['switch0']==0?'none':'block'}};">
                            <label>内边距 / Padding：(单位px)</label>
                            <div class="admin_border">
                                内边距类型：
                                <select name="ispadding" required>
                                    @if(count($model['marginTypes']))
                                        @foreach($model['marginTypes'] as $kmarginType=>$marginType)
                                            <option value="{{ $kmarginType }}" {{ $attrs['ispadding']==$kmarginType ? 'selected' : '' }}>{{ $marginType }}</option>
                                        @endforeach
                                    @endif
                                </select>
                                <div id="padding1" style="display:{{$attrs['ispadding']==3?'block':'none'}};">
                                    左右：(单位px)<input type="text" name="padding2" value="{{ $attrs['padding2'] }}">
                                </div>
                                <div id="padding2" style="display:{{$attrs['ispadding']==4?'block':'none'}};">
                                    上下：(单位px)<input type="text" name="padding1" value="{{ $attrs['padding1'] }}">
                                </div>
                                <div id="padding3" style="display:{{$attrs['ispadding']==5?'block':'none'}};">
                                    上：(单位px)<input type="text" name="padding3" value="{{ $attrs['padding3'] }}">
                                    下：(单位px)<input type="text" name="padding4" value="{{ $attrs['padding4'] }}">
                                    <br>
                                    上：(单位px)<input type="text" name="padding5" value="{{ $attrs['padding5'] }}">
                                    下：(单位px)<input type="text" name="padding6" value="{{ $attrs['padding6'] }}">
                                </div>
                            </div>
                        </div>

                        <div class="am-form-group attrs" style="display:{{$attrs['switch0']==0?'none':'block'}};">
                            <label>宽度 / Width：(单位px)</label>
                            <input type="text" placeholder="" pattern="\d+" name="width" value="{{ $attrs['width'] }}"/>
                        </div>

                        <div class="am-form-group attrs" style="display:{{$attrs['switch0']==0?'none':'block'}};">
                            <label>高度 / Height：(单位px)</label>
                            <input type="text" placeholder="" pattern="\d+" name="height" value="{{ $attrs['height'] }}"/>
                        </div>

                        <div class="am-form-group attrs" style="display:{{$attrs['switch0']==0?'none':'block'}};">
                            <label>边框 / Border：</label>
                            <div class="admin_border">
                                边框方向：
                                <select name="border1">
                                    @foreach($model['borderDirectionNames'] as $kborderDirection=>$borderDirectionName)
                                    <option value="{{ $kborderDirection }}" {{ $attrs['border1']==$kborderDirection ? 'selected' : '' }}>{{ $borderDirectionName }}</option>
                                    @endforeach
                                </select>
                                <div style="height:5px;">{{--间距--}}</div>
                                边框宽度：<input type="text" placeholder="边框宽度，单位px" pattern="\d+" name="border2" value="{{ $attrs['border2'] }}"/>
                                <div style="height:5px;">{{--间距--}}</div>
                                边框类型：
                                <select name="border3">
                                    @foreach($model['borderTypeNames'] as $kborder=>$borderTypeName)
                                        <option value="{{ $kborder }}" {{ $attrs['border3']==$kborder ? 'selected' : '' }}>{{ $borderTypeName }}</option>
                                    @endforeach
                                </select>
                                <div style="height:5px;">{{--间距--}}</div>
                                边框颜色：(点击下面更改颜色)
                                <span style="float:right;">当前颜色预览<div class="admin_yulan" style="{{ $attrs['border4']?'background:'.$attrs['border4']:'' }}"></div></span>
                                <input type="color" title="点击更改颜色" name="border4" value="{{ $attrs['border4'] }}">
                            </div>
                        </div>
                        <script>
                            $(document).ready(function(){
                                var color = $("input[name='border4']");
                                color.change(function(){
                                    $(".admin_yulan").css('background',this.value);
                                });
                            });
                        </script>

                        <div class="am-form-group attrs" style="display:{{$attrs['switch0']==0?'none':'block'}};">
                            <label>定位方式 / Position：</label>
                            <div class="admin_border">
                                <select name="position">
                                    @foreach($model['positionTypeNames'] as $kpositionType=>$positionTypeName)
                                        <option value="{{ $kpositionType }}" {{ $attrs['position']==$kpositionType ? 'selected' : '' }}>{{ $positionTypeName }}</option>
                                    @endforeach
                                </select>
                                <span id="locate" style="display:none;">
                                    左边距离：(定位px)
                                    <input type="text" placeholder="单位px" pattern="\d+" name="left" value="{{ $attrs['left'] }}"/>
                                    顶部距离：(定位px)
                                    <input type="text" placeholder="单位px" pattern="\d+" name="top" value="{{ $attrs['top'] }}"/>
                                </span>
                            </div>
                        </div>
                        <script>
                            $(document).ready(function(){
                                var position = $("select[name='position']");
                                var locate = $("#locate");
                                position.change(function(){
                                    if(position.val()==0){ locate.hide(); }
                                    if(position.val()>0){ locate.show(); }
                                });
                            });
                        </script>

                        <div class="am-form-group attrs" style="display:{{$attrs['switch0']==0?'none':'block'}};">
                            <label>溢出方式 / Overflow：</label>
                            <select name="overflow">
                                @foreach($model['overflowTypeNames'] as $koverflowType=>$overflowTypeName)
                                    <option value="{{ $koverflowType }}" {{ $attrs['overflow']==$koverflowType ? 'selected' : '' }}>{{ $overflowTypeName }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="am-form-group attrs" style="display:{{$attrs['switch0']==0?'none':'block'}};">
                            <label>透明度 / Opacity：</label>
                            <input type="text" placeholder="单位%" pattern="\d+" name="opacity" value="{{ $attrs['opacity'] }}"/>
                        </div>
                        <hr>

                        {{--文字属性--}}
                        <div class="am-form-group">
                            <label>文字样式属性</label>
                            <label><input type="radio" name="switch1" id="close_text" value="0" {{ $textAttr['switch1']==0 ? 'checked' : '' }}> 关闭&nbsp;&nbsp;</label>
                            <label><input type="radio" name="switch1" id="open_text" value="1" {{ $textAttr['switch1']==1 ? 'checked' : '' }}> 展开&nbsp;&nbsp;</label>
                        </div>
                        <script>
                            $(document).ready(function(){
                                var open_text = $("#open_text");
                                var close_text = $("#close_text");
                                var attrs_text = $(".attrs_text");
                                open_text.click(function(){ attrs_text.show(); });
                                close_text.click(function(){ attrs_text.hide(); });
                            });
                        </script>

                        <div class="am-form-group attrs_text" style="display:{{$textAttr['switch1']==0?'none':'block'}};">
                            <label>外边距 / Margin：(单位px)</label>
                            <div class="admin_border">
                                外边距类型：
                                <select name="istextmargin">
                                    @foreach($model['marginTypes'] as $kmarginType=>$marginType)
                                        <option value="{{ $kmarginType }}" {{ $textAttr['istextmargin']==$kmarginType ? 'selected' : '' }}>{{ $marginType }}</option>
                                    @endforeach
                                </select>
                                <div id="textmargin1" style="display:{{$textAttr['istextpadding']==3?'block':'none'}};">
                                    左右：(单位px)<input type="text" name="textmargin2" value="{{ $textAttr['textmargin2'] }}">
                                </div>
                                <div id="textmargin2" style="display:{{$textAttr['istextpadding']==4?'block':'none'}};">
                                    上下：(单位px)<input type="text" name="textmargin1" value="{{ $textAttr['textmargin1'] }}">
                                </div>
                                <div id="textmargin3" style="display:{{$textAttr['istextpadding']==5?'block':'none'}};">
                                    上：(单位px)<input type="text" name="textmargin3" value="{{ $textAttr['textmargin3'] }}">
                                    下：(单位px)<input type="text" name="textmargin4" value="{{ $textAttr['textmargin4'] }}">
                                    <br>
                                    上：(单位px)<input type="text" name="textmargin5" value="{{ $textAttr['textmargin5'] }}">
                                    下：(单位px)<input type="text" name="textmargin6" value="{{ $textAttr['textmargin6'] }}">
                                </div>
                            </div>
                        </div>
                        <script>
                            $(document).ready(function(){
                                var textmargin1 = $("#textmargin1");
                                var textmargin2 = $("#textmargin2");
                                var textmargin3 = $("#textmargin3");
                                $("select[name='istextmargin']").change(function(){
                                    if(this.value<=2){ textmargin1.hide(); textmargin2.hide(); textmargin3.hide(); }
                                    if(this.value==3){ textmargin1.show(); textmargin2.hide(); textmargin3.hide(); }
                                    if(this.value==4){ textmargin1.hide(); textmargin2.show(); textmargin3.hide(); }
                                    if(this.value==5){ textmargin1.hide(); textmargin2.hide(); textmargin3.show(); }
                                });
                            });
                        </script>

                        <div class="am-form-group attrs_text" style="display:{{$textAttr['switch1']==0?'none':'block'}};">
                            <label>内边距 / Padding：(单位px)</label>
                            <div class="admin_border">
                                内边距类型：
                                <select name="istextpadding" required>
                                    @if(count($model['marginTypes']))
                                        @foreach($model['marginTypes'] as $kmarginType=>$marginType)
                                            <option value="{{ $kmarginType }}" {{ $textAttr['istextpadding']==$kmarginType ? 'selected' : '' }}>{{ $marginType }}</option>
                                        @endforeach
                                    @endif
                                </select>
                                <div id="textpadding1" style="display:{{$textAttr['istextpadding']==3?'block':'none'}};">
                                    左右：(单位px)<input type="text" name="textpadding2" value="{{ $textAttr['textpadding2'] }}">
                                </div>
                                <div id="textpadding2" style="display:{{$textAttr['istextpadding']==4?'block':'none'}};">
                                    上下：(单位px)<input type="text" name="textpadding1" value="{{ $textAttr['textpadding1'] }}">
                                </div>
                                <div id="textpadding3" style="display:{{$textAttr['istextpadding']==5?'block':'none'}};">
                                    上：(单位px)<input type="text" name="textpadding3" value="{{ $textAttr['textpadding3'] }}">
                                    下：(单位px)<input type="text" name="textpadding4" value="{{ $textAttr['textpadding4'] }}">
                                    <br>
                                    上：(单位px)<input type="text" name="textpadding5" value="{{ $textAttr['textpadding5'] }}">
                                    下：(单位px)<input type="text" name="textpadding6" value="{{ $textAttr['textpadding6'] }}">
                                </div>
                            </div>
                        </div>

                        <div class="am-form-group attrs_text" style="display:{{$textAttr['switch1']==0?'none':'block'}};">
                            <label>文字颜色 / Color：(点击下面更改颜色)</label>
                            <span style="float:right;">当前颜色预览<div class="admin_yulan2" style="{{$textAttr['textcolor']?'background:'.$textAttr['textcolor']:''}}"></div></span>
                            <input type="color" title="点击更改颜色" name="textcolor" value="{{ $textAttr['textcolor'] }}">
                        </div>
                        <script>
                            $(document).ready(function(){
                                var color = $("input[name='color']");
                                color.change(function(){
                                    $(".admin_yulan2").css('background',this.value);
                                });
                            });
                        </script>

                        <div class="am-form-group attrs_text" style="display:{{$textAttr['switch1']==0?'none':'block'}};">
                            <label>文字尺寸 / Font Size：(单位px)</label>
                            <input type="text" placeholder="单位px" pattern="\d+" name="text_font_size" value="{{ $textAttr['text_font_size'] }}"/>
                        </div>

                        <div class="am-form-group attrs_text" style="display:{{$textAttr['switch1']==0?'none':'block'}};">
                            <label>文字间距 / Word Spacing：(单位px)</label>
                            <input type="text" placeholder="单位px" pattern="\d+" name="text_word_spacing" value="{{ $textAttr['text_word_spacing'] }}"/>
                        </div>

                        <div class="am-form-group attrs_text" style="display:{{$textAttr['switch1']==0?'none':'block'}};">
                            <label>行高 / Line Height：(单位px)</label>
                            <input type="text" placeholder="单位px" pattern="\d+" name="text_line_height" value="{{ $textAttr['text_line_height'] }}"/>
                        </div>

                        {{--<div class="am-form-group attrs_text" style="display:{{$textAttr['switch1']==0?'none':'block'}};">--}}
                            {{--<label>字形变换 / Text Transform：</label>--}}
                            {{--<select name="text_transform">--}}
                                {{--@foreach($model['textTransformTypeNames'] as $ktextTransformType=>$textTransformTypeName)--}}
                                    {{--<option value="{{ $ktextTransformType }}" {{ $textAttr['text_transform']==$ktextTransformType ? 'selected' : '' }}>{{ $textTransformTypeName }}</option>--}}
                                {{--@endforeach--}}
                            {{--</select>--}}
                        {{--</div>--}}

                        {{--<div class="am-form-group attrs_text" style="display:{{$textAttr['switch1']==0?'none':'block'}};">--}}
                            {{--<label>字的水平对齐方式 / Text Align：</label>--}}
                            {{--<select name="text_align">--}}
                                {{--@foreach($model['textAlignTypeNames'] as $ktextAlignType=>$textAlignTypeName)--}}
                                    {{--<option value="{{ $ktextAlignType }}" {{ $textAttr['text_align']==$ktextAlignType ? 'selected' : '' }}>{{ $textAlignTypeName }}</option>--}}
                                {{--@endforeach--}}
                            {{--</select>--}}
                        {{--</div>--}}

                        {{--<div class="am-form-group attrs_text" style="display:{{$textAttr['switch1']==0?'none':'block'}};">--}}
                            {{--<label>背景颜色 / Color：(点击下面更改颜色)</label>--}}
                            {{--<span style="float:right;">当前颜色预览<div class="admin_yulan3" style="{{$textAttr['background']?'background:'.$textAttr['background']:''}}"></div></span>--}}
                            {{--<input type="color" title="点击更改颜色" name="background" value="{{ $textAttr['background'] }}">--}}
                        {{--</div>--}}
                        {{--<script>--}}
                            {{--$(document).ready(function(){--}}
                                {{--var bgcolor = $("input[name='background']");--}}
                                {{--bgcolor.change(function(){--}}
                                    {{--$(".admin_yulan3").css('background',this.value);--}}
                                {{--});--}}
                            {{--});--}}
                        {{--</script>--}}
                        <hr>

                        {{--图片属性--}}
                        <div class="am-form-group">
                            <label>图片样式属性</label>
                            <label><input type="radio" name="switch2" id="close_pic" value="0" {{ $picAttr['switch2']==0 ? 'checked' : '' }}> 关闭&nbsp;&nbsp;</label>
                            <label><input type="radio" name="switch2" id="open_pic" value="1" {{ $picAttr['switch2']==1 ? 'checked' : '' }}> 展开&nbsp;&nbsp;</label>
                        </div>
                        <script>
                            $(document).ready(function(){
                                var open_pic = $("#open_pic");
                                var close_pic = $("#close_pic");
                                var attrs_pic = $(".attrs_pic");
                                open_pic.click(function(){ attrs_pic.show(); });
                                close_pic.click(function(){ attrs_pic.hide(); });
                            });
                        </script>

                        <div class="am-form-group attrs_pic" style="display:{{$picAttr['switch2']==0?'none':'block'}};">
                            <label>外边距 / Margin：(单位px)</label>
                            <div class="admin_border">
                                外边距类型：
                                <select name="ispicmargin">
                                    @foreach($model['marginTypes'] as $kmarginType=>$marginType)
                                        <option value="{{ $kmarginType }}" {{ $picAttr['ispicmargin']==$kmarginType ? 'selected' : '' }}>{{ $marginType }}</option>
                                    @endforeach
                                </select>
                                <div id="picmargin1" style="display:{{$picAttr['ispicmargin']==3?'block':'none'}};">
                                    左右：(单位px)<input type="pic" name="picmargin2" value="{{ $picAttr['picmargin2'] }}">
                                </div>
                                <div id="picmargin2" style="display:{{$picAttr['ispicmargin']==4?'block':'none'}};">
                                    上下：(单位px)<input type="pic" name="picmargin1" value="{{ $picAttr['picmargin1'] }}">
                                </div>
                                <div id="picmargin3" style="display:{{$picAttr['ispicmargin']==5?'block':'none'}};">
                                    上：(单位px)<input type="pic" name="picmargin3" value="{{ $picAttr['picmargin3'] }}">
                                    下：(单位px)<input type="pic" name="picmargin4" value="{{ $picAttr['picmargin4'] }}">
                                    <br>
                                    上：(单位px)<input type="pic" name="picmargin5" value="{{ $picAttr['picmargin5'] }}">
                                    下：(单位px)<input type="pic" name="picmargin6" value="{{ $picAttr['picmargin6'] }}">
                                </div>
                            </div>
                        </div>
                        <script>
                            $(document).ready(function(){
                                var picmargin1 = $("#picmargin1");
                                var picmargin2 = $("#picmargin2");
                                var picmargin3 = $("#picmargin3");
                                $("select[name='ispicmargin']").change(function(){
                                    if(this.value<=2){ picmargin1.hide(); picmargin2.hide(); picmargin3.hide(); }
                                    if(this.value==3){ picmargin1.show(); picmargin2.hide(); picmargin3.hide(); }
                                    if(this.value==4){ picmargin1.hide(); picmargin2.show(); picmargin3.hide(); }
                                    if(this.value==5){ picmargin1.hide(); picmargin2.hide(); picmargin3.show(); }
                                });
                            });
                        </script>

                        <div class="am-form-group attrs_pic" style="display:{{$picAttr['switch2']==0?'none':'block'}};">
                            <label>内边距 / Padding：(单位px)</label>
                            <div class="admin_border">
                                内边距类型：
                                <select name="ispicpadding">
                                    @if(count($model['marginTypes']))
                                        @foreach($model['marginTypes'] as $kmarginType=>$marginType)
                                            <option value="{{ $kmarginType }}">{{ $marginType }}</option>
                                        @endforeach
                                    @endif
                                </select>
                                <div id="picpadding1" style="display:{{$picAttr['ispicpadding']==3?'block':'none'}};">
                                    左右：(单位px)<input type="pic" name="picpadding2" value="{{ $picAttr['picpadding2'] }}">
                                </div>
                                <div id="picpadding2" style="display:{{$picAttr['ispicpadding']==4?'block':'none'}};">
                                    上下：(单位px)<input type="pic" name="picpadding1" value="{{ $picAttr['picpadding1'] }}">
                                </div>
                                <div id="picpadding3" style="display:{{$picAttr['ispicpadding']==5?'block':'none'}};">
                                    上：(单位px)<input type="pic" name="picpadding3" value="{{ $picAttr['picpadding3'] }}">
                                    下：(单位px)<input type="pic" name="picpadding4" value="{{ $picAttr['picpadding4'] }}">
                                    <br>
                                    上：(单位px)<input type="pic" name="picpadding5" value="{{ $picAttr['picpadding5'] }}">
                                    下：(单位px)<input type="pic" name="picpadding6" value="{{ $picAttr['picpadding6'] }}">
                                </div>
                            </div>
                        </div>
                        <script>
                            $(document).ready(function(){
                                var picpadding1 = $("#picpadding1");
                                var picpadding2 = $("#picpadding2");
                                var picpadding3 = $("#picpadding3");
                                $("select[name='ispicpadding']").change(function(){
                                    if(this.value<=2){ picpadding1.hide(); picpadding2.hide(); picpadding3.hide(); }
                                    if(this.value==3){ picpadding1.show(); picpadding2.hide(); picpadding3.hide(); }
                                    if(this.value==4){ picpadding1.hide(); picpadding2.show(); picpadding3.hide(); }
                                    if(this.value==5){ picpadding1.hide(); picpadding2.hide(); picpadding3.show(); }
                                });
                            });
                        </script>

                        <div class="am-form-group attrs_pic" style="display:{{$picAttr['switch2']==0?'none':'block'}};">
                            <label>边框 / Border：</label>
                            <div class="admin_border">
                                边框方向：
                                <select name="picborder1">
                                    @foreach($model['borderDirectionNames'] as $kborderDirection=>$borderDirectionName)
                                        <option value="{{ $kborderDirection }}" {{ $picAttr['picborder1']==$kborderDirection ? 'selected' : '' }}>{{ $borderDirectionName }}</option>
                                    @endforeach
                                </select>
                                <div style="height:5px;">{{--间距--}}</div>
                                边框宽度：<input type="text" placeholder="边框宽度，单位px" pattern="\d+" name="picborder2" value="{{ $picAttr['picborder2'] }}"/>
                                <div style="height:5px;">{{--间距--}}</div>
                                边框类型：
                                <select name="picborder3">
                                    @foreach($model['borderTypeNames'] as $kborder=>$borderTypeName)
                                        <option value="{{ $kborder }}" {{ $picAttr['picborder3']==$kborder ? 'selected' : '' }}>{{ $borderTypeName }}</option>
                                    @endforeach
                                </select>
                                <div style="height:5px;">{{--间距--}}</div>
                                边框颜色：(点击下面更改颜色)
                                <span style="float:right;">当前颜色预览<div class="admin_yulan4" style="{{$picAttr['picborder4']?'background'.$picAttr['picborder4']:''}}"></div></span>
                                <input type="color" title="点击更改颜色" name="picborder4" value="{{ $picAttr['picborder4'] }}">
                            </div>
                        </div>
                        <script>
                            $(document).ready(function(){
                                var picborder4 = $("input[name='picborder4']");
                                picborder4.change(function(){
                                    $(".admin_yulan4").css('background',this.value);
                                });
                            });
                        </script>

                        <div class="am-form-group attrs_pic" style="display:{{$picAttr['switch2']==0?'none':'block'}};">
                            <label>宽度 / Width：(单位px)</label>
                            <input type="text" placeholder="" pattern="\d+" name="picwidth" value="{{ $picAttr['picwidth'] }}"/>
                        </div>

                        <div class="am-form-group attrs_pic" style="display:{{$picAttr['switch2']==0?'none':'block'}};">
                            <label>高度 / Height：(单位px)</label>
                            <input type="text" placeholder="" pattern="\d+" name="picheight" value="{{ $picAttr['picheight'] }}"/>
                        </div>

                        <button type="submit" class="am-btn am-btn-primary">保存修改</button>
                    </fieldset>
                </form>
            </div>
        </div>
    </div>
@stop