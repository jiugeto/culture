@extends('member.main')
@section('content')
    @include('member.common.crumb')

    <form data-am-validator method="POST" action="{{DOMAIN}}member/design" enctype="multipart/form-data">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <h3 class="center">{{$lists['func']['name']}} 添加页</h3>
        <table class="table_create">
            <tr>
                <td class="field_name"><label>设计名称：</label></td>
                <td><input type="text" placeholder="至少2个字符" minlength="2" required name="name"/></td>
            </tr>

            <tr>
                <td class="field_name"><label>设计类型：</label></td>
                <td>
                    <select name="cate" required>
                    @foreach($model['cates'] as $k=>$vcate)
                        <option value="{{$k}}">{{$vcate}}</option>
                    @endforeach
                    </select>
                </td>
            </tr>

            <tr>
                <td class="field_name"><label>价格(元)：</label></td>
                <td><input type="text" placeholder="" pattern="^\d+$" required name="money"/></td>
            </tr>

            <tr>
                <td class="field_name"><label>简介：</label></td>
                <td><textarea name="intro" cols="50" rows="5" required></textarea></td>
            </tr>

            <tr>
                <td class="field_name"><label>详情：</label></td>
                <td><textarea name="detail" cols="50" rows="5" required></textarea></td>
            </tr>

            <tr><td colspan="2" style="text-align:center;">
                    <button class="companybtn" onclick="history.go(-1)">返 回</button>
                    <button type="submit" class="companybtn">保存添加</button>
                </td></tr>
        </table>
    </form>
@stop

