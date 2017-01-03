@extends('admin.main')
@section('content')
    <div class="admin-content">
        @include('admin.common.crumb')
        @include('admin.wallet.menu')
        <hr/>

        <div class="am-g">
            @include('admin.common.info')
            <div class="am-u-sm-12 am-u-md-8 am-u-md-pull-4">
                <form class="am-form" data-am-validator method="POST" action="{{DOMAIN}}admin/wallet/weal/{{ $data['id'] }}" enctype="multipart/form-data">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <input type="hidden" name="_method" value="POST">
                    <input type="hidden" name="type" value="{{ $type }}">
                    <fieldset>
                        <div class="am-form-group">
                            <label>用户名称 / User Name：{{ $data['username'] }}</label>
                            <br><label>@if($type==1)签到@elseif($type==2)金币@elseif($type==3)红包@endif兑换福利</label>
                            <br><label>
                                当前@if($type==1)签到 {{$data['sign']}}
                                @elseif($type==2)金币 {{$data['gold']}}
                                @elseif($type==3)红包 {{$data['tip']}}
                                @endif
                            </label>
                        </div>

                        <div class="am-form-group">
                            <label>兑换数量 / Number：</label>
                            <input type="text" placeholder="数字福利倍数" pattern="^\d+$" required name="num"/>
                            每@if($type==1){{$signByWeal}}个签到
                            @elseif($type==2){{$goldByWeal}}个金币
                            @elseif($type==3){{$tipByWeal}}红包
                            @endif
                            兑换1福利
                        </div>

                        <button type="button" class="am-btn am-btn-primary" onclick="history.go(-1);">返回</button>
                        <button type="submit" class="am-btn am-btn-primary">确定兑换</button>
                    </fieldset>
                </form>
            </div>
        </div>
    </div>
@stop

