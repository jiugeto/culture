<style>
    body,div { margin:0; padding:0; }
    div#win_out { width:720px; height:405px; overflow:hidden; }
    .img { width:720px; height:405px; position:absolute; top:0; }

    /*1>================================*/
    .img1 div.pos { width:720px; height:405px; float:left; overflow:hidden; }
    .img1 div.dh { width:720px; height:405px; position:relative; top:405px; overflow:hidden; }
    .img1 img { height:405px; }

    /*2>================================*/
    .img2 div.pos { padding:10px 0; padding-left:7px; width:230px; height:385px; float:left; overflow:hidden; }
    .img2 div.dh { width:230px; height:385px; position:relative; left:500px; opacity:0; overflow:hidden; }
    .img2 div.pos img { height:405px; }

    /*3>================================*/
    .img3 div.pos { padding:5px 0; padding-left:5px; width:350px; height:390px; float:left; overflow:hidden; }
    .img3 div.dh { width:360px; height:405px; position:relative; left:250px; opacity:0; overflow:hidden; }
    .img3 div.pos img { height:405px; }

    /*4>================================*/
    .img4 div.pos { width:720px; height:405px; overflow:hidden; }
    .img4 div.dh { width:720px; height:405px; position:relative; top:-405px; overflow:hidden; }
    .img4 div.pos img { height:405px; }

    /*5>================================*/
    .img5 div.pos { width:720px; height:405px; overflow:hidden; }
    .img5 div.dh { width:720px; height:405px; position:relative; top:-405px; float:left; }
    .img5 div.pos img { height:405px; }

    /*6>================================*/
    .end div.dh { line-height:400px; text-align:center; font-size:12px; font-family:'微软雅黑'; opacity:0; }

    /*================================*/
    .timeline { width:720px; background:#000066; position:absolute; top:30px; }
    .timeline div.dh { width:720px; height:3px; background:red; position:relative; left:-750px; }

    {{--动画样式--}}
    /*动画的代码开始：定义动画时间*/
    .img1 div.dh {
        animation-name:animate1;
        animation-play-state:paused;
        animation-duration:1.5s;
        animation-timing-function:ease;
        animation-delay:0s;
        /*animation-iteration-count:infinite;*/
        animation-fill-mode:forwards;
    }
    .img2 div.dh {
        animation-name:animate2;
        animation-play-state:paused;
        animation-duration:3s;
        animation-timing-function:ease;
        /*animation-iteration-count:infinite;*/
        animation-delay:1s;
        animation-fill-mode:forwards;
    }
    .img3 div.dh {
        animation-name:animate3;
        animation-play-state:paused;
        animation-duration:3s;
        animation-timing-function:ease;
        /*animation-iteration-count:infinite;*/
        animation-delay:3s;
        animation-fill-mode:forwards;
    }
    .img4 div.dh {
        animation-name:animate4;
        animation-play-state:paused;
        animation-duration:6.5s;
        animation-timing-function:ease;
        animation-delay:5.5s;
        animation-fill-mode:forwards;
    }
    .img5 div.dh {
        animation-name:animate5;
        animation-play-state:paused;
        animation-duration:6s;
        animation-timing-function:ease;
        animation-delay:8.5s;
        animation-fill-mode:forwards;
    }
    .end div.dh {
        animation-name:end;
        animation-play-state:paused;
        animation-duration:3s;
        animation-timing-function:ease;
        animation-delay:14s;
        animation-fill-mode:forwards;
    }
    /*时间线进度条*/
    .timeline div.dh {
    animation-name:timeline;
    animation-play-state:paused;
    animation-duration:19s;
    animation-timing-function:linear;
    animation-delay:0s;
    animation-fill-mode:forwards;
    }

    /*动画的代码开始*/
    @keyframes animate1
    {
        0% { top:405px; }
        20% { top:0px; }
        70% { top:0px; left:0px; opacity:1; }
        100% { top:0px; left:-200px; opacity:0; }
    }
    @keyframes animate2
    {
        0% { left:250px; opacity:1; }
        40% { left:0px; opacity:1; }
        70% { left:0px; opacity:1; }
        100% { left:-500px; opacity:0; }
    }
    @keyframes animate3
    {
        0% { left:500px; }
        25% { left:0px; opacity:1; }
        80% { left:0px; top:0px; opacity:1; }
        100% { left:0px; top:405px; opacity:0; }
    }
    @keyframes animate4
    {
        0% { top:-405px; }
        10% { top:0px; }
        40% { top:0px; }
        50% { top:405px; }
        90% { top:405px; opacity:1; }
        100% { top:910px; opacity:0; }
    }
    @keyframes animate5
    {
        0% { top:-405px; }
        10% { top:0px; }
        40% { top:0px; left:0px; }
        50% { top:0px; left:-720px; }
        90% { top:0px; left:-720px; opacity:1; }
        100% { top:0px; left:-720px; opacity:0; }
    }
    @keyframes end
    {
        0% { font-size:12px; opacity:0; }
        5% { font-size:100px; opacity:0.5; }
        15% { font-size:20px; opacity:1; }
        100% { font-size:20px; opacity:1; }
    }
    /*时间线进度条*/
    @keyframes timeline
    {
    from { left:-720px; }
    to { left:0px; }
    }


    /*========== 动画开关 ==========*/
    .switch { width:720px; height:35px; position:absolute; top:405px; }
    a .onlinebtn { padding:3px 0; width:50%; color:grey; border:0; font-family:'微软雅黑'; font-size:18px; background:rgb(50,10,10); cursor:pointer; float:left; }
    a:hover .onlinebtn { color:white; background:darkred; }
</style>