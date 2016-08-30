@extends('company.main')
@section('content')
    <div class="com_firm">
        {{--<div class="title"><div>公司的团队</div></div>--}}
        {{--<p>团队的简单介绍...</p>--}}
        <div class="title"><div>{{ count($datas) ? $datas[0]->getModuleName() :'无' }}</div></div>
        <p>{!! count($datas) ? $datas[0]->getModuleIntro():'无' !!}</p>
        <div class="com_team_con">
            @if(count($datas))
                @foreach($datas as $data)
            <a href="{{DOMAIN}}c/{{CID}}/team/{{$data->id}}" title="点击查看 {{ $data->name }} 详情">
                <div class="onlyone" id="div_{{$data->id}}" onmouseover="over({{$data->id}});" onmouseout="out({{$data->id}})">
                    <div class="img">
                        <img src="{{$data->pic_id?$data->pic()->url:''}}">
                    </div>
                    <div class="text">{{ $data->name }}</div>
                    {{--<a href="{{DOMAIN}}c/{{CID}}/team/{{$data->id}}" class="com_a_show"></a>--}}
                </div>
            </a>
                @endforeach
            @endif

            @if(count($datas)<$datas->limit)
                @for($i=0;$i<$datas->limit-count($datas);++$i)
            <a href="" title="">
                <div class="onlyone">
                    <div class="img">待添加</div>
                    <div class="text">职员名称</div>
                    {{--<a href="{{DOMAIN}}c/{{CID}}/team/{{$data->id}}" class="com_a_show"></a>--}}
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