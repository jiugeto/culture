{{-- 面包屑导航 --}}


<ul>
    @foreach($menus as $kmenu=>$menu)
        <a href="/member/{{$kmenu}}"><li>{{$menu}}</li></a><li>|</li>
    @endforeach
</ul>