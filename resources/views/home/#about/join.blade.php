@extends('home.main')
@section('content')
    @include('home.common.crumb')
    <div class="s_crumb">
        <div class="crumb">
            <div class="right">
                <a href="/">首页</a> / 关于本站
            </div>
        </div>
    </div>

    <div class="about_con">
        <p>
            本网站发起人--斯塔克，QQ2857156840，希望加入者必须喜欢影视文化这件事、这行业，水平不高可以学习提高，但是目标不同不合谋。
            凡是来合谋者务必喜欢影视制作、热衷影视创作，只为金钱、利益而来的不合谋。
            对影视行业追求、目标、理想雷同的热烈欢迎。
        </p>
        <p>站长本人对国内文化圈、娱乐圈、影视圈、设计行业现状不喜欢的，并尝试着绵薄之力去改善。</p>
        <p>站长相信：广采良言、用心聆听，将事情做好，把用户服务好，自然有回报。</p>
        <p>欢迎志同道合者来参与。</p>

        @include('home.#about.menu')
    </div>
    <div style="height:300px;">{{--空白--}}</div>
@stop