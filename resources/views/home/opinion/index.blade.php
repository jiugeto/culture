@extends('home.main')
@section('content')
    @include('home.common.crumb')
    <div class="opinion_con">
        {{-- 搜索 --}}
        <div class="cre_kong">&nbsp;{{--10px高度留空--}}</div>
        <div class="s_search">
            意见类型：
            <select name="status">
                <option value="0">所有意见</option>
                <option value="2">未处理</option>
                <option value="3">已处理</option>
                <option value="5">已处理并满意</option>
            </select>
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
                });
            </script>
        </div>

        {{-- 意见列表 --}}
        <div class="opinion_list">
            <table class="record">
                <tr>
                    <td class="first"><div><img src="/upload/images/online1.png"></div></td>
                    <td class="text">意见标题：</td>
                    <td class="text">状态：</td>
                    <td class="text">回复：</td>
                    <td class="text">发布时间：</td>
                    <td class="detail"><a href="/opinion/">查看详情</a></td>
                </tr>
            </table>
        </div>
    </div>
@stop