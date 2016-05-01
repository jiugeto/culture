@extends('company.admin.main')
@section('content')
    @include('company.admin.common.crumb')

    <div class="com_admin_list">
        <form data-am-validator method="POST" action="/company/admin/ppt" enctype="multipart/form-data">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <table class="table_create">
                <tr>
                    <td class="field_name"><label>图片：</label></td>
                    <td class="right">
                        <select name="pic_id" required>
                            <option value="0">选择图片</option>
                            @if(count($pics))
                            @foreach($pics as $pic)
                                <option value="{{ $pic->id }}">{{ $pic->name }}</option>
                            @endforeach
                            @endif
                        </select>
                    </td>
                </tr>

                <tr>
                    <td class="field_name"><label>鼠标移动显示：</label></td>
                    <td class="right"><input type="text" class="field_value" name="title"/></td>
                </tr>

                <tr>
                    <td class="field_name"><label>排序：</label></td>
                    <td class="right"><input type="text" class="field_value" pattern="^\d+$" required name="sort2" value="10"/></td>
                </tr>

                <tr>
                    <td class="field_name"><label>公司前台显示否：</label></td>
                    <td class="right">
                        <label><input type="radio" name="isshow2" value="0"> 不显示&nbsp;&nbsp;</label>
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

