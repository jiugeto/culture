@extends('home.main')
@section('content')
    <div class="s_crumb">
        <div class="crumb">
            <div class="right">
                <a href="/">首页</a> /
                <a href="{{DOMAIN}}opition">意见</a> / 编辑
            </div>
        </div>
    </div>

    <div class="home_create">
        <form class="form" data-am-validator method="POST" action="{{DOMAIN}}opinion/{{$data->id}}" enctype="multipart/form-data">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <input type="hidden" name="_method" value="POST">
            <table class="table_create">
                <tr>
                    <td style="width:100px;"><label>意见标题 <span class="star">*</span>：</label></td>
                    <td><input type="text" placeholder="至少2个字符" minlength="2" required name="name" value="{{ $data->name }}"/></td>
                </tr>
                <tr><td colspan="2"><div class="div_hr"></div></td></tr>

                <tr>
                    <td><label>内容 <span class="star">*</span>：</label></td>
                    <td style="position:relative;z-index:5;">
                        @include('home.common.editor')
                    </td>
                </tr>
                <tr><td colspan="2"><div class="div_hr"></div></td></tr>

                <tr><td colspan="2" style="text-align:center;">
                        <button class="homebtn" onclick="history.go(-1)">返 &nbsp;回</button>
                        <button type="submit" class="homebtn">保存修改</button>
                    </td></tr>
            </table>
        </form>
    </div>
@stop

