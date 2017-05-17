{{-- 前台页面菜单导航栏 --}}


<!-- navigate菜单导航栏 -->
<div class="nav">
    <hr>
    <div class="nav_body">
        <div><a href="/"><img src="{{PUB}}assets-home/images/logo.png" class="logo"></a></div>
        <div class="search">
            <input type="text" class="search_input" style="height:{{explode('/',$_SERVER['REQUEST_URI'])[1]=='member'?42:40}}px;" name="global_search" placeholder="找啥呢？来试试{{--暂不可用--}}" value="{{ isset($keyword) ? $keyword : '' }}">
            <input type="hidden" name="global_search_genre" value="{{isset($searchGenre)?$searchGenre:1}}">
            <input type="submit" class="search_text" value="搜 索" onclick="getSearch()">
            <div class="search_sel" style="top:{{explode('/',$_SERVER['REQUEST_URI'])[1]=='member'?10:5}}px;">
                <div class="curr_sel">
                    <span class="curr_sel_text">{{isset($searchGenre)?$searchs['genres'][$searchGenre]:'动画'}}</span>
                    <img src="{{PUB}}assets-home/images/sel_down.png">
                </div>
                <div class="sel_more">
                    <div class="sel_one">
                        <span class="curr_sel_text">
                            {{isset($searchGenre)?$searchs['genres'][$searchGenre]:'动画'}}
                        </span>
                        <img src="{{PUB}}assets-home/images/sel_down.png">
                    </div>
                    @foreach($searchModel['genres'] as $k=>$vsearch)
                        <div class="sel_one" style="padding:4px 8px" onclick="getSearchGenre({{$k}})">
                            {{$vsearch}}
                            <input type="hidden" name="searchGenreName_{{$k}}" value="{{$vsearch}}">
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
        <div class="keyword_pos">热门词汇：{{--暂不可用--}}
            {{--@if(count($searchs['hotwords'])&&$hotwords=$searchs['hotwords'])--}}
                {{--@foreach($hotwords as $hotword)--}}
                    {{--<a onclick="getKeyword({{$hotword->id}})" title="{{$hotword->keyword}}">--}}
                        {{--{{ str_limit($hotword->keyword,5) }}</a> &nbsp;--}}
                {{--@endforeach--}}
            {{--@endif--}}
        </div>

        <span class="nav_right">
            <a href="/{{ Session::has('user.username') ? 'member' : 'login' }}">
                <img src="/assets/images/key.png" class="imgMiniSize">
                {{ Session::has('user.username') ? Session::get('user.username') : '登录/注册' }}
            </a>
            &nbsp; &nbsp;
            <a href="{{DOMAIN}}opinion" style="padding:5px 10px;color:white;background:red;" id="opinion">用户建议</a>
        </span>
        <div class="navigate">
            <div class="navigate_a">
                @foreach($navigates as $navigate)
                    <a href="{{$navigate['link']}}" class="@if(isset($curr_menu) && $curr_menu==ltrim($navigate['link'],'/')) curr @else nav_a @endif" title="点击跳转到{{$navigate['name']}}">{{$navigate['name']}}</a>
                @endforeach
            </div>
        </div>
    </div>
</div>
<!-- navigate菜单导航栏 -->
<!-- 空白 -->
<div class="content_kongbai" id="conKongBaiByIe">&nbsp;</div>
<input type="hidden" id="urlCurr" value="{{$_SERVER['REQUEST_URI']}}">


<script>
    //根据浏览器宽度设置菜单位置
    $(document).ready(function(){ setSearch(); });
    //改变浏览器大小触发事件
    window.onresize = function(){ setSearch(); };
    function setSearch(){
        var clientWidth = document.body.clientWidth;
        //根据浏览器设置搜索位置(IE)
        var browser = window.navigator.userAgent.indexOf("MSIE");   //判断浏览器IE系列，定左右距离
        if (browser>0) {
            var search = $(".search");
            var search_text = $(".search_text");
            var search_sel = $(".search_sel");
            var curr_sel_img = $(".curr_sel > img");
            var sel_more = $(".sel_more");
            var sel_one_img = $(".sel_one > img");
            var keyword = $(".keyword_pos");
            var search_input = $(".search_input");
            search.css('position','fixed');
            search.css('left',(clientWidth-1000)/2+340+'px');
            search.css('top',37+'px');
            search_text.css('position','fixed');
            search_text.css('left',(clientWidth-1000)/2+340+245+'px');
            search_text.css('top',38+'px');
            search_sel.css('position','fixed');
            search_sel.css('left',(clientWidth-1000)/2+339+'px');
            search_sel.css('top',40+'px');
            search_sel.css('padding-bottom',0+'px');
            curr_sel_img.css('position','relative');
            curr_sel_img.css('left',5+'px');
            curr_sel_img.css('top',-15+'px');
            sel_more.css('position','fixed');
            sel_more.css('left',(clientWidth-1000)/2+340+'px');
            sel_more.css('top',40+'px');
            sel_more.css('padding-top',0+'px');
            sel_one_img.css('position','relative');
            sel_one_img.css('left',5+'px');
            sel_one_img.css('top',-15+'px');
            keyword.css('position','fixed');
            keyword.css('left',(clientWidth-1000)/2+340+'px');
            keyword.css('top',85+'px');
            search_input.css('line-height',40+'px');
        }
        //根据浏览器设置右侧几个链接位置
        if (browser>0) {
            var nav_right = $(".nav_right");
            var opinion = $("#opinion");
            nav_right.css('position','fixed');
            nav_right.css('right',(clientWidth-1000)/2+'px');
            nav_right.css('top',55+'px');
        }
    }
    //navigate下面留白的浏览器兼容
    (function isIE() {
        var userAgent = window.navigator.userAgent; //取得浏览器的userAgent字符串
        var urlCurr = $("#urlCurr").val();
        if (userAgent.indexOf("MSIE")>0) {
            if (urlCurr=='/') {
                $("#conKongBaiByIe").css('height','100px');
            } else {
                $("#conKongBaiByIe").css('height','135px');
            }
        } else if (userAgent.indexOf("Firefox")>0 || userAgent.indexOf("Chrome")>0 || userAgent.indexOf("Safari")>0 || userAgent.indexOf("Opera")>0) {
            if (urlCurr=='/') {
                $("#conKongBaiByIe").css('height','105px');
            } else {
                $("#conKongBaiByIe").css('height','148px');
            }
        }
    })();
    //关于搜索
    function getSearchGenre(key){
        var searchGenreName = $("input[name='searchGenreName_"+key+"']").val();
        $(".curr_sel_text").html(searchGenreName);
        $("input[name='global_search_genre']")[0].value = key;
    }
    function getSearch(){
        var globalSearchGenre = $("input[name='global_search_genre']").val();
        var keyword = $("input[name='global_search']").val();
        if (keyword=='') {
            alert('没有填写关键字，将跳转到首页！');
            window.location.href = '{{DOMAIN}}';
        } else {
            window.location.href = '{{DOMAIN}}s/'+globalSearchGenre+'/'+keyword;
        }
    }
</script>