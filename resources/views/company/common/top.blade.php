{{-- 企业后台顶部菜单栏 --}}


<div class="com_top" @if($company['skin'])style="background:{{$company['skin']}};"@endif>
    <div class="com_center">
        <a href="{{DOMAIN}}c/{{$company['id']}}">
            <div class="img">
                @if($company['logo'])
                    <img src="{{$company['logo']}}" title="{{$company['name']}}" class="com_logo_size" style="border:0;">
                @else <img src="{{PUB}}assets-home/images/logo.png" title="logo名称或公司名称" class="com_logo_size" style="border:0;">
                @endif
            </div>
        </a>
        <div id="changeByIe" style="height:15px;display:none;"></div>
        <ul>
            @if(Session::has('user.cid') && Session::get('user.cid')==$company['id'])
            <a href="{{DOMAIN}}com/back"><li>后台</li></a>
            @endif
            @if($topmenus)
            @foreach($topmenus as $topmenu)
                <a href="{{$topmenu['link']}}">
                    <li class="{{$prefix_url==$topmenu['link']?'curr':''}}">{{$topmenu['name']}}</li>
                </a>
            @endforeach
            @else
                @if($url=explode('/',$_SERVER['REQUEST_URI']))
                <a href="{{DOMAIN}}c/{{$company['id']}}/firm">
                    <li class="{{(isset($url[3])&&$url[3]=='firm')?'curr':''}}">服务项目</li>
                </a>
                <a href="{{DOMAIN}}c/{{$company['id']}}/team">
                    <li class="{{(isset($url[3])&&$url[3]=='team')?'curr':''}}">团队</li>
                </a>
                <a href="{{DOMAIN}}c/{{$company['id']}}/part">
                    <li class="{{(isset($url[3])&&$url[3]=='part')?'curr':''}}">花絮</li>
                </a>
                <a href="{{DOMAIN}}c/{{$company['id']}}/product">
                    <li class="{{(isset($url[3])&&$url[3]=='product')?'curr':''}}">作品</li>
                </a>
                <a href="{{DOMAIN}}c/{{$company['id']}}/contact">
                    <li class="{{(isset($url[3])&&$url[3]=='contact')?'curr':''}}">联系方式</li>
                </a>
                <a href="{{DOMAIN}}c/{{$company['id']}}/recruit">
                    <li class="{{(isset($url[3])&&$url[3]=='recruit')?'curr':''}}">招聘</li>
                </a>
                @endif
                <a href="{{DOMAIN}}c/{{$company['id']}}">
                    <li  class="{{$_SERVER['REQUEST_URI']=='/c/'.$company['id']?'curr':''}}">首页</li>
                </a>
                <a href="{{DOMAIN}}" title="返回网站首页"><li style="color:#ff4466;">返回</li></a>
            @endif
        </ul>
    </div>
</div>

<script>
    //top模板height，兼容IE浏览器
    (function isIE() {
        var userAgent = window.navigator.userAgent; //取得浏览器的userAgent字符串
        if (userAgent.indexOf("MSIE")/*!=-1*/>0) {
//            alert('你的IE系列浏览器过旧，建议升级为谷歌、火狐等浏览器，正常浏览！');
            $("#changeByIe").show();
        } else if (userAgent.indexOf("Firefox")>0 || userAgent.indexOf("Chrome")>0 || userAgent.indexOf("Safari")>0 || userAgent.indexOf("Opera")>0) {
            $("#changeByIe").hide();
        } else {
//            alert('你非谷歌、火狐等浏览器，建议升级为谷歌、火狐等浏览器，正常浏览！');
            $("#changeByIe").show();
        }
    })();
</script>