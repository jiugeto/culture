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
                            <label>外边距 / Margin：(单位px)</label>
                            <div class="admin_border">
                                <input type="text" placeholder="上下间距，不填空着代表自动" pattern="\d+" name="margin1" value="{{ $data->margin1 }}"/>
                                <div style="height:5px;">{{--间距--}}</div>
                                <input type="text" placeholder="左右间距，不填空着代表自动" pattern="\d+" name="margin1" value="{{ $data->margin2 }}"/>
                            </div>
                        </div>

                        <div class="am-form-group">
                            <label>内边距 / Padding：(单位px)</label>
                            <div class="admin_border">
                                <input type="text" placeholder="上下间距，不填空着代表自动" pattern="\d+" name="padding1" value="{{ $data->padding1 }}"/>
                                <div style="height:5px;">{{--间距--}}</div>
                                <input type="text" placeholder="左右间距，不填空着代表自动" pattern="\d+" name="padding1" value="{{ $data->padding2 }}"/>
                            </div>
                        </div>

                        <div class="am-form-group">
                            <label>宽度 / Width：(单位px)</label>
                            <input type="text" placeholder="" pattern="\d+" name="width" value="{{ $data->width }}"/>
                        </div>

                        <div class="am-form-group">
                            <label>高度 / Height：(单位px)</label>
                            <input type="text" placeholder="" pattern="\d+" name="height" value="{{ $data->height }}"/>
                        </div>

                        <div class="am-form-group">
                            <label>边框 / Border：</label>
                            <div class="admin_border">
                                边框方向：
                                <select name="border1">
                                    @foreach($model['borderDirectionNames'] as $kborderDirection=>$borderDirectionName)
                                    <option value="{{ $kborderDirection }}" {{ $data->border1==$kborderDirection ? 'selected' : '' }}>{{ $borderDirectionName }}</option>
                                    @endforeach
                                </select>
                                <div style="height:5px;">{{--间距--}}</div>
                                边框宽度：<input type="text" placeholder="边框宽度，单位px" pattern="\d+" name="border2" value="{{ $data->border2 }}"/>
                                <div style="height:5px;">{{--间距--}}</div>
                                边框类型：
                                <select name="border3">
                                    @foreach($model['borderTypeNames'] as $kborder=>$borderTypeName)
                                        <option value="{{ $kborder }}" {{ $data->border3==$kborder ? 'selected' : '' }}>{{ $borderTypeName }}</option>
                                    @endforeach
                                </select>
                                <div style="height:5px;">{{--间距--}}</div>
                                边框颜色：(点击下面更改颜色)
                                <span style="float:right;">当前颜色预览<div class="admin_yulan" style="{{ $data->border4?'background:'.$data->border4:'' }}"></div></span>
                                <input type="color" title="点击更改颜色" name="border4" value="{{ $data->border4 }}">
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

                        <div class="am-form-group">
                            <label>文字颜色 / Color：(点击下面更改颜色)</label>
                            <span style="float:right;">当前颜色预览<div class="admin_yulan" style="{{ $data->color?'background:'.$data->color:'' }}"></div></span>
                            <input type="color" title="点击更改颜色" name="color" value="{{ $data->color }}">
                        </div>

                        <div class="am-form-group">
                            <label>文字尺寸 / Font Size：(单位px)</label>
                            <input type="text" placeholder="单位px" pattern="\d+" name="font_size" value="{{ $data->font_size }}"/>
                        </div>

                        <div class="am-form-group">
                            <label>文字间距 / Word Spacing：(单位px)</label>
                            <input type="text" placeholder="单位px" pattern="\d+" name="word_spacing" value="{{ $data->word_spacing }}"/>
                        </div>

                        <div class="am-form-group">
                            <label>行高 / Line Height：(单位px)</label>
                            <input type="text" placeholder="单位px" pattern="\d+" name="line_height" value="{{ $data->line_height }}"/>
                        </div>

                        <div class="am-form-group">
                            <label>字形变换 / Text Transform：</label>
                            <select name="text_transform">
                                @foreach($model['textTransformTypeNames'] as $ktextTransformType=>$textTransformTypeName)
                                    <option value="{{ $ktextTransformType }}" {{ $data->text_transform==$ktextTransformType ? 'selected' : '' }}>{{ $textTransformTypeName }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="am-form-group">
                            <label>字的水平对齐方式 / Text Align：</label>
                            <select name="text_align">
                                @foreach($model['textAlignTypeNames'] as $ktextAlignType=>$textAlignTypeName)
                                    <option value="{{ $ktextAlignType }}" {{ $data->text_align==$ktextAlignType ? 'selected' : '' }}>{{ $textAlignTypeName }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="am-form-group">
                            <label>背景颜色 / Color：(点击下面更改颜色)</label>
                            <span style="float:right;">当前颜色预览<div class="admin_yulan2"></div></span>
                            <input type="color" title="点击更改颜色" name="background">
                        </div>
                        <script>
                            $(document).ready(function(){
                                var bgcolor = $("input[name='background']");
                                bgcolor.change(function(){
                                    $(".admin_yulan2").css('background',this.value);
                                });
                            });
                        </script>

                        <div class="am-form-group">
                            <label>定位方式 / Position：</label>
                            <div class="admin_border">
                                <select name="position">
                                    @foreach($model['positionTypeNames'] as $kpositionType=>$positionTypeName)
                                        <option value="{{ $kpositionType }}" {{ $data->position==$kpositionType ? 'selected' : '' }}>{{ $positionTypeName }}</option>
                                    @endforeach
                                </select>
                                <span id="locate" style="display:none;">
                                    左边距离：(定位px)
                                    <input type="text" placeholder="单位px" pattern="\d+" name="left" value="{{ $data->left }}"/>
                                    顶部距离：(定位px)
                                    <input type="text" placeholder="单位px" pattern="\d+" name="top" value="{{ $data->top }}"/>
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

                        {{--<div class="am-form-group">--}}
                            {{--<label>左边距离 / Left：(单位px)</label>--}}
                            {{--<input type="text" placeholder="单位px" pattern="\d+" name="left" value="0"/>--}}
                        {{--</div>--}}

                        {{--<div class="am-form-group">--}}
                            {{--<label>顶部距离 / Top：(单位px)</label>--}}
                            {{--<input type="text" placeholder="单位px" pattern="\d+" name="top" value="0"/>--}}
                        {{--</div>--}}

                        <div class="am-form-group">
                            <label>溢出方式 / Overflow：</label>
                            <select name="overflow">
                                @foreach($model['overflowTypeNames'] as $koverflowType=>$overflowTypeName)
                                    <option value="{{ $koverflowType }}" {{ $data->overflow==$koverflowType ? 'selected' : '' }}>{{ $overflowTypeName }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="am-form-group">
                            <label>透明度 / Opacity：</label>
                            <input type="text" placeholder="单位%" pattern="\d+" name="opacity" value="{{ $data->opacity }}"/>
                        </div>

                        <div class="am-form-group">
                            <label>简介 / Introduce：</label>
                            <textarea name="intro" cols="50" rows="5"> {{ $data->intro }}</textarea>
                        </div>

                        <button type="submit" class="am-btn am-btn-primary">保存修改</button>
                    </fieldset>
                </form>
            </div>
        </div>
    </div>
@stop