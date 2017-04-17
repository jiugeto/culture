@extends('company.admin.main')
@section('content')
    @include('company.admin.common.crumb')

    <div class="com_admin_list">
        <form data-am-validator method="POST" action="{{DOMAIN_C_BACK}}link" enctype="multipart/form-data">
            <input type="hidden" name="_token" value="{{csrf_token()}}">
            <table class="table_create">
                <tr>
                    <td class="field_name"><label>链接名称：</label></td>
                    <td class="right">
                        <input type="text" class="field_value" placeholder="至少2位" minlength="2" required name="name"/>
                    </td>
                </tr>

                <tr>
                    <td class="field_name"><label>类型：</label></td>
                    <td class="right">
                        <select name="type" required>
                        @if(count($model['types']))
                            @foreach($model['types'] as $k=>$vtype)
                                @if($k!=1)
                            <option value="{{$k}}">{{$vtype}}</option>
                                @endif
                            @endforeach
                        @endif
                        </select>
                    </td>
                </tr>

                <tr>
                    <td class="field_name"><label>鼠标移动显示：</label></td>
                    <td class="right">
                        <input type="text" class="field_value" name="title">
                    </td>
                </tr>

                <tr>
                    <td class="field_name"><label>简介：</label></td>
                    <td class="right">
                        <textarea cols="40" rows="5" name="intro"></textarea>
                    </td>
                </tr>

                <tr>
                    <td class="field_name"><label>当前链接：</label></td>
                    <td class="right">
                        <input type="text" class="field_value" placeholder="至少2个字符" required name="link"/>
                    </td>
                </tr>

                <tr>
                    <td class="field_name"><label>显示方式：</label></td>
                    <td class="right">
                        <label style="cursor:pointer;"><input type="radio" style="height:18px" name="display_way" value="1" checked onclick="$('#thumb').hide()"> 文字方式显示&nbsp;&nbsp;</label>
                        <label style="cursor:pointer;"><input type="radio" style="height:18px" name="display_way" value="2" onclick="$('#thumb').show()"> 图片方式显示&nbsp;&nbsp;</label>
                    </td>
                </tr>

                <tr id="thumb" style="display:none;">
                    <td colspan="2">先添加，再上传缩略图。</td>
                </tr>

                <tr><td colspan="2" style="text-align:center;">
                        <button class="companybtn" onclick="history.go(-1)">返&nbsp;回</button>
                        <button type="submit" class="companybtn">保存添加</button>
                    </td></tr>
            </table>
        </form>
    </div>
@stop

