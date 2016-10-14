{{-- 前台首页头模板 --}}

<!-- header头 -->
<div class="header">
    <div class="header_text text_color">
      <span>
        {{--<div class="head_left">欢迎来逛逛</div>--}}
        <div class="head_left">
            @if(Session::has('user.username'))
                <a href="/member">{{ Session::get('user.username') }}</a>
                <a href="/member" target="_blank">会员中心</a>
                <a href="/login/dologout">退出</a>
            @else
                <a href="/regist">免费注册</a>
                <a href="/login">登录</a>
            @endif
        </div>
      </span>
      <span class="header_right">
        <div class="head_right"><a href="/online">在线创作</a></div>
        <div class="head_right"><a href="/newuser">新手点这里</a></div>
        <div class="head_right">
            {{--<a href="javascript:void(0);" onclick="show_Favorite(window.location,document.title);">加入收藏</a>--}}
            {{--<a href="javascript:void(0);"onclick="show_index(window.location);">设为首页</a>--}}
            <a href="/" style="color:red;">淘文化首页</a>
            {{--<select name="urlType">--}}
                {{--<option value="/" {{explode($_SERVER['REQUEST_URI'],'/')[1]==''?'selected':''}}>淘文化首页</option>--}}
                {{--<option value="/member" {{ explode($_SERVER['REQUEST_URI'],'/')[1]=='member' ? 'selected' : '' }}>会员后台</option>--}}
                {{--<option value="/person/space" {{ explode($_SERVER['REQUEST_URI'],'/')[1]=='person' ? 'selected' : '' }}>个人后台</option>--}}
            {{--</select>--}}
            {{--<script>--}}
                {{--$("select[name='urlType']").change(function(){--}}
                    {{--window.location.href = $(this).val();--}}
                {{--});--}}
            {{--</script>--}}
        </div>
      </span>
    </div>
</div>
<!-- header头 -->

{{--<script language="javascript">--}}
    {{--//收藏本页--}}
    {{--function show_Favorite (sURL,sTitle) {--}}
        {{--sURL = encodeURI(sURL);try{window.external.addFavorite(sURL,sTitle);}--}}
        {{--catch (e) {--}}
            {{--try{--}}
                {{--window.sidebar.addPanel(sTitle, sURL, "");--}}
            {{--} catch (e) {--}}
                    {{--alert("加入收藏失败，请使用Ctrl+D进行添加,或手动在浏览器里进行设置.");--}}
            {{--}--}}
        {{--}--}}

    {{--}--}}
    {{--function showList (id,num) {--}}
        {{--if (num==1) {--}}
            {{--document.getElementById(id).style.display = "block";--}}
        {{--} else {--}}
            {{--document.getElementById(id).style.display = "none";--}}
        {{--}--}}
    {{--}--}}
    {{--function show_index (url) {--}}
        {{--if (document.all) {--}}
            {{--document.body.style.behavior='url(#default#homepage)';document.body.setHomePage(url);--}}
        {{--}else{--}}
            {{--alert("您好,您的浏览器不支持自动设置页面为首页功能,请您手动在浏览器里设置该页面为首页!");--}}
        {{--}--}}

    {{--}--}}

{{--</script>--}}