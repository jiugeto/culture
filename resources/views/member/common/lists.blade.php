{{-- 右侧菜单栏 --}}


<ul>
    @foreach($lists as $klist=>$list)
        @if(!in_array($klist,['func','create','edit','show']))
            <a href="/member/{{$lists['func']['url']}}/{{$klist}}"
               style="color:{{$klist==$curr_list?'red':'black'}};">
                <li>{{$list}}</li>
            </a>
            <li>|</li>
        @endif
    @endforeach
</ul>
<div class="mem_create"><a href="/member/{{$lists['func']['url']}}/create">{{$lists['create']['name']}}</a></div>