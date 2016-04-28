@extends('company.admin.main')
@section('content')
    @include('company.admin.common.crumb')

    <div class="com_admin_list">
        <form data-am-validator method="POST" action="/company/admin/part" enctype="multipart/form-data">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <table class="table_create">
                <tr>
                    <td class="field_name"><label>花絮名称：</label></td>
                    <td class="right"><input type="text" class="field_value" name="name"/></td>
                </tr>

                <tr>
                    <td class="field_name"><label>类型：</label></td>
                    <td class="right">
                        <select name="cate_id">
                            <option value="">选择类型</option>
                            @foreach($categorys as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @if($category->child)
                                    @foreach($category->child as $subcate)
                                        <option value="{{ $subcate->id }}">{{ '&nbsp;=='.$subcate->name }}</option>
                                        @if($subcate->child)
                                            @foreach($subcate->child as $subcate2)
                                                <option value="{{ $subcate2->id }}">
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
                    <td class="right"><textarea name="intro" cols="40" rows="5"></textarea></td>
                </tr>

                <tr>
                    <td class="field_name"><label>鼠标移动显示：</label></td>
                    <td class="right"><input type="text" class="field_value" name="title"/></td>
                </tr>

                <tr>
                    <td class="field_name"><label>图片：</label></td>
                    <td class="right">
                        <select name="pic_id">
                            <option value="">选择图片</option>
                            @if($pics)
                                @foreach($pics as $pic)
                                    <option value="{{ $pic->id }}">
                                        <img src="{{ $pic->url }}" style="width:50px;"> {{ $pic->name }}</option>
                                @endforeach
                            @endif
                        </select>
                        <a href="/company/admin/pic" class="job">添加链接</a>
                    </td>
                </tr>

                <tr>
                    <td class="field_name"><label>花絮链接：</label></td>
                    <td class="right">
                        <select name="video_id">
                            <option value="">选择链接</option>
                            @if($videos)
                                @foreach($videos as $video)
                                    <option value="{{ $video->id }}">{{ $video->name }}</option>
                                @endforeach
                            @endif
                        </select>
                        <a href="/company/admin/video" class="job">添加链接</a>
                    </td>
                </tr>

                <tr>
                    <td class="field_name"><label>前台显示否：</label></td>
                    <td class="right">
                        <label><input type="radio" name="isshow2" value="0"> 不显示&nbsp;&nbsp;</label>
                        <label><input type="radio" name="isshow2" value="1" checked> 显示&nbsp;&nbsp;</label>
                    </td>
                </tr>

                <tr><td colspan="2" style="text-align:center;">
                        <button class="companybtn" onclick="history.go(-1)">返 &nbsp;&nbsp;&nbsp;回</button>
                        <button type="submit" class="companybtn">保存添加</button>
                    </td></tr>
            </table>
        </form>
    </div>
@stop

