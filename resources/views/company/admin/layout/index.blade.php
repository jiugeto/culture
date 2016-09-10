@extends('company.admin.main')
@section('content')
    @include('company.admin.common.crumb')

    <div class="com_admin_list" style="height:870px;overflow:auto;">
        {{--<h3 class="center pos">{{ $lists['func']['name'] }}</h3>--}}
        <div class="menu">
            <a class="list_btn curr" id="amodule"><b>模块</b></a>
            <a class="list_btn" id="ahome"><b>首页</b></a>
        </div>
        <table class="table_create" cellspacing="0" cellpadding="0" id="tmodule">
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
                            <td class="first"><b>{{ $module->name }}</b></td>
                            <td><label><input type="radio" class="radio_pos" name="module_isshow_{{$module->id}}" value="1" {{ $module->isshow==1 ? 'checked' : '' }}> 显示&nbsp;&nbsp;</label><br></td>
                            @if($module->cid)
                                <td><label><input type="radio" class="radio_pos" name="module_isshow_{{$module->id}}" value="0" {{ $module->isshow==0 ? 'checked' : '' }}> 不显示&nbsp;&nbsp;</label></td>
                                <td><button class="companybtn sure" onclick="module_sure({{$module->id}})" id="sure_{{$module->id}}">确定更新</button>
                                    <input type="hidden" name="m_isshow_{{$module->id}}" value="{{ $module->isshow }}">
                                </td>
                            @else
                                <td><span style="color:darkgrey;font-size:14px;">/</span></td>
                                <td><span style="color:darkgrey;font-size:14px;">不可选</span></td>
                            @endif
                        </tr>
                            @endforeach
                        @endif
                    </table>
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
                            <td class="first"><b>{{ $module->name }}</b></td>
                            <td colspan="2"><input type="text" class="field_value" style="width:100px;" name="module_sort_{{$module->id}}" value="{{ $module->sort }}"></td>
                            <td><button class="companybtn sure" onclick="module_sort({{$module->id}})">确定更新</button>
                                <input type="hidden" name="m_sort_{{$module->id}}" value="{{ $module->sort }}">
                            </td>
                        </tr>
                            @endforeach
                        @endif
                    </table>
                </td>
            </tr>
        </table>

        <table class="table_create" cellspacing="0" cellpadding="0" id="thome" style="display:none;">
            <tr>
                <td class="field_name" style="text-align:center;" colspan="3">
                    <b>首页设置</b>
                    &nbsp;&nbsp;&nbsp;
                </td>
            </tr>
            <tr>
                <td class="field_name">显示控制：</td>
                <td></td>
            </tr>
            {{--<tr>--}}
                {{--<td class="field_name">顺序控制：</td>--}}
                {{--<td></td>--}}
            {{--</tr>--}}
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
        function module_sure(id){
            var module_isshow = $("input[name='module_isshow_'"+id+"]").val();
            var m_isshow = $("input[name='m_isshow_'"+id+"]").val();
            if (module_isshow==m_isshow) { alert('选项没有变化！'); return; }
            window.location.href = '{{DOMAIN}}company/admin/layout/module/isshow/'+id+'/'+module_isshow;
        }
        //模块的排序控制
        function module_sort(id){
            var module_sort = $("input[name='module_sort_"+id+"']").val();
            var m_sort = $("input[name='m_sort_"+id+"']").val();
            if (module_sort==m_sort) { alert('排序值没有变化！'); return; }
            window.location.href = '{{DOMAIN}}company/admin/layout/module/sort/'+id+'/'+module_sort;
        }
    </script>
@stop

