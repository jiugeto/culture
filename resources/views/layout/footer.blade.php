{{-- 前台页面脚部模板 --}}


<!-- 空白 -->
<div class="content_kongbai">&nbsp;</div>
<div class="footer">
    <div style="height:10px;"></div>
    <div class="footer_center">
        {{--<p class="footer_pic">--}}
            {{--<a href=""><img src=""></a>--}}
        {{--</p>--}}
        <p class="footer_text">
            @foreach($footers as $footer)
                <a href="{{ $footer['link'] }}" title="{{ $footer['title'] }}">{{ $footer['name'] }}</a>
            @endforeach
        </p>
        {{--<p class="footer_beizhu">Copyright © 2016-2020 zuoshiping.com All Rights Reserved 版权所有 微文化</p>--}}
    </div>
    <div style="height:10px;"></div>
</div>