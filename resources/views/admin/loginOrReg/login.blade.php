@extends('admin.loginOrReg.index')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">登录</div>
                    <div class="panel-body">
                        {{--@if (Session::has('msg'))--}}
                            {{--<div class="alert alert-danger">--}}
                                {{--<strong>出错啦</strong> 这些问题需要您修正<br><br>--}}
                                {{--<ul>--}}

                                    {{--<li>{{ Session::get('msg') }}</li>--}}

                                {{--</ul>--}}
                            {{--</div>--}}
                        {{--@endif--}}

                        <form class="form-horizontal" role="form" method="POST" action="/admin/login">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <input type="hidden" name="_method" value="POST">

                            <div class="form-group">
                                <label class="col-md-4 control-label">用户名</label>
                                <div class="col-md-6">
                                    <input type="text" class="form-control" minlength="2" required name="username" value="">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-4 control-label">密码</label>
                                <div class="col-md-6">
                                    <input type="password" class="form-control" minlength="5" required name="password">
                                </div>
                            </div>

                            {{--<div class="form-group">--}}
                                {{--<div class="col-md-6 col-md-offset-4">--}}
                                    {{--<div class="checkbox">--}}
                                        {{--<label>--}}
                                            {{--<input type="checkbox" name="remember"> 记住我--}}
                                        {{--</label>--}}
                                    {{--</div>--}}
                                {{--</div>--}}
                            {{--</div>--}}

                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-4">
                                    <button type="submit" class="btn btn-primary"> 登 录 </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
