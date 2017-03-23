{{--右边头像模板--}}


<div class="per_right_head">
    <p class="title">头像</p>
    <div class="head">
        <div class="img">
            @if($user && $user['head'])
                <img src="{{$user['head']}}" width="120">
            @endif
        </div>
    </div>
    <div class="nicheng">{{$user?$user['username']:''}}</div>
    <table cellpadding="0" cellspacing="0">
        <tr>
            <td><a href="{{DOMAIN}}person/user/gethead">编辑头像</a></td>
            <td><a href="{{DOMAIN}}person/message">查看留言</a></td>
        </tr>
        <tr>
            <td><a href="{{DOMAIN}}person/user/{{$user['id']}}/edit">资料编辑</a></td>
            <td><a href="{{DOMAIN}}person/user/getpwd">更新密码</a></td>
        </tr>
    </table>
</div>