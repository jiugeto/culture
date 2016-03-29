@extends('home.main')
@section('content')
    <div class="pro_content">
        {{-- 产品广告位 --}}
        <div class="pro_ad">
            <div class="pro_ad_pic">
                <img src="/upload/images/ppt.png">
            </div>
            <div class="pro_ad_change">
                <div class="ppt_change_bg"></div>
                <ul class="ppt_change_pic">
                    <a href="##"><li><img src="/upload/images/ppt.png"></li></a>
                    <a href=""><li><img src="/upload/images/ppt2.png"></li></a>
                </ul>
            </div>
        </div>

        {{-- 一楼 --}}
        <div class="pro_floor">
            <div class="pro_big">
                <p>新闻新闻</p>
                <ul>
                    <li><span>新闻新闻</span></li>
                    <li><span>新闻新闻</span></li>
                    <li><span>新闻新闻</span></li>
                </ul>
            </div>
            <div class="pro_big">
                <div class="img"><img src="/upload/images/online1.png"></div>
                <a href="">巨大那部分的加班费</a>
            </div>
            <div class="pro_big2">
                <div class="img_text">
                    <div class="img">
                        <a href=""><img src="/upload/images/online1.png"></a>
                    </div>
                    <div class="text"><a href="">租赁租赁</a></div>
                </div>
                <div class="img_text">
                    <div class="img">
                        <a href=""><img src="/upload/images/online1.png"></a>
                    </div>
                    <div class="text"><a href="">租赁租赁</a></div>
                </div>
                <div class="img_text">
                    <div class="img">
                        <a href=""><img src="/upload/images/online1.png"></a>
                    </div>
                    <div class="text"><a href="">租赁租赁</a></div>
                </div>
                <div class="img_text">
                    <div class="img">
                        <a href=""><img src="/upload/images/online1.png"></a>
                    </div>
                    <div class="text"><a href="">租赁租赁</a></div>
                </div>
            </div>
        </div>
        <br style="clear:both;"><br>

        {{-- 二楼：原创 --}}
        <div class="pro_floor">
            <div class="title">原创</div>
            {{-- 原创视频 --}}
            <div class="original">
                <div class="img_text">
                    <div class="img">
                        <a href=""><img src="/upload/images/online1.png"></a>
                    </div>
                    <div class="text"><a href="">原创视频</a></div>
                </div>
                <div class="img_text">
                    <div class="img">
                        <a href=""><img src="/upload/images/online1.png"></a>
                    </div>
                    <div class="text"><a href="">原创视频</a></div>
                </div>
                <div class="img_text">
                    <div class="img">
                        <a href=""><img src="/upload/images/online1.png"></a>
                    </div>
                    <div class="text"><a href="">原创视频</a></div>
                </div>
                <div class="img_text">
                    <div class="img">
                        <a href=""><img src="/upload/images/online1.png"></a>
                    </div>
                    <div class="text"><a href="">原创视频</a></div>
                </div>
                <div class="img_text">
                    <div class="img">
                        <a href=""><img src="/upload/images/online1.png"></a>
                    </div>
                    <div class="text"><a href="">原创视频</a></div>
                </div>
                <div class="img_text">
                    <div class="img">
                        <a href=""><img src="/upload/images/online1.png"></a>
                    </div>
                    <div class="text"><a href="">原创视频</a></div>
                </div>
                <div class="img_text">
                    <div class="img">
                        <a href=""><img src="/upload/images/online1.png"></a>
                    </div>
                    <div class="text"><a href="">原创视频</a></div>
                </div>
                <div class="img_text">
                    <div class="img">
                        <a href=""><img src="/upload/images/online1.png"></a>
                    </div>
                    <div class="text"><a href="">原创视频</a></div>
                </div>
            </div>
            {{-- 公司信息 --}}
            <div class="pro_com">
                <div class="privateInfo"></div>
            </div>
            {{-- 设计师信息 --}}
            <div class="pro_per">
                <div class="privateInfo"></div>
            </div>
        </div>

        {{-- 猜你喜欢 --}}

        <!-- 空白 -->
        <div class="content_kongbai">&nbsp;</div>
    </div>
@stop