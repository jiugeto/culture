{{-- 会员后台视频预览模板，外在视图要有个id=pre --}}


<style>
    a#pre { padding:2px 10px;border:1px dashed lightgrey;border-radius:3px;cursor:pointer; }
    a:hover#pre { border:1px solid red;color:red; }
    .play { box-shadow:0 0 100px black;position:fixed;left:30%;top:210px; }
    a#close { padding:10px;color:red;background:lightgrey;border-radius:10px;box-shadow:0 0 100px black;cursor:pointer;display:none; }
    a:hover#close { color:white;background:red; }
</style>

<div class="play">
    {{--<embed src="http://yuntv.letv.com/bcloud.swf" allowFullScreen="true" quality="high" width="640" height="360" align="middle" allowScriptAccess="always" flashvars="uu=1ew2bpfrka&vu=9c87e2e08b&pu=5fc8cd11e6&auto_play=0&gpcflag=1&width=640&height=360" type="application/x-shockwave-flash"></embed>--}}
    {{--<a id="close">X</a>--}}
</div>
<input type="hidden" name="width" value="{{ $data->width }}">
<a id="close">X</a>

<script>
    $(document).ready(function(){
        var close = $("#close");
        var pre = '<embed src="{{ $data->url }}" allowFullScreen="true" quality="high" width="{{ $data->width }}" height="{{ $data->height }}" align="middle" allowScriptAccess="always" flashvars="{{ $data->url2 }}&auto_play={{ $user->leplay }}&width={{ $data->width }}&height={{ $data->height }}" type="application/x-shockwave-flash"></embed>';
        $("#pre").click(function(){ $(".play").html(pre); $("#close").show(); });
        close.click(function(){ $(".play").html(''); $(this).hide(); });
        //视频，关闭按钮的定位
        var clientWidth = document.body.clientWidth;
        var clientHeight = document.body.clientHeight;
        close.css("position",'fixed');
        close.css("left",clientWidth*30/100*1+$("input[name='width']").val()*1+'px');
        close.css("top",210+'px');
    });
</script>