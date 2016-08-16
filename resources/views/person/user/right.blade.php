{{--右边头像模板--}}


<div class="per_right_head">
    <p class="title">头像</p>
    <div class="img">
        {{--@if($user && $user->head())--}}
        {{--<img src="{{ $user->head() }}" style="width:120px;">--}}
        {{--@else--}}
        <div style="margin:0;width:120px;height:100px;background:rgb(240,240,240);border:0;"></div>
        {{--@endif--}}
    </div>
    <div class="nicheng">00</div>
    <table cellpadding="0" cellspacing="0">
        @if(explode('/',$_SERVER['REQUEST_URI'])[3]!='gethead')
        <tr>
            <td><a href="{{DOMAIN}}person/user/gethead">编辑头像</a></td>
            <td><a href="">查看留言</a></td>
        </tr>
        <tr>
            <td><a href="">资料编辑</a></td>
            <td></td>
        </tr>
        @else
        <tr>
            <td><a href="">查看留言</a></td>
            <td><a href="">资料编辑</a></td>
        </tr>
        @endif
    </table>
</div>