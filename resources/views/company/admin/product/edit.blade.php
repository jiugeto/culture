@extends('company.admin.main')
@section('content')
    @include('company.admin.common.crumb')

    <div class="com_admin_list">
        <form data-am-validator method="POST" action="/company/admin/product/{id}" enctype="multipart/form-data">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <input type="hidden" name="_method" value="POST">
            <table class="table_create">
                <tr>
                    <td class="field_name"><label>产品名称：</label></td>
                    <td class="right"><input type="text" class="field_value" name="name" value="{{ $data->name }}"/></td>
                </tr>

                <tr>
                    <td class="field_name"><label>类型：</label></td>
                    <td class="right">
                        <select name="cate_id">
                            <option value="" {{ $data->cate_id=='' ? 'selected' : '' }}>选择类型</option>
                            @foreach($categorys as $category)
                                <option value="{{ $category->id }}" {{ $data->cate_id==$category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                                @if($category->child)
                                    @foreach($category->child as $subcate)
                                        <option value="{{ $subcate->id }}" {{ $data->cate_id==$subcate->id ? 'selected' : '' }}>{{ '&nbsp;=='.$subcate->name }}</option>
                                        @if($subcate->child)
                                            @foreach($subcate->child as $subcate2)
                                                <option value="{{ $subcate2->id }}" {{ $data->cate_id==$subcate2->id ? 'selected' : '' }}>
                                                    {{ '&nbsp;&nbsp;&nbsp;&nbsp;=='.$subcate2->name }}</option>
                                            @endforeach
                                        @endif
                                    @endforeach
                                @endif
                            @endforeach
                        </select>
                        <a href="/company/admin/category" class="job">添加链接</a>
                    </td>
                </tr>

                <tr>
                    <td class="field_name"><label>简单介绍：</label></td>
                    <td class="right"><textarea name="intro" cols="40" rows="5">{{ $data->intro }}</textarea></td>
                </tr>

                <tr>
                    <td class="field_name"><label>鼠标移动显示：</label></td>
                    <td class="right"><input type="text" class="field_value" name="title" value="{{ $data->title }}"/></td>
                </tr>

                <tr>
                    <td class="field_name"><label>图片：</label></td>
                    <td class="right">
                        <select name="pic_id">
                            <option value="" {{ $data->pic_id=='' ? 'selected' : '' }}>选择图片</option>
                            @if($pics)
                                @foreach($pics as $pic)
                                    <option value="{{ $pic->id }}" {{ $data->pic_id==$pic->id ? 'selected' : '' }}>
                                        <img src="{{ $pic->url }}" style="width:50px;"> {{ $pic->name }}</option>
                                @endforeach
                            @endif
                        </select>
                        <a href="/company/admin/pic" class="job">添加链接</a>
                    </td>
                </tr>

                <tr>
                    <td class="field_name"><label>产品链接：</label></td>
                    <td class="right">
                        <select name="video_id">
                            <option value="" {{ $data->video_id=='' ? 'selected' : '' }}>选择链接</option>
                            @if($videos)
                                @foreach($videos as $video)
                                    <option value="{{ $video->id }}" {{ $data->video_id==$video->id ? 'selected' : '' }}>{{ $video->name }}</option>
                                @endforeach
                            @endif
                        </select>
                        <a href="/company/admin/video" class="job">添加链接</a>
                    </td>
                </tr>

                <tr>
                    <td class="field_name"><label>前台显示否：</label></td>
                    <td class="right">
                        <label><input type="radio" name="isshow2" value="0" {{ $data->isshow2==0 ? 'checked' : '' }}> 不显示&nbsp;&nbsp;</label>
                        <label><input type="radio" name="isshow2" value="1" {{ $data->isshow2==1 ? 'checked' : '' }}> 显示&nbsp;&nbsp;</label>
                    </td>
                </tr>

                <tr><td colspan="2" style="text-align:center;">
                        <button class="companybtn" onclick="history.go(-1)">返 &nbsp;&nbsp;&nbsp;回</button>
                        <button type="submit" class="companybtn">保存修改</button>
                    </td></tr>
            </table>
        </form>
    </div>
@stop

