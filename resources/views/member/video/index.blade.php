@extends('member.main')
@section('content')
    @include('member.common.crumb')
    <div class="mem_tab">@include('member.common.lists')</div>
    <div class="hr_tab"></div>
    <!-- 空白 -->
    <div class="list_kongbai">&nbsp;</div>
    <div class="list">
        <table class="list_tab">
            <tr>
                <td>编号</td>
                <td>视频名称</td>
                <td>缩略图</td>
                <td>创建时间</td>
                <td>操作</td>
            </tr>
        @if($datas->total())
            @foreach($datas as $data)
            <tr>
                <td>{{ $data->id }}</td>
                <td><a href="{{DOMAIN}}member/video/{{ $data->id }}">{{ $data->name }}</a></td>
                <td><img src="{{ $data->getPicUrl() }}" style="width:100px;"></td>
                <td>{{ $data->createTime() }}</td>
                <td>
                    @if($curr['url']=='')
                        <a href="{{DOMAIN}}member/video/{{ $data->id }}" class="list_btn">查看</a>
                        <a href="{{DOMAIN}}member/video/{{ $data->id }}/edit" class="list_btn">编辑</a>
                        <a href="{{DOMAIN}}member/video/{{ $data->id }}/destroy" class="list_btn">删除</a>
                    @else
                        <a href="{{DOMAIN}}member/video/{{ $data->id }}/restore" class="list_btn">还原</a>
                        <a href="{{DOMAIN}}member/video/{{ $data->id }}/forceDelete" class="list_btn">销毁记录</a>
                    @endif
                </td>
            </tr>
            @endforeach
        @else @include('member.common.norecord')
        @endif
            <tr><td colspan="10">视频自动播放设置：
                    <label><input type="radio" class="radio" name="leplay" value="0" {{ $user->leplay==0 ? 'checked' : '' }}> 手动播放&nbsp;</label>
                    <label><input type="radio" class="radio" name="leplay" value="1" {{ $user->leplay==1 ? 'checked' : '' }}> 自动播放&nbsp;</label>
                </td></tr>
            <script>
                $(document).ready(function(){
                    $("input[name='leplay']").change(function(){
                        window.location.href = '{{DOMAIN}}member/video/leplay/'+$(this).val();
                    });
                });
            </script>
        </table>
        @include('member.common.page')
    </div>
@stop