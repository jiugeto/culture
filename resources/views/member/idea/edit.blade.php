@extends('member.main')
@section('content')
    @include('member.common.crumb')

    <form data-am-validator method="POST" action="/member/idea/{{ $data->id }}" enctype="multipart/form-data">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <input type="hidden" name="_method" value="POST">
        <table class="table_create">
            <tr>
                <td><label>创意名称 / Name：</label></td>
                <td><input type="text" placeholder="至少2个字符" minlength="2" required name="name" value="{{ $data->name }}"/></td>
            </tr>
            <tr><td></td></tr>

            <tr>
                <td><label>分类 / Category：</label></td>
                <td>
                    <select name="cate_id" required>
                        <option value="0">-请选择-</option>
                        @foreach($categorys as $category)
                            <option value="{{ $category->id }}" {{ $data->cate_id==$category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                            @if($category->child)
                                @foreach($category->child as $subcate)
                                    <option value="{{ $subcate->id }}" {{ $data->cate_id==$subcate->id ? 'selected' : '' }}>{{ '&nbsp;=='.$subcate->name }}</option>
                                    @if($subcate->child)
                                        @foreach($subcate->child as $subcate2)
                                            <option value="{{ $subcate2->id }}" {{ $data->cate_id==$subcate2->id ? 'selected' : '' }}>
                                                {{ '&nbsp;&nbsp;&nbsp;&nbsp;=='.$subcate2->name }}</option>
                                        @endforeach
                                    @endif
                                @endforeach
                            @endif
                        @endforeach
                    </select>
                    {{--<a href="/member/category/create/{{'个人需求'}}">[+添加类型]</a>--}}
                </td>
            </tr>
            <tr><td></td></tr>

            <tr>
                <td><label>内容 / Contont：</label></td>
                <td>
                    @include('UEditor::head')
                    <script id="container" name="intro" type="text/plain">
                        {!! $data->content !!}
                    </script>
                    <!-- 实例化编辑器 -->
                    <script type="text/javascript">
                        var ue = UE.getEditor('container',{
                            initialFrameWidth:500,
                            initialFrameHeight:200,
                            toolbars:[['redo','undo','bold','italic','underline','strikethrough','horizontal','forecolor','fontfamily','fontsize','priview','directionality','paragraph','insertimage','magefloat','searchreplace','pasteplain','help']]
                        });
                        ue.ready(function() {
                            //此处为支持laravel5 csrf ,根据实际情况修改,目的就是设置 _token 值.
                            ue.execCommand('serverparam', '_token', '{{ csrf_token() }}');
                        });
                    </script>
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
