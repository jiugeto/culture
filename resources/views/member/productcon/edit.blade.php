@extends('member.main')
@section('content')
    @include('member.common.crumb')

    <form data-am-validator method="POST" action="/member/productcon/{{ $data->id }}" enctype="multipart/form-data">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <input type="hidden" name="_method" value="POST">
        <table class="table_create">
            <tr>
                <td class="field_name"><label>类型：</label></td>
                <td>
                    <select name="genre" required>
                        @if(count($model['genres']))
                            @foreach($model['genres'] as $kgenre=>$genre)
                                <option value="{{ $kgenre }}" {{ $data->genre==$kgenre ? 'selected' : '' }}>{{ $genre }}</option>
                            @endforeach
                        @endif
                    </select>
                </td>
            </tr>
            {{--<tr><td></td></tr>--}}
            <script>
                $(document).ready(function(){
                    var name = $("#name");
                    var pic = $("#pic");
                    $("select[name='genre']").change(function(){
                        if(this.value==1){ pic.show(); name.hide(); }
                        if(this.value==2){ name.show(); pic.hide(); }
                    });
                });
            </script>

            <tr id="pic">
                <td class="field_name"><label>图片：</label></td>
                <td>
                    <select name="pic_id">
                    @if(count($model->pics()))
                        @foreach($model->pics() as $pic)
                            <option value="{{ $pic->id }}" {{ $data->pic_id==$pic->id ? 'selected' : '' }}>{{ $pic->name }}</option>
                        @endforeach
                    @else
                        <option value="">暂无图片</option>
                    @endif
                    </select>
                    &nbsp;<a href="/member/pic" class="star">图片列表</a>
                </td>
            </tr>
            {{--<tr><td></td></tr>--}}

            <tr id="name" style="display:none;">
                <td class="field_name"><label>文字：</label></td>
                <td><input type="text" class="field_value" placeholder="至少2个字符" minlength="2" name="name" value="{{ $data->name }}"/></td>
            </tr>
            {{--<tr><td></td></tr>--}}

            <tr>
                <td class="field_name"><label>产品名称：</label></td>
                <td>
                    <select name="productid" required>
                    @if(count($model->products()))
                        @foreach($model->products() as $product)
                            <option value="{{ $product->id }}" {{ $data->productid==$product->id ? 'selected' : '' }}>{{ $product->name }}</option>
                        @endforeach
                    @endif
                    </select>
                    &nbsp;<a href="/member/product" class="star">产品列表</a>
                </td>
            </tr>
            {{--<tr><td></td></tr>--}}

            <tr>
                <td class="field_name"><label>属性名称：</label></td>
                <td>
                    <select name="attrid" required>
                    @if(count($model->attrs()))
                        @foreach($model->attrs() as $attr)
                            <option value="{{ $attr->name }}" {{ $data->attrid==$attr->id ? 'selected' : '' }}>{{ $attr->name }}</option>
                        @endforeach
                    @endif
                    </select>
                    &nbsp;<a href="/member/productattr" class="star">属性列表</a>
                </td>
            </tr>
            {{--<tr><td></td></tr>--}}

            <tr>
                <td class="field_name"><label>简介：</label></td>
                <td><textarea name="intro" cols="40" rows="5">{{ $data->intro }}</textarea></td>
            </tr>
            {{--<tr><td></td></tr>--}}

            <tr><td colspan="2" style="text-align:center;">
                    <button class="companybtn" onclick="history.go(-1)">返 回</button>
                    <button type="submit" class="companybtn">保存修改</button>
                </td></tr>
        </table>
    </form>
@stop

