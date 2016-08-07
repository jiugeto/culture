@extends('member.main')
@section('content')
    @include('member.common.crumb')

    <form data-am-validator method="POST" action="/member/entertain" enctype="multipart/form-data">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <table class="table_create">
            <tr>
                <td><label>娱乐名称 / Name：</label></td>
                <td><input type="text" placeholder="至少2个字符" minlength="2" required name="title"/></td>
            </tr>
            {{--<tr><td></td></tr>--}}

            <tr>
                <td><label>供求关系 / Genre：</label></td>
                <td>
                    <label><input type="radio" name="genre" value="1" checked/> 娱乐供应&nbsp;&nbsp;</label>
                    <label><input type="radio" name="genre" value="2"/> 娱乐需求&nbsp;&nbsp;</label>
                </td>
            </tr>
            {{--<tr><td></td></tr>--}}

            <tr>
                <td><label>简介 / Introduce：</label></td>
                <td>
                    <textarea name="content" cols="50" rows="5"></textarea>
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
                    <button type="submit" class="companybtn">保存添加</button>
                </td></tr>
        </table>
    </form>
@stop

