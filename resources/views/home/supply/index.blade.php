@extends('home.main')
@section('content')
    {{-- 供应单位模板 --}}
    <div class="s_crumb">
        <div class="crumb">首页 /</div>
    </div>

    <div class="s_con">
        {{-- 搜索 --}}
        <div class="cre_kong">&nbsp;{{--10px高度留空--}}</div>
        <div class="s_search">
            搜索：
        </div>

        {{-- 列表 --}}
        <div class="cre_kong">&nbsp;{{--10px高度留空--}}</div>
        <div class="s_list">
            <div class="record"></div>
        </div>
    </div>
@stop