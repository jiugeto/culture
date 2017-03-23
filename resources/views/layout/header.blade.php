{{-- 前台首页头模板 --}}

<!-- header头 -->
<div class="header">
    <div class="header_text text_color">
      <span>
        {{--<div class="head_left">欢迎来逛逛</div>--}}
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
            {{--<a href="/online">在线创作</a>--}}
            <a href="{{env('TALK_DOMAIN')}}" target="_blank">话题论坛</a>
            <a href="{{env('ONLINE_DOMAIN')}}" target="_blank">在线创作</a>
        </div>
        <div class="head_right"><a href="{{DOMAIN}}newuser">新手点这里</a></div>
        {{--<div class="head_right">--}}
            {{--<a href="javascript:void(0);" onclick="show_Favorite(window.location,document.title);">加入收藏</a>--}}
            {{--<a href="javascript:void(0);"onclick="show_index(window.location);">设为首页</a>--}}
            {{--<a href="/" style="color:red;">本站首页</a>--}}
            {{--<select name="space" title="点击选择" style="outline:none;">--}}
                {{--<option value="">本站首页</option>--}}
                {{--<option value="1">跳到本站首页</option>--}}
                {{--<option value="2">跳到在线创作</option>--}}
                {{--<option value="3">跳到个人空间</option>--}}
                {{--<option value="4">跳到话题中心</option>--}}
            {{--</select>--}}
        {{--</div>--}}
        {{--<script>--}}
            {{--$("select[name='space']").change(function(){--}}
                {{--var space = $(this).val();--}}
                {{--var tolink = '/';--}}
                {{--if (space==2) {--}}
                    {{--tolink = '{{env('ONLINE_DOMAIN')}}';--}}
                {{--} else if (space==3) {--}}
                    {{--tolink = '/person';--}}
                {{--} else if (space==4) {--}}
                    {{--tolink = '{{env('TALK_DOMAIN')}}';--}}
                {{--}--}}
                {{--window.location.href = tolink;--}}
            {{--});--}}
        {{--</script>--}}
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