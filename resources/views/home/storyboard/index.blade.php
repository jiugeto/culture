@extends('home.main')
@section('content')
    @include('home.common.crumb')

    {{--分镜来一个瀑布流--}}
    <link rel="stylesheet" type="text/css" href="{{PUB}}assets-home/css/waterfall.css">
    <div class="pbl_title">
        分镜：
        {{--<a href="{{DOMAIN}}storyboard" class="{{ $way=='' ? 'star' : '' }}">全部</a>--}}
        {{--<a href="{{DOMAIN}}storyboard/w/1" class="{{ $way=='isnew' ? 'star' : '' }}">最新</a>--}}
        {{--<a href="{{DOMAIN}}storyboard/w/2" class="{{ $way=='ishot' ? 'star' : '' }}">热门</a>--}}
        <a class="{{ $way==0 ? 'star' : '' }}" onclick="getWay(0)">全部</a>
        {{-- w代表检索方式 --}}
        <a class="{{ $way==1 ? 'star' : '' }}" onclick="getWay(1)">最新</a>
        <a class="{{ $way==2 ? 'star' : '' }}" onclick="getWay(2)">热门</a>
        <input type="hidden" name="way" value="{{$way}}">
        <input type="hidden" name="cate" value="{{$cate}}">
        <span class="right">分镜：{{ count($datas) }}</span>
        <br>分类：
        <a class="{{ $cate==0 ? 'star' : '' }}" onclick="getCate(0)">全部</a>
        @foreach($model['cates2'] as $kcate=>$vcate)
            <a class="{{ $cate==$kcate ? 'star' : '' }}" onclick="getCate({{$kcate}})">{{ $vcate }}</a>
        @endforeach
    </div>
    <script>
        var way = $("input[name='way']");
        var cate = $("input[name='cate']");
        function getWay(w){
            way[0].value = w;
            window.location.href = '{{DOMAIN}}storyboard/w/'+way.val()+'/'+cate.val();
        }
        function getCate(c){
            cate[0].value = c;
            window.location.href = '{{DOMAIN}}storyboard/w/'+way.val()+'/'+cate.val();
        }
    </script>

    <div class="pbl_out">
        @if(count($datas))
            @foreach($datas as $data)
        <div class="pbl_one">
            <div class="pbl_in">
                <div class="img">
                    <a href="{{DOMAIN}}storyboard/{{ $data->id }}" title="点击进入查看{{ $data->name }}">
                        <img src="{{ $data->thumb() }}">
                    </a></div>
                <div class="title">
                    <a href="{{DOMAIN}}storyboard/{{ $data->id }}" title="点击进入查看{{ $data->name }}">
                        {{ str_limit($data->name,15) }}</a>
                </div>
                @if($data->company())<a href="">{{ $data->getComName() }}</a>@endif
                <span class="right">
                    <a class="click" onclick="like({{$data->id}})" title="点击喜欢或者不喜欢">喜欢：{{ $data->getLike() }}</a>&nbsp;&nbsp;
                    {{--<a class="click" id="apply">申请分镜</a>--}}
                </span>
            </div>
        </div>
            @endforeach
        @else
        <div class="pbl_one">
            <div class="pbl_in">
                <div class="img">+</div>
                <div class="title"><a href="">分镜名称</a></div>
                <a href="">公司名称</a>
            <span class="right">
                <a class="click" onclick="">喜欢：0</a>&nbsp;&nbsp;
                {{--<a class="click" onclick="">回复：0</a>--}}
            </span>
            </div>
        </div>
        @endif
    </div>
    {{--前台分页--}}
    <div class="page"></div>

    <script>
        $(document).ready(function(){
            //计算瀑布流高度
            var pbl_out = $(".pbl_out");
            var pbl_in = $(".pbl_in");
            var num = Math.ceil(pbl_in.length/4);
//            alert(Math.ceil(pbl_in.length/4));
            pbl_out.css('height',340*num+'px');
        });

        function like(id){
            window.location.href = "{{DOMAIN}}storyboard/like/1/"+id;
        }
    </script>
@stop