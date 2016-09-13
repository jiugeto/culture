@extends('company.admin.main')
@section('content')
    @include('company.admin.common.crumb')

    <div class="com_admin_list">
        <form data-am-validator method="POST" action="{{DOMAIN}}company/admin/contact/{{ $data->id }}" enctype="multipart/form-data">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <input type="hidden" name="_method" value="POST">
            <table class="table_create">
                <tr>
                    <td class="field_name"><label>公司座机：</label></td>
                    <td class="right">
                        <input type="text" class="field_value" style="width:60px;" placeholder="例：0571" pattern="^\d{3,4}$" name="areacode" value="{{ $data->areacode?$data->areacode:'' }}"/> -
                        <input type="text" class="field_value" style="width:200px;" placeholder="例：88882345" pattern="^\d{8}$" name="tel" value="{{ $data->tel?$data->tel:'' }}"/>
                    </td>
                </tr>

                <tr>
                    <td class="field_name"><label>企业QQ：</label></td>
                    <td class="right"><input type="text" class="field_value" placeholder="至少5位" minlength="5" name="qq" value="{{ $data->qq?$data->qq:'' }}"/></td>
                </tr>

                <tr>
                    <td class="field_name"><label>公司网址：</label></td>
                    <td class="right"><input type="text" class="field_value" placeholder="至少5位" pattern="^([\w-]+\.)+[\w-]+(/[\w- ./?%&=]*)?$" minlength="5" name="web" value="{{ $data->web?$data->web:'' }}"/></td>
                </tr>

                <tr>
                    <td class="field_name"><label>传真：</label></td>
                    <td class="right"><input type="text" class="field_value" placeholder="例：(65) 62236601" minlength="5" name="fax" value="{{ $data->fax?$data->fax:'' }}"/></td>
                </tr>

                <tr>
                    <td class="field_name"><label>邮编：</label></td>
                    <td class="right"><input type="text" class="field_value" placeholder="例：310026" pattern="^\d{6}$" name="zipcode" value="{{ $data->zipcode?$data->zipcode:'' }}"/></td>
                </tr>

                <tr>
                    <td class="field_name"><label>企业邮箱：</label></td>
                    <td class="right"><input type="text" class="field_value" placeholder="例：xxx@xxx.com" pattern="^\([\.a-zA-Z0-9_-])+@([a-zA-Z0-9_-])+(\.[a-zA-Z0-9_-])+$" name="email" value="{{ $data->email?$data->email:'' }}"/></td>
                </tr>

                <tr>
                    <td class="field_name"><label>公司地址：</label></td>
                    <td class="right"><input type="text" class="field_value" placeholder="至少2个字符" minlength="2" name="address" value="{{ $data->address }}"/></td>
                </tr>

                <tr><td colspan="2" style="text-align:center;">
                        <button class="companybtn" onclick="history.go(-1)">返&nbsp; 回</button>
                        <button type="submit" class="companybtn">保存修改</button>
                    </td></tr>
            </table>
        </form>
    </div>
@stop

