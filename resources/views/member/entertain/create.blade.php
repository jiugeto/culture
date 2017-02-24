@extends('member.main')
@section('content')
    @include('member.common.crumb')

    <form data-am-validator method="POST" action="{{DOMAIN}}member/entertain" enctype="multipart/form-data">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <table class="table_create">
            <tr>
                <td class="field_name"><label>娱乐名称：</label></td>
                <td><input type="text" placeholder="至少2个字符" minlength="2" required name="title"/></td>
            </tr>

            <tr>
                <td class="field_name"><label>简介：</label></td>
                <td>
                    <textarea name="intro" cols="50" rows="5"></textarea>
                </td>
            </tr>

            <tr>
                <td class="field_name"><label>选择艺人：</label></td>
                <td>@if(count($staffs))
                        @foreach($staffs as $staff)
                            <label><input type="checkbox" name="actor[]" value="{{$staff['id']}}"
                                  style="width:15px;height:15px;">{{$staff['name']}}&nbsp;&nbsp;&nbsp;&nbsp; </label>
                        @endforeach
                    @endif
                </td>
            </tr>

            <tr>
                <td class="field_name"><label>选择作品：</label></td>
                <td>@if(count($works))
                        @foreach($works as $work)
                            <label><input type="checkbox" name="actor[]" value="{{$work['id']}}"
                                  style="width:15px;height:15px;">{{$work['name']}}&nbsp;&nbsp;&nbsp;&nbsp; </label>
                        @endforeach
                    @endif
                </td>
            </tr>

            <tr><td colspan="2" style="text-align:center;">
                    <button class="companybtn" onclick="history.go(-1)">返 回</button>
                    <button type="submit" class="companybtn">保存添加</button>
                </td></tr>
        </table>
    </form>
@stop

