@extends('home.main')
@section('content')
    @include('home.common.crumb')

    {{--分镜来一个瀑布流--}}
    <link rel="stylesheet" type="text/css" href="{{PUB}}assets-home/css/waterfall.css">
    <div class="pbl_title pbl_show_title"><b>{{ $data->name }}</b></div>
    <div class="pbl_out">
        <div class="pbl_show_user">{{ $data->user() }} 发布于 {{ $data->created_at }}</div>
        <div class="pbl_show_con">
            <img src="{{ $data->thumb() }}">
        </div>
        <div style="height:20px;border-bottom:5px solid rgba(240,240,240,1);">{{--空白--}}</div>
        <div class="pbl_show_user">分镜简介</div>
        @if($data->intro)
        <div class="pbl_intro">{{ $data->intro }}</div>
        @else <p style="text-align:center;">无</p> @endif
    </div>
    <div class="pbl_out2">
        <div class="pbl_show_user">分镜细节</div>
        @if($data->detail)
            <div class="pbl_show_con">
                @if($data->iscon==3) {!! $data->detail !!}
                @else
                    <div class="pbl_show_btn">您没有查看细节的权限</div>
                    <div class="pbl_show_btn">
                        <a id="lookopen" title="点击申请">查看分镜</a>
                    </div>
                @endif
            </div>
        @else <p style="text-align:center;">没有细节</p>
        @endif
    </div>
    <div class="pbl_show_btn">
        <a onclick="like({{$data->id}})" title="点击喜欢或者不喜欢">
            喜欢 <span class="star">{{ $data->getLike() }}</span>
        </a>
    </div>
    <div style="height:50px;">{{--空白--}}</div>
    <input type="hidden" name="_token" value="{{csrf_token()}}">
    <input type="hidden" name="id" value="{{ $data->id }}">
    <input type="hidden" name="thumb" value="{{ $data->thumb() }}">
    <input type="hidden" name="genre" value="{{ $data->genre }}">
    <input type="hidden" name="iscon" value="{{ $data->iscon }}">
    <input type="hidden" name="remarks" value="{{ $data->remarks }}">

    <div class="laymsg" style="">
        <h4 style="text-align:center;">查看限制</h4>
        <p id="msgcon"></p>
        <p id="toOrder" style="display:none;"><a class="toOrder">申请下单</a></p>
        <p id="toSure"><a href="">确定</a></p>
        <a class="close" onclick="$('.laymsg').hide();"> X </a>
    </div>
    <div class="layback">
        <h4 style="text-align:center;">订单申请</h4>
        <p id="backcon"></p>
        <p><a href="{{DOMAIN}}member/order">进入订单列表</a></p>
        <a class="close" onclick="$('.layback').hide();"> X </a>
    </div>

    <script>
        $(document).ready(function(){
            var filePath = $("input[name='thumb']").val();
            var image = new Image(); image.src = filePath;
            $(".pbl_out").css('height',image.height+400+'px');

            //下订单权限
            var iscon = $("input[name='iscon']");
            var remarks = $("input[name='remarks']");
            $("#lookopen").click(function(){
                if (iscon.val()==0) {
                    $(".laymsg").show(); $("#toOrder").show(); $("#toSure").hide();
                    $("#msgcon").html("您没有查看权限，查看分镜详情请先下订单！");
                    return;
                } else if (iscon.val()==1) {
                    $(".laymsg").show(); $("#toOrder").hide(); $("#toSure").show();
                    $("#msgcon").html("您没有查看权限，订单未得到回复，请耐心等待！");
                    return;
                } else if (iscon.val()==2) {
                    $(".laymsg").show(); $("#toOrder").hide(); $("#toSure").show();
                    $("#msgcon").html("您没有查看权限，对方拒绝您的分镜订单请求，理由："+remarks.val()+"！");
                    return;
                } else if (iscon.val()==3) {
                    $(this).hide(); $("#lookclose").show(); $("#con").show();
                }
            });
            $.ajaxSetup({headers : {'X-CSRF-TOKEN':$('input[name="_token"]').val()}});
            $(".toOrder").click(function(){
                var id = $("input[name='id']").val();
                //1创意供应，2创意需求，3分镜供应，4分镜需求，5商品供应，6商品需求，7娱乐供应，8娱乐需求，9演员供应，10演员需求，1租赁供应，12租赁需求
                var genre0 = $("input[name='genre']").val();
                var genre;
                if (genre0==1) { genre = 3; } else if (genre0==2) { genre = 4; }
                $.ajax({
                    type: 'POST',
                    url: '{{DOMAIN}}}member/order/create',
                    data: {'genre':genre,'id':id},
                    dataType: 'json',
                    success: function(data) {
                        alert(data.message);
                        $(".laymsg").hide(); $(".layback").show(); $("#backcon").html(data.message);
                    }
                });
            });
        });

        function like(id){
            window.location.href = "{{DOMAIN}}storyboard/like/2/"+id;
        }
    </script>
@stop