{{-- 前台首页头模板 --}}

<!-- header头 -->
<div class="header">
    <div class="header_text text_color">
      <span>
        <div class="head_left"><a href="javascript:;">欢迎来逛逛</a></div>
        <div class="head_left">
            @if(Session::has('user.username'))
                <a href="{{DOMAIN}}member">会员：{{ Session::get('user.username') }}</a> &nbsp;
                <a href="{{DOMAIN}}login/dologout">退出</a>
            @else
                <a href="{{DOMAIN}}regist">免费注册</a>
                <a href="{{DOMAIN}}login">登录</a>
            @endif
        </div>
      </span>
      <span class="header_right">
        <div class="head_right">
            <a href="javascript:;" onclick="alert('待建设！');">农土特产</a>
            <a href="javascript:;" onclick="alert('待建设！');">特效广场</a>
            {{--<a href="javascript:;" onclick="alert('待建设！');">网站试用</a>--}}
            <a href="{{env('TALK_DOMAIN')}}" target="_blank">论坛</a>
            <a href="{{env('ONLINE_DOMAIN')}}" target="_blank">在线创作</a>
        </div>
        <div class="head_right">
            <a href="{{DOMAIN}}help" target="_blank">有疑问?看<span style="color:#ff4466;">帮助</span></a>
            <a href="javascript:void(0);" onclick="show_Favorite(window.location,document.title);"
               style="color:#ff4466;">加入收藏</a>
            {{--<a href="javascript:void(0);"onclick="show_index(window.location);">设为首页</a>--}}
        </div>

      </span>
    </div>
</div>
<!-- header头 -->

<script language="javascript">
    //收藏本页
    function show_Favorite (sURL,sTitle) {
        sURL = encodeURI(sURL);try{window.external.addFavorite(sURL,sTitle);}
        catch (e) {
            try{
                window.sidebar.addPanel(sTitle, sURL, "");
            } catch (e) {
                    alert("加入收藏失败，请使用Ctrl+D进行添加,或手动在浏览器里进行设置.");
            }
        }

    }
    function showList (id,num) {
        if (num==1) {
            document.getElementById(id).style.display = "block";
        } else {
            document.getElementById(id).style.display = "none";
        }
    }
    //设置为首页
    function show_index (url) {
        if (document.all) {
            document.body.style.behavior='url(#default#homepage)';document.body.setHomePage(url);
        }else{
            alert("您好,您的浏览器不支持自动设置页面为首页功能,请您手动在浏览器里设置该页面为首页!");
        }

    }
</script>