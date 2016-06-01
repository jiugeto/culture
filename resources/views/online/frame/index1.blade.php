@extends('online.main')
@section('content')
    <style>
        /*========== 动画与属性编辑 ==========*/
        .online_frame {
            margin-top:-20px;
            width:100%;
            background:rgb(20,20,20);
            border-top:5px solid black;
            position:fixed;bottom:100px;
            height:200px;
            overflow:auto;
        }
        .frame {
            margin:0 auto;
            width:980px;
        }
        .frame .menus {
            color:white;
            background:rgb(60,60,60);
            float:left;
        }
        .frame .menus .grey {
            padding:5px;
            width:20px;
            height:200px;
            color:darkgrey;
            border-right:2px solid black;
            float:left;
        }
        .frame .oneframe {
            margin:2px;
            padding:5px 10px;
            /*width:200px;*/
            background:rgb(80,80,80);
        }
        .oneframe a { cursor:pointer; }
        .oneframe a:hover { color:red;text-decoration:underline; }
    </style>

    {{--  在线创建窗口 --}}
    <div class="online_frame" style="@if(isset($footSwitch)&&!$footSwitch)bottom:25px;@endif">
        {{--属性修改--}}
        <div class="frame">
            <div class="menus">
                <div class="grey">样式修改 {{ count($attrs) }}</div>
                @if(count($attrs))
                    @foreach($attrs as $attr)
                        <div class="oneframe">
                            {{ $attr->name }}
                            @if($attr->attrs())
                                @foreach($attr->attrs() as $attr1)
                                <table>
                                    <tr><td>外边距：
                                        <select name="ismargin">
                                            @foreach($attrModel['marginTypes'] as $kmarginType=>$marginTypeName)
                                            <option value="{{ $kmarginType }}">{{ $marginTypeName }}</option>
                                            @endforeach
                                        </select>
                                        &nbsp;&nbsp;&nbsp;&nbsp;
                                        </td></tr>
                                </table>
                                <script>
                                $(document).ready(function(){
                                });
                                </script>
                                @endforeach
                            @endif
                        </div>
                    @endforeach
                @endif
            </div>
        </div>
        {{--动画修改--}}
        <div class="frame">
            <div class="menus">
                <div class="grey">动画单帧修改 {{ count($layers) }}</div>
                @if(count($layers))
                    @foreach($layers as $layer)
                        <div class="oneframe">
                            {{ $layer->name }} <a id="open">展开</a> <a id="close" style="display:none;">关闭</a>
                            <input type="hidden" name="layerid" value="{{ $layer->id }}">
                            <table id="attrs" style="display:none;">
                            @if(count($layer->cons()) || count($layer->layerAttrs()))
                                动画内容
                                @if(count($layer->cons()))
                                @foreach($layer->cons() as $con)
                                <tr>
                                    <td class="left">动画名称：</td><td>{{ $layer->name }}</td>
                                    @if($con->genre==1)
                                    <td class="left">图片：</td>
                                    <td>
                                        <select name="pic_id">
                                        @if(count($pics))
                                        @foreach($pics as $pic)
                                        <option value="{{ $pic->id }}">{{ $pic->name }}</option>
                                        @endforeach
                                        @endif
                                        </select>
                                        {{--<a href="">图片列表</a>--}}
                                    </td>
                                    @elseif($con->genre==2)
                                    <td class="left">文字：</td>
                                    <td><input type="text" name="textName" value="{{ $con->name }}"></td>
                                    @endif
                                    {{--<td></td><td></td>--}}
                                </tr>
                                @endforeach
                                @if(count($layer->layerAttr()))
                                <tr><td colspan="10"><div style="border-bottom:1px dashed lightgrey;"></div></td></tr>
                                @endif
                                @endif
                                {{--动画样式--}}
                                {{--<tr>--}}
                                    {{--<td class="left">属性：</td><td><input type="text" value="值"></td>--}}
                                    {{--<td class="left">属性：</td><td><input type="text" value="值"></td>--}}
                                    {{--<td class="left">属性：</td><td><input type="text" value="值"></td>--}}
                                {{--</tr>--}}
                                {{--动画关键帧--}}
                                <tr><td colspan="10"><div style="border-bottom:1px dashed lightgrey;"></div></td></tr>
                                @if(count($layer->layerAttrs()))
                                @foreach($layer->layerAttrs() as $layerAttr)
                                <tr>
                                    <td class="left">属性名称：</td><td>{{ $layerAttr->layerAttr() }}</td>
                                    <td class="left">动画点(帧)：</td>
                                    <td><input type="text" name="per{{$layerAttr->id}}" value="{{ $layerAttr->per }}">%</td>
                                    <td class="left">动画值：</td>
                                    <td><input type="text" name="val{{$layerAttr->id}}" value="{{ $layerAttr->val }}"></td>
                                </tr>
                                @endforeach
                                @endif
                            @else <tr><td colspan="10">无</td></tr>
                            @endif
                            </table>
                        </div>
                    @endforeach
                @endif
                <div class="oneframe">
                    00000 <a id="open">展开</a> <a id="close" style="display:none;">关闭</a>
                    <table id="attrs" style="display:none;">
                        <tr>
                            <td class="left">内容：</td><td><input type="text" value="内容值"></td>
                            <td class="left">内容：</td><td><input type="text" value="内容值"></td>
                            <td class="left"></td><td></td>
                        </tr>
                        <tr><td colspan="10"><div style="border-bottom:1px dashed lightgrey;"></div></td></tr>
                        <tr>
                            <td class="left">属性：</td><td><input type="text" value="值"></td>
                            <td class="left">属性：</td><td><input type="text" value="值"></td>
                            <td class="left">属性：</td><td><input type="text" value="值"></td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
        <div style="height:200px;">{{--空白--}}</div>
    </div>
@stop