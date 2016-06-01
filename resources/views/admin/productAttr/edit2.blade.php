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
                <form class="am-form" data-am-validator method="POST" action="/admin/productattr/{{ $data->id }}/update{{ $index }}" enctype="multipart/form-data">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <input type="hidden" name="_method" value="POST">
                    <input type="hidden" name="index" value="{{ $index }}">
                    <fieldset>
                        {{--总的样式属性--}}
                        <div class="am-form-group">
                            <label>二级样式</label>
                        </div>

                        <div class="am-form-group">
                            <label>样式开关：</label>
                            <label><input type="radio" class="radio" name="switch" value="0" {{ !$attrs['switch'] ? 'checked' : '' }}> 不启用&nbsp;&nbsp;&nbsp;</label>
                            <label><input type="radio" class="radio" name="switch" value="1" {{ $attrs['switch'] ? 'checked' : '' }}> 启用&nbsp;&nbsp;&nbsp;</label>
                        </div>
                        <script>
                            $(document).ready(function(){
                                $("input[name='switch']").click(function(){
                                    if(this.value==0){ $("#attrs").hide(); }
                                    else { $("#attrs").show(); }
                                });
                            });
                        </script>

                    <span id="attrs" style="display:{{$attrs['switch']?'block':'none'}};">
                        <div class="am-form-group">
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

                        <div class="am-form-group">
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
                                    左：(单位px)<input type="text" name="padding5" value="{{ $attrs['padding5'] }}">
                                    右：(单位px)<input type="text" name="padding6" value="{{ $attrs['padding6'] }}">
                                </div>
                            </div>
                        </div>
                        <script>
                            $(document).ready(function(){
                                var padding1 = $("#padding1");
                                var padding2 = $("#padding2");
                                var padding3 = $("#padding3");
                                $("select[name='ispadding']").change(function(){
                                    if(this.value<=2){ padding1.hide(); padding2.hide(); padding3.hide(); }
                                    if(this.value==3){ padding1.show(); padding2.hide(); padding3.hide(); }
                                    if(this.value==4){ padding1.hide(); padding2.show(); padding3.hide(); }
                                    if(this.value==5){ padding1.hide(); padding2.hide(); padding3.show(); }
                                });
                            });
                        </script>

                        <div class="am-form-group">
                            <label>宽度 / Width：(单位px)</label>
                            <input type="text" placeholder="" pattern="\d+" name="width" value="{{ $attrs['width'] }}"/>
                        </div>

                        <div class="am-form-group">
                            <label>高度 / Height：(单位px)</label>
                            <input type="text" placeholder="" pattern="\d+" name="height" value="{{ $attrs['height'] }}"/>
                        </div>

                        <div class="am-form-group">
                            <label>边框 / Border：</label>
                            <div class="admin_border">
                                边框方向：
                                <select name="border1">
                                    @foreach($model['borderDirectionNames'] as $kborderDirection=>$borderDirectionName)
                                    <option value="{{ $kborderDirection }}" {{ $attrs['border1']==$kborderDirection ? 'selected' : '' }}>{{ $borderDirectionName }}</option>
                                    @endforeach
                                </select>
                                <span id="border_con" style="display:{{$attrs['border1']?'block':'none'}};">
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
                                </span>
                            </div>
                        </div>
                        <script>
                            $(document).ready(function(){
                                var border_con = $("#border_con");
                                var color = $("input[name='border4']");
                                $("select[name='border1']").change(function(){
                                    if(this.value){ border_con.show(); }
                                    else{ border_con.hide(); }
                                });
                                color.change(function(){
                                    $(".admin_yulan").css('background',this.value);
                                });
                            });
                        </script>

                        <div class="am-form-group">
                            <label>溢出方式 / Overflow：</label>
                            <select name="overflow">
                                @foreach($model['overflowTypeNames'] as $koverflowType=>$overflowTypeName)
                                    <option value="{{ $koverflowType }}" {{ $attrs['overflow']==$koverflowType ? 'selected' : '' }}>{{ $overflowTypeName }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="am-form-group">
                            <label>透明度 / Opacity：</label>
                            <input type="text" placeholder="单位%" pattern="\d+" name="opacity" value="{{ $attrs['opacity'] }}"/>
                        </div>
                        <hr>

                        @if(in_array($index,[2,3,5]))
                        <div class="am-form-group">
                            <label>文字颜色 / Color：(点击下面更改颜色)</label>
                            <br>
                            <label><input type="radio" class="radio" name="iscolor" value="0" {{ !$attrs['iscolor'] ? 'checked' : '' }}> 无&nbsp;&nbsp;</label>
                            <label><input type="radio" class="radio" name="iscolor" value="1" {{ $attrs['iscolor'] ? 'checked' : '' }}> 有&nbsp;&nbsp;</label>
                            <span style="float:right;display:{{$attrs['iscolor']?'block':'none'}};" id="color">当前颜色预览<div class="admin_yulan2" style="{{$attrs['color']?'background:'.$attrs['color'].'':''}}"></div></span>
                            <input type="color" title="点击更改颜色" style="display:{{$attrs['iscolor']?'block':'none'}};" name="color" value="{{ $attrs['color'] }}">
                        </div>
                        <script>
                            $(document).ready(function(){
                                var iscolor = $("input[name='iscolor']");
                                var color = $("input[name='color']");
                                iscolor.click(function(){
                                    if(this.value==0){ $("#color").hide(); color.hide(); }
                                    else{ $("#color").show(); color.show(); }
                                });
                                color.change(function(){
                                    $(".admin_yulan2").css('background',this.value);
                                });
                            });
                        </script>

                        <div class="am-form-group">
                            <label>文字尺寸 / Font Size：(单位px)</label>
                            <input type="text" placeholder="单位px" pattern="\d+" name="font_size" value="{{ $attrs['font_size'] }}"/>
                        </div>

                        <div class="am-form-group">
                            <label>文字间距 / Word Spacing：(单位px)</label>
                            <input type="text" placeholder="单位px" pattern="\d+" name="word_spacing" value="{{ $attrs['word_spacing'] }}"/>
                        </div>

                        <div class="am-form-group">
                            <label>行高 / Line Height：(单位px)</label>
                            <input type="text" placeholder="单位px" pattern="\d+" name="line_height" value="{{ $attrs['line_height'] }}"/>
                        </div>

                        <div class="am-form-group">
                            <label>字形变换 / Text Transform：</label>
                            <select name="text_transform">
                                @foreach($model['textTransformTypeNames'] as $ktextTransformType=>$textTransformTypeName)
                                    <option value="{{ $ktextTransformType }}" {{ $attrs['text_transform']==$ktextTransformType ? 'selected' : '' }}>{{ $textTransformTypeName }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="am-form-group">
                            <label>字的水平对齐方式 / Text Align：</label>
                            <select name="text_align">
                                @foreach($model['textAlignTypeNames'] as $ktextAlignType=>$textAlignTypeName)
                                    <option value="{{ $ktextAlignType }}" {{ $attrs['text_align']==$ktextAlignType ? 'selected' : '' }}>{{ $textAlignTypeName }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="am-form-group">
                            <label>背景颜色 / Color：(点击下面更改颜色)</label>
                            <br>
                            <label><input type="radio" class="radio" name="isbackground" value="0" {{ !$attrs['isbackground'] ? 'checked' : '' }}> 无&nbsp;&nbsp;</label>
                            <label><input type="radio" class="radio" name="isbackground" value="1" {{ $attrs['isbackground'] ? 'checked' : '' }}> 有&nbsp;&nbsp;</label>
                            <span style="float:right;display:{{$attrs['isbackground']?'block':'none'}};" id="background">当前颜色预览<div class="admin_yulan3" style="{{$attrs['background']?'background:'.$attrs['background']:''}}"></div></span>
                            <input type="color" title="点击更改颜色" style="display:{{$attrs['isbackground']?'block':'none'}};" name="background" value="{{ $attrs['background'] }}">
                        </div>
                        <script>
                            $(document).ready(function(){
                                var isbackground = $("input[name=isbackground]");
                                var bgcolor = $("input[name='background']");
                                isbackground.click(function(){
                                    if(this.value==0){ $("#background").hide(); bgcolor.hide(); }
                                    else{ $("#background").show(); bgcolor.show(); }
                                });
                                bgcolor.change(function(){
                                    $(".admin_yulan3").css('background',this.value);
                                });
                            });
                        </script>

                        <div class="am-form-group">
                            <label>定位方式 / Position：</label>
                            <div class="admin_border">
                                <select name="position">
                                    @foreach($model['positionTypeNames'] as $kpositionType=>$positionTypeName)
                                        <option value="{{ $kpositionType }}" {{ $attrs['position']==$kpositionType ? 'selected' : '' }}>{{ $positionTypeName }}</option>
                                    @endforeach
                                </select>
                            <span id="locate" style="display:{{$attrs['position']?'block':'none'}};">
                                左边距离：(定位px)
                                <input type="text" placeholder="单位px" pattern="(\d+)|(-[0-9]+)" name="left" value="{{ $attrs['left'] }}"/>
                                顶部距离：(定位px)
                                <input type="text" placeholder="单位px" pattern="(\d+)|(-[0-9]+)" name="top" value="{{ $attrs['top'] }}"/>
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

                        <div class="am-form-group">
                            <label>浮动方式 / Float：</label>
                            <select name="float">
                                @foreach($model['floatTypeNames'] as $kfloatType=>$floatTypeName)
                                    <option value="{{ $kfloatType }}" @if($attrs['float']){{ $attrs['float']==$kfloatType ? 'selected' : '' }}@endif>{{ $floatTypeName }}</option>
                                @endforeach
                            </select>
                        </div>
                        @endif
                    </span>

                        <button type="submit" class="am-btn am-btn-primary">保存修改</button>
                    </fieldset>
                </form>
            </div>
        </div>
    </div>
@stop