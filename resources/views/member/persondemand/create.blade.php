@extends('member.main')
@section('content')
    @include('member.common.crumb')

    <form data-am-validator method="POST" action="/admin/persondemand" enctype="multipart/form-data">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <table class="table_create">
            <tr>
                <td><label>作品名称 / Name：</label></td>
                <td><input type="text" placeholder="至少2个字符" minlength="2" required name="name"/></td>
            </tr>

            <tr>
                <td><label>作品类型 / Category：</label></td>
                <td>
                    <select name="cate_id">
                        <option value="">-请选择-</option>
                    </select>
                </td>
            </tr>

            <tr>
                <td><label>设计说明 / Introduce：</label></td>
                <td><textarea name="intro" cols="50" rows="5"></textarea></td>
            </tr>

            <tr>
                <td><label>作品链接 / Link：</label></td>
                <td><input type="text" placeholder="至少2个字符" minlength="2" required name="price"/></td>
            </tr>

            <tr><td colspan="2" style="text-align:center;"><button type="submit" class="companybtn">保存添加</button></td></tr>
        </table>
    </form>
@stop

