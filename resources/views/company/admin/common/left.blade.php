{{-- 企业后台控制管理中心顶部 --}}


<div class="com_admin_left">
    @foreach($companyMenus as $companyMenu)
        @if($companyMenu['pid']==0)
            @if($companyMenu['pid']==0)
            <a href="{{DOMAIN.$companyMenu['platUrl']}}/{{$companyMenu['url']}}">
                <div class="menu {{$curr_func==$companyMenu['url']?'curr':''}}">
                    <span>
                        @if($companyMenu['url']=='home')
                            <img src="{{DOMAIN}}assets/images/home.png">
                        @elseif(in_array($companyMenu['url'],['auth','info','content','general']))
                            <img src="{{DOMAIN}}assets/images/tool.png">
                        @endif
                    </span>
                    {{$companyMenu['name']}}
                </div>
            </a>
            @if($companyMenu['child'])
                @foreach($companyMenu['child'] as $subMenu)
                    <a href="{{DOMAIN.$subMenu['platUrl']}}/{{$subMenu['url']}}">
                        <div class="level2 menu {{($curr_func==$subMenu['url']||$curr_func==$subMenu['url'].'module')?'curr':''}}">
                            ﹂{{$subMenu['name']}}</div>
                    </a>
                @endforeach
            @endif
            @endif
        @endif
    @endforeach
</div>