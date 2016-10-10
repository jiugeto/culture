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
        <form class="form" data-am-validator method="POST" action="{{DOMAIN}}opinion/status/{{$data->id}}" enctype="multipart/form-data">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <input type="hidden" name="_method" value="POST">
            <table class="table_create">
                <tr>
                    <td colspan="2"><label>意见：{{ $data->name }}</label></td>
                </tr>

                <tr>
                    <td><label>满意度 <span class="star">*</span>：</label></td>
                    <td>
                        <select name="status">
                            <option value="4">满意</option>
                            <option value="3">不满意</option>
                        </select>
                    </td>
                </tr>
                <tr><td colspan="2"><div class="div_hr"></div></td></tr>

                <tr>
                    <td><label>留言 <span class="star">*</span>：</label></td>
                    <td>
                        <textarea name="remarks" cols="80" rows="10"></textarea>
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

