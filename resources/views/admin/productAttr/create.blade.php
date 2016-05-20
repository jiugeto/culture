@extends('admin.main')
@section('content')
    <style>
        a#open,a#close,a#open_text,a#close_text,a#open_pic,a#close_pic { padding:2px 10px;border:1px solid gainsboro;cursor:pointer; }
    </style>
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
                <form class="am-form" data-am-validator method="POST" action="/admin/productattr" enctype="multipart/form-data">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <fieldset>
                        <div class="am-form-group">
                            <label>名称 / Name：</label>
                            <input type="text" placeholder="至少2个字符" minlength="2" required name="name"/>
                        </div>

                        <div class="am-form-group">
                            <label>类样式名称 / Name：</label>
                            <input type="text" placeholder="至少2个字符，英文、拼音、字母或数字组合" pattern="^[a-zA-Z0-9_-]+$" required name="style_name"/>
                        </div>

                        <div class="am-form-group">
                            <label>产品名称 / Name：</label>
                            <select name="productid">
                            @if($model->productAll())
                                @foreach($model->productAll() as $product)
                                    <option value="{{ $product->id }}">{{ $product->name }}</option>
                                @endforeach
                            @endif
                            </select>
                        </div>

                        <div class="am-form-group">
                            <label>简介 / Introduce：</label>
                            <textarea name="intro" cols="50" rows="5"></textarea>
                        </div>

                        {{--总的样式属性--}}
                        <div class="am-form-group">
                            <label>总的样式属性
                                {{--<a id="open">展开</a><a id="close" style="display:none;">关闭</a>--}}
                            </label>
                            <label><input type="radio" name="switch0" id="open" value="0"> 展开&nbsp;&nbsp;</label>
                            <label><input type="radio" name="switch0" id="close" value="1" checked> 关闭&nbsp;&nbsp;</label>
                        </div>
                        <script>
                            $(document).ready(function(){
                                var open = $("#open");
                                var close = $("#close");
                                var attrs = $(".attrs");
                                open.click(function(){ /*open.hide(); close.show();*/ attrs.show(); });
                                close.click(function(){ /*close.hide(); open.show();*/ attrs.hide(); });
                            });
                        </script>

                        <div class="am-form-group attrs" style="display:none;">
                            <label>外边距 / Margin：(单位px)</label>
                            <div class="admin_border">
                                外边距类型：
                                <select name="ismargin">
                                    @foreach($model['marginTypes'] as $kmarginType=>$marginType)
                                        <option value="{{ $kmarginType }}">{{ $marginType }}</option>
                                    @endforeach
                                </select>
                                <div id="margin1" style="display:none;">
                                    左右：(单位px)<input type="text" name="margin2">
                                </div>
                                <div id="margin2" style="display:none;">
                                    上下：(单位px)<input type="text" name="margin1">
                                </div>
                                <div id="margin3" style="display:none;">
                                    上：(单位px)<input type="text" name="margin3">
                                    下：(单位px)<input type="text" name="margin4">
                                    <br>
                                    上：(单位px)<input type="text" name="margin5">
                                    下：(单位px)<input type="text" name="margin6">
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

                        <div class="am-form-group attrs" style="display:none;">
                            <label>内边距 / Padding：(单位px)</label>
                            <div class="admin_border">
                                内边距类型：
                                <select name="ispadding" required>
                                    @if(count($model['marginTypes']))
                                        @foreach($model['marginTypes'] as $kmarginType=>$marginType)
                                            <option value="{{ $kmarginType }}">{{ $marginType }}</option>
                                        @endforeach
                                    @endif
                                </select>
                                <div id="padding1" style="display:none;">
                                    左右：(单位px)<input type="text" name="padding2">
                                </div>
                                <div id="padding2" style="display:none;">
                                    上下：(单位px)<input type="text" name="padding1">
                                </div>
                                <div id="padding3" style="display:none;">
                                    上：(单位px)<input type="text" name="padding3">
                                    下：(单位px)<input type="text" name="padding4">
                                    <br>
                                    上：(单位px)<input type="text" name="padding5">
                                    下：(单位px)<input type="text" name="padding6">
                                </div>
                            </div>
                        </div>

                        <div class="am-form-group attrs" style="display:none;">
                            <label>宽度 / Width：(单位px)</label>
                            <input type="text" placeholder="" pattern="\d+" name="width"/>
                        </div>

                        <div class="am-form-group attrs" style="display:none;">
                            <label>高度 / Height：(单位px)</label>
                            <input type="text" placeholder="" pattern="\d+" name="height"/>
                        </div>

                        <div class="am-form-group attrs" style="display:none;">
                            <label>边框 / Border：</label>
                            <div class="admin_border">
                                边框方向：
                                <select name="border1">
                                    @foreach($model['borderDirectionNames'] as $kborderDirection=>$borderDirectionName)
                                    <option value="{{ $kborderDirection }}">{{ $borderDirectionName }}</option>
                                    @endforeach
                                </select>
                                <div style="height:5px;">{{--间距--}}</div>
                                边框宽度：<input type="text" placeholder="边框宽度，单位px" pattern="\d+" name="border2"/>
                                <div style="height:5px;">{{--间距--}}</div>
                                边框类型：
                                <select name="border3">
                                    @foreach($model['borderTypeNames'] as $kborder=>$borderTypeName)
                                        <option value="{{ $kborder }}">{{ $borderTypeName }}</option>
                                    @endforeach
                                </select>
                                <div style="height:5px;">{{--间距--}}</div>
                                边框颜色：(点击下面更改颜色)
                                <span style="float:right;">当前颜色预览<div class="admin_yulan"></div></span>
                                <input type="color" title="点击更改颜色" name="border4">
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

                        <div class="am-form-group attrs" style="display:none;">
                            <label>定位方式 / Position：</label>
                            <div class="admin_border">
                                <select name="position">
                                    @foreach($model['positionTypeNames'] as $kpositionType=>$positionTypeName)
                                        <option value="{{ $kpositionType }}">{{ $positionTypeName }}</option>
                                    @endforeach
                                </select>
                                <span id="locate" style="display:none;">
                                    左边距离：(定位px)
                                    <input type="text" placeholder="单位px" pattern="\d+" name="left" value="0"/>
                                    顶部距离：(定位px)
                                    <input type="text" placeholder="单位px" pattern="\d+" name="top" value="0"/>
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

                        <div class="am-form-group attrs" style="display:none;">
                            <label>溢出方式 / Overflow：</label>
                            <select name="overflow">
                                @foreach($model['overflowTypeNames'] as $koverflowType=>$overflowTypeName)
                                    <option value="{{ $koverflowType }}">{{ $overflowTypeName }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="am-form-group attrs" style="display:none;">
                            <label>透明度 / Opacity：</label>
                            <input type="text" placeholder="单位%" pattern="\d+" name="opacity"/>
                        </div>
                        <hr>

                        {{--文字属性--}}
                        <div class="am-form-group">
                            <label>文字样式属性
                                {{--<a id="open_text">展开</a><a id="close_text" style="display:none;">关闭</a>--}}
                            </label>
                            <label><input type="radio" name="switch1" id="open_text" value="0"> 展开&nbsp;&nbsp;</label>
                            <label><input type="radio" name="switch1" id="close_text" value="1" checked> 关闭&nbsp;&nbsp;</label>
                        </div>
                        <script>
                            $(document).ready(function(){
                                var open_text = $("#open_text");
                                var close_text = $("#close_text");
                                var attrs_text = $(".attrs_text");
                                open_text.click(function(){ /*open_text.hide(); close_text.show();*/ attrs_text.show(); });
                                close_text.click(function(){ /*close_text.hide(); open_text.show();*/ attrs_text.hide(); });
                            });
                        </script>

                        <div class="am-form-group attrs_text" style="display:none;">
                            <label>外边距 / Margin：(单位px)</label>
                            <div class="admin_border">
                                外边距类型：
                                <select name="istextmargin">
                                    @foreach($model['marginTypes'] as $kmarginType=>$marginType)
                                        <option value="{{ $kmarginType }}">{{ $marginType }}</option>
                                    @endforeach
                                </select>
                                <div id="textmargin1" style="display:none;">
                                    左右：(单位px)<input type="text" name="textmargin2">
                                </div>
                                <div id="textmargin2" style="display:none;">
                                    上下：(单位px)<input type="text" name="textmargin1">
                                </div>
                                <div id="textmargin3" style="display:none;">
                                    上：(单位px)<input type="text" name="textmargin3">
                                    下：(单位px)<input type="text" name="textmargin4">
                                    <br>
                                    上：(单位px)<input type="text" name="textmargin5">
                                    下：(单位px)<input type="text" name="textmargin6">
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

                        <div class="am-form-group attrs_text" style="display:none;">
                            <label>内边距 / Padding：(单位px)</label>
                            <div class="admin_border">
                                内边距类型：
                                <select name="istextpadding" required>
                                    @if(count($model['marginTypes']))
                                        @foreach($model['marginTypes'] as $kmarginType=>$marginType)
                                            <option value="{{ $kmarginType }}">{{ $marginType }}</option>
                                        @endforeach
                                    @endif
                                </select>
                                <div id="textpadding1" style="display:none;">
                                    左右：(单位px)<input type="text" name="textpadding2">
                                </div>
                                <div id="textpadding2" style="display:none;">
                                    上下：(单位px)<input type="text" name="textpadding1">
                                </div>
                                <div id="textpadding3" style="display:none;">
                                    上：(单位px)<input type="text" name="textpadding3">
                                    下：(单位px)<input type="text" name="textpadding4">
                                    <br>
                                    上：(单位px)<input type="text" name="textpadding5">
                                    下：(单位px)<input type="text" name="textpadding6">
                                </div>
                            </div>
                        </div>

                        <div class="am-form-group attrs_text" style="display:none;">
                            <label>文字颜色 / Color：(点击下面更改颜色)</label>
                            <span style="float:right;">当前颜色预览<div class="admin_yulan2"></div></span>
                            <input type="color" title="点击更改颜色" name="textcolor">
                        </div>
                        <script>
                            $(document).ready(function(){
                                var color = $("input[name='color']");
                                color.change(function(){
                                    $(".admin_yulan2").css('background',this.value);
                                });
                            });
                        </script>

                        <div class="am-form-group attrs_text" style="display:none;">
                            <label>文字尺寸 / Font Size：(单位px)</label>
                            <input type="text" placeholder="单位px" pattern="\d+" name="font_size"/>
                        </div>

                        <div class="am-form-group attrs_text" style="display:none;">
                            <label>文字间距 / Word Spacing：(单位px)</label>
                            <input type="text" placeholder="单位px" pattern="\d+" name="word_spacing"/>
                        </div>

                        <div class="am-form-group attrs_text" style="display:none;">
                            <label>行高 / Line Height：(单位px)</label>
                            <input type="text" placeholder="单位px" pattern="\d+" name="line_height"/>
                        </div>

                        <div class="am-form-group attrs_text" style="display:none;">
                            <label>字形变换 / Text Transform：</label>
                            <select name="text_transform">
                                @foreach($model['textTransformTypeNames'] as $ktextTransformType=>$textTransformTypeName)
                                    <option value="{{ $ktextTransformType }}">{{ $textTransformTypeName }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="am-form-group attrs_text" style="display:none;">
                            <label>字的水平对齐方式 / Text Align：</label>
                            <select name="text_align">
                                @foreach($model['textAlignTypeNames'] as $ktextAlignType=>$textAlignTypeName)
                                    <option value="{{ $ktextAlignType }}">{{ $textAlignTypeName }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="am-form-group attrs_text" style="display:none;">
                            <label>背景颜色 / Color：(点击下面更改颜色)</label>
                            <span style="float:right;">当前颜色预览<div class="admin_yulan3"></div></span>
                            <input type="color" title="点击更改颜色" name="background">
                        </div>
                        <script>
                            $(document).ready(function(){
                                var bgcolor = $("input[name='background']");
                                bgcolor.change(function(){
                                    $(".admin_yulan3").css('background',this.value);
                                });
                            });
                        </script>
                        <hr>

                        {{--图片属性--}}
                        <div class="am-form-group">
                            <label>图片样式属性
                                {{--<a id="open_pic">展开</a><a id="close_pic" style="display:none;">关闭</a>--}}
                            </label>
                            <label><input type="radio" name="switch2" id="open_pic" value="0"> 展开&nbsp;&nbsp;</label>
                            <label><input type="radio" name="switch2" id="close_pic" value="1" checked> 关闭&nbsp;&nbsp;</label>
                        </div>
                        <script>
                            $(document).ready(function(){
                                var open_pic = $("#open_pic");
                                var close_pic = $("#close_pic");
                                var attrs_pic = $(".attrs_pic");
                                open_pic.click(function(){ /*open_pic.hide(); close_pic.show();*/ attrs_pic.show(); });
                                close_pic.click(function(){ /*close_pic.hide(); open_pic.show();*/ attrs_pic.hide(); });
                            });
                        </script>

                        <div class="am-form-group attrs_pic" style="display:none;">
                            <label>外边距 / Margin：(单位px)</label>
                            <div class="admin_border">
                                外边距类型：
                                <select name="ispicmargin">
                                    @foreach($model['marginTypes'] as $kmarginType=>$marginType)
                                        <option value="{{ $kmarginType }}">{{ $marginType }}</option>
                                    @endforeach
                                </select>
                                <div id="picmargin1" style="display:none;">
                                    左右：(单位px)<input type="pic" name="picmargin2">
                                </div>
                                <div id="picmargin2" style="display:none;">
                                    上下：(单位px)<input type="pic" name="picmargin1">
                                </div>
                                <div id="picmargin3" style="display:none;">
                                    上：(单位px)<input type="pic" name="picmargin3">
                                    下：(单位px)<input type="pic" name="picmargin4">
                                    <br>
                                    上：(单位px)<input type="pic" name="picmargin5">
                                    下：(单位px)<input type="pic" name="picmargin6">
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

                        <div class="am-form-group attrs_pic" style="display:none;">
                            <label>内边距 / Padding：(单位px)</label>
                            <div class="admin_border">
                                内边距类型：
                                <select name="ispicpadding" required>
                                    @if(count($model['marginTypes']))
                                        @foreach($model['marginTypes'] as $kmarginType=>$marginType)
                                            <option value="{{ $kmarginType }}">{{ $marginType }}</option>
                                        @endforeach
                                    @endif
                                </select>
                                <div id="picpadding1" style="display:none;">
                                    左右：(单位px)<input type="pic" name="picpadding2">
                                </div>
                                <div id="picpadding2" style="display:none;">
                                    上下：(单位px)<input type="pic" name="picpadding1">
                                </div>
                                <div id="picpadding3" style="display:none;">
                                    上：(单位px)<input type="pic" name="picpadding3">
                                    下：(单位px)<input type="pic" name="picpadding4">
                                    <br>
                                    上：(单位px)<input type="pic" name="picpadding5">
                                    下：(单位px)<input type="pic" name="picpadding6">
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

                        <div class="am-form-group attrs_pic" style="display:none;">
                            <label>边框 / Border：</label>
                            <div class="admin_border">
                                边框方向：
                                <select name="picborder1">
                                    @foreach($model['borderDirectionNames'] as $kborderDirection=>$borderDirectionName)
                                        <option value="{{ $kborderDirection }}">{{ $borderDirectionName }}</option>
                                    @endforeach
                                </select>
                                <div style="height:5px;">{{--间距--}}</div>
                                边框宽度：<input type="text" placeholder="边框宽度，单位px" pattern="\d+" name="picborder2"/>
                                <div style="height:5px;">{{--间距--}}</div>
                                边框类型：
                                <select name="picborder3">
                                    @foreach($model['borderTypeNames'] as $kborder=>$borderTypeName)
                                        <option value="{{ $kborder }}">{{ $borderTypeName }}</option>
                                    @endforeach
                                </select>
                                <div style="height:5px;">{{--间距--}}</div>
                                边框颜色：(点击下面更改颜色)
                                <span style="float:right;">当前颜色预览<div class="admin_yulan4"></div></span>
                                <input type="color" title="点击更改颜色" name="picborder4">
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

                        <div class="am-form-group attrs_pic" style="display:none;">
                            <label>宽度 / Width：(单位px)</label>
                            <input type="text" placeholder="" pattern="\d+" name="picwidth"/>
                        </div>

                        <div class="am-form-group attrs_pic" style="display:none;">
                            <label>高度 / Height：(单位px)</label>
                            <input type="text" placeholder="" pattern="\d+" name="picheight"/>
                        </div>

                        <button type="submit" class="am-btn am-btn-primary">保存添加</button>
                    </fieldset>
                </form>
            </div>
        </div>
    </div>
@stop