{{--激活QQ客服模板--}}


<style>
    .qqchat { margin:20px;padding:15px 20px;width:150px;color:black;
        position:fixed;right:60px;bottom:150px; }
    .qqchat #bg { width:150px;height:140px;background:#c8c8c8;
        filter:alpha(opacity=40);-moz-opacity:0.4;opacity:0.4;
        position:absolute;top:0px;z-index:-1; }
    .qqchat b { padding:0 10px; }
    .qqchat p { margin:0;padding:5px 0; }
    .qqchat a { padding:2px 25px;text-decoration:none;color:orangered; }
    .qqchat a:hover { color:red;background:gainsboro; }
    .qqchat img { border:0; }
    .qqchat .small { padding:0 10px;border-top:1px solid gainsboro;font-size:12px; }
    /*.qqchat p.duihua { margin-bottom:5px;color:orangered;text-align:center;*/
        /*border-bottom:1px solid lightgrey;*/
        /*background:lightgrey;cursor:pointer; }*/
</style>

<div class="qqchat">
    <div id="bg"></div>
    {{--@if(isset($zspChat))--}}
    {{--<p class="duihua" title="点击聊天" onclick="getChat();"><b>对话</b></p>--}}
    {{--@endif--}}

    <b>QQ咨询</b>
    <p><a href="http://sighttp.qq.com/msgrd?v=1&uin=2857156840" title="点击QQ咨询">
            <img src="{{PUB}}assets-home/images/qq_icon.png" width="16"> 斯塔克
        </a>
    </p>
    <p class="small">
        Q：2857156840<br>
        周一 -- 周五<br>
        09:00-17:00 在线
    </p>
</div>

{{--@include('layout.#chatWindow')--}}