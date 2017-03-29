@extends('company.main')
@section('content')
    <div class="com_product">
        <p class="crumb" style="padding-bottom:5px;border-bottom:1px dashed #e5e5e5;color:#808080;">
            <b>合作伙伴：</b>
            <span class="float_right">
                <a href="{{DOMAIN}}c/{{$company['id']}}">首页</a> / 合作伙伴
            </span>
        </p>
        <div class="com_list">
            @if(count($datas))
                @foreach($datas as $data)
            <a href="" title="{{$data['name']}}">
                <div class="com_pro" style="height:120px;" id="par_{{$data['id']}}"
                     onmouseover="over({{$data['id']}})" onmouseout="out({{$data['id']}})">
                    <div class="img">
                        <img src="{{$data['thumb']}}">
                    </div>
                    <div class="textbtn" onmouseover="over({{$data['id']}})">看资料</div>
                </div>
            </a>
                @endforeach
            @endif
            @if(count($datas)<$limit)
                @for($i=0;$i<$limit-count($datas);++$i)
            <a href="javascript:;" title="待添加合作伙伴logo">
                <div class="com_pro" style="height:120px;">
                    <div class="img">待添加</div>
                    <div class="textbtn">资料</div>
                </div>
            </a>
                @endfor
            @endif
        </div>
        @include('company.common.page2')
    </div>

    <script>
        function over(id){
            $("#par_"+id+" div.textbtn").stop(true,true).animate({top:"-30px"});
        }
        function out(id){
            $("#par_"+id+" div.textbtn").stop(true,true).animate({top:"0px"});
        }
    </script>
@stop