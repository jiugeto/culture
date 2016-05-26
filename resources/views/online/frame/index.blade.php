@extends('online.main')
@section('content')
    {{--<style>--}}
    {{--</style>--}}

    {{--  在线创建窗口 --}}
    <div class="online_win">
        <div class="animate">
            {{--动画开始--}}
            @if(count($attrs))
                @foreach($attrs as $attr)
                <div class="{{ $attr->style_name }}">
                    <div class="pos">
                        <div class="dh"><img src="/uploads/images/2016/ppt.png"></div>
                    </div>
                </div>
                @endforeach
            @endif
            {{--动画结束--}}
        </div>
    </div>
    {{--  在线创建窗口 --}}

    {{--<div class="switch">--}}
    {{--</div>--}}
    <div class="frame_edit">
    <div class="frame">
        <div class="menus">
            <div class="grey">动画单帧修改 （{{ count($layers) }}）</div>
            @if(count($layers))
                @foreach($layers as $layer)
                <div class="oneframe">
                    {{ $layer->name }} <a id="open">展开</a> <a id="close" style="display:none;">关闭</a>
                    <input type="hidden" name="layerid" value="{{ $layer->id }}">
                    <table id="attrs" style="display:none;">
                    @if(count($layer->cons()) || count($layer->layerAttrs()))
                        {{--动画内容--}}
                        @if(count($layer->cons()))
                        @foreach($layer->cons() as $con)
                            <tr>
                                <td class="left">动画名称：</td><td>{{ $layer->name }}</td>
                            @if($con->genre==1)
                                <td class="left">图片：</td>
                                <td>
                                    <select name="pic_id">
                                        @if(count($pics))
                                            @foreach($pics as $pic)
                                                <option value="{{ $pic->id }}">{{ $pic->name }}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                    <a href="">图片列表</a>
                                </td>
                            @elseif($con->genre==2)
                                <td class="left">文字：</td>
                                <td><input type="text" name="textName" value="{{ $con->name }}"></td>
                            @endif
                                <td></td><td></td>
                            </tr>
                        @endforeach
                            @if(count($layer->layerAttr()))
                                <tr><td colspan="10"><div style="border-bottom:1px dashed lightgrey;"></div></td></tr>
                            @endif
                        @endif
                        {{--动画样式--}}
                        {{--<tr>--}}
                            {{--<td class="left">属性：</td><td><input type="text" value="值"></td>--}}
                            {{--<td class="left">属性：</td><td><input type="text" value="值"></td>--}}
                            {{--<td class="left">属性：</td><td><input type="text" value="值"></td>--}}
                        {{--</tr>--}}
                        {{--动画关键帧--}}
                        {{--<tr><td colspan="10"><div style="border-bottom:1px dashed lightgrey;"></div></td></tr>--}}
                        @if(count($layer->layerAttrs()))
                        @foreach($layer->layerAttrs() as $layerAttr)
                            <tr>
                                <td class="left">属性名称：</td><td>{{ $layerAttr->layerAttr() }}</td>
                                <td class="left">动画点(帧)：</td>
                                <td><input type="text" name="per{{$layerAttr->id}}" value="{{ $layerAttr->per }}">%</td>
                                <td class="left">动画值：</td>
                                <td><input type="text" name="val{{$layerAttr->id}}" value="{{ $layerAttr->val }}"></td>
                            </tr>
                        @endforeach
                        @endif
                    @else <tr><td colspan="10">无</td></tr>
                    @endif
                    </table>
                </div>
                @endforeach
            @endif
            {{--<div class="oneframe">--}}
                {{--00000 <a id="open">展开</a> <a id="close" style="display:none;">关闭</a>--}}
                {{--<table id="attrs" style="display:none;">--}}
                    {{--<tr>--}}
                        {{--<td class="left">内容：</td><td><input type="text" value="内容值"></td>--}}
                        {{--<td class="left">内容：</td><td><input type="text" value="内容值"></td>--}}
                        {{--<td class="left"></td><td></td>--}}
                    {{--</tr>--}}
                    {{--<tr><td colspan="10"><div style="border-bottom:1px dashed lightgrey;"></div></td></tr>--}}
                    {{--<tr>--}}
                        {{--<td class="left">属性：</td><td><input type="text" value="值"></td>--}}
                        {{--<td class="left">属性：</td><td><input type="text" value="值"></td>--}}
                        {{--<td class="left">属性：</td><td><input type="text" value="值"></td>--}}
                    {{--</tr>--}}
                {{--</table>--}}
            {{--</div>--}}
        </div>
    </div>
    <div style="height:200px;">{{--空白--}}</div>
    </div>

    <script>
        $(document).ready(function(){
            var open = $("#open");
            var close = $("#close");
            var attrs = $("#attrs");
            open.click(function(){ open.hide(); close.show(); attrs.show(); });
            close.click(function(){ open.show(); close.hide(); attrs.hide(); });
        });
    </script>
@stop