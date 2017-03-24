@extends('person.main')
@section('content')
    <div class="per_body" style="border:0;height:700px;background:0;">
        @include('person.common.top')
        <div class="per_list">
            <p class="title">发送消息</p>
            <form method="POST" action="{{DOMAIN}}person/message" enctype="multipart/form-data"
                  class="list" style="width:748px;">
                <input type="hidden" name="_token" value="{{csrf_token()}}">
                {{--<h4 style="text-align:center;">发送消息</h4>--}}
                <table class="tform">
                    <tr>
                        <td>接收人：</td>
                        <td><input type="text" placeholder="用户名" minlength="2" maxlength="20" name="uname"></td>
                    </tr>
                    <tr>
                        <td>标题：</td>
                        <td><input type="text" placeholder="至少2个字符" minlength="2" maxlength="20" name="title"></td>
                    </tr>
                    <tr>
                        <td>内容：</td>
                        <td><textarea name="intro" required minlength="2" maxlength="255"></textarea></td>
                    </tr>
                    <tr>
                        <td colspan="2" style="text-align:center;">
                            {{--<a onclick="history.go(-1);">返回上一页</a>--}}
                            <button type="button" class="companybtn" onclick="history.go(-1);">返回上一页</button>
                            <button type="submit" class="companybtn" value="send">开始发送</button>
                        </td>
                    </tr>
                </table>
            </form>
        </div>
        @include('person.common.head')
    </div>
@stop