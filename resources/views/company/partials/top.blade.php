{{-- 企业后台顶部菜单栏 --}}


<div class="com_top">
    <div class="com_center">
        <div class="com_logo">
            {{--<a href="##"><div class="img"></div></a>--}}
                <a href="/company/home">
                    <div class="img">
                        @if($comMain)
                            <img src="{{ $comMain->logo }}" title="{{ $comMain->company()?$comMain->company()->name:'某某公司' }}-{{ $comMain->title }}" class="com_logo_size">
                        @else <img src="/assets/images/del_red.png" title="logo名称或公司名称" class="com_logo_size">
                        @endif
                    </div>
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
            {{--@foreach($topmenus as $kmenu=>$topmenu)--}}
                {{--<a href="/company/{{ $kmenu }}"><li class="{{$curr==$kmenu?'curr':''}}">{{ $topmenu }}</li></a>--}}
            {{--@endforeach--}}
            @foreach($topmenus as $topmenu)
                @if(count($topmenu)<8)
                <a href="/company/{{ $topmenu->link }}">
                    <li class="{{$curr==$topmenu->link?'curr':''}}">{{ $topmenu->name }}</li>
                </a>
                @endif
            @endforeach
        </ul>
    </div>
</div>