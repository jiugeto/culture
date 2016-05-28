{{-- 前台页面脚部模板 --}}

<!-- footer网站脚部 -->
<style>
    a#footer_close,a#footer_open { padding:0 10px;color:grey;cursor:pointer; }
    a#footer_close:hover,a#footer_open:hover { color:white; }
</style>
<div class="footer">
    <div style="float:right;">
        <a id="footer_close">隐藏</a> <a id="footer_open" style="display:none;">显示</a>
    </div>
    <div class="footer_center">
        {{--<p class="footer_pic">--}}
            {{--<a href=""><img src=""></a>--}}
        {{--</p>--}}
        <p class="footer_text">
            @foreach($footers as $footer)
                <a href="{{ $footer->link }}" title="{{ $footer->title }}">{{ $footer->name }}</a>
            @endforeach
        </p>
        <p class="footer_beizhu">Copyright © 2016-2020 microculture.com All Rights Reserved 版权所有 微文化</p>
    </div>
</div>
<script>
    $(document).ready(function(){
        var footer_close = $("#footer_close");
        var footer_open = $("#footer_open");
        var footer_center = $(".footer_center");
        footer_close.click(function(){ footer_close.toggle(100); footer_open.toggle(100); footer_center.toggle(100); });
        footer_open.click(function(){ footer_open.toggle(100); footer_close.toggle(100); footer_center.toggle(100); });
    });
</script>
<!-- footer网站脚部 -->