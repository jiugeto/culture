@extends('company.admin.main')
@section('content')
    @include('company.admin.common.crumb')

    <div class="com_admin_list">
        <form data-am-validator method="POST" action="{{DOMAIN_C_BACK}}ppt/{{$data['id']}}" enctype="multipart/form-data">
            <input type="hidden" name="_token" value="{{csrf_token()}}">
            <input type="hidden" name="_method" value="POST">
            <table class="table_create">
                <tr>
                    <td class="field_name"><label>广告名称：</label></td>
                    <td class="right">
                        <input type="text" class="field_value" placeholder="至少2个字符" minlength="2" required name="name" value="{{$data['name']}}"/>
                    </td>
                </tr>

                <tr>
                    <td class="field_name"><label>广告位：</label></td>
                    <td class="right">
                        <select name="adplace" required>
                        @if(count($adplaces))
                            @foreach($adplaces as $adplace)
                            <option value="{{$adplace['id']}}" {{$data['adplace_id']==$adplace['id']?'selected':''}}>
                                {{$adplace['name'].'('.$adplace['width'].'*'.$adplace['height'].')'}}</option>
                            @endforeach
                        @endif
                        </select>
                    </td>
                </tr>

                <tr>
                    <td class="field_name"><label>广告介绍：</label></td>
                    <td class="right">
                        <textarea cols="50" rows="10" name="intro">{{$data['intro']}}</textarea>
                    </td>
                </tr>

                <tr>
                    <td class="field_name"><label>广告链接：</label></td>
                    <td class="right">
                        <input type="text" class="field_value" placeholder="跳转的链接地址，例：wwww.baidu.com/..." required name="link" value="{{$data['link']}}"/>
                    </td>
                </tr>

                <tr>
                    <td class="field_name"><label>广告期限：</label></td>
                    <td class="right">
                        <label style="cursor:pointer;"><input type="radio" style="position:relative;top:10px;" name="isperiod" value="0" {{(!$data['fromTime']&&!$data['toTime'])?'checked':''}} onclick="$('.period').hide();"> 长期&nbsp;</label>
                        <label style="cursor:pointer;"><input type="radio" style="position:relative;top:10px;" name="isperiod" value="1" {{($data['fromTime']&&$data['toTime'])?'checked':''}} onclick="$('.period').show();"> 自定义期限&nbsp;</label>
                    </td>
                </tr>

                <tr class="period" style="display:none;">
                    <td class="field_name"><label>起始有效期：</label></td>
                    <td class="right">
                        <input type="text" class="field_value" placeholder="2000" pattern="^\d{4}$" minlength="1970" style="width:30px" name="from_y" value="{{$data['fromTime']?date('Y',$data['fromTime']):''}}"/> 年
                        <input type="text" class="field_value" placeholder="01" pattern="^\d{2}$" minlength="01" max="12" style="width:30px" name="from_m" value="{{$data['fromTime']?date('m',$data['fromTime']):''}}"> 月
                        <input type="text" class="field_value" placeholder="01" pattern="^\d{2}$" minlength="01" maxlength="{{$dayCount}}" style="width:30px" name="from_d" value="{{$data['fromTime']?date('d',$data['fromTime']):''}}"/> 日
                    </td>
                </tr>

                <tr class="period" style="display:none;">
                    <td class="field_name"><label>结束有效期：</label></td>
                    <td class="right">
                        <input type="text" class="field_value" placeholder="2000" pattern="^\d{4}$" minlength="1970" style="width:30px" name="to_y" value="{{$data['toTime']?date('Y',$data['toTime']):''}}"/> 年
                        <input type="text" class="field_value" placeholder="01" pattern="^\d{2}$" minlength="01" maxlength="12" style="width:30px" name="to_m" value="{{$data['toTime']?date('m',$data['toTime']):''}}"/> 月
                        <input type="text" class="field_value" placeholder="01" pattern="^\d{2}$" minlength="01" maxlength="{{$dayCount}}" style="width:30px" name="to_d" value="{{$data['toTime']?date('d',$data['toTime']):''}}"/> 日
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

