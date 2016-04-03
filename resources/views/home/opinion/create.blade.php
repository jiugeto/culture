@extends('home.main')
@section('content')
    @include('home.common.crumb')

    <div class="home_create">
        <form class="form" data-am-validator method="POST" action="/home/opinion/create" enctype="multipart/form-data">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <table class="table_create">
                <tr><td colspan="2">本条是{{ $reply==0 ? '新意见' : $reply.'的回复意见' }}（带<span class="star">*</span>号的是必填项）</td></tr>
                <tr><td>&nbsp;</td></tr>

                <tr>
                    <td style="width:100px;"><label>意见标题 <span class="star">*</span>：</label></td>
                    <td><input type="text" placeholder="至少2个字符" minlength="2" required name="name"/></td>
                </tr>
                <tr><td>&nbsp;</td></tr>

                <tr>
                    <td><label>内容 <span class="star">*</span>：</label></td>
                    <td>
                        {{--<input type="text" placeholder="至少2个字符" minlength="2" required name="name"/>--}}
                        @include('UEditor::head')
                        <script id="container" name="intro" type="text/plain"></script>
                        <!-- 实例化编辑器 -->
                        <script type="text/javascript">
                            var ue = UE.getEditor('container',{
                                initialFrameWidth:550,
                                initialFrameHeight:100,
                                    toolbars:[['redo','undo','bold','italic','underline','strikethrough','horizontal','forecolor','fontfamily','fontsize','indent','priview','directionality','paragraph','searchreplace','insertimage','imagefloat','pasteplain','help']]
                            });
                            ue.ready(function() {
                                //此处为支持laravel5 csrf ,根据实际情况修改,目的就是设置 _token 值.
                                ue.execCommand('serverparam', '_token', '{{ csrf_token() }}');
                            });
                        </script>
                    </td>
                </tr>
                <tr><td>&nbsp;</td></tr>

                <tr>
                    <td><label>上传图片：</label></td>
                    <td><input type="text" placeholder="至少2个字符" minlength="2" required name="pic"/></td>
                </tr>
                <tr><td>&nbsp;</td></tr>

                <tr><td colspan="2" style="text-align:center;">
                        <button class="homebtn" onclick="history.go(-1)">返 &nbsp;&nbsp;&nbsp;回</button>
                        <button type="submit" class="homebtn">保存添加</button>
                    </td></tr>
            </table>
        </form>
    </div>
@stop

