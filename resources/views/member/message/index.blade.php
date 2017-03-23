@extends('member.main')
@section('content')
    @include('member.common.crumb')
    <div class="mem_tab">
        <ul>
            <a href="{{DOMAIN}}member/message">
                <li class="{{$list==1?'curr':''}}">收件箱</li>
            </a>
            <a href="{{DOMAIN}}member/message/s/2">
                <li class="{{$list==2?'curr':''}}">发件箱</li>
            </a>
        </ul>
        <div class="mem_create"><a href="javascript:;" onclick="getSender()">发消息</a></div>
    </div>
    <div class="hr_tab"></div>
    <!-- 空白 -->
    <div class="list_kongbai">&nbsp;</div>
    <div class="list">
        <table class="list_tab">
            <tr>
                <td>编号</td>
                <td>标题</td>
                <td>消息类型</td>
                <td>{{$list==2?'接收人':'发送人'}}</td>
                <td>内容</td>
                <td>创建时间</td>
                {{--<td>操作</td>--}}
            </tr>
        @if(count($datas))
            @foreach($datas as $data)
            <tr>
                <td>{{ $data['id'] }}</td>
                <td>{{ $data['title'] }}</td>
                <td>{{ $data['genreName'] }}</td>
                <td>{{$list==2?UserNameById($data['accept']):UserNameById($data['sender'])}}</td>
                <td>{{ str_limit($data['intro'],20) }}</td>
                <td>{{ $data['createTime'] }}</td>
                {{--<td>--}}
                    {{--<a href="" class="list_btn">查看</a>--}}
                {{--</td>--}}
            </tr>
            @endforeach
        @else <tr><td colspan="10" style="text-align:center;">没有记录</td></tr>
        @endif
        </table>
        @include('member.common.page2')
    </div>

    <div class="tankuang" id="sender">
        <div class="mask"></div>
        <div class="con">
            <form id="formlink" action="{{DOMAIN}}member/message" method="POST" enctype="multipart/form-data" data-am-validator>
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <input type="hidden" name="_method" value="POST">
                <p style="text-align:center;" class="pname">发送消息</p>
                <p>收件人：
                    <input type="text" name="accept" placeholder="用户名" required>
                </p>
                <p>消息标题：
                    <input type="text" name="title" placeholder="" required>
                </p>
                <p>内容：
                    <textarea name="intro" cols="30" rows="5" style="resize:none;" required></textarea>
                </p>
                <button type="submit" class="homebtn">立即发送</button>
            </form>
            <a title="关闭" onclick="getClose()">X</a>
        </div>
    </div>

    <script>
        function getSender(){ $("#sender").show(200); }
        function getClose(){ $(".tankuang").hide(); }
    </script>
@stop