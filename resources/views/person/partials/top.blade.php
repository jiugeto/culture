{{-- 顶部模板 --}}


<div class="per_top">
    <p class="t"><b>{{ \Session::has('user')?\Session::get('user.username'):'' }} 的个人后台</b></p>
    <p><a href="">{{ 'http://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'] }}</a></p>
    <p class="t"><b>
            {{--<a href="">空间首页</a> &nbsp;--}}
            {{--<a href="">相册</a> &nbsp;--}}
            {{--<a href="">资料</a> &nbsp;--}}
            {{--<a href="">视频</a> &nbsp;--}}
            {{--<a href="">作品</a> &nbsp;--}}
            {{--<a href="">设计</a> &nbsp;--}}
            {{--<a href="">留言</a> &nbsp;--}}
            {{--<a href="">好友</a> &nbsp;--}}
            {{--<a href="">访问</a> &nbsp;--}}
            {{--<a href="">统计</a> &nbsp;--}}
            @foreach($links as $klink=>$vlink)
                <a href="{{ $klink }}" class="{{ $curr==$klink ? 'curr_link' : '' }}">{{ $vlink }}</a> &nbsp;
            @endforeach
        </b></p>
</div>