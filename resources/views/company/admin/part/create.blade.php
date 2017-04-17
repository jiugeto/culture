@extends('company.admin.main')
@section('content')
    @include('company.admin.common.crumb')

    <div class="com_admin_list">
        <h3 class="center pos">花絮添加</h3>
        <form data-am-validator method="POST" action="{{DOMAIN_C_BACK}}part"
              enctype="multipart/form-data">
            <input type="hidden" name="_token" value="{{csrf_token()}}">
            <table class="table_create">
                <tr>
                    <td class="field_name"><label>花絮名称：</label></td>
                    <td class="right">
                        <input type="text" class="field_value" placeholder="至少2个字符"
                               minlength="2" required name="name"/>
                    </td>
                </tr>

                <tr>
                    <td class="field_name"><label>类型：</label></td>
                    <td class="right">
                        <select name="genre" required>
                        @foreach($model['genres'] as $k=>$vgenre)
                            <option value="{{$k}}">{{$vgenre}}</option>
                        @endforeach
                        </select>
                    </td>
                </tr>

                <tr>
                    <td class="field_name"><label>简单介绍：</label></td>
                    <td class="right">
                        <textarea name="intro" cols="40" rows="10" required></textarea>
                    </td>
                </tr>

                <tr><td colspan="2" style="text-align:center;">
                        <button class="companybtn" onclick="history.go(-1)">返&nbsp;&nbsp; 回</button>
                        <button type="submit" class="companybtn">保存添加</button>
                    </td></tr>
            </table>
        </form>
    </div>
@stop

