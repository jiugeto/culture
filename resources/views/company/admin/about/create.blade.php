@extends('company.admin.main')
@section('content')
    @include('company.admin.common.crumb')

    <div class="com_admin_list">
        <form data-am-validator method="POST" action="/company/admin/about" enctype="multipart/form-data">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <table class="table_create">
                <tr>
                    <td class="field_name"><label>页面名称：</label></td>
                    <td class="right"><input type="text" class="field_value" placeholder="至少2位" minlength="2" name="name"/></td>
                </tr>

                <tr>
                    <td class="field_name"><label>页面类型：</label></td>
                    <td class="right">
                        <select name="type" required>
                        @if(count($model['types']))
                            @foreach($model['types'] as $ktype=>$type)
                                @if($ktype<=4)
                                <option value="{{ $ktype }}">{{ $type }}</option>
                                @endif
                            @endforeach
                        @endif
                        </select>
                    </td>
                </tr>

                <tr>
                    <td class="field_name"><label>内容：</label></td>
                    <td class="right" style="position:relative;z-index:0;">
                        @include('company.admin.common.editor')
                    </td>
                </tr>

                <tr>
                    <td class="field_name"><label>排序：</label></td>
                    <td class="right"><input type="text" class="field_value" pattern="^\d+$" name="sort" value="10"/></td>
                </tr>

                <tr>
                    <td class="field_name"><label>前台是否显示：</label></td>
                    <td class="right">
                        <label><input type="radio" name="isshow" value="0"> 不显示&nbsp;&nbsp;</label>
                        <label><input type="radio" name="isshow" value="1" checked> 显示&nbsp;&nbsp;</label>
                    </td>
                </tr>

                <tr><td colspan="2" style="text-align:center;">
                        <button class="companybtn" onclick="history.go(-1)">返 &nbsp; 回</button>
                        <button type="submit" class="companybtn">保存添加</button>
                    </td></tr>
            </table>
        </form>
    </div>
@stop

