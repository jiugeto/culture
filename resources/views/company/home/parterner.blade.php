@extends('company.main')
@section('content')
    <div class="com_product">
        <p class="crumb"><b>合作伙伴：</b>全部
            <span class="float_right">
                <a href="">首页</a> / 合作伙伴
            </span>
        </p>

        <div class="com_list">
            @if(count($datas))
                @foreach($datas as $data)
            <a href="" title="{{ $data->name }}">
                <div class="com_pro" style="height:120px;" id="par_{{$data->id}}" onmouseover="over({{$data->id}})" onmouseout="out({{$data->id}})">
                    <div class="img">
                        <img src="{{ $data->getPicUrl() }}" style="@if($size=$data->getPicSize($w=228,$h=120))width:{{$size['w']}}px;height:{{$size['h']}}px; @endif">
                    </div>
                    <div class="textbtn" onclick="getPar({{$data->id}})" onmouseover="over({{$data->id}})">看资料</div>
                </div>
            </a>
                @endforeach
            @endif
            @if(count($datas)<$datas->limit)
                @for($i=0;$i<$datas->limit-count($datas);++$i)
            <a title="待添加合作伙伴logo">
                <div class="com_pro" style="height:120px;">
                    <div class="img">待添加</div>
                    <div class="textbtn">资料</div>
                </div>
            </a>
                @endfor
            @endif
        </div>
        @include('company.partials.page')
    </div>

    <script>
        function over(id){
            $("#par_"+id+" div.textbtn").stop(true,true).animate({top:"-30px"});
        }
        function out(id){
            $("#par_"+id+" div.textbtn").stop(true,true).animate({top:"0px"});
        }
        function getPar(id){
            window.location.href = '{{DOMAIN}}c/{{CID}}/parterner/'+id;
        }
    </script>
@stop