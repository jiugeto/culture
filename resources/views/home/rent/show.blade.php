@extends('home.main')
@section('content')
    @include('home.common.crumb')

    <div class="idea_show">
        <span class="idea_left">
            <div class="idea_con">
                <p class="title">{{$data['name']}}</p>
                <table>
                    <tr>
                        <td>设备租金：</td>
                        <td>{{$data['money']}}</td>
                    </tr>
                    <tr>
                        <td>设备类型：</td>
                        <td>{{$data['typeName']}}</td>
                    </tr>
                    <tr>
                        <td>开始期限：</td>
                        <td>{{date('Y年m月d日 H:i',$data['fromtime'])}}</td>
                    </tr>
                    <tr>
                        <td>结束期限：</td>
                        <td>{{date('Y年m月d日 H:i',$data['totime'])}}</td>
                    </tr>
                    <tr>
                        <td>有效时间：</td>
                        <td>{{$data['period']}}</td>
                    </tr>
                    <tr>
                        <td>所在地区：</td>
                        <td>{{AreaNameByid($data['area'])}}</td>
                    </tr>
                    <tr><td colspan="2">设备简介：</td></tr>
                    <tr>
                        <td colspan="2"><textarea readonly class="show_intro">{{$data['intro']}}</textarea></td>
                    </tr>
                    <tr>
                        <td>设备图片：</td>
                        <td></td>
                    </tr>
                    <tr>
                        <td colspan="2" style="text-align:center;">
                            <button class="homebtn" title="返回上一页"
                                    onclick="window.location.href='{{DOMAIN}}entertain';"> 返 &nbsp;回</button>
                        </td>
                    </tr>
                </table>
            </div>
        </span>
        {{--发布方信息--}}
        @include('home.common.userinfo')
    </div>
@stop