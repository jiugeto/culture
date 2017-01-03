@extends('home.main')
@section('content')
    {{--@include('home.common.crumb')--}}
    <div class="s_crumb">
        <div class="crumb">
            <div class="right">
                <a href="/">首页</a> / 用户建议
            </div>
        </div>
    </div>

    <div class="opinion_con">
        {{-- 搜索 --}}
        <div class="cre_kong">&nbsp;{{--10px高度留空--}}</div>
        <div class="s_search">
            意见类型：
            <select name="status" class="s_select">
                <option value="0" {{ $status==0 ? 'selected' : '' }}>所有</option>
                <option value="1" {{ $status==1 ? 'selected' : '' }}>新意见</option>
                <option value="2" {{ $status==2 ? 'selected' : '' }}>处理中</option>
                <option value="4" {{ $status==5 ? 'selected' : '' }}>满意</option>
            </select>
            <a href="{{DOMAIN}}opinion/create" class="opinion_create">发布意见</a>
            <script>
                $(document).ready(function(){
                    //发布按钮位置
                    var create = $(".opinion_create");
                    var clientWidth = document.body.clientWidth;
                    create.css('position','absolute');
                    create.css('right',(clientWidth-1000)/2+30+'px');
                });

                $("select[name='status']").change(function(){
                    if($(this).val()==0){
                        window.location.href = '{{DOMAIN}}opinion';
                    } else {
                        window.location.href = '{{DOMAIN}}opinion/s/'+$(this).val();
                    }
                });
            </script>
        </div>

        {{-- 意见列表 --}}
        <div class="opinion_list">
            @if(count($datas)>1)
                @foreach($datas as $kdata=>$data)
                    @if(is_numeric($kdata))
            <table class="record">
                <tr>
                    <td class="text">标题：{{ $data['name'] }}</td>
                    <td class="text">状态：{{ $data['statusName'] }}</td>
                    <td class="text">用户：{{ $data['username'] }}</td>
                    <td class="text" style="width:300px;font-size:14px;">时间：{{ $data['createTime'] }}</td>
                    <td class="detail">
                        @if($data['status']==1 && $data['uid']==Session::get('user.uid'))
                            {{--<a href="{{DOMAIN}}opinion/{{$data['id']}}/edit" style="float:right;">修改</a>--}}
                        @elseif($data['status']==3 && $data['uid']==Session::get('user.uid'))
                            <a href="{{DOMAIN}}opinion/status/{{$data['id']}}" style="float:right;">去评价</a>
                        @endif
                        <a href="{{DOMAIN}}opinion/{{$data['id']}}" style="float:right;">查看</a>
                    </td>
                </tr>
            </table>
                    @endif
                @endforeach
            @else
            <table class="record">
                <tr><td colspan="10" class="center">没有记录</td></tr>
            </table>
            @endif

            @include('home.common.page2')
        </div>
    </div>
@stop