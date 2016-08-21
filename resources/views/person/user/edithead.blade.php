@extends('person.main')
@section('content')
    <div class="per_body" style="border:0;height:700px;background:0;">
        @include('person.partials.top')

        <div class="per_list">
            <p class="title">个人头像</p>
            <table cellpadding="0" cellspacing="0" class="list">
                <tr>
                    <td>原来头像：</td>
                    <td>
                        <div class="head">
                            @if($user->head)
                                <img src="{{ $user->head() }}">
                            @else
                                <div class="nopic">无</div>
                            @endif
                        </div>
                    </td>
                </tr>
                <tr><td colspan="2"><div style="padding:5px 0;border-bottom:1px solid ghostwhite;"></div></td></tr>
                <tr>
                    <td>选择更新：</td>
                    <td>
                        <a title="点击选择你的图片" onclick="$('.pic_list').toggle(200);$('.pic_list_sure').toggle(200);$(this).html('收起列表');">图片列表</a>
                    </td>
                </tr>
                <tr><td></td>
                    <td width="600">
                        <div class="pic_list">
                            @if(count($pics))
                                @foreach($pics as $pic)
                            <div class="img {{$pic->id==$user->head?'img_curr':''}}" onclick="getPic({{$pic->id}});" title="点击获取该图片">
                                <img src="{{ $pic->url }}"
                                     style="@if($size=$pic->getPicSize($pic,$w=100,$h=100)) width:{{$size}}px; @endif height:100px;">
                                <div class="bianhao">编号：{{ $pic->id }}</div>
                            </div>
                                @endforeach
                            @endif
                        </div>
                        <br>
                        <a class="pic_list_sure">确定图片 编号<span id="addpicid" class="red">{{ $user->head ? $user->head : 0 }}</span></a>
                    </td>
                </tr>
                <tr><td colspan="2"><div style="padding:5px 0;border-bottom:1px solid ghostwhite;"></div></td></tr>
                <tr>
                    <td colspan="2" style="text-align:center;">
                        <a onclick="history.go(-1);">返回上一页</a>
                        <a href="{{DOMAIN}}member/pic">图片管理</a>
                        <a href="{{DOMAIN}}member/pic/create">添加图片</a>
                    </td>
                </tr>
            </table>
        </div>

        @include('person.common.head')
    </div>

    <input type="hidden" name="picid">
    <script>
        var picid = $("input[name='picid']");
        function getPic(id){
            $("#addpicid").html(id);
            picid[0].value = id;
        }
        $(".pic_list_sure").click(function(){
            if (picid.val()==0) { alert('未选择图片！'); return; }
            window.location.href = '{{DOMAIN}}person/user/sethead/'+picid.val();
        });
    </script>
@stop