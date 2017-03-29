{{-- 这里是公司后台控制中心 --}}


<div class="com_admin_crumb">
    <p>首页
        @if(!in_array($lists['func']['url'],['home','auth','info','content']))
            / {{ $lists['func']['name'] }}
        @endif
        / {{ $curr['name'] }}
    </p>
</div>