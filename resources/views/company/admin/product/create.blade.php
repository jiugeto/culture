@extends('company.admin.main')
@section('content')
    @include('company.admin.common.crumb')

    <div class="com_admin_list">
        <form data-am-validator method="POST" action="/company/admin/product" enctype="multipart/form-data">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <table class="table_create">
                <tr>
                    <td class="field_name"><label>产品名称：</label></td>
                    <td class="right"><input type="text" class="field_value" name="name"/></td>
                </tr>

                <tr>
                    <td class="field_name"><label>类型：</label></td>
                    <td class="right">
                        <select name="cate_id">
                            <option value="">选择类型</option>
                        </select>
                    </td>
                </tr>

                <tr>
                    <td class="field_name"><label>简单介绍：</label></td>
                    <td class="right"><textarea name="intro" cols="40" rows="5"></textarea></td>
                </tr>

                <tr>
                    <td class="field_name"><label>鼠标移动显示：</label></td>
                    <td class="right"><input type="text" class="field_value" name="title"/></td>
                </tr>

                <tr>
                    <td class="field_name"><label>图片：</label></td>
                    <td class="right">
                        <select name="cate_id">
                            <option value="">选择图片</option>
                        </select>
                    </td>
                </tr>

                <tr>
                    <td class="field_name"><label>链接：</label></td>
                    <td class="right">
                        <select name="cate_id">
                            <option value="">选择链接</option>
                        </select>
                    </td>
                </tr>

                <tr>
                    <td class="field_name"><label>前台显示否：</label></td>
                    <td class="right">
                        <label><input type="radio" name="isshow2" value="0" checked> 不显示&nbsp;&nbsp;</label>
                        <label><input type="radio" name="isshow2" value="1" checked> 显示&nbsp;&nbsp;</label>
                    </td>
                </tr>

                <tr><td colspan="2" style="text-align:center;">
                        <button class="companybtn" onclick="history.go(-1)">返 &nbsp;&nbsp;&nbsp;回</button>
                        <button type="submit" class="companybtn">保存添加</button>
                    </td></tr>
            </table>
        </form>
    </div>
@stop

