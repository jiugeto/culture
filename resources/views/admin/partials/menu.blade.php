{{-- 系统后台左侧菜单 --}}

<ul class="am-list admin-sidebar-list">
    @foreach($actions as $action)
    <li class="admin-parent">
        <a class="am-cf" data-am-collapse="{target: '#collapse-nav'}" href="/admin/{{$action->url}}">
            <span class="am-icon-file"></span>  {{ $action->name }}
            <span class="am-icon-angle-right am-fr am-margin-right"></span>
        </a>
        <ul class="am-list am-collapse admin-sidebar-sub am-in" id="collapse-nav">
            @if($action->child)
                @foreach($action->child as $sub_action)
            <li>
                <a href="/admin/{{$sub_action->url}}@if($sub_action->action!='index'){{'/'.$sub_action->action}}@endif" class="{{$sub_action->style_class}}">
                    <span class="am-icon-check"></span> {{ $sub_action->name }}
                    <span class="am-icon-star am-fr am-margin-right admin-icon-yellow"></span>
                </a>
            </li>
                @endforeach
            @endif
        </ul>
    </li>
    @endforeach
</ul>