@extends('home.main')
@section('content')
    @include('home.common.crumb')

    <div class="opinion_con">
        <div class="opinion_list">
            <p class="cate">分类：
                <a href="{{DOMAIN}}idea" class="{{$cate==0?'curr':''}}">所有</a>
                @foreach($model['cates2'] as $kcate=>$vcate)
                    <a href="{{DOMAIN}}idea/cate/{{$kcate}}" class="{{$cate==$kcate?'curr':''}}">{{ $vcate }}</a>
                @endforeach
            </p>
            @if($datas->total())
                @foreach($datas as $data)
            <table class="idea">
                <tr>
                    <td rowspan="3" width="230">
                        <div class="img">
                            @if($data->pic_id && $data->getPicUrl())
                            <img src="{{PUB}}uploads/images/2016/online1.png">
                            @endif
                        </div>
                    </td>
                    <td>
                        <a href="{{DOMAIN}}idea/{{$data->id}}"><b>{{ $data->name }}</b></a>
                        <span class="right">阅读：{{ count($data->read($userid)) }}</span>
                        <span class="right"><a href="{{DOMAIN}}idea/{{$data->id}}">查看</a></span>
                    </td>
                </tr>
                <tr><td class="con">{{ $data->intro }}</td></tr>
                <tr>
                    <td class="small">
                        <input type="hidden" name="userid" value="{{ $userid }}">
                        <input type="hidden" name="uid" value="{{ $data->uid }}">
                        <input type="hidden" name="id" value="{{ $data->id }}">
                        <a id="click" style="display:{{ !$data->click($userid) ? 'block' : 'none' }};">关注：{{ $data->click($userid) }}</a>
                        <a id="noclick" style="display:{{ $data->click($userid) ? 'block' : 'none' }};">取消关注：{{ $data->click($userid) }}</a>
                        <a id="collect" style="display:{{ !$data->collect($userid) ? 'block' : 'none' }};">收藏：{{ $data->collect($userid) }}</a>
                        <a id="nocollect" style="display:{{ $data->collect($userid) ? 'block' : 'none' }};">取消收藏：{{ $data->collect($userid) }}</a>
                        <span class="right">时间：{{ $data->createTime() }}&nbsp;&nbsp;发布人：{{ $data->getUName() }}</span>
                    </td>
                </tr>
            </table>
                @endforeach
            @endif
            @include('home.common.page')
        </div>
    </div>

    <script>
        $(document).ready(function(){
            var userid = $("input[name='userid']").val();
            var uid = $("input[name='uid']").val();
            var id = $("input[name='id']").val();
            $("#click").click(function(){
                if(userid==uid){ alert("不能关注自己的创意 !"); return; }
                window.location.href = '/idea/click/'+id+'/1';
            });
            $("#noclick").click(function(){
//                if(userid==uid){ alert("不能关注自己的创意 !"); return; }
                window.location.href = '/idea/click/'+id+'/0';
            });
            $("#collect").click(function(){
                if(userid==uid){ alert("不能收藏自己的创意 !"); return; }
                window.location.href = '/idea/collect/'+id+'/1';
            });
            $("#nocollect").click(function(){
//                if(userid==uid){ alert("不能关注自己的创意 !"); return; }
                window.location.href = '/idea/collect/'+id+'/0';
            });
        });
    </script>
@stop