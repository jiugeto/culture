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
                <form class="am-form" data-am-validator method="POST" action="/admin/productcon/" enctype="multipart/form-data">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <fieldset>
                        <div class="am-form-group">
                            <label>名称 / Name：</label>
                            <input type="text" placeholder="至少2个字符" minlength="2" required name="name"/>
                        </div>

                        <div class="am-form-group">
                            <label>类型 / Genre：</label>
                            <select name="genre" required>
                                @if($model['genres'])
                                    @foreach($model['genres'] as $kgenre=>$genre)
                                        <option value="{{ $kgenre }}">{{ $genre }}</option>
                                    @endforeach
                                @endif
                            </select>
                        </div>

                        <div class="am-form-group">
                            <label>属性名称 / Attr：</label>
                            <select name="attrid">
                                @if($model->attrAll())
                                    @foreach($model->attrAll() as $attr)
                                        <option value="{{ $attr->id }}">{{ $attr->name }}</option>
                                    @endforeach
                                @endif
                            </select>
                        </div>

                        <div class="am-form-group">
                            <label>图片 / Picture：<a href="/admin/pic">图片预览</a></label>
                            <select name="pic_id">
                                <option value="">选择图片</option>
                                @if($model->picAll())
                                    @foreach($model->picAll() as $pic)
                                        <option value="{{ $pic->id }}">{{ $pic->name }}</option>
                                    @endforeach
                                @endif
                            </select>
                        </div>

                        <div class="am-form-group">
                            <label>外边距 / Margin：(单位px)</label>
                            上下：<input type="text" placeholder="上下间距，不填空着代表自动" pattern="\d+" name="margin1"/>
                            左右：<input type="text" placeholder="左右间距，不填空着代表自动" pattern="\d+" name="margin2"/>
                        </div>

                        <div class="am-form-group">
                            <label>内边距 / Padding：(单位px)</label>
                            上下：<input type="text" placeholder="上下间距，不填空着代表自动" pattern="\d+" name="padding1"/>
                            左右：<input type="text" placeholder="左右间距，不填空着代表自动" pattern="\d+" name="padding2"/>
                        </div>

                        <div class="am-form-group">
                            <label>边框 / Border：</label>
                            <div class="admin_border">
                                边框方向：
                                <select name="border1">
                                    @foreach($model['borderDirectionNames'] as $kborderDirection=>$borderDirectionName)
                                        <option value="{{ $kborderDirection }}">{{ $borderDirectionName }}</option>
                                    @endforeach
                                </select>
                                边框宽度：
                                <input type="text" placeholder="边框宽度，单位px" pattern="\d+" name="border2"/>
                                边框类型：
                                <select name="border3">
                                    @foreach($model['borderTypeNames'] as $kborder=>$borderTypeName)
                                        <option value="{{ $kborder }}">{{ $borderTypeName }}</option>
                                    @endforeach
                                </select>
                                边框颜色：(点击下面更改颜色)
                                <span style="float:right;">当前颜色预览<div class="admin_yulan"></div></span>
                                <input type="color" title="点击更改颜色" name="border4">
                            </div>
                        </div>

                        <div class="am-form-group">
                            <label>宽度 / Width：(单位px)</label>
                            <input type="text" placeholder="" pattern="\d+" name="width"/>
                        </div>

                        <div class="am-form-group">
                            <label>高度 / Height：(单位px)</label>
                            <input type="text" placeholder="" pattern="\d+" name="height"/>
                        </div>

                        <div class="am-form-group">
                            <label>文字属性 / Text：</label>
                            <div class="admin_border" id="text_attr" style="display:none;">
                                文字颜色：(点击下面更改颜色)
                                <span style="float:right;">当前颜色预览<div class="admin_yulan2"></div></span>
                                <input type="color" title="点击更改颜色" name="color">
                                文字大小：(单位px)
                                <input type="text" placeholder="" pattern="\d+" name="font_size" value="16"/>
                                字间距：(单位px)
                                <input type="text" placeholder="" pattern="\d+" name="word_spacing"/>
                                行高：(单位px)
                                <input type="text" placeholder="" pattern="\d+" name="line_height"/>
                                字形：
                                <select name="text_transform">
                                    @foreach($model['textTransformTypeNames'] as $ktextTransformType=>$textTransformTypeName)
                                        <option value="{{ $ktextTransformType }}">{{ $textTransformTypeName }}</option>
                                    @endforeach
                                </select>
                                水平对齐：
                                <select name="text_align">
                                    @foreach($model['textAlignTypeNames'] as $ktextAlignType=>$textAlignTypeName)
                                        <option value="{{ $ktextAlignType }}">{{ $textAlignTypeName }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="switch_pic">
                                <a id="open">展 开</a>
                                <a id="close" style="display:none;">关 闭</a>
                            </div>
                        </div>

                        <button type="submit" class="am-btn am-btn-primary">保存修改</button>
                    </fieldset>
                </form>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function(){
            var border4 = $("input[name='border4']");
            var color = $("input[name='color']");
            var open = $("#open");
            var close = $("#close");
            var text_attr = $("#text_attr");
            border4.change(function(){
                $(".admin_yulan").css('background',this.value);
            });
            color.change(function(){
                $(".admin_yulan2").css('background',this.value);
            });
            $("select[name='genre']").change(function(){
                if(this.value==1){ close.hide(); open.show(); text_attr.hide(); }
                if(this.value==2){ open.hide(); close.show(); text_attr.show(); }
            });
            open.click(function(){ open.hide(); close.show(); text_attr.show(); });
            close.click(function(){ close.hide(); open.show(); text_attr.hide(); });
        });
    </script>
@stop