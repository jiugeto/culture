@extends('member.main')
@section('content')
    @include('member.common.crumb')

    <form data-am-validator method="POST" action="{{DOMAIN}}member/personD/{{ $data->id }}" enctype="multipart/form-data">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <input type="hidden" name="_method" value="POST">
        <table class="table_create">
            <tr>
                <td><label>作品名称 / Name：</label></td>
                <td><input type="text" placeholder="至少2个字符" minlength="2" required name="name" value="{{ $data->name }}"/></td>
            </tr>
            <tr><td></td></tr>

            <tr>
                <td><label>作品类型 / Category：</label></td>
                <td>
                    <select name="cate_id">
                        <option value="0"
                                {{ $data->cate_id==0 ? 'selected' : '' }}>
                            -请选择-</option>
                        @foreach($categorys as $category)
                            <option value="{{ $category->id }}"
                                    {{ $data->cate_id==$category->id ? 'selected' : '' }}>
                                {{ $category->name }}</option>
                        @endforeach
                    </select>
                    {{--<a href="{{DOMAIN}}member/category/create/{{'个人需求'}}">[+添加类型]</a>--}}
                </td>
            </tr>
            <tr><td></td></tr>

            <tr>
                <td><label>设计说明 / Introduce：</label></td>
                <td>
                    <textarea name="intro" cols="50" rows="5">{{ $data->intro }}</textarea>
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
            <tr><td></td></tr>

            <tr>
                <td><label>作品链接 / Link：</label></td>
                <td><input type="text" placeholder="至少2个字符" minlength="2" required name="link_id" value="{{ $data->link_id }}"/></td>
            </tr>
            <tr><td></td></tr>

            <tr><td colspan="2" style="text-align:center;"><button type="submit" class="companybtn">保存添加</button></td></tr>
        </table>
    </form>
@stop

