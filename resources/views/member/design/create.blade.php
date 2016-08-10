@extends('member.main')
@section('content')
    @include('member.common.crumb')

    <form data-am-validator method="POST" action="/member/{{ $lists['func']['url'] }}" enctype="multipart/form-data">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <p style="text-align:center;"><b>{{ $lists['func']['name'] }}{{ in_array($lists['func']['url'],['designPerD','designComD']) ? '需求' : '供应' }}添加</b></p>
        <table class="table_create">
            <tr>
                <td><label>设计名称{{-- / Name--}}：</label></td>
                <td><input type="text" placeholder="至少2个字符" minlength="2" required name="name"/></td>
            </tr>
            {{--<tr><td></td></tr>--}}

            {{--<tr>--}}
                {{--<td><label>供求关系--}}{{-- / Genre--}}{{--：</label></td>--}}
                {{--<td>--}}
                    {{--<label><input type="radio" name="genre" value="1" checked/> 设计供应&nbsp;&nbsp;</label>--}}
                    {{--<label><input type="radio" name="genre" value="2"/> 设计需求&nbsp;&nbsp;</label>--}}
                {{--</td>--}}
            {{--</tr>--}}
            {{--<tr><td></td></tr>--}}

            <tr>
                <td><label>设计类型{{-- / cate--}}：</label></td>
                <td>
                    <select name="cate" required>
                    @foreach($model['cates'] as $kcate=>$vcate)
                        <option value="{{ $kcate }}">{{ $vcate }}</option>
                    @endforeach
                    </select>
                </td>
            </tr>
            {{--<tr><td></td></tr>--}}

            <tr>
                <td><label>价格{{-- / Price--}}：(单位元)</label></td>
                <td><input type="text" placeholder="" pattern="^\d+(.\d{1,2})?$" required name="money"/></td>
            </tr>
            {{--<tr><td></td></tr>--}}

            <tr>
                <td><label>简介{{-- / Introduce--}}：</label></td>
                <td>
                    <textarea name="intro" cols="50" rows="5"></textarea>
                    {{--@include('UEditor::head')
                    <script id="container" name="intro" type="text/plain"></script>
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

            <tr>
                <td><label>详情{{-- / Detail--}}：</label></td>
                <td style="position:relative;z-index:5;">
                    {{--<textarea name="detail" cols="50" rows="5"></textarea>--}}
                    @include('UEditor::head')
                    <script id="container" name="detail" type="text/plain"></script>
                    <!-- 实例化编辑器 -->
                    <script type="text/javascript">
                        var ue = UE.getEditor('container',{
                            initialFrameWidth:400,
                            initialFrameHeight:100,
                                    toolbars:[['redo','undo','bold','italic','underline','strikethrough','horizontal','forecolor','fontfamily','fontsize','fullscreen','priview','directionality','paragraph','insertimage','searchreplace','pasteplain','help']]
                        });
                        ue.ready(function() {
                            //此处为支持laravel5 csrf ,根据实际情况修改,目的就是设置 _token 值.
                            ue.execCommand('serverparam', '_token', '{{ csrf_token() }}');
                        });
                    </script>
                </td>
            </tr>
            {{--<tr><td></td></tr>--}}

            {{--<tr>--}}
                {{--<td><label>排序--}}{{-- / Sort--}}{{--：</label></td>--}}
                {{--<td><input type="text" placeholder="值越大越靠前" pattern="^\d+$" required name="sort" value="20"/></td>--}}
            {{--</tr>--}}
            {{--<tr><td></td></tr>--}}

            <tr><td colspan="2" style="text-align:center;">
                    <button class="companybtn" onclick="history.go(-1)">返 回</button>
                    <button type="submit" class="companybtn">保存添加</button>
                </td></tr>
        </table>
    </form>
@stop

