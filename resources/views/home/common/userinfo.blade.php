{{-- 前台发布人信息模板 --}}


<span class="idea_right">
    <div class="userinfo">
        <p class="title">{{$userInfo['company']?$userInfo['company']['name']:$userInfo['name']}}</p>
        @if($userInfo['address'])<p>地址：{{str_limit($userInfo['address'],20)}}</p>@endif
        <p>发布时间：{{$userInfo['createTime']}}</p>
    </div>
</span>