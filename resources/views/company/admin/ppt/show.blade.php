@extends('company.admin.main')
@section('content')
    @include('company.admin.common.crumb')

    <div class="com_admin_list">
        <h3 class="center pos">{{$lists['func']['name']}}详情页</h3>
        <table class="table_create" cellspacing="0" cellpadding="0">
            <tr>
                <td class="field_name">PPT名称：</td>
                <td>{{$data['name']}}</td>
            </tr>
            <tr>
                <td class="field_name">广告位：</td>
                <td>{{$data['adplaceName']}}</td>
            </tr>
            <tr>
                <td class="field_name">图片预览：</td>
                <td>@if($data['img'])<img src="{{$data['img']}}" width="300">@else/@endif</td>
            </tr>
            <tr>
                <td class="field_name">链接：</td>
                <td>{{$data['link']}}</td>
            </tr>
            <tr>
                <td class="field_name">广告期限：</td>
                <td>@if($data['fromTime']&&$data['toTime'])
                        {{date('Y年m月d日',$data['fromTime'])}} <--> {{date('Y年m月d日',$data['toTime'])}}
                    @else 长期
                    @endif
                </td>
            </tr>
            <tr>
                <td class="field_name">上传时间：</td>
                <td>{{$data['createTime']}}</td>
            </tr>
            <tr>
                <td class="field_name">更新时间：</td>
                <td>{{$data['updateTime']}}</td>
            </tr>

            <tr><td class="center" colspan="2" style="border:0;cursor:pointer;">
                    <button class="companybtn" onclick="history.go(-1)">返&nbsp; 回</button>
                </td></tr>
        </table>
    </div>
@stop

