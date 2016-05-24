@extends('online.main')
@section('content')
    {{--<style>--}}
    {{--</style>--}}

    {{--  在线创建窗口 --}}
    <div class="online_win">
        <div class="animate" style="background:white;">
            {{--动画开始--}}
            {{--动画结束--}}
        </div>
    </div>
    {{--  在线创建窗口 --}}

    <div class="switch">
    </div>
    <div class="frame">
        <div style="height:10px;">{{--空白--}}</div>
        <div class="menus">
            <div class="grey">单帧动画修改</div>
            <div class="oneframe">
                00000 <a id="open">展开</a> <a id="close" style="display:none;">关闭</a>
                @if(count($attrs))
                    @foreach()
                <table id="attrs" style="display:none;">
                    <tr>
                        <td class="left">内容：</td><td><input type="text" value="内容值"></td>
                        <td class="left">内容：</td><td><input type="text" value="内容值"></td>
                        <td class="left"></td><td></td>
                    </tr>
                    <tr>
                        <td class="left">属性：</td><td><input type="text" value="值"></td>
                        <td class="left">属性：</td><td><input type="text" value="值"></td>
                        <td class="left">属性：</td><td><input type="text" value="值"></td>
                    </tr>
                </table>
                    @endforeach
                @endif
            </div>
        </div>
    </div>
    <div style="height:200px;">{{--空白--}}</div>

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