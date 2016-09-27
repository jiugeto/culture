{{-- 前台页面菜单导航栏 --}}


<!-- navigate菜单导航栏 -->
<div class="nav">
    <hr>
    <div class="nav_body">
        <div><a href="/"><img src="{{PUB}}assets-home/images/logo.png" class="logo"></a></div>
        <div class="nav_qiehuan" style="display:{{explode('/',$_SERVER['REQUEST_URI'])[1]?'block':'none'}};" title="点击显示或隐藏菜单">
            <img src="{{PUB}}assets/images/daohang.png" class="imgMiniSize"> 导航
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
            <input type="text" class="search_input" name="global_search" placeholder="{{--想要啥效果，赶紧找哦--}}暂不可用" value="{{ isset($keyword) ? $keyword : '' }}">
            <input type="hidden" name="global_search_genre" value="{{isset($searchGenre)?$searchGenre:1}}">
            <input type="submit" class="search_text" value="搜 索" onclick="getSearch()">
            <div class="search_sel">
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
            &nbsp;&nbsp;<a href="/idea" style="color:red;">创意</a>
            &nbsp;&nbsp;<a href="/talk" style="color:red;">话题</a>
            &nbsp;&nbsp;<a href="/opinion" class="opinion" style="color:white;">用户建议</a>
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
    $(document).ready(function(){
        //菜单栏切换
        var nav_qiehuan = $(".nav_qiehuan");
        var nav_qh = $(".nav_qh");
        var nav_hide = $(".nav_hide");
//        nav_qiehuan.mouseover(function(){
//            nav_hide.show(200);
//            nav_qiehuan.css('border-bottom','0');
//            $("#shang").hide(); $("#xia").show();
//        });
//        nav_qh.mouseleave(function(){
//            nav_hide.hide();
//            nav_qiehuan.css('border-bottom','1px solid lightgray');
//        });
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
        //根据浏览器宽度设置菜单位置
        var clientWidth = document.body.clientWidth;
//        alert(clientWidth);
        nav_qiehuan.css('position','fixed');
        nav_qiehuan.css('left',(clientWidth-1000)/2+200+'px');
        nav_qh.css('position','fixed');
        nav_qh.css('left',(clientWidth-1000)/2+20+'px');
    });
</script>