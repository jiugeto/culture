@extends('member.main')
@section('content')
    @include('member.common.crumb')
    <form data-am-validator method="POST" action="{{DOMAIN}}member/{{$lists['func']['url']}}" enctype="multipart/form-data">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <p style="text-align:center;"><b>{{$lists['func']['name']}}添加</b></p>
        <table class="table_create">
            <tr>
                <td class="field_name"><label>名称：</label></td>
                <td><input type="text" class="field_value" placeholder="至少2个字符" minlength="2" required name="name"/></td>
            </tr>

            <tr>
                <td class="field_name"><label>作品类型：</label></td>
                <td>
                    <select name="cate" required>
                        @foreach($model['cates'] as $k=>$vcate)
                            <option value="{{$k}}">{{$vcate}}</option>
                        @endforeach
                    </select>
                </td>
            </tr>

            <tr>
                <td class="field_name"><label>简介：</label></td>
                <td>
                    <textarea name="intro" cols="40" rows="5"></textarea>
                </td>
            </tr>

            <tr>
                <td class="field_name"><label>价格(元)：</label></td>
                <td><input type="text" class="field_value" placeholder="用户估价" pattern="^\d+$" required name="money" value="0"/></td>
            </tr>

            <tr><td colspan="2" style="text-align:center;">
                    <button class="companybtn" onclick="history.go(-1)">返 &nbsp;&nbsp;&nbsp;回</button>
                    <button type="submit" class="companybtn">保存添加</button>
                </td></tr>
        </table>
    </form>
@stop

