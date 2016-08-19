@extends('home.main')
@section('content')
    @include('home.common.crumb')
    <div class="opinion_con">
        {{-- 搜索 --}}
        <div class="cre_kong">&nbsp;{{--10px高度留空--}}</div>
        <div class="s_search">
            意见类型：
            <select name="status" class="s_select">
                <option value="0" {{ $status==0 ? 'selected' : '' }}>所有意见</option>
                <option value="2" {{ $status==2 ? 'selected' : '' }}>未处理</option>
                <option value="3" {{ $status==3 ? 'selected' : '' }}>已处理</option>
                <option value="5" {{ $status==5 ? 'selected' : '' }}>已处理并满意</option>
            </select>
            <a href="/opinion/create" class="opinion_create">发布意见</a>
            <script>
                $(document).ready(function(){
                    var status = $("select[name='status']");
                    status.change(function(){
                        if(status.val()==0){
                            window.location.href = '{{DOMAIN}}opinion';
                        } else {
                            window.location.href = '{{DOMAIN}}'+status.val()+'/opinion';
                        }
                    });
                    //发布按钮位置
                    var create = $(".opinion_create");
                    var clientWidth = document.body.clientWidth;
//                    alert(clientWidth);
                    create.css('position','absolute');
                    create.css('right',(clientWidth-1000)/2+30+'px');
                });
            </script>
        </div>

        {{-- 意见列表 --}}
        <div class="opinion_list">
            @if($datas->total())
                @foreach($datas as $data)
            <table class="record">
                <tr>
                    <td class="first"><div><img src="{{PUB}}uploads/images/2016/online1.png"></div></td>
                    <td class="text">意见标题：{{ $data->name }}</td>
                    <td class="text">状态：{{ $data->status() }}</td>
                    <td class="text">回复：{{ count($data->replyModels()) }}
                        {{--{{ $data->reply==0 ? 0 : $data->reply() }}--}}
                    </td>
                    <td class="text">发布时间：{{ $data->created_at }}</td>
                    <td class="detail">
                        <a href="{{DOMAIN}}opinion/{{$data->id}}">查看</a>
                        @if($data->status==1)
                            <a href="{{DOMAIN}}opinion/{{$data->id}}/edit">修改</a>
                        @elseif($data->status==4)
                            <a href="{{DOMAIN}}opinion/create/{{$data->id}}">回复</a>
                        @endif
                    </td>
                </tr>
                @if($data->reply)
                    <tr><td colspan="10">
                            <div class="div_hr">
                                <span class="open">展开</span>
                                <span class="close" style="display:none;">合起</span>
                                {{ count($data->replyModels()) }}
                            </div>
                        </td></tr>
                    @foreach($data->replyModels as $replyModel)
                    <tr class="reply" style="display:none;">
                        <td>&nbsp;</td>
                        <td class="text">意见标题：{{ $replyModel->name }}</td>
                        <td class="text">状态：{{ $replyModel->status() }}</td>
                        <td class="text">发布时间：{{ $data->created_at }}</td>
                        <td class="detail">
                            <a href="/opinion/{{$replyModel->id}}">查看</a>
                        </td>
                    </tr>
                    @endforeach
                    <script>
                        $(document).ready(function(){
                            $(".open").toggle();
                            $(".close").toggle();
                            $(".reply").toggle();
                        });
                    </script>
                @endif
            </table>
                @endforeach
            @else
            <table class="record">
                <tr><td colspan="10" class="center">没有记录</td></tr>
            </table>
            @endif

            @include('home.common.page')
        </div>
    </div>
@stop