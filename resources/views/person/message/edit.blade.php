@extends('person.main')
@section('content')
    <div class="per_body" style="border:0;height:700px;background:0;">
        @include('person.partials.top')
        <div class="per_list">
            <p class="title">修改消息</p>
            <form method="POST" action="{{DOMAIN}}person/message/{{ $data->id }}" enctype="multipart/form-data" class="list">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <input type="hidden" name="_method" value="POST">
                {{--<h4 style="text-align:center;">发送消息</h4>--}}
                <table class="tform">
                    <tr>
                        <td>接收人：</td>
                        <td><input type="text" placeholder="邮箱/QQ/用户名" name="name" value="{{ $data->userName() }}"></td>
                    </tr>
                    <tr>
                        <td>标题：</td>
                        <td><input type="text" placeholder="至少2个字符" name="title" value="{{ $data->title }}"></td>
                    </tr>
                    <tr>
                        <td>内容：</td>
                        <td>
                            <textarea name="intro">{{ $data->intro }}</textarea>
                            {{--@include('UEditor::head')--}}
                            {{--<script id="container" name="intro" type="text/plain"></script>--}}
                            {{--<!-- 实例化编辑器 -->--}}
                            {{--<script type="text/javascript">--}}
                                {{--var ue = UE.getEditor('container',{--}}
                                    {{--initialFrameWidth:420,--}}
                                    {{--initialFrameHeight:200,--}}
                                            {{--toolbars:[['redo','undo','bold','italic','underline','strikethrough','horizontal','forecolor','fontfamily','fontsize','priview','directionality','paragraph','searchreplace','pasteplain','help','insertImage','fullscreen']]--}}
                                {{--});--}}
                                {{--ue.ready(function() {--}}
                                    {{--//此处为支持laravel5 csrf ,根据实际情况修改,目的就是设置 _token 值.--}}
                                    {{--ue.execCommand('serverparam', '_token', '{{ csrf_token() }}');--}}
                                {{--});--}}
                            {{--</script>--}}
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2" style="text-align:center;">
                            <a onclick="history.go(-1);">返回上一页</a>
                            <button type="submit" class="companybtn" name="submit" value="nosend">保存草稿</button>
                            <button type="submit" class="companybtn" name="submit" value="send">开始发送</button>
                        </td>
                    </tr>
                </table>
            </form>
        </div>
        @include('person.common.head')
    </div>
@stop