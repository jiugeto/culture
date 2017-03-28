@extends('company.main')
@section('content')
    <div class="com_about">
        <span class="left">
            <div class="about_con">
            @if(count($datas))
            @foreach($datas as $k=>$data)
                <div class="star" id="star_{{$data['id']}}" style="display:{{$k==0?'block':'none'}}">
                    {{$data['name']}}
                    <span style="color:#e5e5e5;font-size:12px;">{{$data['createTime']}}</span>
                </div>
                <div class="con" id="con_{{$data['id']}}" style="display:{{$k==0?'block':'none'}}">
                    @if($data['thumb'])
                    <div class="img"><img src="{{$data['thumb']}}"></div>
                    @endif
                    {{$data['intro']}}
                </div>
            @endforeach
            @else 待填写...
            @endif
            </div>
        </span>
        <span class="right">
            <div class="about_a">
                <div class="{{$genre==1?'curr':''}}"
                     onclick="window.location.href='{{DOMAIN}}c/{{$company['id']}}/about';"> ▶ 公司介绍</div>
                <div class="{{$genre==2?'curr':''}}"
                     onclick="window.location.href='{{DOMAIN}}c/{{$company['id']}}/about/s/2';"> ▶ 公司历程</div>
                <div class="{{$genre==3?'curr':''}}"
                     onclick="window.location.href='{{DOMAIN}}c/{{$company['id']}}/about/s/3';"> ▶ 公司新闻</div>
                <div class="{{$genre==4?'curr':''}}"
                     onclick="window.location.href='{{DOMAIN}}c/{{$company['id']}}/about/s/4';"> ▶ 行业资讯</div>
            </div>
            <div class="about_func">
                <p>标题：</p>
                @if($datas)
                    @foreach($datas as $data)
                    <p class="funcName" id="funcName_{{$data['id']}}" title="点击显示 {{$data['name']}}">
                        <a href="javascript:;" onclick="getFunc({{$data['id']}})">{{$data['name']}}</a>
                    </p>
                    @endforeach
                @endif
            </div>
        </span>
    </div>

    <script>
        function getFunc(id){
            $(".star").hide(); $(".con").hide();
            $("#star_"+id).show(); $("#con_"+id).show();
            $(".funcName").css('color','#808080'); $("#funcName_"+id).css('color','#ff4466');
        }
    </script>
@stop