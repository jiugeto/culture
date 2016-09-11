{{-- 企业后台顶部菜单栏 --}}


<div class="com_top" style="background:{{$comMain->getSkin()}};">
    <div class="com_center">
        <div class="com_logo">
            <a href="{{DOMAIN}}company/home">
                <div class="img">
                    @if($comMain)
                        <img src="{{ $comMain->logo }}" title="{{ $comMain->company()?$comMain->company()->name:'某某公司' }}-{{ $comMain->title }}" class="com_logo_size">
                    @else <img src="{{PUB}}assets-home/images/logo.png" title="logo名称或公司名称" class="com_logo_size">
                    @endif
                </div>
            </a>
        </div>
        <ul>
            @if(Session::has('user.cid') && $comMain && Session::get('user.cid')==$comMain->cid)
            <a href="{{DOMAIN}}company/admin"><li>后台</li></a>
            @endif
            @if(count($topmenus))
            @foreach($topmenus as $topmenu)
                <a href="{{ $topmenu->link }}">
                    <li class="{{$prefix_url==$topmenu->link?'curr':''}}">{{ $topmenu->name }}</li>
                </a>
            @endforeach
            @else
                @if($url=DOMAIN.'c/')
                <a href="{{$url}}contact"><li>联系方式</li></a>
                <a href="{{$url}}recruit"><li>招聘</li></a>
                <a href="{{$url}}firm"><li>服务项目</li></a>
                <a href="{{$url}}team"><li>团队</li></a>
                <a href="{{$url}}part"><li>花絮</li></a>
                <a href="{{$url}}product"><li>作品</li></a>
                @endif
                <a href="{{DOMAIN}}company"><li class="curr">首页</li></a>
            @endif
        </ul>
    </div>
</div>