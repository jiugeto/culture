{{-- 企业后台控制管理中心顶部 --}}


<div class="com_admin_left">
    {{--<a href="#"><div><span><img src="/assets/images/home.png"></span>首页参数✔</div></a>--}}
    {{--<a href="#"><div><span><img src="/assets/images/tool.png"></span>后台布局</div></a>--}}
    {{--<a href="#"><div><span><img src="/assets/images/tool.png"></span>公司信息</div></a>--}}
    {{--<a href="#"><div class="level2">﹂页面布局</div></a>--}}
    {{--<a href="#"><div class="level2">﹂基本设置</div></a>--}}
    {{--<a href="#"><div class="level2">﹂添加单页</div></a>--}}
    {{--<a href="#"><div><span><img src="/assets/images/tool.png"></span>内容设置</div></a>--}}
    {{--<a href="#"><div class="level2">﹂首页编辑</div></a>--}}
    {{--<a href="#"><div class="level2">﹂产品编辑</div></a>--}}
    {{--<a href="#"><div class="level2">﹂新闻编辑</div></a>--}}
    {{--<a href="#"><div class="level2">﹂招聘编辑</div></a>--}}
    {{--<a href="#"><div class="level2">﹂联系编辑</div></a>--}}
    {{--<a href="#"><div><span><img src="/assets/images/tool.png"></span>扩展功能</div></a>--}}
    @foreach($companyMenus as $companyMenu)
        @if($companyMenu->pid==0)
            @if($companyMenu->pid==0)
            <a href="/{{$companyMenu->platUrl}}/{{$companyMenu->url}}"><div>
                <span>@if($companyMenu->url=='home')<img src="/assets/images/home.png">@elseif(in_array($companyMenu->url,['auth','cominfo','content']))<img src="/assets/images/tool.png">@endif</span>
                {{ $companyMenu->name }}
                </div></a>
            @if($companyMenu->child)
                @foreach($companyMenu->child as $subMenu)
                    <a href="/{{$subMenu->platUrl}}/{{$subMenu->url}}">
                        <div class="level2">﹂{{ $subMenu->name }}</div>
                    </a>
                @endforeach
            @endif
            @endif
        @endif
    @endforeach
    <div class="none">&nbsp;</div>
</div>