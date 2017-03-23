@extends('person.main')
@section('content')
    <div class="per_body" style="border:0;height:700px;background:0;">
        @include('person.common.top')
        <div class="per_list">
            <p class="title">@if($m==0)我的好友@elseif($m==1)新的申请@elseif($m==2)寻找好友@endif</p>
            <div class="list" style="width:748px;height:700px;">
                @if(count($datas)>1)
                    @foreach($datas as $kdata=>$data)
                        @if(is_numeric($kdata) && in_array($m,[0,1]))
                <div class="frield">
                    <a href="">
                        <div class="left head"><img src=""></div>
                    </a>
                    <div class="left">
                        <p><span class="uname" id="frield2_{{$data['id']}}">
                                {{ $data['username']!=Session::get('user.username')?$data['username']:$data['frieldName'] }}</span>
                            <span class="level">等级</span>
                        </p>
                        <p>签名签名签名签名签名</p>
                        <p class="toshow">
                            @if($m==1)
                                <a href="{{DOMAIN}}person/frield/pass/{{$data['id']}}">同意</a>&nbsp;
                                <a href="javascript:;" onclick="getRefuse({{$data['id']}})">拒绝</a>&nbsp;
                            @endif
                            <a href="{{DOMAIN}}person/frield/{{$m}}/{{$data['username']!=Session::get('user.username')?$data['id']:$data['frield_id']}}">查看</a>
                        </p>
                    </div>
                </div>
                        @elseif(is_numeric($kdata) && $m==2)
                <div class="frield">
                    <a href="">
                        <div class="left head"><img src=""></div>
                    </a>
                    <div class="left">
                        <p><span class="uname" id="frield{{$data['id']}}">{{ $data['username'] }}</span>
                            <span class="level">等级</span></p>
                        <p style="padding:10px 0">{{ $data['area']?$model->getAreaName($data['area']):'未知地区' }}</p>
                        <p class="toshow">
                            <a onclick="getApply({{$data['id']}})">添加好友</a>&nbsp;
                            <a href="{{DOMAIN}}person/frield/{{$m}}/{{$data['id']}}">查看</a>
                        </p>
                    </div>
                </div>
                        @endif
                    @endforeach
                @else
                    <div style="margin:20px auto;text-align:center;">没有{{$m==1?'申请':'好友'}}</div>
                @endif

                {{--空白填充--}}
                {{--@if(count($datas)-1<$datas['pagelist']['limit'])--}}
                    {{--@for($i=0;$i<$datas['pagelist']['limit']+1-count($datas);++$i)--}}
                {{--<div class="frield">--}}
                    {{--<a href="">--}}
                        {{--<div class="left head"><img src=""></div>--}}
                    {{--</a>--}}
                    {{--<div class="left">--}}
                        {{--<p><span class="uname">名称</span>--}}
                            {{--<span class="level">等级</span></p>--}}
                        {{--<p>签名签名签名签名签名</p>--}}
                        {{--<p class="toshow">--}}
                            {{--@if($m==1)--}}
                                {{--<a href="">同意</a>&nbsp;--}}
                                {{--<a href="">拒绝</a>&nbsp;--}}
                            {{--@endif--}}
                            {{--<a href="">查看</a>--}}
                        {{--</p>--}}
                    {{--</div>--}}
                {{--</div>--}}
                    {{--@endfor--}}
                {{--@endif--}}

                <div style="clear:both;">@include('home.common.page2')</div>
            </div>
        </div>
        @include('person.common.head')
        <div class="per_right_head">
            <p class="title">好友菜单</p>
            <div class="menu {{ $m==1 ? 'm_curr' : '' }}" onclick="window.location.href='{{DOMAIN}}person/frield/m/1';">新的申请</div>
            <div class="menu {{ $m==0 ? 'm_curr' : '' }}" onclick="window.location.href='{{DOMAIN}}person/frield';">我的好友</div>
            <div class="menu {{ $m==2 ? 'm_curr' : '' }}" onclick="window.location.href='{{DOMAIN}}person/frield/m/2';">寻找好友</div>
            {{--<div class="menu">黑名单</div>--}}
            <div style="height:10px;"></div>
        </div>
    </div>

    {{--弹窗--}}
    <script src="{{PUB}}assets/js/jquery-1.10.2.min.js"></script>
    <style>
        .mask { width:100%;height:100%;background:black;
            filter:alpha(opacity:30);opacity:0.3;-moz-opacity:0.3;-khtml-opacity:0.3;
            position:fixed;left:0;top:0;z-index:10;
            }
        .tankuang .con { padding:20px;width:410px;color:grey;background:white;position:fixed;left:30%;top:30%;z-index:10; }
        .tankuang .con textarea { padding:5px;width:400px;height:100px;border:1px solid lightgrey;resize:none;outline:none; }
        .tankuang .con button { margin:10px 140px;padding:10px 30px;border:0;color:white;background:orangered;cursor:pointer; }
        .tankuang .con button:hover { background:red; }
        .tankuang .con .close { padding:10px 20px;color:red;background:grey;cursor:pointer;position:absolute;left:450px;top:0; }
        .tankuang .con a:hover.close { color:white;background:orangered; }
    </style>
    <div class="tankuang" id="addfrield" style="display:none;">
        <div class="mask"></div>
        <div class="con">
            <form data-am-validator method="POST" action="{{DOMAIN}}person/frield/apply" enctype="multipart/form-data">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <input type="hidden" name="frield_id" value="0">
                <p style="text-align:center;"><b>你将添加 <span id="frieldName">XXX</span> 为好友</b></p>
                <p>备注：<br>
                    <textarea placeholder="添加备注说明" minlength="2" maxlength="255" required name="intro"></textarea>
                </p>
                <button type="submit">立即添加</button>
            </form>
            <a class="close" onclick="$('#addfrield').hide(200);">X</a>
        </div>
    </div>
    <div class="tankuang" id="refusefrield" style="display:none;">
        <div class="mask"></div>
        <div class="con">
            <form data-am-validator method="POST" action="{{DOMAIN}}person/frield/refuse" enctype="multipart/form-data">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <input type="hidden" name="refuse" value="0">
                <p style="text-align:center;"><b>你将拒绝 <span id="frield2Name">XXX</span> 的申请</b></p>
                <p>拒绝理由：<br>
                    <textarea placeholder="添加拒绝理由" minlength="2" maxlength="255" required name="remarks2"></textarea>
                </p>
                <button type="submit">确定</button>
            </form>
            <a class="close" onclick="$('#refusefrield').hide(200);">X</a>
        </div>
    </div>

    <script>
        function getApply(frield_id){
            var frieldName = $("#frield"+frield_id).html();
            $("input[name='frield_id']")[0].value = frield_id;
            $("#frieldName").html(frieldName);
            $("#addfrield").show(200);
        }
        function getRefuse(id){
            var frieldName = $("#frield2_"+id).html();
            $("input[name='refuse']")[0].value = id;
            $("#frield2Name").html(frieldName);
            $("#refusefrield").show(200);
        }
    </script>
@stop