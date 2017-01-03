{{-- 前台页面菜单导航栏 --}}


<!-- navigate菜单导航栏 -->
<div class="nav">
    <hr>
    <div class="nav_body">
        <div><a href="/"><img src="{{PUB}}assets-home/images/logo.png" class="logo"></a></div>
        <div class="nav_qiehuan" style="display:{{explode('/',$_SERVER['REQUEST_URI'])[1]?'block':'none'}};" title="点击显示或隐藏菜单">
            <img src="{{PUB}}assets/images/daohang.png" class="imgMiniSize"> <b>导航</b>
            <span id="shang">▲</span><span id="xia" style="display:none;">▼</span>
        </div>
        <div class="nav_qh">
            <div class="nav_hide" style="display:none;">
                @foreach($navigates as $navigate)
                    <a href="{{ $navigate->link }}" class="@if(isset($curr_menu) && $curr_menu==ltrim($navigate->link,'/')) curr @else nav_a @endif" title="{{ $navigate->title }}">{{ $navigate->name }}</a>
                @endforeach
            </div>
        </div>

        <div class="search">
            <input type="text" class="search_input" style="height:{{explode('/',$_SERVER['REQUEST_URI'])[1]=='member'?42:40}}px;" name="global_search" placeholder="找啥呢？来试试" value="{{ isset($keyword) ? $keyword : '' }}">
            <input type="hidden" name="global_search_genre" value="{{isset($searchGenre)?$searchGenre:1}}">
            <input type="submit" class="search_text" value="搜 索" onclick="getSearch()">
            <div class="search_sel" style="top:{{explode('/',$_SERVER['REQUEST_URI'])[1]=='member'?10:5}}px;">
                <div class="curr_sel">
                    <span class="curr_sel_text">{{isset($searchGenre)?$searchs['genres'][$searchGenre]:'创作'}}</span>
                    <img src="{{PUB}}assets-home/images/sel_down.png">
                </div>
                <div class="sel_more">
                    <div class="sel_one">
                        <span class="curr_sel_text">{{isset($searchGenre)?$searchs['genres'][$searchGenre]:'创作'}}</span>
                        <img src="{{PUB}}assets-home/images/sel_down.png">
                    </div>
                    @if(count($searchs['genres']))
                        @foreach($searchs['genres'] as $ks=>$vsearch)
                            <div class="sel_one" style="padding:4px 8px" onclick="getSearchGenre({{$ks}})">
                                {{ $vsearch }}
                                <input type="hidden" name="searchGenreName_{{$ks}}" value="{{ $vsearch }}">
                            </div>
                        @endforeach
                    @endif
                </div>
            </div>
        </div>
        <div class="keyword_pos">热门词汇：
            @if(count($searchs['hotwords'])&&$hotwords=$searchs['hotwords'])
                @foreach($hotwords as $hotword)
                    <a onclick="getKeyword({{$hotword->id}})" title="{{$hotword->keyword}}">
                        {{ str_limit($hotword->keyword,5) }}</a> &nbsp;
                @endforeach
            @endif
        </div>
        <script>
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

        <span class="nav_right">
            <a href="/{{ Session::has('user.username') ? 'member' : 'login' }}">
                <img src="/assets/images/key.png" class="imgMiniSize">
                {{ Session::has('user.username') ? Session::get('user.username') : '登录/注册' }}</a>&nbsp;
            {{--<div class="login_hide">--}}
                {{--<a href="">资料</a><br>--}}
                {{--<a href="">退出</a>--}}
            {{--</div>--}}
            {{--&nbsp;&nbsp;<a href="/idea" style="color:red;">创意</a>--}}
            {{--&nbsp;&nbsp;<a href="/talk" style="color:red;">话题</a>--}}
            &nbsp;&nbsp;<a href="{{env('TALK_DOMAIN')}}" target="_blank">话题论坛</a>
            &nbsp;&nbsp;<a href="/opinion" style="padding:5px 20px;color:white;background:red;" id="opinion">用户建议</a>
        </span>
        <div class="navigate">
            <div class="navigate_a" style="display:{{explode('/',$_SERVER['REQUEST_URI'])[1]?'none':'block'}};">
                @foreach($navigates as $kn=>$navigate)
                    @if($kn<10)
                    <a href="{{ $navigate->link }}" class="@if(isset($curr_menu) && $curr_menu==ltrim($navigate->link,'/')) curr @else nav_a @endif" title="{{ $navigate->title }}">{{ $navigate->name }}</a>
                    @endif
                @endforeach
            </div>
        </div>
    </div>
</div>
<!-- navigate菜单导航栏 -->


<script>
    var nav_qiehuan = $(".nav_qiehuan");
    var nav_qh = $(".nav_qh");
    $(document).ready(function(){
        //根据浏览器宽度设置菜单位置
        var clientWidth = document.body.clientWidth;
        nav_qiehuan.css('position','fixed');
        nav_qiehuan.css('left',(clientWidth-1000)/2+200+'px');
        nav_qh.css('position','fixed');
        nav_qh.css('left',(clientWidth-1000)/2+20+'px');
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
    });
    //菜单栏切换
    var nav_hide = $(".nav_hide");
    nav_qiehuan.click(function(){
        if (nav_hide[0].style.display=='none') {
            nav_hide.show(200);
            nav_qiehuan.css('border-bottom','0');
            $("#shang").hide(); $("#xia").show();
        } else {
            nav_hide.hide(200);
            nav_qiehuan.css('border-bottom','1px solid lightgray');
            $("#shang").show(); $("#xia").hide();
        }
    });
</script>