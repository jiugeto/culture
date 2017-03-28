@extends('company.main')
@section('content')
    <div class="com_firm">
        <div class="title"><div>{{count($datas)?$datas[0]['moduleName']:'无'}}</div></div>
        <p>{{count($datas)?$datas[0]['moduleIntro']:'无'}}</p>
        <div class="com_team_con">
            @if(count($datas))
                @foreach($datas as $data)
            <a href="{{DOMAIN}}c/{{$company['id']}}/team/{{$data['id']}}" title="点击查看 {{$data['name']}} 详情">
                <div class="onlyone" id="div_{{$data['id']}}"
                     onmouseover="over({{$data['id']}});" onmouseout="out({{$data['id']}})">
                    <div class="img">
                        @if($data['thumb'])<img src="{{$data['thumb']}}">@endif
                    </div
                    <div class="text">{{$data['name']}}</div>
                    <a href="{{DOMAIN}}c/{{$company['id']}}/team/{{$data['id']}}"></a>
                </div>
            </a>
                @endforeach
            @endif

            @if(count($datas)<5)
                @for($i=0;$i<5-count($datas);++$i)
            <a href="" title="">
                <div class="onlyone">
                    <div class="img">待添加</div>
                    <div class="text">职员名称</div>
                </div>
            </a>
                @endfor
            @endif
        </div>
    </div>

    <script>
        function over(id){
            $("#div_"+id+" div.text").stop(true,true).animate({top:"-40px"});
        }
        function out(id){
            $("#div_"+id+" div.text").stop(true,true).animate({top:"0px"});
        }
    </script>
@stop