@extends('person.main')
@section('content')
    <div class="per_body" style="border:0;height:700px;background:0;">
        @include('person.common.top')

        <div class="per_list">
            <p class="title">个人头像</p>
            <table cellpadding="0" cellspacing="0" class="list">
                <tr>
                    <td>原来头像：</td>
                    <td>
                        <div class="head">
                            @if($user['head'])
                                <img src="{{$user['head']}}" width="200">
                            @else
                                <div class="nopic">无</div>
                            @endif
                        </div>
                    </td>
                </tr>
                <tr><td colspan="2"><div style="padding:5px 0;border-bottom:1px solid ghostwhite;"></div></td></tr>
                <tr>
                    <td>更新图片：</td>
                    <td>
                        <form id="sethead" method="POST" action="{{DOMAIN}}person/user/sethead"
                              enctype="multipart/form-data">
                            <input type="hidden" name="_token" value="{{csrf_token()}}">
                            <input type="file" name="head" style="cursor:pointer;">
                            <input type="submit" title="点击更新图片" value="确定上传">
                        </form>
                    </td>
                </tr>
                <tr><td></td></tr>
                <tr><td colspan="2"><div style="padding:5px 0;border-bottom:1px solid ghostwhite;"></div></td></tr>
                <tr>
                    <td colspan="2" style="text-align:center;">
                        <a onclick="history.go(-1);">返回上一页</a>
                    </td>
                </tr>
            </table>
        </div>

        @include('person.common.head')
    </div>
@stop