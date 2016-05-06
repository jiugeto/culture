@extends('company.admin.main')
@section('content')
    @include('company.admin.common.crumb')

    <div class="com_admin_list">
        <h3 class="center pos">{{ $lists['func']['name'] }}{{--详情页--}}</h3>
        <table class="table_create" cellspacing="0" cellpadding="0" id="t1">
            <tr>
                <td class="field_name" style="text-align:center;" colspan="2">
                    <b>功能页面设置</b>
                    &nbsp;&nbsp;&nbsp;
                </td>
            </tr>
            <tr>
                <td class="field_name">显示控制：</td>
                <td>
                    <table class="radio">
                        @if(count($modules))
                            @foreach($modules as $module)
                        <tr>
                            <td class="first"><b>{{ $module->name }}</b></td>
                            <td><label><input type="radio" class="radio_pos" name="isshow{{$module->id}}" value="0" {{ $module->isshow==0 ? 'checked' : '' }}> 不显示&nbsp;&nbsp;</label></td>
                            <td><label><input type="radio" class="radio_pos" name="isshow{{$module->id}}" value="1" {{ $module->isshow==1 ? 'checked' : '' }}> 显示&nbsp;&nbsp;</label><br></td>
                        </tr>
                            @endforeach
                        @endif
                    </table>
                </td>
            </tr>
            <tr>
                <td class="field_name">顺序控制：</td>
                <td></td>
            </tr>
        </table>

        <table class="table_create" cellspacing="0" cellpadding="0" id="t2" style="display:none;">
            <tr>
                <td class="field_name" style="text-align:center;" colspan="2">
                    <b>首页设置</b>
                    &nbsp;&nbsp;&nbsp;
                </td>
            </tr>
            <tr>
                <td class="field_name">显示控制：</td>
                <td></td>
            </tr>
            <tr>
                <td class="field_name">顺序控制：</td>
                <td></td>
            </tr>
        </table>

        <table class="table_create" cellspacing="0" cellpadding="0">
            <tr><td class="center" colspan="3" style="border:0;cursor:pointer;">
                    {{--<a href="/company/admin/layout/{{$data->id}}/edit">--}}
                        {{--<button class="companybtn">修&nbsp;&nbsp;改</button></a>--}}
                    <a><button class="companybtn" onclick="history.go(-1)">返&nbsp;&nbsp;回</button></a>
                </td></tr>
        </table>
    </div>
@stop

