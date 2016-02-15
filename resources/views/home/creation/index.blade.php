@extends('home.main')
@section('content')
    <div class="content">
        <!-- 菜单栏 -->
        <div class="con_tab">
            <span class="con_tab_menu con_text_color_red">创作视频</span>
            <span class="con_tab_menu con_text_color">我的收藏</span>
            <span class="con_tab_menu con_text_color">我的专辑</span>
        </div>
        <!-- 创作窗口 -->
        <div class="con_create">
            <div class="con_menu">
                <span class="con_menu_toggle">菜单显示：</span>
                <span class="con_menu_list">视频属性</span>
            </div>
            <div class="con_win"></div>
            <div class="con_time">
                <span class="con_time_menu">时间线</span>
                <span class="con_time_rand">时长01:00</span>
                <span class="con_time_voice">声音</span>
                <div class="con_timeline"></div>
            </div>
        </div>
        <!-- 我的收藏窗口 -->
        <div class="con_collection"></div>
        <!-- 我的专辑(口袋)窗口 -->
        <div class="con_pocket"></div>
        <!-- 空白 -->
        <div class="content_kongbai">&nbsp;</div>
    </div>
@stop