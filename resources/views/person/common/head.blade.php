{{--右边头像模板--}}


<div class="per_right_head">
    <p class="title">头像</p>
    <div class="head">
        <div class="img">
            @if($user && $user['headImg'])
                <img src="{{ $user['headImg'] }}" style="
                    /*width:120px; height:100px;*/
                {{--@if($size=$user->getUserPicSize($user,$w=120,$h=100)) width:{{$size['w']}}px;height:{{$size['h']}}px; @endif--}}
                @if($size=$model->getImgSize($user['head'],$w=120,$h=100)) width:{{$size['w']}}px;height:{{$size['h']}}px; @endif
                    ">
            @else
                <div style="margin:0;width:120px;height:100px;background:rgb(240,240,240);border:0;"></div>
            @endif
        </div>
    </div>
    <div class="nicheng">{{ $user ? $user['username'] : '' }}</div>
    <table cellpadding="0" cellspacing="0">
        <tr>
            <td><a href="{{DOMAIN}}person/user/gethead">编辑头像</a></td>
            <td><a href="{{DOMAIN}}person/message">查看留言</a></td>
        </tr>
        <tr>
            <td><a href="{{DOMAIN}}person/user/{{ $user['id'] }}/edit">资料编辑</a></td>
            <td><a href="{{DOMAIN}}person/user/getpwd">更新密码</a></td>
        </tr>
    </table>
</div>