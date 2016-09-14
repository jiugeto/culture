{{--图片列表--}}


<style>
    .pic_list .pic_one { width:100px;height:50px;overflow:hidden; }
</style>

<span id="pic_curr" style="color:grey;">当前图片：{{ isset($data) ? $data->getPicName() : '未选择' }}</span>
<div style="height:10px"></div>
<input type="hidden" name="pic_id">
<a class="selpic" onclick="$('.pic_list').toggle(200);" title="点击展开或关闭图片列表">图片切换</a>
<a href="{{DOMAIN}}company/admin/pic" class="job">图片列表</a>
<div class="pic_list">
    @if(count($pics))
        @foreach($pics as $pic)
            <div class="img" onclick="getpic({{$pic->id}})" onmouseover="move({{$pic->id}})">
                <div class="pic_one"><img src="{{ $pic->url }}" title="选择 {{ $pic->name }}" style="@if($size=$pic->getUserPicSize($pic,$w=100,$h=50))width:{{$size['w']}}px;height:{{$size['h']}}px;@endif"></div>
                <div class="picsize size_{{$pic->id}}">{{ $pic->width.'*'.$pic->height }}</div>
            </div>
            <input type="hidden" name="picName_{{ $pic->id }}" value="{{ $pic->name }}">
        @endforeach
    @endif
</div>

<script>
    function move(picid){
        $(".picsize").css('bottom',0); $(".size_"+picid).animate({'bottom':'20px'},50);
    }
    function getpic(picid){
        var picName = $("input[name='picName_"+picid+"']").val();
        $("#pic_curr").html("当前图片："+picName);
        $("input[name='pic_id']")[0].value = picid;
        $(".pic_list").hide();
    }
</script>