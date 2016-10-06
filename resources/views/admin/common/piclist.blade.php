{{--图片列表--}}


<style>
    a.selpic {
        margin:0 5px;
        padding:0 10px; padding-bottom:2px;
        color:rgb(14,144,210);
        text-decoration:none;
        border:1px solid rgb(14,144,210);
        border-radius:3px;
        cursor:pointer;
    }
    a:hover.selpic {
        color:orangered;
        text-decoration:underline;
        border:1px solid orangered;
    }
    .pic_list {
        padding:5px;
        width:420px; height:250px;
        border:1px solid lightgrey;
        background:white;
    @if($urls=explode('/',$_SERVER['REQUEST_URI']))
        @if(isset($urls[2])) position:absolute;left:20px;
            @if($urls[2]=='orderpro') top:180px;
            @elseif($urls[2]=='video') top:210px;
            @elseif($urls[2]=='goods') top:540px;
            @endif
        @endif
    @endif
        overflow:auto;
        display:none;
    }
    .pic_list .picsize{
        color:white;
        font-size:12px;
        text-align:center;
        background:rgba(50,50,50,0.5);
        position:relative;bottom:0;
    }
    .pic_list .pic_one { width:100px;height:50px;overflow:hidden; }
    /*.com_admin_list*/ .pic_list .img {
        margin-right:2px; margin-bottom:2px;
        width:100px; height:50px;
        border:1px solid lightgrey;
        background:gainsboro;
        overflow:hidden;
        cursor:pointer;
        float:left;
    }
    .pic_list .img:hover { border:1px solid orangered; }
</style>

<span id="pic_curr" style="color:grey;"><br>当前图片：{{ (isset($data)&&$data->getPicName()) ? $data->getPicName() : '未选择' }}</span>
<div style="height:10px"></div>
<input type="hidden" name="pic_id" value="{{ isset($data->pic_id) ? $data->pic_id : 0 }}">
<a class="selpic" onclick="$('.pic_list').toggle(200);" title="点击展开或关闭图片列表">图片切换</a>
<a href="{{DOMAIN}}admin/pic" class="job">图片列表</a>
<div class="pic_list">
    @if(count($pics))
        @foreach($pics as $pic)
            <div class="img" onclick="getpic({{$pic->id}})" onmouseover="move({{$pic->id}})">
                <div class="pic_one"><img src="{{ $pic->url }}" title="选择 {{ $pic->name }}" style="@if($size=$pic->getUserPicSize($pic,$w=100,$h=50))width:{{$size['w']}}px;height:{{$size['h']}}px;@endif"></div>
                <div class="picsize size_{{$pic->id}}" onmousemove="move2({{$pic->id}})">{{ $pic->width.'*'.$pic->height }}</div>
            </div>
            <input type="hidden" name="picName_{{ $pic->id }}" value="{{ $pic->name }}">
        @endforeach
    @endif
</div>
<p>@if(isset($data)&&$data->getPicName())<img src="{{$data->getPicUrl()}}" width="200">@endif</p>

<script>
    function move(picid){
        $(".picsize").css('bottom',0); $(".size_"+picid).animate({'bottom':'20px'},50);
    }
    function move2(picid){ $(".size_"+picid).css('bottom',20+'px'); }
    function getpic(picid){
        var picName = $("input[name='picName_"+picid+"']").val();
        $("#pic_curr").html("当前图片："+picName);
        $("input[name='pic_id']")[0].value = picid;
        $(".pic_list").hide();
    }
</script>