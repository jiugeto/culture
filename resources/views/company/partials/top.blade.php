{{-- 企业后台顶部菜单栏 --}}


<div class="com_top">
    <div class="com_center">
        <div class="com_logo">
            <a href="##">
                <img src="/assets/images/del_red.png" title="logo名称或公司名称" class="com_logo_size">
            </a>
        </div>
        <ul>
            <a href="/company/admin"><li>后台</li></a>
            {{--<a href="##"><li>联系方式</li></a>--}}
            {{--<a href="##"><li>招聘</li></a>--}}
            {{--<a href="##"><li>服务项目</li></a>--}}
            {{--<a href="##"><li>团队</li></a>--}}
            {{--<a href="##"><li>花絮</li></a>--}}
            {{--<a href="##"><li>作品</li></a>--}}
            {{--<a href="##"><li class="curr">首页</li></a>--}}
            @foreach($topmenus as $kmenu=>$topmenu)
                <a href="/company/{{ $kmenu }}"><li class="{{$curr==$kmenu?'curr':''}}">{{ $topmenu }}</li></a>
            @endforeach
        </ul>
    </div>
</div>