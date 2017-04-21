@extends('home.main')
@section('content')
    @include('home.common.crumb')

    <div class="idea_show">
        <span class="idea_left">
            <div class="idea_con">
                <p class="title">{{ $data->name }}</p>
                <table>
                    <tr>
                        <td>片源类型：</td>
                        <td>{{ $data->genre() }}</td>
                    </tr>
                    <tr>
                        <td>供求类型：</td>
                        <td>{{ $data->type() }}</td>
                    </tr>
                    <tr>
                        <td>样片类别：</td>
                        <td>{{ $data->getCate() }}</td>
                    </tr>
                    <tr>
                        <td>样片截图：</td>
                        <td>
                            <a href="{{DOMAIN}}product/video/{{ $data->id }}/{{ $data->video_id }}" target="_blank" title="点进去看视频"><img src="{{ $data->getPicUrl() }}" style="@if($size=$data->getPicSize($w=300,$h=110)) width:{{$size['w']}}px;height:{{$size['h']}}px; @endif"></a>
                            <br><a href="{{DOMAIN}}product/video/{{ $data->id }}/{{ $data->video_id }}" target="_blank" class="showVideo">点击预览视频</a>
                        </td>
                    </tr>
                    <tr>
                        <td>简介：</td>
                        <td>{!! $data->intro !!}</td>
                    </tr>
                    <tr>
                        <td>点击量：</td>
                        <td>{{ $data->click }}
                            &nbsp;&nbsp;<a class="onclick" id="addclick" title="狠狠点击">点击量</a>
                        </td>
                    </tr>
                    <tr>
                        <td>点击用户：</td>
                        <td>{{ $data->getClicks($uid) }}
                            &nbsp;&nbsp;<a class="onclick" id="click" title="狠狠点击">用户点击</a>
                        </td>
                    </tr>
                    <tr>
                        <td>喜欢用户：</td>
                        <td>{{ $data->getLikes($uid) }}
                            &nbsp;&nbsp;<a class="onclick" id="like" title="狠狠点击">用户喜欢</a>
                        </td>
                    </tr>
                </table>
            </div>
        </span>
        <input type="hidden" name="id" value="{{ $data->id }}">
        {{--发布方信息--}}
        @include('home.common.userinfo')
    </div>

    <script>
        $(document).ready(function(){
            var id = $("input[name='id']").val();
            //点击量1，点击用户2，喜欢用户3
            $("#addclick").click(function(){ window.location.href = "/product/click/"+id+'/'+1; });
            $("#click").click(function(){ window.location.href = "/product/click/"+id+'/'+2; });
            $("#like").click(function(){ window.location.href = "/product/click/"+id+'/'+3; });
        });
    </script>
@stop