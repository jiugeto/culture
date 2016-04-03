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
                            window.location.href = '/opinion';
                        } else {
                            window.location.href = '/'+status.val()+'/opinion';
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
                    <td class="first"><div><img src="/uploads/images/2016/online1.png"></div></td>
                    <td class="text">意见标题：{{ $data->name }}</td>
                    <td class="text">状态：{{ $data->status() }}</td>
                    <td class="text">回复：{{ $data->reply() }}</td>
                    <td class="text">发布时间：{{ $data->created_at }}</td>
                    <td class="detail">
                        <a href="/opinion/{{$data->id}}">查看</a>
                        <a href="/opinion/{{$data->id}}/edit">修改</a>
                    </td>
                </tr>
            </table>
                @endforeach
            @else
            <table class="record">
                <tr><td colspan="10" style="text-align:center;">没有记录</td></tr>
            </table>
            @endif

            @include('home.common.page')
        </div>
    </div>
@stop