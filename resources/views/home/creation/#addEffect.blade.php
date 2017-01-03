{{----}}


<style>
    .effect { margin:0 auto;padding:10px 50px;width:750px;color:grey;border:1px dashed gainsboro;border-radius:5px; }
    .effect input { padding:5px 10px;width:700px;border:1px solid gainsboro; }
    .effect select { padding:2px 10px;border:1px solid gainsboro;color:grey; }
    .effect textarea { padding:5px;border:1px solid gainsboro; }
    .effect a { color:orangered;text-decoration:none; }
</style>

<div class="effect">
    @if(!Session::has('user'))<p style="padding:0;border:0;color:red;">还没有登录，以下填写无效，请先登录！</p>@endif
    <form method="POST" action="{{DOMAIN}}creation/addEffect" enctype="multipart/form-data">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        {{--<input type="hidden" name="method" value="POST">--}}

        产品名称：<br>
        <input type="text" placeholder="至少2个字符" name="name">
        <br><br>

        效果参考链接：<br>
        <input type="text" placeholder="外部视频链接复制、粘贴于此" name="link">
        <br><br>

        修改要求：<br>
        <textarea placeholder="对动画内容、属性、动画帧的修改要求，建议格式例：01:05--图文更换/属性调整..." name="intro" cols="100" rows="10"></textarea>
        <br><br>

        渲染格式：
        <select name="formatMoney">
            @foreach($orderProModel['formatNames'] as $kformat=>$formatName)
                <option value="{{ $orderProModel['formatMoneys'][$kformat] }}">{{ $formatName }}</option>
            @endforeach
        </select>
        &nbsp;&nbsp;&nbsp;&nbsp;
        渲染价：<span id="renderMoney" class="red">{{$orderProModel['formatMoneys'][1]}}</span>元
        <br><br>
        总价 = 渲染价 + 制作价

        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        优先使用福利(元)：{{(Session::has('user')&&$wallet)?$wallet->weal:0}}
        <a href="{{DOMAIN}}member/wallet" target="_blank">去兑换福利</a>
        <br><br>

        <button type="submit" class="homebtn">保存添加</button>
    </form>
</div>

<script>
    //价格计算
    $("select[name='formatMoney']").change(function(){
        var renderMoney = $(this).val();
        $("#renderMoney").html(renderMoney);
    });
</script>