@extends('member.main')
@section('content')
    {{--@include('member.common.crumb')--}}
    <div class="mem_crumb">
        <a href="{{DOMAIN}}member">会员后台</a> / 会员设置 / 资料设置
    </div>

    <form data-am-validator method="POST" action="{{DOMAIN}}member/setting/{{ $data['id'] }}" enctype="multipart/form-data">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <input type="hidden" name="_method" value="POST">

        <table class="table_create">
            {{--基本信息--}}
            <tr><td colspan="2">
                    <p class="center"><b>基本设置</b>(带<span class="star">*</span>的是必填项)</p>
                </td></tr>
            <tr>
                <td class="field_name" style="width:40%;"><label>用户名：</label></td>
                <td>{{ $data['username'] }}
                    {{--<input type="text" placeholder="至少2个字符" minlength="2" required name="username" value="{{ $data->username }}"/>--}}
                </td>
            </tr>
            {{--<tr><td>&nbsp;</td></tr>--}}
            <tr>
                <td class="field_name"><label>邮箱：</label></td>
                <td><input type="text" placeholder="例：123@qq.com" pattern="^\w+([-+.]\w+)*@\w+([-.]\w+)*\.\w+([-.]\w+)*$" name="email" value="{{ $data['email'] }}"/></td>
            </tr>
            {{--<tr><td>&nbsp;</td></tr>--}}
            <tr>
                <td class="field_name"><label>qq：</label></td>
                <td><input type="text" name="qq" value="{{ $data['qq'] }}"/></td>
            </tr>
            {{--<tr><td>&nbsp;</td></tr>--}}
            <tr>
                <td class="field_name"><label>电话：</label></td>
                <td><input type="text" name="tel" value="{{ $data['tel'] }}"/></td>
            </tr>
            {{--<tr><td>&nbsp;</td></tr>--}}
            <tr>
                <td class="field_name"><label>手机：</label></td>
                <td><input type="text" name="mobile" value="{{ $data['mobile'] }}"/></td>
            </tr>
            {{--<tr><td>&nbsp;</td></tr>--}}
            @if(in_array($data['isuser'],[1,50]))
            <tr>
                <td class="field_name"><label>用户类型<span class="star">(*)</span>：</label></td>
                <td>
                    @foreach($isusers as $key=>$isuser)
                        <label><input type="radio" class="radio" name="isuser" value="{{$key}}" onclick="change(this.value);" {{ $data['isuser']==$key ? 'checked' : '' }}> {{ $isuser }}</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        @if($key%3==0) <br> @endif
                    @endforeach
                </td>
            </tr>
            @endif
            {{--<tr><td>&nbsp;</td></tr>--}}
        </table>

        @if(in_array($data['isuser'],[1,50]))
        {{--个人信息--}}
        <table class="table_create mem_person" style="display:none;">
            <tr><td class="field_name" colspan="2">
                    <p class="center"><b>个人信息</b></p>
                </td></tr>
            <tr>
                <td class="field_name"><label>真实名字<span class="star">(*)</span>：</label></td>
                <td><input type="text" name="realname" placeholder="至少2位" minlength="2"/></td>
            </tr>
            {{--<tr><td>&nbsp;</td></tr>--}}
            <tr>
                <td class="field_name"><label>性别<span class="star">(*)</span>：</label></td>
                <td>
                    <label><input type="radio" name="sex" value="1" checked/>男&nbsp;&nbsp;</label>
                    <label><input type="radio" name="sex" value="2"/>女&nbsp;&nbsp;</label>
                </td>
            </tr>
            {{--<tr><td>&nbsp;</td></tr>--}}
            <tr>
                <td class="field_name"><label>身份证<span class="star">(*)</span>：</label></td>
                <td><input type="text" name="idcard" pattern="^\d{18}|(\d{17}x)$"/></td>
            </tr>
            {{--<tr><td>&nbsp;</td></tr>--}}
            {{--<tr>--}}
                {{--<td><label>身份证正面照：</label></td>--}}
                {{--<td><input type="file"/></td>--}}
            {{--</tr>--}}
            {{--<tr><td>&nbsp;</td></tr>--}}
        </table>

        {{--企业信息--}}
        <table class="table_create mem_company" style="display:none;">
            <tr><td colspan="2">
                    <p class="center"><b>企业信息</b></p>
                </td></tr>
            <tr>
                <td class="field_name"><label>公司名称<span class="star">(*)</span>：</label></td>
                <td><input type="text" name="name" placeholder="至少2个字符" minlength="2"/></td>
            </tr>
            {{--<tr><td>&nbsp;</td></tr>--}}
            <tr>
                <td class="field_name"><label>地区<span class="star">(*)</span>：</label></td>
                <td><input type="text" name="area"/></td>
            </tr>
            {{--<tr><td>&nbsp;</td></tr>--}}
            <tr>
                <td class="field_name"><label>具体地址<span class="star">(*)</span>：</label></td>
                <td><input type="text" name="address" placeholder="至少2位字符" minlength="2"/></td>
            </tr>
            {{--<tr><td>&nbsp;</td></tr>--}}
            <tr>
                <td class="field_name"><label>营业执照号码<span class="star">(*)</span>：</label></td>
                <td><input type="text" name="yyzzid"/></td>
            </tr>
            {{--<tr><td>&nbsp;</td></tr>--}}
        </table>
        @endif
        <script>
            function change(value){
//                alert(value);
                if(value==1 || value==3){
                    $(".mem_person").show();
                    $(".mem_company").hide();
                } else {
                    $(".mem_person").hide();
                    $(".mem_company").show();
                }
            }
        </script>

        {{--更改密码--}}
        <table class="table_create">
            {{--<tr><td colspan="2"><div class="div_hr"></div></td></tr>--}}
            {{--<tr><td colspan="2" class="center">--}}
                    {{--<a href="{{DOMAIN}}member/setting/pwd/{{ $data->id }}"><button class="companybtn">更新密码</button></a>--}}
                {{--</td></tr>--}}
            {{--<tr><td colspan="2"><div class="div_hr"></div></td></tr>--}}
            {{--<tr><td>&nbsp;</td></tr>--}}
            <tr><td colspan="2" class="center">
                    <button class="companybtn" onclick="history.go(-1)">返 &nbsp;&nbsp;&nbsp;回</button>
                    <button type="submit" class="companybtn">保存修改</button>
                </td></tr>
        </table>
    </form>
@stop