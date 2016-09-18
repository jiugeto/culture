{{-- 前台发布人信息模板 --}}


<span class="idea_right">
    @if($userInfo = $data->user())
        <div class="userinfo">
            <p class="title">{{ $userInfo->company($uid) ? $userInfo->company($uid)->name.'的' : '' }} {{--{{ $userInfo->username }}--}}</p>
            @if($userInfo->address)<p>地址：{{ str_limit($userInfo->address,20) }}</p>@endif
            <p>发布时间：{{ $userInfo->createTime() }}</p>
        </div>
    @endif
</span>