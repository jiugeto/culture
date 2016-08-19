@extends('member.main')
@section('content')
    @include('member.common.crumb')

    <form data-am-validator method="POST" action="{{DOMAIN}}member/product/{{ $data->id }}" enctype="multipart/form-data">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <input type="hidden" name="_method" value="POST">
        <table class="table_create">
            <tr>
                <td class="field_name"><label>产品名称：</label></td>
                <td><input type="text" class="field_value" placeholder="至少2个字符" minlength="2" required name="name" value="{{ $data->name }}"/></td>
            </tr>
            {{--<tr><td></td></tr>--}}

            <tr>
                <td class="field_name"><label>宽度：</label></td>
                <td><input type="text" class="field_value" placeholder="宽度，单位px" pattern="^\d+$" required name="width" value="{{ $data->width }}"/></td>
            </tr>
            {{--<tr><td></td></tr>--}}

            <tr>
                <td class="field_name"><label>高度：</label></td>
                <td><input type="text" class="field_value" placeholder="高度，单位px" pattern="^\d+$" required name="height" value="{{ $data->height }}"/></td>
            </tr>
            <tr><td></td></tr>

            <tr>
                <td class="field_name"><label>简介：</label></td>
                <td>
                    <textarea name="intro" cols="40" rows="5">{{ $data->intro }}</textarea>
                    {{--@include('UEditor::head')
                    <script id="container" name="content" type="text/plain"></script>
                    <!-- 实例化编辑器 -->
                    <script type="text/javascript">
                        var ue = UE.getEditor('container',{
                            initialFrameWidth:500,
                            initialFrameHeight:100,
//                                    toolbars:[['redo','undo','bold','italic','underline','strikethrough','horizontal','forecolor','fontfamily','fontsize','priview','directionality','paragraph','searchreplace','pasteplain','help']]
                        });
                        ue.ready(function() {
                            //此处为支持laravel5 csrf ,根据实际情况修改,目的就是设置 _token 值.
                            ue.execCommand('serverparam', '_token', '{{ csrf_token() }}');
                        });
                    </script>--}}
                </td>
            </tr>
            {{--<tr><td></td></tr>--}}

            <tr><td colspan="2" style="text-align:center;">
                    <button class="companybtn" onclick="history.go(-1)">返 &nbsp;&nbsp;&nbsp;回</button>
                    <button type="submit" class="companybtn">保存修改</button>
                </td></tr>
        </table>
    </form>
@stop

