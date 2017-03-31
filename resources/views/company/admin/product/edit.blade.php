@extends('company.admin.main')
@section('content')
    @include('company.admin.common.crumb')

    <div class="com_admin_list">
        <h3 class="center pos">产品修改</h3>
        <form data-am-validator method="POST" action="{{DOMAIN_C_BACK}}product/{{$data['id']}}"
              enctype="multipart/form-data">
            <input type="hidden" name="_token" value="{{csrf_token()}}">
            <input type="hidden" name="_method" value="POST">
            <table class="table_create">
                <tr>
                    <td class="field_name"><label>产品名称：</label></td>
                    <td class="right">
                        <input type="text" class="field_value" placeholder="至少2个字符"
                               minlength="2" required name="name" value="{{$data['name']}}"/>
                    </td>
                </tr>

                <tr>
                    <td class="field_name"><label>样片：</label></td>
                    <td class="right">
                        <select name="genre" required>
                            <option value="1" {{$data['genre']==1?'selected':''}}>动画片段</option>
                            <option value="3" {{$data['genre']==2?'selected':''}}>视频供应</option>
                        </select>
                    </td>
                </tr>

                <tr>
                    <td class="field_name"><label>类型：</label></td>
                    <td class="right">
                        <select name="cate" required>
                            @foreach($model['cates'] as $k=>$vcate)
                                <option value="{{$k}}" {{$data['cate']==$k?'selected':''}}>{{$vcate}}</option>
                            @endforeach
                        </select>
                    </td>
                </tr>

                <tr>
                    <td class="field_name"><label>简单介绍：</label></td>
                    <td class="right"><textarea name="intro" cols="40" rows="5">{{$data['intro']}}</textarea></td>
                </tr>

                <tr>
                    <td class="field_name"><label>价格：</label></td>
                    <td class="right">
                        <input type="text" class="field_value" placeholder="" pattern="^\d+$" required
                               name="money" value="{{$data['money']}}"/>
                    </td>
                </tr>

                <tr><td colspan="2" style="text-align:center;">
                        <button class="companybtn" onclick="history.go(-1)">返&nbsp;&nbsp; 回</button>
                        <button type="submit" class="companybtn">保存修改</button>
                    </td></tr>
            </table>
        </form>
    </div>
@stop

