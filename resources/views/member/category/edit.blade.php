@extends('member.main')
@section('content')
    @include('member.common.crumb')

    <form data-am-validator method="POST" action="/member/category/{{ $data->id }}" enctype="multipart/form-data">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <input type="hidden" name="_method" value="POST">
        <table class="table_create">
            <tr>
                <td><label>类型名称 / Name：</label></td>
                <td><input type="text" placeholder="至少2个字符" minlength="2" required name="name" value="{{ $data->name }}"/></td>
            </tr>
            <tr><td></td></tr>

            <tr>
                <td><label>父ID / PID：</label></td>
                <td>
                    <select name="pid">
                        <option value="0" {{ $data->pid==0 ? 'selected' : '' }}>-0级类型-</option>
                        @foreach($pidone as $v)
                            <option value="{{ $v->id }}"
                                    {{ $data->pid==$v->id ? 'selected' : '' }}>
                                {{ $v->name }}</option>
                        @endforeach
                    </select>
                </td>
            </tr>
            <tr><td></td></tr>

            <tr>
                <td><label>说明 / Introduce：</label></td>
                <td>
                    <textarea name="intro" cols="50" rows="5">{{ $data->intro }}</textarea>
                </td>
            </tr>
            <tr><td></td></tr>

            <tr><td colspan="2" style="text-align:center;">
                    <button class="companybtn" onclick="history.go(-1)">返 &nbsp;&nbsp;&nbsp;回</button>
                    <button type="submit" class="companybtn">保存修改</button>
                </td></tr>
        </table>
    </form>
@stop

