@extends('member.main')
@section('content')
    @include('member.common.crumb')

    <form data-am-validator method="POST" action="{{DOMAIN}}member/rent/{{ $data['id'] }}" enctype="multipart/form-data">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <input type="hidden" name="_method" value="POST">
        <table class="table_create">
            <tr>
                <td class="field_name"><label>设备名称：</label></td>
                <td><input type="text" placeholder="至少2个字符" minlength="2" required name="name" value="{{ $data['name'] }}"/></td>
            </tr>

            <tr>
                <td class="field_name"><label>设备类型：</label></td>
                <td>
                    <select name="type">
                        @foreach($model['types'] as $ktype=>$vtype)
                            <option value="{{ $ktype }}" {{ $data['type']==$ktype ? 'selected' : '' }}>{{ $vtype }}</option>
                        @endforeach
                    </select>
                </td>
            </tr>

            <tr>
                <td class="field_name"><label>简介：</label></td>
                <td>
                    <textarea name="intro" cols="50" rows="5">{{ $data['intro'] }}</textarea>
                </td>
            </tr>

            <tr>
                <td class="field_name"><label>价格(元)：</label></td>
                <td><input type="text" placeholder="数字" pattern="^\d+$" required name="money" value="{{ $data['money'] }}"/></td>
            </tr>

            <tr>
                <td class="field_name"><label>租赁起始时间：</label></td>
                <td>
                    <input type="text" placeholder="如：2016" pattern="^[1-9]\d{3}$" name="from_y"
                           value="{{date('Y',$data['fromtime'])}}" style="width:60px"/> 年
                    <input type="text" placeholder="如：01" pattern="^\d{1,2}$" minlength="1" maxlength="12" name="from_m"
                           value="{{date('m',$data['fromtime'])}}" style="width:40px"/> 月
                    <input type="text" placeholder="如：01" pattern="^\d{1,2}$" minlength="1" maxlength="31" name="from_d"
                           value="{{date('d',$data['fromtime'])}}" style="width:40px"/> 日
                </td>
            </tr>

            <tr>
                <td class="field_name"><label>租赁结束时间：</label></td>
                <td>
                    <input type="text" placeholder="如：2016" pattern="^[1-9]\d{3}$" name="to_y"
                           value="{{date('Y',$data['totime'])}}" style="width:60px"/> 年
                    <input type="text" placeholder="如：01" pattern="^\d{1,2}$" minlength="1" maxlength="12" name="to_m"
                           value="{{date('m',$data['totime'])}}" style="width:40px"/> 月
                    <input type="text" placeholder="如：01" pattern="^\d{1,2}$" minlength="1" maxlength="31" name="to_d"
                           value="{{date('d',$data['totime'])}}" style="width:40px"/> 日
                </td>
            </tr>

            <tr><td colspan="2" style="text-align:center;">
                    <button class="companybtn" onclick="history.go(-1)">返 &nbsp;&nbsp;&nbsp;回</button>
                    <button type="submit" class="companybtn">保存修改</button>
                </td></tr>
        </table>
    </form>
@stop

