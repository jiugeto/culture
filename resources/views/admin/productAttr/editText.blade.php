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
                <form class="am-form" data-am-validator method="POST" action="/admin/productattr/text/{{ $data['id'] }}" enctype="multipart/form-data">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <input type="hidden" name="_method" value="POST">
                    <fieldset>
                        {{--文字信息--}}
                        <div class="am-form-group">
                            <label>文字 / Text：</label>
                            <div class="admin_border">
                                输入文字：
                                <input type="text" minlength="2" required name="text_con" value="{{ $data['text_con'] }}">
                                <div id="text_attr" style="display:none;">
                                    <div style="height:5px;"></div>
                                    <hr>
                                    外边距：(单位px)
                                    <input type="text" placeholder="上下间距，不填空着代表自动" pattern="\d+" name="text_margin1" value="{{ $data['text_margin1'] }}"/>
                                    <div style="height:5px;">{{--间距--}}</div>
                                    <input type="text" placeholder="左右间距，不填空着代表自动" pattern="\d+" name="text_margin2" value="{{ $data['text_margin2'] }}"/>
                                    <hr>
                                    内边距：(单位px)
                                    <input type="text" placeholder="上下间距，不填空着代表自动" pattern="\d+" name="text_padding1" value="{{ $data['text_padding1'] }}"/>
                                    <div style="height:5px;">{{--间距--}}</div>
                                    <input type="text" placeholder="左右间距，不填空着代表自动" pattern="\d+" name="text_padding2" value="{{ $data['text_padding2'] }}"/>
                                    <hr>
                                    边框方向：
                                    <select name="text_border1">
                                        @foreach($model['borderDirectionNames'] as $kborderDirection=>$borderDirectionName)
                                            <option value="{{ $kborderDirection }}" {{ $data['text_border1']==$kborderDirection ? 'selected' : '' }}>{{ $borderDirectionName }}</option>
                                        @endforeach
                                    </select>
                                    <div style="height:5px;">{{--间距--}}</div>
                                    边框宽度：<input type="text" placeholder="边框宽度，单位px" pattern="\d+" name="text_border2" value="{{ $data['text_border2'] }}"/>
                                    <div style="height:5px;">{{--间距--}}</div>
                                    边框类型：
                                    <select name="text_border3">
                                        @foreach($model['borderTypeNames'] as $kborder=>$borderTypeName)
                                            <option value="{{ $kborder }}" {{ $data['text_border3']==$kborder ? 'selected' : '' }}>{{ $borderTypeName }}</option>
                                        @endforeach
                                    </select>
                                    <div style="height:5px;">{{--间距--}}</div>
                                    边框颜色：(点击下面更改颜色)
                                    <span style="float:right;">当前颜色预览<div class="admin_yulan5"></div></span>
                                    <input type="color" title="点击更改颜色" name="text_border4" value="{{ $data['text_border4'] }}">
                                    <hr>
                                    宽度：(单位px)
                                    <input type="text" placeholder="" pattern="\d+" name="text_font_size" value="{{ $data['text_font_size'] }}"/>
                                    <hr>
                                    文字颜色：(点击下面更改颜色)
                                    <span style="float:right;">当前颜色预览<div class="admin_yulan6"></div></span>
                                    <input type="color" title="点击更改颜色" name="text_color" value="{{ $data['text_color'] }}">
                                </div>
                            </div>
                            <div class="switch_pic">
                                <a id="open1">展 开</a>
                                <a id="close1" style="display:none;">关 闭</a>
                            </div>
                        </div>
                        <script>
                            $(document).ready(function(){
                                var open = $("#open1");
                                var close = $("#close1");
                                var text_attr = $("#text_attr");
                                var pic_border4 = $("input[name='pic_border4']");
                                var text_border4 = $("input[name='text_border4']");
                                var text_color = $("input[name='text_color']");
                                open.click(function(){
                                    open.hide(); close.show(); text_attr.show();
                                });
                                close.click(function(){
                                    close.hide(); open.show(); text_attr.hide();
                                });
                                $("select[name='pic_id']").change(function(){
                                    if(this.value!=''){ open.hide(); close.show(); text_attr.show(); }
                                    if(this.value==''){ close.hide(); open.show(); text_attr.hide(); }
                                });
                                pic_border4.change(function(){
                                    $(".admin_yulan4").css('background',this.value);
                                });
                                text_border4.change(function(){
                                    $(".admin_yulan5").css('background',this.value);
                                });
                                text_color.change(function(){
                                    $(".admin_yulan6").css('background',this.value);
                                });
                            });
                        </script>

                        <button type="submit" class="am-btn am-btn-primary">保存修改</button>
                    </fieldset>
                </form>
            </div>
        </div>
    </div>
@stop