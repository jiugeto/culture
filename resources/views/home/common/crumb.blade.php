{{-- 这里是首页面包屑导航模板 --}}


<div class="s_crumb">
    <div class="crumb">
        <div class="right">
            首页 / {{ $menus[$curr] }}
            @if($menus[$curr]=='用户意见')
                {{ $reply==0 ? ' / 发布新意见' : ' / 意见'.$reply.'的回复' }}
            @endif
        </div>
    </div>
</div>