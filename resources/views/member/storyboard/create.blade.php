@extends('member.main')
@section('content')
    @include('member.common.crumb')

    <form data-am-validator method="POST" action="{{DOMAIN}}member/storyboard" enctype="multipart/form-data">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <table class="table_create">
            <tr>
                <td class="field_name"><label>分镜名称：</label></td>
                <td><input type="text" placeholder="至少2个字符" minlength="2" required name="name"/></td>
            </tr>

            <tr>
                <td class="field_name"><label>供求关系：</label></td>
                <td>
                    <label><input type="radio" class="radio" name="genre" value="1"> 供应&nbsp;&nbsp;</label>
                    <label><input type="radio" class="radio" name="genre" value="2"> 需求&nbsp;&nbsp;</label>
                </td>
            </tr>

            <tr>
                <td class="field_name"><label>分类：</label></td>
                <td>
                    <select name="cate" required>
                        @foreach($model['cates'] as $k=>$vcate)
                             <option value="{{ $k }}">{{ $vcate }}</option>
                        @endforeach
                    </select>
                </td>
            </tr>

            <tr>
                <td class="field_name"><label>简介：</label></td>
                <td><textarea name="intro" cols="50" rows="5" required></textarea></td>
            </tr>

            <tr>
                <td class="field_name"><label>详情内容：</label></td>
                <td><textarea name="detail" cols="50" rows="5" required></textarea></td>
            </tr>

            <tr>
                <td class="field_name"><label>价格(元)：</label></td>
                <td><input type="text" placeholder="数字" pattern="^\d+$" required name="money"/></td>
            </tr>

            <tr><td colspan="2" style="text-align:center;">
                    <button class="companybtn" onclick="history.go(-1)">返 &nbsp;&nbsp;&nbsp;回</button>
                    <button type="submit" class="companybtn">保存添加</button>
                </td></tr>
        </table>
    </form>
@stop

