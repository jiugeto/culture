{{-- 右侧菜单栏 --}}


<ul>
    @foreach($lists as $klist=>$list)
        {{--@if(!in_array($klist,['func','create','edit','show']))--}}
        @if(in_array($klist,['','trash']))
            <a href="/member/{{$lists['func']['url']}}/{{$klist}}"
               style="color:{{$klist==$curr['url']?'red':'black'}};">
                <li>{{$lists[$klist]['name']}}</li>
            </a>
            <li>|</li>
        @endif
    @endforeach
</ul>
{{--@if($lists['func']['url']!='product')--}}
    <div class="mem_create"><a href="/member/{{$lists['func']['url']}}/create">{{$lists['create']['name']}}</a></div>
{{--@else--}}
    {{--<div class="mem_create"><a href="/online">在线创作</a></div>--}}
{{--@endif--}}