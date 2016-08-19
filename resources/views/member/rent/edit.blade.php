@extends('member.main')
@section('content')
    @include('member.common.crumb')

    <form data-am-validator method="POST" action="{{DOMAIN}}member/rent/{{ $data->id }}" enctype="multipart/form-data">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <input type="hidden" name="_method" value="POST">
        <table class="table_create">
            <tr>
                <td><label>设备名称 / Name：</label></td>
                <td><input type="text" placeholder="至少2个字符" minlength="2" required name="name" value="{{ $data->name }}"/></td>
            </tr>
            <tr><td></td></tr>

            <tr>
                <td><label>供求关系 / Genre：</label></td>
                <td>
                    <label><input type="radio" name="genre" value="1" {{ $data->genre==1 ? 'checked' : '' }}/> 租赁供应&nbsp;&nbsp;</label>
                    <label><input type="radio" name="genre" value="2" {{ $data->genre==2 ? 'checked' : '' }}/> 租赁需求&nbsp;&nbsp;</label>
                </td>
            </tr>
            <tr><td></td></tr>

            <tr>
                <td><label>简介 / Introduce：</label></td>
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
                <td><label>价格 / Pricce：</label></td>
                <td><input type="text" placeholder="数字" pattern="^(\d+)|(\d+\.\d{2})$" required name="price" value="{{ $data->price }}"/></td>
            </tr>
            <tr><td></td></tr>

            <tr><td colspan="2" style="text-align:center;">
                    <button class="companybtn" onclick="history.go(-1)">返 &nbsp;&nbsp;&nbsp;回</button>
                    <button type="submit" class="companybtn">保存修改</button>
                </td></tr>
        </table>
    </form>
@stop

