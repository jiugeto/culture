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
                <form class="am-form" data-am-validator method="POST" action="/admin/productattr/pic/{{ $data['id'] }}" enctype="multipart/form-data">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <input type="hidden" name="_method" value="POST">
                    <fieldset>
                        <div class="am-form-group">
                            <label>图片信息</label>
                        </div>

                        {{--图片信息--}}
                        <div class="am-form-group">
                            <label>图片 / Picture：<a href="/admin/pic">图片预览</a></label>
                            <div class="admin_border">
                                图片名称：
                                <select name="pic_id" required>
                                    <option value="" {{ !$data['pic_id'] ? 'selected' : '' }}>选择图片</option>
                                    @if($model->picAll())
                                        @foreach($model->picAll() as $pic)
                                            <option value="{{ $pic->id }}" {{ $data['pic_id']==$pic->id ? 'selected' : '' }}>{{ $pic->name }}</option>
                                        @endforeach
                                    @endif
                                </select>
                                <div id="pic_attr" style="display:{{ $data['pic_id']?'block':'none' }};">
                                    <div style="height:5px;"></div>
                                    <hr>
                                    外边距：(单位px)
                                    <input type="text" placeholder="上下间距，不填空着代表自动" pattern="\d+" name="pic_margin1" value="{{ $data['pic_margin1'] }}"/>
                                    <div style="height:5px;">{{--间距--}}</div>
                                    <input type="text" placeholder="左右间距，不填空着代表自动" pattern="\d+" name="pic_margin2" value="{{ $data['pic_margin2'] }}"/>
                                    <hr>
                                    内边距：(单位px)
                                    <input type="text" placeholder="上下间距，不填空着代表自动" pattern="\d+" name="pic_padding1" value="{{ $data['pic_padding1'] }}"/>
                                    <div style="height:5px;">{{--间距--}}</div>
                                    <input type="text" placeholder="左右间距，不填空着代表自动" pattern="\d+" name="pic_padding2" value="{{ $data['pic_padding2'] }}"/>
                                    <hr>
                                    边框方向：
                                    <select name="pic_border1">
                                        @foreach($model['borderDirectionNames'] as $kborderDirection=>$borderDirectionName)
                                            <option value="{{ $kborderDirection }}" {{ $data['pic_border1']==$kborderDirection ? 'selected' : '' }}>{{ $borderDirectionName }}</option>
                                        @endforeach
                                    </select>
                                    <div style="height:5px;">{{--间距--}}</div>
                                    边框宽度：<input type="text" placeholder="边框宽度，单位px" pattern="\d+" name="pic_border2" value="{{ $data['pic_border2'] }}"/>
                                    <div style="height:5px;">{{--间距--}}</div>
                                    边框类型：
                                    <select name="pic_border3">
                                        @foreach($model['borderTypeNames'] as $kborder=>$borderTypeName)
                                            <option value="{{ $kborder }}" {{ $data['pic_border3']==$kborder ? 'selected' : '' }}>{{ $borderTypeName }}</option>
                                        @endforeach
                                    </select>
                                    <div style="height:5px;">{{--间距--}}</div>
                                    边框颜色：(点击下面更改颜色)
                                    <span style="float:right;">当前颜色预览<div class="admin_yulan4"></div></span>
                                    <input type="color" title="点击更改颜色" name="pic_border4" value="{{ $data['pic_border4'] }}">
                                    <hr>
                                    宽度：(单位px)
                                    <input type="text" placeholder="" pattern="\d+" name="pic_width" value="{{ $data['pic_width'] }}"/>
                                    <hr>
                                    高度：(单位px)
                                    <input type="text" placeholder="" pattern="\d+" name="pic_height" value="{{ $data['pic_height'] }}"/>
                                </div>
                            </div>
                            <div class="switch_pic">
                                <a id="open">展 开</a>
                                <a id="close" style="display:none;">关 闭</a>
                            </div>
                        </div>
                        <script>
                            $(document).ready(function(){
                                var open = $("#open");
                                var close = $("#close");
                                var pic_attr = $("#pic_attr");
                                var pic_border4 = $("input[name='pic_border4']");
                                pic_border4.change(function(){
                                    $(".admin_yulan4").css('background',this.value);
                                });
                                open.click(function(){
                                    open.hide(); close.show(); pic_attr.show();
                                });
                                close.click(function(){
                                    close.hide(); open.show(); pic_attr.hide();
                                });
                                $("select[name='pic_id']").change(function(){
                                    if(this.value!=''){ open.hide(); close.show(); pic_attr.show(); }
                                    if(this.value==''){ close.hide(); open.show(); pic_attr.hide(); }
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