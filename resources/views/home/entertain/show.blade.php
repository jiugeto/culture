@extends('home.main')
@section('content')
    @include('home.common.crumb')

    <div class="idea_show">
        <span class="idea_left">
            <div class="idea_con">
                <p class="title">{{ $data->title }}</p>
                <table>
                    <tr><td>娱乐内容：</td></tr>
                    <tr><td colspan="2">
                            <textarea readonly class="show_intro">{{ $data->content }}</textarea>
                        </td></tr>
                    <tr><td colspan="2">&nbsp;</td></tr>
                    <tr>
                        <td>&nbsp;</td>
                        <td>
                            <button class="homebtn" onclick="window.location.href='{{DOMAIN}}entertain';">返 &nbsp;回</button>
                        </td>
                    </tr>
                </table>
            </div>
        </span>
        <input type="hidden" name="id" value="{{ $data->id }}">
        {{--发布方信息--}}
        @include('home.common.info')
    </div>
@stop