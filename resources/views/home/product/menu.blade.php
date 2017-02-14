{{--样片、定制的菜单模板--}}


{{-- 产品广告位 --}}
@if($ptype==1)
<div class="pro_ad">
    <div class="pro_ad_pic">
        @if(count($ppts))
            @foreach($ppts as $ppt)
                <a href="{{ $ppt['link'] }}" title="{{ $ppt['name'] }}" id="ppt_{{$ppt['id']}}">
                    <img src="{{ $ppt['img'] }}">
                </a>
            @endforeach
        @endif
        @if(count($ppts)<9)
            <a href="javascript:;" title="待添加">
                <div style="width:100%;height:100%;background:gainsboro;color:grey;text-align:center;line-height:200px;">待添加</div>
            </a>
        @endif
    </div>
    <div class="pro_ad_change">
        <div class="ppt_change_bg"></div>
        <ul class="ppt_change_pic">
            @if(count($ppts))
                @foreach($ppts as $kppt=>$ppt)
                    <li class="{{$kppt==0?'curr':''}}" onmouseover="over({{$ppt['id']}})">
                        <img src="{{$ppt['img']}}">
                    </li>
                @endforeach
            @endif
            @if(count($ppts)<9)
                @for($i=0;$i<9-count($ppts);++$i)
                    <li>+</li>
                @endfor
            @endif
        </ul>
    </div>
</div>
<script>
    function over(pptid){
        $(".ppt_change_pic > li").removeClass('curr'); $(this).addClass('curr');
        $(".pro_ad_pic > a").hide(); $("#ppt_"+pptid).show();
    }
</script>
@endif

{{--插入选择--}}
<div class="cre_kong">&nbsp;</div>
<div class="cre_cate" style="width:980px;height:120px">
    <a href="{{DOMAIN}}product">
        <div class="text {{$ptype==1?'curr':''}}" style="width:430px;">样片
            <div class="small">供应方发布的样片</div>
        </div>
    </a>
    <a href="{{DOMAIN}}product/s/2">
        <div class="text {{$ptype==2?'curr':''}}" style="width:430px;">定制
            <div class="small">需求方的片源要求、量身定做</div>
        </div>
    </a>
</div>
<div class="cre_kong">&nbsp;</div>
<div class="cre_cate" style="width:980px;font-size:12px;">
    制作可能使用软件：3D软件（MAYA/MAX/C4D/REALFLOW...），合成软件（AE...），剪辑软件（EDIUS/PR...）等。
</div>