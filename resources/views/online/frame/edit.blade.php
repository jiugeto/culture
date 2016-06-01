@extends('online.main')
@section('content')
    @include('online.common.style')
    @include('online.common.show')

    <div class="online_frame" style="@if(isset($footSwitch)&&!$footSwitch)bottom:25px;@endif">
        <div class="frame">
            {{--属性修改--}}
            <div class="menus">
                <a {{--href="/online/{{$data->id}}/frame/style"--}}><div class="title">样式修改 {{ count($attrs) }}</div></a>
            </div>
            {{--动画内容修改--}}
            <div class="menus">
                <a {{--href="/online/{{$data->id}}/frame"--}}><div class="title star" id="title2" style="color:red;">动画内容修改</div></a>
            </div>
            <div class="menus oneframe" id="con">
                @if(count($attrs))
                @foreach($attrs as $attr)
                    <a href="">所在属性：{{ $attr->name }}</a>
                    <table style="width:100%;">
                    @if(count($attr->cons()))
                    @foreach($attr->cons() as $con)
                        <tr>
                            <td style="width:50%;">
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
                            <input type="hidden" name="index" value="{{ $con->id }}">
                            </td>
                            {{--<td>内容类型：--}}
                                {{--<label><input type="radio" name="genre" value="1" checked> 图片 &nbsp;&nbsp;</label>--}}
                                {{--<label><input type="radio" name="genre" value="2"> 文字 &nbsp;&nbsp;</label>--}}
                            {{--</td>--}}
                        </tr>
                        <tr><td colspan="10"><div style="height:1px;border-bottom:1px dashed grey;"></div></td></tr>
                    @endforeach
                    @endif
                    </table>
                @endforeach
                @endif
            </div>
            {{--动画帧修改--}}
            <div class="menus">
                <a {{--href="/online/{{$data->id}}/frame/layer"--}}><div class="title" id="title3">动画单帧修改 {{ count($layers) }}</div></a>
            </div>
            <div class="menus oneframe" id="layer" style="display:none;">
            </div>
        </div>
        <div style="height:100px;">{{--空白--}}</div>
    </div>

    <script>
        $(document).ready(function(){
            var con = $("#con");
            var layer = $("#layer");
            $("#title2").click(function(){
                con.show(200); layer.hide(200); $("#title3").css('color','darkgrey'); $("#title2").css('color','red');
            });
            $("#title3").click(function(){
                con.hide(200); layer.show(200); $("#title2").css('color','darkgrey'); $("#title3").css('color','red');
            });
        });
    </script>
@stop