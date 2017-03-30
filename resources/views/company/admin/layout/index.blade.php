@extends('company.admin.main')
@section('content')
    @include('company.admin.common.crumb')

    <div class="com_admin_list" style="height:870px;overflow:auto;">
        {{--<h3 class="center pos">{{ $lists['func']['name'] }}</h3>--}}
        <div class="menu">
            <a class="list_btn {{$m==0?'curr':''}}" href="{{DOMAIN_C_BACK}}layout" id="amodule"><b>模块</b></a>
            <a class="list_btn {{$m==1?'curr':''}}" href="{{DOMAIN_C_BACK}}layout/m/1" id="ahome"><b>首页</b></a>
        </div>
        <table class="table_create" cellspacing="0" cellpadding="0" id="tmodule"
               style="width:500px;display:{{$m==0?'block':'none'}};">
            <tr>
                <td class="field_name" style="text-align:center;" colspan="3">
                    <b>模块设置</b>
                    &nbsp;&nbsp;&nbsp;
                </td>
            </tr>
            <tr>
                <td class="field_name">显示控制：
                </td>
                <td>
                    <table class="radio">
                        @if(count($modules))
                            @foreach($modules as $module)
                        <tr>
                            <td class="first"><b>{{$module['name']}}</b></td>
                            <td><label class="clickradio" title="点击设置模块显示">
                                    <input type="radio" class="radio_pos" name="moduleShow_{{$module['id']}}"
                                           value="2" {{$module['isshow']==2?'checked':''}}
                                           onchange="setModuleShow(this.name,this.value)"
                                        > 显示&nbsp;&nbsp;
                                </label><br></td>
                            <td><label class="clickradio" title="点击设置模块显示">
                                    <input type="radio" class="radio_pos" name="moduleShow_{{$module['id']}}"
                                           value="1" {{$module['isshow']==1?'checked':''}}
                                           onchange="setModuleShow(this.name,this.value)"
                                        > 不显示&nbsp;&nbsp;
                                </label></td>
                        </tr>
                            @endforeach
                        @endif
                    </table>
                    <span style="font-size:14px;color:#808080;">产品、花絮是必须显示的，这里不做控制</span>
                </td>
            </tr>
            <tr>
                <td class="field_name">排序控制：
                    <p style="color:darkgrey;font-size:14px;">(值越大越靠前)</p>
                </td>
                <td>
                    <table class="radio">
                        @if(count($modules))
                            @foreach($modules as $module)
                        <tr>
                            <td class="first"><b>{{$module['name']}}</b></td>
                            <td colspan="2">
                                <input type="text" class="field_value" style="width:100px;"
                                                   name="module_sort_{{$module['id']}}" value="{{$module['sort']}}">
                            </td>
                            <td>
                                <button class="companybtn sure" onclick="module_sort({{$module['id']}})">确定更新</button>
                                <input type="hidden" name="m_sort_{{$module['id']}}" value="{{$module['sort']}}">
                            </td>
                        </tr>
                            @endforeach
                        @endif
                    </table>
                </td>
            </tr>
        </table>

        <table class="table_create" cellspacing="0" cellpadding="0" id="thome"
               style="width:500px;display:{{$m==1?'block':'none'}};">
            <tr>
                <td class="field_name" style="text-align:center;" colspan="3">
                    <b>首页设置</b>
                    &nbsp;&nbsp;&nbsp;
                </td>
            </tr>
            <tr>
                <td class="field_name">显示控制：</td>
                <td>
                    <table class="radio">
                        @foreach($layoutHomeSwitchs as $k=>$switch)
                    <tr>
                        <td class="first"><b>{{$model['layoutNames'][$k]}}</b></td>
                        <td><label class="clickradio" title="点击设置首页显示">
                                <input type="radio" class="radio_pos" name="{{$k}}" value="1"
                                       {{$switch==1?'checked' : '' }}
                                       onclick="setHomeSwitch(this.name,this.value)"
                                > 显示&nbsp;&nbsp;
                            </label><br></td>
                        <td><label class="clickradio" title="点击设置首页显示">
                                <input type="radio" class="radio_pos" name="{{$k}}" value="0"
                                       {{$switch==0?'checked':''}}
                                        onclick="setHomeSwitch(this.name,this.value)"
                                > 不显示&nbsp;&nbsp;
                            </label></td>
                        {{--<td>--}}
                            {{--<button class="companybtn sure"--}}
                                    {{--onclick="setLayoutHomeShow({{$k}})">确定更新</button>--}}
                            {{--<input type="hidden" name="layoutSwitch_{{$k}}">--}}
                        {{--</td>--}}
                    </tr>
                        @endforeach
                    </table>
                </td>
            </tr>
            <tr>
                <td class="field_name">皮肤颜色：
                    <div style="color:darkgrey;font-size:14px;">当前选择：
                        <div style="width:50px;height:20px;float:right;
                                background:{{$company['skin']?$company['skin']:'#323232'}};"></div>
                    </div>
                </td>
                <td>
                    <input type="color" name="skin" title="点击选择颜色" style="width:200px;height:50px"
                        value="{{$company['skin']?$company['skin']:''}}" onchange="setSkin(this.value)">
                </td>
            </tr>
        </table>
    </div>

    <div class="com_admin_list" style="height:95px;overflow:auto;">
        <table class="table_create" cellspacing="0" cellpadding="0" id="btn">
            <tr><td class="center" colspan="3" style="border:0;cursor:pointer;">
                    {{--<a href="/company/admin/layout/{{$data->id}}/edit">--}}
                    {{--<button class="companybtn">修&nbsp;&nbsp;改</button></a>--}}
                    <a><button class="companybtn" onclick="history.go(-1)">返&nbsp; 回</button></a>
                </td></tr>
        </table>
    </div>

    <script>
        //分页面显示
        $("#amodule").click(function(){
            $(".menu > a").removeClass('curr'); $(this).addClass('curr');
            $(".com_admin_list > table").hide(); $("#tmodule").show(); $("#btn").show();
        });
        $("#ahome").click(function(){
            $(".menu > a").removeClass('curr'); $(this).addClass('curr');
            $(".com_admin_list > table").hide(); $("#thome").show(); $("#btn").show();
        });

        //模块的显示控制
        function setModuleShow(key,val){
            var moduleid = key.split('_');
            window.location.href = '{{DOMAIN_C_BACK}}layout/module/setshow/'+moduleid[1]+'/'+val;
        }
        //模块的排序控制
        function module_sort(id){
            var module_sort = $("input[name='module_sort_"+id+"']").val();
            var m_sort = $("input[name='m_sort_"+id+"']").val();
            if (module_sort==m_sort) { alert('排序值没有变化！'); return; }
            window.location.href = '{{DOMAIN_C_BACK}}layout/module/sort/'+id+'/'+module_sort;
        }
        //首页的显示控制
        function setHomeSwitch(key,val){
            window.location.href = '{{DOMAIN_C_BACK}}layout/homeswitch/'+key+'/'+val;
        }
        //皮肤控制
        function setSkin(skin){
            if (skin.substr(0,1)=='#') { skin = skin.substr(1); }
            window.location.href = '{{DOMAIN_C_BACK}}layout/skin/'+skin;
        }
    </script>
@stop

