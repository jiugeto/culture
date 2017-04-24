@extends('home.main')
@section('content')
    @include('home.common.crumb')

    <div class="idea_show">
        <span class="idea_left">
            <div class="idea_con">
                <p class="title">{{$data['name']}}</p>
                <table>
                    <tr>
                        <td>所在娱乐主题：</td>
                        <td>{{$data['entertainTitle']}}</td>
                    </tr>
                    {{--<tr>--}}
                        {{--<td>职员类型：</td>--}}
                        {{--<td>{{$data['']}}</td>--}}
                    {{--</tr>--}}
                    <tr>
                        <td>性别：</td>
                        <td>{{$data['sexName']}}</td>
                    </tr>
                    <tr>
                        <td>身高：</td>
                        <td>{{$data['height']}}</td>
                    </tr>
                    <tr>
                        <td>学历：</td>
                        <td>{{$data['eduName']}}</td>
                    </tr>
                    <tr>
                        <td>近照：</td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>地址：</td>
                        <td>{{$data['origin']}}</td>
                    </tr>
                    <tr>
                        <td>毕业学校：</td>
                        <td>{{$data['school']}}</td>
                    </tr>
                    <tr><td colspan="2">&nbsp;</td></tr>
                    <tr>
                        <td>&nbsp;</td>
                        <td>
                            <button class="homebtn" onclick="window.location.href='{{DOMAIN}}entertain/2/0';">
                                返 &nbsp;回</button>
                        </td>
                    </tr>
                </table>
            </div>
        </span>
        <input type="hidden" name="id" value="{{$data['id']}}">
        {{--发布方信息--}}
        @include('home.common.userinfo')
    </div>
@stop