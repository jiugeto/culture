@extends('member.main')
@section('content')
    @include('member.common.crumb')

    <form data-am-validator method="POST" action="{{DOMAIN}}member/idea" enctype="multipart/form-data">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <table class="table_create">
            <tr>
                <td class="field_name"><label>创意名称：</label></td>
                <td><input type="text" placeholder="至少2个字符" minlength="2" required name="name"/></td>
            </tr>

            <tr>
                <td class="field_name"><label>供求关系：</label></td>
                <td>
                    <label><input type="radio" class="radio" name="genre" value="1" checked> 作者&nbsp;&nbsp;</label>
                    <label><input type="radio" class="radio" name="genre" value="2"> 读者&nbsp;&nbsp;</label>
                </td>
            </tr>

            <tr>
                <td class="field_name"><label>分类：</label></td>
                <td>
                    <select name="cate" required>
                        @foreach($model['cates'] as $kcate=>$vcate)
                            <option value="{{ $kcate }}">{{ $vcate }}</option>
                        @endforeach
                    </select>
                </td>
            </tr>

            <tr>
                <td class="field_name"><label>内容简介：</label></td>
                <td><textarea name="intro" cols="50" rows="5"></textarea></td>
            </tr>

            <tr>
                <td class="field_name"><label>细节显示：</label></td>
                <td>
                    <label><input type="radio" class="radio" name="isdetail" value="1" checked> 不显示&nbsp;&nbsp;</label>
                    <label><input type="radio" class="radio" name="isdetail" value="2"> 显示&nbsp;&nbsp;</label>
                </td>
            </tr>

            <tr>
                <td class="field_name"><label>内容细节：</label></td>
                <td><textarea name="detail" cols="40" rows="5"></textarea></td>
            </tr>

            <tr>
                <td class="field_name"><label>价格(元)：</label></td>
                <td><input type="text" placeholder="0表示免费" pattern="^\d+$" required name="money"/></td>
            </tr>

            <tr><td colspan="10" style="text-align:center;">
                    <button class="companybtn" onclick="history.go(-1)">返&nbsp; 回</button>
                    <button type="submit" class="companybtn">保存添加</button>
                </td></tr>
        </table>
    </form>
@stop

