@extends('member.main')
@section('content')
    @include('member.common.crumb')

    <form data-am-validator method="POST" action="/member/product" enctype="multipart/form-data">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <table class="table_create">
            <tr>
                <td class="field_name"><label>名称：</label></td>
                <td><input type="text" class="field_value" placeholder="至少2个字符" minlength="2" required name="name"/></td>
            </tr>
            {{--<tr><td></td></tr>--}}

            <tr>
                <td class="field_name"><label>类样式名称：</label></td>
                <td><input type="text" placeholder="至少2个字符，英文、拼音、字母或数字组合" pattern="^[a-zA-Z0-9_-]+$" required name="style_name"/></td>
            </tr>
            {{--<tr><td></td></tr>--}}

            <tr>
                <td class="field_name"><label>产品名称：</label></td>
                <td>
                    <select name="productid" required>
                    @if(count($model->products()))
                        @foreach($model->products() as $product)
                            <option value="{{ $product->name }}">{{ $product->name }}</option>
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
                    上下：
                    <label><input type="radio" class="radio" name="ismargin1" value="0"> 自定义&nbsp;&nbsp;</label>
                    <label><input type="radio" class="radio" name="ismargin1" value="1" checked> 自动&nbsp;&nbsp;</label>
                    <div id="ismargin1" style="display:none;">
                        <br>
                        上：<input type="text" style="width:100px;" name="margin1"> px
                        下：<input type="text" style="width:100px;" name="margin2"> px
                    </div>
                    <div style="height:5px;"></div>
                    左右：
                    <label><input type="radio" class="radio" name="ismargin2" value="0"> 自定义&nbsp;&nbsp;</label>
                    <label><input type="radio" class="radio" name="ismargin2" value="1" checked> 自动&nbsp;&nbsp;</label>
                    <div id="ismargin2" style="display:none;">
                        <br>
                        上：<input type="text" style="width:100px;" name="margin3"> px
                        下：<input type="text" style="width:100px;" name="margin4"> px
                    </div>
                </td>
            </tr>
            {{--<tr><td></td></tr>--}}
            <script>
                $(document).ready(function(){
                    var ismargin1 = $("#ismargin1");
                    var ismargin2 = $("#ismargin2");
                    $("input[name='ismargin1']").change(function(){
                        if(this.value){ ismargin1.show(); }
                        if(this.value==1){ ismargin1.hide(); }
                    });
                    $("input[name='ismargin2']").change(function(){
                        if(this.value){ ismargin2.show(); }
                        if(this.value==1){ ismargin2.hide(); }
                    });
                });
            </script>

            <tr>
                <td class="field_name"><label>内边距：</label></td>
                <td class="td_border">
                    上下：
                    <label><input type="radio" class="radio" name="ispadding1" value="0"> 自定义&nbsp;&nbsp;</label>
                    <label><input type="radio" class="radio" name="ispadding1" value="1" checked> 自动&nbsp;&nbsp;</label>
                    <div id="ispadding1" style="display:none;">
                        <br>
                        上：<input type="text" style="width:100px;" name="padding1"> px
                        下：<input type="text" style="width:100px;" name="padding2"> px
                    </div>
                    <div style="height:5px;"></div>
                    左右：
                    <label><input type="radio" class="radio" name="ispadding2" value="0"> 自定义&nbsp;&nbsp;</label>
                    <label><input type="radio" class="radio" name="ispadding2" value="1" checked> 自动&nbsp;&nbsp;</label>
                    <div id="ispadding2" style="display:none;">
                        <br>
                        上：<input type="text" style="width:100px;" name="padding3"> px
                        下：<input type="text" style="width:100px;" name="padding4"> px
                    </div>
                </td>
            </tr>
            {{--<tr><td></td></tr>--}}
            <script>
                $(document).ready(function(){
                    var ispadding1 = $("#ispadding1");
                    var ispadding2 = $("#ispadding2");
                    $("input[name='ispadding1']").change(function(){
                        if(this.value){ ispadding1.show(); }
                        if(this.value==1){ ispadding1.hide(); }
                    });
                    $("input[name='ispadding2']").change(function(){
                        if(this.value){ ispadding2.show(); }
                        if(this.value==1){ ispadding2.hide(); }
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
                <td class="field_name"><label>简介：</label></td>
                <td><textarea name="intro" cols="40" rows="5"></textarea></td>
            </tr>
            {{--<tr><td></td></tr>--}}

            <tr><td colspan="2" style="text-align:center;">
                    <button class="companybtn" onclick="history.go(-1)">返 &nbsp;&nbsp;&nbsp;回</button>
                    <button type="submit" class="companybtn">保存添加</button>
                </td></tr>
        </table>
    </form>
@stop

