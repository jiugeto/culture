@extends('member.main')
@section('content')
    @include('member.common.crumb')
    <form data-am-validator method="POST" action="{{DOMAIN}}member/goods" enctype="multipart/form-data">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <p style="text-align:center;"><b>视频添加</b></p>
        <table class="table_create">
            <tr>
                <td class="field_name"><label>名称：</label></td>
                <td><input type="text" class="field_value" placeholder="至少2个字符" minlength="2" required name="name"/></td>
            </tr>

            <tr>
                <td class="field_name"><label>作品类型：</label></td>
                <td>
                    <select name="cate" required>
                        @foreach($model['cates2'] as $kcate=>$vcate)
                            <option value="{{ $kcate }}">{{ $vcate }}</option>
                        @endforeach
                    </select>
                </td>
            </tr>

            <tr>
                <td class="field_name"><label>简介：</label></td>
                <td>
                    <textarea name="intro" cols="40" rows="5"></textarea>
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

            <tr>
                <td class="field_name"><label>鼠标移动的文字：</label></td>
                <td><input type="text" class="field_value" placeholder="" name="title"/></td>
            </tr>
            <tr><td colspan="2" style="border-bottom:1px solid ghostwhite"></td></tr>

            <tr>
                <td class="field_name"><label>视频截图：</label></td>
                <td>@include('member.common.piclist')</td>
            </tr>
            <tr><td colspan="2" style="border-bottom:1px solid ghostwhite"></td></tr>

            <tr>
                <td class="field_name"><label>视频链接：</label></td>
                <td>
                    {{--<input type="text" class="field_value" placeholder="至少2个字符" minlength="2" required name="video_id"/>--}}
                    <select name="video_id" required>
                        <option value="0">链接选择</option>
                        @if(count($videos))
                            @foreach($videos as $video)
                                <option value="{{ $video->id }}">{{ $video->name.' --> '.$video->url }}</option>
                            @endforeach
                        @endif
                    </select>
                    <br><a href="{{DOMAIN}}member/video" class="job">视频列表</a>
                </td>
            </tr>

            <tr><td colspan="2" style="text-align:center;">
                    <button class="companybtn" onclick="history.go(-1)">返 &nbsp;&nbsp;&nbsp;回</button>
                    <button type="submit" class="companybtn">保存添加</button>
                </td></tr>
        </table>
    </form>
@stop

