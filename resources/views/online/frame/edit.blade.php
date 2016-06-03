@extends('online.main')
@section('content')
    @include('online.common.style')
    @include('online.common.show')

    <div class="online_frame" style="@if(isset($footSwitch)&&!$footSwitch)bottom:25px;@endif">
        <div class="frame">
            {{--属性修改--}}
            <div class="menus">
                <a><div class="title" id="title1">样式修改</div></a>
            </div>
            <div class="menus oneframe" id="style" style="display:none;"></div>

            {{--动画内容修改--}}
            <div class="menus">
                <a><div class="title star" id="title2" style="color:red;">动画内容修改</div></a>
            </div>
            <div class="menus oneframe" id="con">
                @if(count($cons))
                @foreach($cons as $con)
                <table style="border-bottom:1px dashed grey;">
                    <tr><td style="width:50%;">
                        @if($con->genre==1)
                            图片选择：
                            <select name="pic_id{{$con->id}}" required>
                            @if(count($pics))
                            @foreach($pics as $pic)
                                <option value="{{ $pic->id }}" {{ $con->pic_id==$pic->id ? 'selected' : '' }}>{{ $pic->name }}</option>
                            @endforeach
                            @else
                            <option value="">无</option>
                        @endif
                        </select>
                        @elseif($con->genre==2)
                            文字填写：<input type="text" placeholder="填写文字" minlength="2" required name="name{{$con->id}}" value="{{ $con->name }}">
                        @endif
                        </td>
                        <td>样式选择：</td>
                    </tr>
                </table>
                @endforeach
                @endif
                {{--@if(count($attrs))--}}
                {{--@foreach($attrs as $attr)--}}
                    {{--<a href="">所在属性：{{ $attr->name }}</a>--}}
                    {{--<table style="width:100%;">--}}
                    {{--@if(count($attr->cons()))--}}
                    {{--@foreach($attr->cons() as $con)--}}
                        {{--<tr>--}}
                            {{--<td style="width:50%;">--}}
                            {{--@if($con->genre==1)--}}
                                {{--图片选择：--}}
                                {{--<select name="pic_id{{$con->id}}" required>--}}
                                    {{--@if(count($pics))--}}
                                        {{--@foreach($pics as $pic)--}}
                                            {{--<option value="{{ $pic->id }}" {{ $con->pic_id==$pic->id ? 'selected' : '' }}>{{ $pic->name }}</option>--}}
                                        {{--@endforeach--}}
                                    {{--@else--}}
                                        {{--<option value="">无</option>--}}
                                    {{--@endif--}}
                                {{--</select>--}}
                            {{--@elseif($con->genre==2)--}}
                                {{--文字填写：<input type="text" placeholder="填写文字" minlength="2" required name="name{{$con->id}}" value="{{ $con->name }}">--}}
                            {{--@endif--}}
                            {{--<input type="hidden" name="index" value="{{ $con->id }}">--}}
                            {{--</td>--}}
                        {{--</tr>--}}
                        {{--<tr><td colspan="10"><div style="height:1px;border-bottom:1px dashed grey;"></div></td></tr>--}}
                    {{--@endforeach--}}
                    {{--@endif--}}
                    {{--</table>--}}
                {{--@endforeach--}}
                {{--@endif--}}
            </div>

            {{--动画帧修改--}}
            <div class="menus">
                <a><div class="title" id="title3">动画单帧修改</div></a>
            </div>
            <div class="menus oneframe" id="layerAttr" style="display:none;"></div>

            {{--动画设置修改--}}
            <div class="menus">
                <a><div class="title" id="title4">动画设置</div></a>
            </div>
            <div class="menus oneframe" id="layer" style="display:none;"></div>
        </div>
        <div style="height:100px;">{{--空白--}}</div>
    </div>

    <script>
        $(document).ready(function(){
            var style = $("#style");
            var con = $("#con");
            var layerAttr = $("#layerAttr");
            var layer = $("#layer");
            $("#title1").click(function(){
                style.show(200); con.hide(200); layerAttr.hide(200); layer.hide(200);
                $("#title1").css('color','red'); $("#title2").css('color','darkgrey');
                $("#title3").css('color','darkgrey'); $("#title4").css('color','darkgrey');
            });
            $("#title2").click(function(){
                style.hide(200); con.show(200); layerAttr.hide(200); layer.hide(200);
                $("#title1").css('color','darkgrey'); $("#title2").css('color','red');
                $("#title3").css('color','darkgrey'); $("#title4").css('color','darkgrey');
            });
            $("#title3").click(function(){
                style.hide(200); con.hide(200); layerAttr.show(200); layer.hide(200);
                $("#title1").css('color','darkgrey'); $("#title2").css('color','darkgrey');
                $("#title3").css('color','red'); $("#title4").css('color','darkgrey');
            });
            $("#title4").click(function(){
                style.hide(200); con.hide(200); layerAttr.hide(200); layer.show(200);
                $("#title1").css('color','darkgrey'); $("#title2").css('color','darkgrey');
                $("#title3").css('color','darkgrey'); $("#title4").css('color','red');
            });
        });
    </script>
@stop