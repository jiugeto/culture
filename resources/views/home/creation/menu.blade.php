
{{-- 用户类型 --}}
{{--<div class="cre_kong">&nbsp;</div>--}}
{{--<div class="cre_select">--}}
    {{--<button class="cre_gener">普通用户 | 免费 <img src="{{PUB}}assets-home/images/gener_x.png"></button>--}}
    {{--<button class="cre_jiantou1">=></button>--}}
    {{--<button class="cre_per">个人会员 | 免费 <img src="{{PUB}}assets-home/images/person_x.png"></button>--}}
    {{--<button class="cre_jiantou2">=></button>--}}
    {{--<button class="cre_com">企业会员 | 免费 <img src="{{PUB}}assets-home/images/company_x.png"></button>--}}
{{--</div>--}}

{{-- 片源类型 --}}
<div class="cre_kong">&nbsp;</div>
<div class="cre_cate" style="height:120px">
    <a href="{{DOMAIN}}creation">
        <div class="text {{$genre==1?'curr':''}}">☑ 已有动画
            <div class="small">已有在线模板，方便调节</div>
        </div>
    </a>
    <a href="{{DOMAIN}}creation/s/2/{{$cate}}/0">
        <div class="text {{$genre==2?'curr':''}}">□ 动画定制
            <div class="small">只有离线模板，收费预览</div>
        </div>
    </a>
    <a href="{{DOMAIN}}creation/s/3/{{$cate}}/0">
        <div class="text {{$genre==3?'curr':''}}">☒ 效果定制
            <div class="small">没有模板，用户提供效果，量身定制</div>
        </div>
    </a>
</div>
<div class="cre_kong">&nbsp;</div>
<div class="cre_cate" style="font-size:12px;">
    注意：这里的在线创作，只是模板/效果/动画的片段，不是完整的片子；产品样片才是完整的片子。
</div>
<div class="cre_kong">&nbsp;</div>
<div class="cre_cate">
    类型：
    <a href="
        @if($genre!=1) {{DOMAIN}}creation/s/{{$genre}}/0/{{$isOrder}}
        @else {{DOMAIN}}creation
        @endif
    " class="{{$cate==0?'curr':''}}">全部</a>
    @foreach($model['cates2'] as $kcate=>$vcate)
        <a href="{{DOMAIN}}creation/s/{{$genre}}/{{$kcate}}/{{$isOrder}}" class="{{$cate==$kcate?'curr':''}}">{{ $vcate }}</a>
    @endforeach
</div>
<div class="cre_kong">&nbsp;{{--10px高度留空--}}</div>
<div class="cre_cate">
    菜单：
    <a href="
        @if($genre==1 && $cate)
        {{DOMAIN}}creation
        @else
        {{DOMAIN}}creation/s/{{$genre}}/{{$cate}}/0
        @endif
        " title="模板源" class="{{!$isOrder?'curr':''}}">
        @if($genre==1)在线片源@elseif($genre==2)离线片源@elseif($genre==3)效果定制@endif
    </a>
    <a href="{{DOMAIN}}creation/s/{{$genre}}/{{$cate}}/1" title="成功订单" class="{{$isOrder?'curr':''}}">用户成品</a>

    {{--增加需求的链接--}}
    @if($genre==3)
    &nbsp;    <span style="color:gainsboro">|</span> &nbsp;
    <a href="{{DOMAIN}}member/online" title="去添加效果需求"><b>添加效果需求</b></a>
    @endif
</div>
<div class="cre_kong">&nbsp;</div>