{{-- 面包屑导航 --}}


<div class="mem_crumb">
    会员后台
    @if(array_key_exists('func',$menus)) {{ ' / '.$menus['func']['name'] }} @endif
    @if(array_key_exists('create',$menus) && $menus['create']['name']) {{ ' / '.$menus['create']['name'] }} @endif
</div>