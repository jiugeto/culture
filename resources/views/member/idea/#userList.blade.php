@extends('member.main')
@section('content')
    @include('member.common.crumb')

    {{--<form data-am-validator method="POST" action="{{DOMAIN}}member/idea/{{ $id }}" enctype="multipart/form-data">--}}
        {{--<input type="hidden" name="_token" value="{{ csrf_token() }}">--}}
        {{--<input type="hidden" name="_method" value="POST">--}}
        <table class="table_create">
            <tr>
                <td style="text-align:center;" colspan="2"><label>允许查看本创意的用户</label></td>
            </tr>
            {{--<tr><td></td></tr>--}}

            <tr>
                <td class="field_name"><label>用户选择 / User：</label></td>
                <td>
                    @if(count($users))
                    @foreach($users as $user)
                        <span style="padding:2px 10px 5px 10px;border:1px solid lightgrey;">{{ $user->user() }}</span>&nbsp;
                    @endforeach
                    @endif
                </td>
            </tr>
            {{--<tr><td></td></tr>--}}

            {{--<tr><td colspan="10" style="text-align:center;">--}}
                    {{--<button class="companybtn" onclick="history.go(-1)">返 &nbsp;&nbsp;&nbsp;回</button>--}}
                    {{--<button type="submit" class="companybtn">保存修改</button>--}}
                {{--</td></tr>--}}
        </table>
    {{--</form>--}}
@stop

