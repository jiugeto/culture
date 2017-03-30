{{-- 企业后台控制管理中心顶部 --}}


<div class="com_admin_left">
    @foreach($companyMenus as $companyMenu)
        @if($companyMenu['pid']==0)
            @if($companyMenu['pid']==0)
            <a href="
                @if($companyMenu['url']=='javascript:;')javascript:;
                @else{{DOMAIN.$companyMenu['platUrl']}}/{{$companyMenu['url']}}
                @endif
                    ">
                <div class="menu {{$curr_func==$companyMenu['url']?'curr':''}}">
                    <span>
                        @if($companyMenu['url']=='home')
                            <img src="{{DOMAIN}}assets/images/home.png">
                        @elseif($companyMenu['url']=='javascript:;')
                            <img src="{{DOMAIN}}assets/images/tool.png">
                        @endif
                    </span>
                    {{$companyMenu['name']}}
                </div>
            </a>
            @if($companyMenu['child'])
                @foreach($companyMenu['child'] as $subMenu)
                    <a href="{{DOMAIN.$subMenu['platUrl']}}/{{$subMenu['url']}}">
                        <div class="level2 menu
                        {{($curr_func==$subMenu['url']||$curr_func==$subMenu['url'].'module')?'curr':''}}">
                            <span style="color:#bfbfbf;">→</span>
                            {{$subMenu['name']}}
                        </div>
                    </a>
                @endforeach
            @endif
            @endif
        @endif
    @endforeach
</div>