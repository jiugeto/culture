@extends('admin.main')
@section('content')
    <div class="admin-content">
        @include('admin.common.crumb')
        <div class="am-g">
            <div class="am-u-sm-12">
                <div class="am-form-group">
                    <div class="am-btn-toolbar">
                        <div class="am-btn-group am-btn-group-xs">
                            <a href="{{DOMAIN}}admin/user">
                                <button type="button" class="am-btn am-btn-default">
                                    <img src="{{PUB}}assets/images/redo.png" class="icon"> 返回用户列表
                                </button>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <hr/>

        <div class="am-g">
            @include('admin.common.info')
            <div class="am-u-sm-12 am-u-md-8 am-u-md-pull-4">
                <form class="am-form" data-am-validator method="POST" action="{{DOMAIN}}admin/wallet/{{ $data['id'] }}" enctype="multipart/form-data">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <input type="hidden" name="_method" value="POST">
                    <input type="hidden" name="uid" value="{{ $data['uid'] }}">
                    <fieldset>
                        <div class="am-form-group">
                            <label>签到总数 / Sign：</label>
                            <input type="text" placeholder="" pattern="^\d+$" required name="sign" value="{{ $data['sign'] }}"/>
                        </div>

                        <div class="am-form-group">
                            <label>金币总数 / Gold：</label>
                            <input type="text" placeholder="" pattern="^\d+$" required name="gold" value="{{ $data['gold'] }}"/>
                        </div>

                        <div class="am-form-group">
                            <label>红包总数 / Tip：</label>
                            <input type="text" placeholder="" pattern="^\d+$" required name="tip" value="{{ $data['tip'] }}"/>
                        </div>

                        <div class="am-form-group">
                            <label>福利 / Weal：</label>
                            <input type="text" placeholder="" pattern="^\d+$" required name="weal" value="{{ $data['weal'] }}"/>
                        </div>

                        <button type="button" class="am-btn am-btn-primary" onclick="history.go(-1);">返回</button>
                        <button type="submit" class="am-btn am-btn-primary">保存添加</button>
                    </fieldset>
                </form>
            </div>
        </div>
    </div>
@stop

