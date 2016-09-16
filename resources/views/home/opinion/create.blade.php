@extends('home.main')
@section('content')
    <div class="s_crumb">
        <div class="crumb">
            <div class="right">
                <a href="/">首页</a> /
                <a href="{{DOMAIN}}opition">意见</a> / 创建
            </div>
        </div>
    </div>

    <div class="home_create">
        <form class="form" data-am-validator method="POST" action="{{DOMAIN}}opinion" enctype="multipart/form-data">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <table class="table_create">
                <tr>
                    <td colspan="2" class="head">
                        本条是
                        @if($isreply==0) 新意见 @else {{ isset($reply) ? $reply.'的回复意见' : '' }} @endif
                        （带<span class="star">*</span>号的是必填项）
                    </td>
                </tr>
                <tr><td>&nbsp;</td></tr>

                <tr>
                    <td style="width:100px;"><label>意见标题 <span class="star">*</span>：</label></td>
                    <td><input type="text" placeholder="至少2个字符" minlength="2" required name="name"/></td>
                </tr>
                <tr><td colspan="2"><div class="div_hr"></div></td></tr>

                <tr>
                    <td><label>内容 <span class="star">*</span>：</label></td>
                    <td style="position:relative;z-index:5;">@include('home.common.editor')</td>
                </tr>

                <tr><td colspan="2" style="text-align:center;">
                        <button class="homebtn" onclick="history.go(-1)">返 &nbsp;&nbsp;&nbsp;回</button>
                        <button type="submit" class="homebtn">保存添加</button>
                    </td></tr>
            </table>
        </form>
    </div>
@stop

