{{--产品样片详情模板--}}


<table class="table_create" cellspacing="0" cellpadding="0">
    <tr>
        <td class="field_name">{{ $lists['func']['url']=='product'?'产品':'花絮' }}名称：</td>
        <td>{{ $data->name }}</td>
    </tr>
    <tr>
        <td class="field_name">分类：</td>
        <td>{{ $data->getCate() }}</td>
    </tr>
    <tr>
        <td class="field_name">简单介绍：</td>
        <td>{{ $data->intro }}</td>
    </tr>
    <tr>
        <td class="field_name">鼠标移动显示：</td>
        <td>{{ $data->title }}</td>
    </tr>
    <tr>
        <td class="field_name">图片：</td>
        <td><div style="width:450px;height:200px;overflow:auto;"><img src="{{ $data->getPicUrl() }}" style="@if($size=$data->getUserPicSize($data->pic(),$w=300,$h=200))width:{{$size}}px;@endif height:200px;"></div></td>
    </tr>
    <tr>
        <td class="field_name">视频地址：</td>
        <td>{{ $data->getVideoUrl() }}</td>
    </tr>
    <tr>
        <td class="field_name">前台显示否：</td>
        <td>{{ $data->isshow2 ? '显示' : '不显示' }}</td>
    </tr>

    <tr><td class="center" colspan="2" style="border:0;cursor:pointer;">
            {{--<a href="/company/admin/job/{{$data->id}}/edit">--}}
            {{--<button class="companybtn">修&nbsp;&nbsp;改</button></a>--}}
            <a><button class="companybtn" onclick="history.go(-1)">返&nbsp;&nbsp;回</button></a>
        </td></tr>
</table>