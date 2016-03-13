{{-- 右侧菜单栏 --}}


<ul>
    @foreach($menus as $kmenu=>$menu)
        @if(!in_array($kmenu,['func','create','edit','show']))
            <a href="/member/{{$menus['func']['url']}}/{{$kmenu}}"
               style="color:{{$kmenu==$curr?'red':'black'}};">
                <li>{{$menu}}</li>
            </a>
            <li>|</li>
        @endif
    @endforeach
</ul>
<div class="mem_create"><a href="/member/{{$menus['func']['url']}}/create">{{$menus['create']['name']}}</a></div>