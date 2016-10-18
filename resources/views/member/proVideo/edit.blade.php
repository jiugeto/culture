@extends('member.main')
@section('content')
    @include('member.common.crumb')

    <form data-am-validator method="POST" action="{{DOMAIN}}member/proVideo/{{ $data->id }}" enctype="multipart/form-data">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <input type="hidden" name="_method" value="POST">
        <table class="table_create">
            <tr>
                <td class="field_name"><label>名称：</label></td>
                <td><input type="text" class="field_value" placeholder="至少2个字符" minlength="2" required name="name" value="{{ $data->name }}"/></td>
            </tr>
            {{--<tr><td colspan="2"><div style="border-bottom:1px dashed ghostwhite;"></div></td></tr>--}}

            <tr>
                <td class="field_name"><label>类别：</label></td>
                <td>
                    <select name="cate">
                        @foreach($model['cates2'] as $kcate=>$vcate)
                            <option value="{{ $kcate }}" {{ $kcate==$data->cate ? 'selected' : '' }}>{{ $vcate }}</option>
                        @endforeach
                    </select>
                </td>
            </tr>
            {{--<tr><td colspan="2"><div style="border-bottom:1px dashed ghostwhite;"></div></td></tr>--}}

            <tr>
                <td class="field_name"><label>修改要求：</label></td>
                <td>
                    <textarea name="intro" cols="40" rows="5">{{ $data->intro }}</textarea>
                </td>
            </tr>
            {{--<tr><td colspan="2"><div style="border-bottom:1px dashed ghostwhite;"></div></td></tr>--}}

            @if($data->genre==2)
                <tr>
                    <td class="field_name"><label>视频效果链接：</label></td>
                    <td><textarea placeholder="" required name="link" cols="50" rows="5">{{ $data->link }}</textarea></td>
                </tr>
                {{--<tr><td colspan="2"><div style="border-bottom:1px dashed ghostwhite;"></div></td></tr>--}}
            @endif

            <tr><td colspan="2" style="text-align:center;">
                    <button class="companybtn" onclick="history.go(-1)">返 &nbsp;&nbsp;&nbsp;回</button>
                    <button type="submit" class="companybtn">保存修改</button>
                </td></tr>
        </table>
    </form>
@stop

