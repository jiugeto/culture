{{--激活QQ客服模板--}}


<style>
    .qqchat { margin:20px;padding:15px 20px;width:150px;color:black;
        position:fixed;right:60px;bottom:300px; }
    .qqchat #bg { width:150px;height:210px;background:#c8c8c8;
        filter:alpha(opacity=40);-moz-opacity:0.4;opacity:0.4;
        position:absolute;top:0px;z-index:-1; }
    .qqchat b { padding:0 10px; }
    .qqchat p { margin:0;padding:0;padding-bottom:5px; }
    .qqchat a { padding:2px 25px;text-decoration:none;color:orangered; }
    .qqchat a:hover { color:red;background:gainsboro; }
    .qqchat img { border:0; }
    .qqchat .small { padding:0 10px;border-top:1px solid gainsboro;font-size:12px; }
</style>

<div class="qqchat">
    <div id="bg"></div>
    <b>QQ咨询</b>
    {{--<p><a href="http://sighttp.qq.com/msgrd?v=1&uin=2857156840" title="点击QQ咨询">--}}
            {{--<img src="{{PUB}}assets-home/images/qq_icon.png" width="16"> 斯塔克--}}
        {{--</a>--}}
    {{--</p>--}}
    {{--<p><a href="http://sighttp.qq.com/msgrd?v=1&uin=1528204762" title="点击QQ咨询">--}}
            {{--<img src="{{PUB}}assets-home/images/qq_icon.png" width="16"> 囧布斯--}}
        {{--</a>--}}
    {{--</p>--}}
    {{--<p><a href="http://sighttp.qq.com/msgrd?v=1&uin=2944662969" title="点击QQ咨询">--}}
            {{--<img src="{{PUB}}assets-home/images/qq_icon.png" width="16"> 土包子--}}
        {{--</a>--}}
    {{--</p>--}}
    <p><a href="http://wpa.qq.com/msgrd?v=3&uin=2857156840&site=qq&menu=yes"
          target="_blank" title="点击这里给我发消息">
            {{--<img border="0" src="http://wpa.qq.com/pa?p=2:2857156840:52" alt="点击这里给我发消息" title="点击这里给我发消息"/> 斯塔克--}}
            <img src="{{PUB}}assets-home/images/qq_icon.png" border="0" width="16"> 斯塔克
        </a>
    </p>
    <p><a href="http://wpa.qq.com/msgrd?v=3&uin=1528204762&site=qq&menu=yes"
          target="_blank" title="点击这里给我发消息">
            <img src="{{PUB}}assets-home/images/qq_icon.png" width="16"> 囧布斯
        </a>
    </p>
    <p><a href="http://wpa.qq.com/msgrd?v=3&uin=2944662969&site=qq&menu=yes"
          target="_blank" title="点击这里给我发消息">
            <img src="{{PUB}}assets-home/images/qq_icon.png" width="16"> 土包子
        </a>
    </p>
    <p class="small">
        <a href="javascript:;">价格举报</a><br>
        <a href="javascript:;">交易举报</a>
    </p>
    <p class="small">
        {{--Q：2857156840<br>--}}
        周一 -- 周五<br>
        09:00-17:00 在线
    </p>
</div>