@extends('member.main')
@section('content')
    @include('member.common.crumb')

    <form data-am-validator method="POST" action="{{DOMAIN}}member/entertain/{{ $data['id'] }}" enctype="multipart/form-data">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <input type="hidden" name="_methodn" value="POST">
        <table class="table_create">
            <tr>
                <td class="field_name"><label>娱乐名称：</label></td>
                <td><input type="text" placeholder="至少2个字符" minlength="2" required name="title" value="{{ $data['title'] }}"/></td>
            </tr>

            <tr>
                <td class="field_name"><label>简介：</label></td>
                <td>
                    <textarea name="intro" cols="50" rows="5">{{ $data['intro'] }}</textarea>
                </td>
            </tr>

            <tr>
                <td class="field_name"><label>选择艺人：</label></td>
                <td>@if(count($staffs))
                        @foreach($staffs as $staff)
                            <label><input type="checkbox" name="actor[]" value="{{$staff['id']}}" style="width:15px;height:15px;"
                                  @if(in_array($staff['id'],$data['staffs'])) checked @endif
                                 >{{$staff['name']}}&nbsp;&nbsp;&nbsp;&nbsp; </label>
                        @endforeach
                    @endif
                </td>
            </tr>

            <tr><td colspan="2" style="text-align:center;">
                    <button class="companybtn" onclick="history.go(-1)">返 回</button>
                    <button type="submit" class="companybtn">保存修改</button>
                </td></tr>
        </table>
    </form>
@stop

