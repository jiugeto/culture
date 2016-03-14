{{-- 右侧菜单栏 --}}


<ul>
    @foreach($menus as $kmenu=>$menu)
        @if(!in_array($kmenu,['func','create']))
        <a href="/member/{{$kmenu}}"><li>{{$menu}}</li></a><li>|</li>
        @endif
    @endforeach
</ul>
<div class="mem_create"><a href="/member/{{$menus['func']['url']}}/create">创建作品</a></div>
