@extends('member.main')
@section('content')
    @include('member.common.crumb')
    <form data-am-validator method="POST" action="{{DOMAIN}}member/goods/{{ $data['id'] }}" enctype="multipart/form-data">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <input type="hidden" name="_method" value="POST">
        <p style="text-align:center;"><b>视频修改</b></p>
        <table class="table_create">
            <tr>
                <td class="field_name"><label>作品名称：</label></td>
                <td><input type="text" class="field_value" placeholder="至少2个字符" minlength="2" required name="name" value="{{ $data['name'] }}"/></td>
            </tr>
            <tr><td></td></tr>

            <tr>
                <td class="field_name"><label>作品类型：</label></td>
                <td>
                    <select name="cate" required>
                        @foreach($model['cates'] as $kcate=>$vcate)
                            <option value="{{ $kcate }}" {{ $data['cate']==$kcate ? 'selected' : '' }}>{{ $vcate }}</option>
                        @endforeach
                    </select>
                </td>
            </tr>
            <tr><td></td></tr>

            <tr>
                <td class="field_name"><label>设计说明：</label></td>
                <td>
                    <textarea name="intro" cols="40" rows="5">{{ $data['intro'] }}</textarea>
                </td>
            </tr>
            <tr><td></td></tr>

            <tr>
                <td class="field_name"><label>价格(元)：</label></td>
                <td><input type="text" class="field_value" placeholder="用户估价" pattern="^\d+$" required name="money" value="{{$data['money']}}"/></td>
            </tr>

            <tr><td colspan="2" style="text-align:center;">
                    <button class="companybtn" onclick="history.go(-1)">返 &nbsp;&nbsp;&nbsp;回</button>
                    <button type="submit" class="companybtn">保存修改</button>
                </td></tr>
        </table>
    </form>
@stop

