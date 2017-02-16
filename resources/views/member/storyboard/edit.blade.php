@extends('member.main')
@section('content')
    @include('member.common.crumb')

    <form data-am-validator method="POST" action="{{DOMAIN}}member/storyboard/{{ $data['id'] }}" enctype="multipart/form-data">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <input type="hidden" name="_method" value="POST">
        <table class="table_create">
            <tr>
                <td class="field_name"><label>分镜名称：</label></td>
                <td><input type="text" placeholder="至少2个字符" minlength="2" required name="name" value="{{ $data['name'] }}"/></td>
            </tr>

            <tr>
                <td class="field_name"><label>供求关系：</label></td>
                <td>
                    <label><input type="radio" class="radio" name="genre" value="1"
                                {{$data['genre']==1 ? 'checked' : ''}}> 供应&nbsp;&nbsp;</label>
                    <label><input type="radio" class="radio" name="genre" value="2"
                                {{$data['genre']==2 ? 'checked' : ''}}> 需求&nbsp;&nbsp;</label>
                </td>
            </tr>

            <tr>
                <td class="field_name"><label>分类：</label></td>
                <td>
                    <select name="cate" required>
                        @foreach($model['cates'] as $k=>$vcate)
                             <option value="{{ $k }}" {{ $data['cate']==$k ? 'selected' : '' }}>{{ $vcate }}</option>
                        @endforeach
                    </select>
                </td>
            </tr>

            <tr>
                <td class="field_name"><label>简介：</label></td>
                <td><textarea name="intro" cols="50" rows="5" required>{{$data['intro']}}</textarea></td>
            </tr>

            <tr>
                <td class="field_name"><label>价格(元)：</label></td>
                <td><input type="text" placeholder="数字" pattern="^\d+$" required name="money" value="{{ $data['money'] }}"/></td>
            </tr>

            <tr><td colspan="2" style="text-align:center;">
                    <button class="companybtn" onclick="history.go(-1)">返 &nbsp;&nbsp;&nbsp;回</button>
                    <button type="submit" class="companybtn">保存修改</button>
                </td></tr>
        </table>
    </form>
@stop

