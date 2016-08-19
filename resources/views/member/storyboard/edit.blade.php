@extends('member.main')
@section('content')
    @include('member.common.crumb')

    <form data-am-validator method="POST" action="{{DOMAIN}}member/storyboard/{{ $data->id }}" enctype="multipart/form-data">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <input type="hidden" name="_method" value="POST">
        <table class="table_create">
            <tr>
                <td class="field_name"><label>分镜名称：</label></td>
                <td><input type="text" placeholder="至少2个字符" minlength="2" required name="name" value="{{ $data->name }}"/></td>
            </tr>
            <tr><td></td></tr>

            <tr>
                <td class="field_name"><label>分类：</label></td>
                <td>
                    <select name="cate">
                    @if($model->cates())
                        @foreach($model->cates() as $cate)
                             <option value="{{ $cate->id }}" {{ $data->cate_id==$cate->id ? 'selected' : '' }}>{{ $cate->name }}</option>
                        @endforeach
                    @endif
                    </select>
                </td>
            </tr>
            <tr><td></td></tr>

            <tr>
                <td class="field_name"><label>简介：</label></td>
                <td style="position:relative;z-index:0;">
                    {{--<textarea name="intro" cols="50" rows="5"></textarea>--}}
                    @include('UEditor::head')
                    <script id="container" name="intro" type="text/plain">
                        {!! $data->intro !!}
                    </script>
                    <!-- 实例化编辑器 -->
                    <script type="text/javascript">
                        var ue = UE.getEditor('container',{
                            initialFrameWidth:400,
                            initialFrameHeight:100,
                                    toolbars:[['redo','undo','bold','italic','underline','strikethrough','horizontal','forecolor','fontfamily','fontsize','priview','directionality','paragraph','imagefloat','insertimage','searchreplace','pasteplain','help']]
                        });
                        ue.ready(function() {
                            //此处为支持laravel5 csrf ,根据实际情况修改,目的就是设置 _token 值.
                            ue.execCommand('serverparam', '_token', '{{ csrf_token() }}');
                        });
                    </script>
                </td>
            </tr>
            <tr><td></td></tr>

            <tr>
                <td class="field_name"><label>价格：</label></td>
                <td><input type="text" placeholder="数字" pattern="^(\d+)|(\d+\.\d{2})$" name="money" value="{{ $data->money }}"/></td>
            </tr>
            <tr><td></td></tr>

            <tr>
                <td class="field_name"><label>排序：</label></td>
                <td><input type="text" placeholder="数字" pattern="^\d+$" required name="sort2" value="{{ $data->sort2 }}"/></td>
            </tr>
            <tr><td></td></tr>

            <tr>
                <td class="field_name"><label>前台是否显示：</label></td>
                <td>
                    <label><input type="radio" class="radio" name="isshow2" value="0" {{ $data->isshow2==0 ? 'checked' : '' }}> 不显示&nbsp;&nbsp;</label>
                    <label><input type="radio" class="radio" name="isshow2" value="1" {{ $data->isshow2==1 ? 'checked' : '' }}> 显示&nbsp;&nbsp;</label>
                </td>
            </tr>
            <tr><td></td></tr>

            <tr><td colspan="2" style="text-align:center;">
                    <button class="companybtn" onclick="history.go(-1)">返 &nbsp;&nbsp;&nbsp;回</button>
                    <button type="submit" class="companybtn">保存修改</button>
                </td></tr>
        </table>
    </form>
@stop

