@extends('home.main')
@section('content')
    <div class="s_crumb">
        <div class="crumb">
            <div class="right">
                <a href="/">首页</a> /
                <a href="{{DOMAIN}}uservoice">用户心声</a> / 新心声
            </div>
        </div>
    </div>

    <div class="home_create">
        <form class="form" data-am-validator method="POST" action="{{DOMAIN}}uservoice" enctype="multipart/form-data">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <table class="table_create">
                <tr>
                    <td style="width:100px;"><label>心声标题 <span class="star">*</span>：</label></td>
                    <td><input type="text" placeholder="至少2个字符" minlength="2" required name="name"/></td>
                </tr>
                {{--<tr><td colspan="2"><div class="div_hr"></div></td></tr>--}}

                <tr>
                    <td style="width:100px;"><label>工作岗位 <span class="star">*</span>：</label></td>
                    <td><input type="text" placeholder="所属工作，至少2个字符" minlength="2" required name="work"/></td>
                </tr>
                {{--<tr><td colspan="2"><div class="div_hr"></div></td></tr>--}}

                <tr>
                    <td><label>内容 <span class="star">*</span>：</label></td>
                    <td>
                        <textarea placeholder="所属工作，至少2个字符" minlength="2" required name="intro" cols="74" rows="10"></textarea>
                    </td>
                </tr>

                <tr><td colspan="2" style="text-align:center;">
                        <button class="homebtn" onclick="history.go(-1)">返 &nbsp;回</button>
                        <button type="submit" class="homebtn">保存添加</button>
                    </td></tr>
            </table>
        </form>
    </div>
@stop

