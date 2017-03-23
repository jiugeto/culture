@extends('person.main')
@section('content')
    <div class="per_body" style="border:0;height:700px;background:0;">
        @include('person.common.top')
        <div class="per_list">
            <p class="title">@if($m==0)我的好友@elseif($m==1)新的申请@elseif($m==2)寻找好友@endif</p>
            <div class="list" style="width:748px;">
                <table class="tform" style="margin:0 30%;width:400px;">
                    <tr>
                        <td colspan="2" style="padding:10px 100px;"><b>用户信息</b></td>
                    </tr>
                    {{--@if($m==2)--}}
                        <tr>
                            <td width="150">用户名：</td>
                            <td>{{ $data['username'] }}</td>
                        </tr>
                        <tr>
                            <td width="150">头像：</td>
                            <td>
                                @if($url=$model->getUrlByPicid($data['head']))
                                    <img src="{{ $url }}">
                                @else 未填
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <td>性别：</td>
                            <td>{{ $data['person']?$data['person']['sexName']:'未填' }}</td>
                        </tr>
                        <tr>
                            <td>城市：</td>
                            <td>{{ $model->getAreaName($data['area']) }}</td>
                        </tr>
                    {{--@elseif(in_array($m,[0,1]))--}}
                    {{--@endif--}}
                    <tr>
                        <td colspan="2" style="padding:10px 100px;">
                            <a href="javascript:;" onclick="history.go(-1)">返回</a>
                        </td>
                    </tr>
                </table>
            </div>
        </div>
        @include('person.common.head')
    </div>
@stop