@extends('company.admin.main')
@section('content')
    @include('company.admin.common.crumb')

    <div class="com_admin_list">
        <form data-am-validator method="POST" action="{{DOMAIN_C_BACK}}firm/{{$data['id']}}" enctype="multipart/form-data">
            <input type="hidden" name="_token" value="{{csrf_token()}}">
            <input type="hidden" name="_method" value="POST">
            <table class="table_create">
                <tr>
                    <td class="field_name"><label>服务名称：</label></td>
                    <td class="right">
                        <input type="text" class="field_value" placeholder="至少2位" minlength="2" name="name" value="{{$data['name']}}"/>
                    </td>
                </tr>

                <tr>
                    <td class="field_name"><label>内容：</label></td>
                    <td class="right">
                        <textarea cols="30" rows="10" placeholder="至少2个字符" minlength="2" maxlength="255" required name="intro">{{$data['intro']}}</textarea>
                    </td>
                </tr>

                <tr>
                    <td class="field_name"><label>小字：</label></td>
                    <td class="right">
                        <input type="text" class="field_value" placeholder="至少2个字符，多组用|隔开" minlength="2" required name="small"value="{{$data['small']}}"/>
                    </td>
                </tr>

                <tr><td colspan="2" style="text-align:center;">
                        <button class="companybtn" onclick="history.go(-1)">返&nbsp; 回</button>
                        <button type="submit" class="companybtn">保存修改</button>
                    </td></tr>
            </table>
        </form>
    </div>
@stop

