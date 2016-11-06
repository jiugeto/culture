@extends('home.main')
@section('content')
    @include('home.common.crumb')
    <div style="height:2px;">{{--空白--}}</div>
    <div class="pro_content">
        @include('home.product.menu')

        <div class="pro_floor">
            <div class="title">
                定做的片源
                <a href="{{DOMAIN}}product/addPro" style="color:orangered;float:right;">添加新片源</a>
            </div>
            <div class="cre_source" style="padding:0;">
                <table class="goodCus">
                    <tr>
                        <td>片源名</td>
                        <td width="200">描述</td>
                        <td>需求方</td>
                        <td>预算</td>
                        <td>提供数</td>
                        <td>状态</td>
                        <td>发布时间</td>
                        <td width="100">操作</td>
                    </tr>
                @if(count($datas))
                    @foreach($datas as $data)
                        <tr>
                            <td>{{ str_limit($data->name,10) }}</td>
                            <td>{{ str_limit($data->intro,20) }}</td>
                            <td>{{ $data->getUName() }}</td>
                            <td>{{ $data->getMoney1() }}</td>
                            <td>{{ count($data->getGoodCustoms(10)) }}</td>
                            <td></td>
                            <td>{{ $data->createTime() }}</td>
                            <td>
                                <a href="" style="color:orangered;">详情</a> &nbsp;
                                <a href="" style="color:orangered;">提供方</a>
                            </td>
                        </tr>
                    @endforeach
                @endif
                </table>
            </div>
            <br>
            @include('home.common.page')
        </div>
        <br style="clear:both;"><br>
    </div>
@stop