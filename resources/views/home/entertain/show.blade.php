@extends('home.main')
@section('content')
    @include('home.common.crumb')

    <div class="idea_show">
        <span class="idea_left">
            <div class="idea_con">
                <p class="title">{{ $data->title }}</p>
                <table>
                    <tr><td>片源类型：</td></tr>
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
        <span class="idea_right">
            @if($userInfo = $data->user())
            <div class="userinfo">
                <p class="title">{{ $userInfo->company($uid) ? $userInfo->company($uid)->name.'的' : '' }} {{ $userInfo->username }}</p>
                @if($userInfo->address)<p>地址：{{ $userInfo->address }}</p>@endif
                <p>发布时间：{{ $userInfo->createTime() }}</p>
            </div>
            @endif
        </span>
    </div>
@stop