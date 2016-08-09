{{-- 商品的创建模板 --}}

<table class="table_create">
    <tr>
        <td class="field_name"><label>名称：</label></td>
        <td><input type="text" class="field_value" placeholder="至少2个字符" minlength="2" required name="name"/></td>
    </tr>
    {{--<tr><td></td></tr>--}}

    {{--<tr>--}}
        {{--<td class="field_name"><label>作品类型：</label></td>--}}
        {{--<td>--}}
            {{--<select name="cate_id">--}}
                {{--<option value="0">-请选择-</option>--}}
                {{--@foreach($categorys as $category)--}}
                    {{--<option value="{{ $category->id }}">{{ $category->name }}</option>--}}
                    {{--@if($category->child)--}}
                        {{--@foreach($category->child as $subcate)--}}
                            {{--<option value="{{ $subcate->id }}">{{ '&nbsp;=='.$subcate->name }}</option>--}}
                            {{--@if($subcate->child)--}}
                                {{--@foreach($subcate->child as $subcate2)--}}
                                    {{--<option value="{{ $subcate2->id }}">--}}
                                        {{--{{ '&nbsp;&nbsp;&nbsp;&nbsp;=='.$subcate2->name }}</option>--}}
                                {{--@endforeach--}}
                            {{--@endif--}}
                        {{--@endforeach--}}
                    {{--@endif--}}
                {{--@endforeach--}}
            {{--</select>--}}
            {{--<a href="/member/category/create/{{'个人需求'}}">[+添加类型]</a>--}}
        {{--</td>--}}
    {{--</tr>--}}
    {{--<tr><td></td></tr>--}}

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
    {{--<tr><td></td></tr>--}}

    <tr>
        <td class="field_name"><label>鼠标移动的文字：</label></td>
        <td><input type="text" class="field_value" placeholder="至少2个字符" minlength="2" required name="title"/></td>
    </tr>
    {{--<tr><td></td></tr>--}}

    <tr>
        <td class="field_name"><label>截图：</label></td>
        <td>
            {{--<input type="text" class="field_value" placeholder="至少2个字符" minlength="2" required name="link_id"/>--}}
            <select name="pic_id">
                <option value="">选择您的图片</option>
            @if(count($model->pics()))
                @foreach($model['pics'] as $pic)
                <option value="{{ $pic->id }}"><img src="{{ $pic->url }}" style="width:50px;"> {{ $pic->name }}</option>
                @endforeach
            @endif
            </select>
        </td>
    </tr>
    {{--<tr><td></td></tr>--}}

    <tr>
        <td class="field_name"><label>链接：</label></td>
        <td>
            {{--<input type="text" class="field_value" placeholder="至少2个字符" minlength="2" required name="video_id"/>--}}
            <select name="pic_id">
                <option value="">选择您的链接</option>
            @if(count($model->videos()))
                @foreach($model['$videos'] as $video)
                <option value="{{ $video->id }}">{{ $video->url }}</option>
                @endforeach
            @endif
            </select>
        </td>
    </tr>
    {{--<tr><td></td></tr>--}}

    <tr><td colspan="2" style="text-align:center;">
            <button class="companybtn" onclick="history.go(-1)">返 &nbsp;&nbsp;&nbsp;回</button>
            <button type="submit" class="companybtn">保存添加</button>
        </td></tr>
</table>
