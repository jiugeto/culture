@extends('company.admin.main')
@section('content')
    @include('company.admin.common.crumb')

    <div class="com_admin_list">
        <form data-am-validator method="POST" action="{{DOMAIN}}company/admin/job" enctype="multipart/form-data">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <input type="hidden" name="type" value="5">{{--招聘type==5--}}
            <input type="hidden" name="genre" value="1">{{--招聘genre==1--}}
            <table class="table_create">
                <tr>
                    <td class="field_name"><label>岗位名称：</label></td>
                    <td class="right"><input type="text" class="field_value" placeholder="至少2位" minlength="2" name="name"/></td>
                </tr>

                <tr>
                    <td class="field_name"><label>需要人数：</label></td>
                    <td class="right"><input type="text" class="field_value" placeholder="数字" pattern="^\d+$" required name="number"/></td>
                </tr>

                <tr>
                    <td class="field_name"><label>工作要求：</label></td>
                    <td class="right" style="position:relative;z-index:0;">
                        @include('company.admin.common.editor')
                    </td>
                </tr>

                <tr>
                    <td class="field_name"><label>排序：</label></td>
                    <td class="right"><input type="text" class="field_value" pattern="^\d+$" name="sort" value="10"/></td>
                </tr>

                <tr>
                    <td class="field_name"><label>前台公司页面显示否：</label></td>
                    <td class="right">
                        <label><input type="radio" name="isshow" value="0"> 不显示&nbsp;&nbsp;</label>
                        <label><input type="radio" name="isshow" value="1" checked> 显示&nbsp;&nbsp;</label>
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

