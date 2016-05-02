@extends('admin.main')
@section('content')
<div class="admin-content">
    @include('admin.common.crumb')
    <div class="am-g">
        @include('admin.common.menu')
        {{--@include('admin.type.search')--}}
    </div>
    <hr/>

    <div class="am-g">
        @include('admin.common.info')
        <div class="am-u-sm-12 am-u-md-8 am-u-md-pull-4">
            <table class="am-table am-table-striped am-table-hover table-main">
                <tbody id="tbody-alert">
                <tr>
                    <td class="am-hide-sm-only">编号 / Id：</td>
                    <td>{{ $data->id }}</td>
                </tr>
            @if($data->cname)
                <tr>
                    <td class="am-hide-sm-only">公司名称 / Company Name：</td>
                    <td>{{ $data->cname }}</td>
                </tr>
            @else
                <tr>
                    <td colspan="2">此为默认记录</td>
                </tr>
            @endif
                <tr>
                    <td class="am-hide-sm-only">鼠标移动显示 / OverMouse：</td>
                    <td>{{ $data->title }}</td>
                </tr>
                <tr>
                    <td class="am-hide-sm-only">关键字 / Keyword：</td>
                    <td>{{ $data->keyword }}</td>
                </tr>
                <tr>
                    <td class="am-hide-sm-only">描述 / Description：</td>
                    <td>{{ $data->description }}</td>
                </tr>
                <tr>
                    <td class="am-hide-sm-only">logo / Logo：</td>
                    <td><img src="{{ $data->logo }}"></td>
                </tr>
                {{--<tr>--}}
                    {{--<td class="am-hide-sm-only">招聘的岗位 / Job：</td>--}}
                    {{--<td>--}}
                        {{--@if(isset($data->jobs) && $data->jobs)--}}
                            {{--@foreach($data->jobs as $job) {{ $job }}<br> @endforeach--}}
                        {{--@endif--}}
                    {{--</td>--}}
                {{--</tr>--}}
                {{--<tr>--}}
                    {{--<td class="am-hide-sm-only">招聘的岗位要求 / Job Require：</td>--}}
                    {{--<td>--}}
                        {{--@if(isset($data->jobRequires) && $data->jobRequires)--}}
                            {{--@foreach($data->jobRequires as $jobRequire) {{ $jobRequire }}<br> @endforeach--}}
                        {{--@endif--}}
                    {{--</td>--}}
                {{--</tr>--}}
                <tr>
                    <td class="am-hide-sm-only">排序 / Sort：</td>
                    <td>{{ $data->sort }}</td>
                </tr>
                <tr>
                    <td class="am-hide-sm-only">是否置顶 / Top：</td>
                    <td>{{ $data->istop ? '置顶' : '不置定' }}</td>
                </tr>
                <tr>
                    <td class="am-hide-sm-only">前台是否显示 / Show：</td>
                    <td>{{ $data->isshow ? '显示' : '不显示' }}</td>
                </tr>
                <tr>
                    <td class="am-hide-sm-only">创建时间 / Create Time：</td>
                    <td>{{ $data->created_at }}</td>
                </tr>
                <tr>
                    <td class="am-hide-sm-only">修改时间 / Update Time：</td>
                    <td>{{ $data->updated_at!='0000-00-00 00:00:00' ? $data->updated_at : '未修改' }}</td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>
@stop