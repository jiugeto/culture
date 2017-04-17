@extends('company.admin.main')
@section('content')
    @include('company.admin.common.crumb')

    <div class="com_admin_list">
        <form data-am-validator method="POST" action="{{DOMAIN_C_BACK}}singlemodule/{{$data['id']}}" enctype="multipart/form-data">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <input type="hidden" name="_method" value="POST">
            <h4 style="padding:10px;padding-top:40px;text-align:center;">单页模块添加</h4>
            <table class="table_create">
                <tr>
                    <td class="field_name"><label>模块名称：</label></td>
                    <td class="right">
                        <input type="text" class="field_value" placeholder="至少2位" minlength="2" name="name" value="{{$data['name']}}"/>
                    </td>
                </tr>

                <tr>
                    <td class="field_name"><label>内容：</label></td>
                    <td class="right">
                        <textarea name="intro" cols="40" rows="10" required style="resize:none;">{{$data['intro']}}</textarea>
                    </td>
                </tr>

                <tr><td colspan="2" style="text-align:center;">
                        <button class="companybtn" onclick="history.go(-1)">返 &nbsp;&nbsp;&nbsp;回</button>
                        <button type="submit" class="companybtn">保存修改</button>
                    </td></tr>
            </table>
        </form>
    </div>
@stop

