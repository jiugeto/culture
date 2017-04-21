@extends('home.main')
@section('content')
    @include('home.common.crumb')

    <div class="idea_show">
        <span class="idea_left">
            <div class="idea_con">
                <p class="title">{{ $data->name }}</p>
                <table>
                    <tr>
                        <td>设备租金：</td>
                        <td>{{ $data->money() }}</td>
                    </tr>
                    <tr>
                        <td>设备类型：</td>
                        <td>{{ $data->getType() }}</td>
                    </tr>
                    <tr>
                        <td>开始期限：</td>
                        <td>{{ date('Y年m月d日 H:i',$data->fromtime) }}
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        </td>
                    </tr>
                    <tr>
                        <td>结束期限：</td>
                        <td>{{ date('Y年m月d日 H:i',$data->totime) }}</td>
                    </tr>
                    <tr>
                        <td>有效时间：</td>
                        <td>{{ $data->period() }}</td>
                    </tr>
                    <tr>
                        <td>所在地区：</td>
                        <td>{{ $data->getAreaName() }}</td>
                    </tr>
                    <tr>
                        <td>设备图片：</td>
                        <td>
                            @if(count($data->getPics()))
                                @foreach($data->getPics() as $pic)
                                    <div class="img_size_div">
                                        <img src="{{ $pic->getPicUrl() }}" class="img_size_img">
                                    </div>
                                @endforeach
                            @else 暂无
                            @endif
                        </td>
                    </tr>
                    <tr><td colspan="2">设备简介：</td></tr>
                    <tr>
                        <td colspan="2"><textarea readonly class="show_intro">{{ $data->intro }}</textarea></td>
                    </tr>
                    <tr>
                        <td colspan="2" style="text-align:center;">
                            <button class="homebtn" onclick="window.location.href='{{DOMAIN}}entertain';">返 &nbsp;回</button>
                        </td>
                    </tr>
                </table>
            </div>
        </span>
        <input type="hidden" name="id" value="{{ $data->id }}">
        {{--发布方信息--}}
        @include('home.common.userinfo')
    </div>
@stop