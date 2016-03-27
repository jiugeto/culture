@extends('home.main')
@section('content')
    <!-- 广告PPT -->
    <div class="ppt">
        <ul class="ppt_pic">
            <li><a href="" title="ppt"><img src="/upload/images/ppt.png"></a></li>
            <li><a href="" title="ppt2"><img src="/upload/images/ppt2.png"></a></li>
            <li></li>
        </ul>
        <div class="ppt_change">
            <div class="ppt_change_bg"></div>
            {{--<span class="jiantou_left">◀</span>--}}
            {{--<span class="jiantou_right">▶</span>--}}
            <ul class="ppt_change_pic">
                <a href="##"><li><img src="/upload/images/ppt.png"></li></a>
                <a href=""><li><img src="/upload/images/ppt2.png"></li></a>
            </ul>
        </div>
    </div>
    <script>
        $(document).ready(function(){
            var clientWidth = document.body.clientWidth;
            $(".ppt").css('width',clientWidth);
        });
    </script>
    <!-- 广告PPT -->

    <div class="content">
        <!-- 在线创作 -->
        <div class="online">
            <p class="floor">
                <img src="/assets-home/images/floor_red.png" class="floor_img">
                <span class="floor_text">1F</span>
                <span class="floor_text2">&nbsp;在线创作</span>
            </p>
            <div class="online_con">
                <div class="online_first">
                    <a href="" title="online1">
                        <div class="con_img"><img src="/upload/images/online1.png"></div>
                    </a>
                </div>
                <div class="online_div">
                    <a href="" title="online1">
                        <div class="con_img"><img src="/upload/images/online2.png"></div>
                        <div class="con_text"><a href="">样片</a></div>
                    </a>
                </div>
                <div class="online_div">
                    <a href="" title="online1">
                        <div class="con_img"><img src="/upload/images/online3.png"></div>
                        <div class="con_text"><a href="">样片</a></div>
                    </a>
                </div>
                <div class="online_div">
                    <a href="" title="online1">
                        <div class="con_img"><img src="/upload/images/online4.png"></div>
                        <div class="con_text"><a href="">样片</a></div>
                    </a>
                </div>
                <div class="online_div">
                    <a href="" title="online1">
                        <div class="con_img"><img src="/upload/images/online2.png"></div>
                        <div class="con_text"><a href="">样片</a></div>
                    </a>
                </div>
                <div class="online_div">
                    <a href="" title="online1">
                        <div class="con_img"><img src="/upload/images/online3.png"></div>
                        <div class="con_text"><a href="">样片</a></div>
                    </a>
                </div>
                <div class="online_div">
                    <a href="" title="online1">
                        <div class="con_img"><img src="/upload/images/online4.png"></div>
                        <div class="con_text"><a href="">样片</a></div>
                    </a>
                </div>
            </div>
        </div>
        {{-- 精选 --}}
        <div class="selected">
            <p>精选</p>
            <div class="img"><a href=""><img src="/upload/images/online1.png"></a></div>
            <div class="img"><a href=""><img src="/upload/images/online1.png"></a></div>
            <div class="img"><a href=""><img src="/upload/images/online1.png"></a></div>
        </div>
        <br style="clear:both;"><br>

        <!-- 特色产品：产品样片 -->
        <div class="trait">
            <p class="floor">
                <img src="/assets-home/images/floor_red.png" class="floor_img">
                <span class="floor_text">2F</span>
                <span class="floor_text2">&nbsp;特色产品</span>
            </p>
            <div class="trait_con">
                <div class="img"><a href=""><img src="/upload/images/online1.png"></a></div>
                <div class="img"><a href=""><img src="/upload/images/online1.png"></a></div>
                <div class="img"><a href=""><img src="/upload/images/online1.png"></a></div>
                <div class="img"><a href=""><img src="/upload/images/online1.png"></a></div>
                <div class="img"><a href=""><img src="/upload/images/online1.png"></a></div>
                <div class="img"><a href=""><img src="/upload/images/online1.png"></a></div>
                {{--箭头--}}
                <div class="arrow">
                    <div class="con_left"> ◀ </div>
                    <div class="con_right"> ▶ </div>
                </div>
            </div>
        </div>
        <br style="clear:both;">
        
        <!-- 热门品牌：供应单位 -->
        {{--<div class="hot">--}}
            {{--<p class="floor">--}}
                {{--<img src="/assets-home/images/floor_red.png" class="floor_img">--}}
                {{--<span class="floor_text">3F</span>--}}
                {{--<span class="floor_text2">&nbsp;热门品牌</span>--}}
            {{--</p>--}}
            {{--<div class="trait_con">--}}
                {{--<div class="img"><a href=""><img src="/upload/images/online1.png"></a></div>--}}
                {{--<div class="img"><a href=""><img src="/upload/images/online1.png"></a></div>--}}
                {{--<div class="img"><a href=""><img src="/upload/images/online1.png"></a></div>--}}
                {{--<div class="img"><a href=""><img src="/upload/images/online1.png"></a></div>--}}
                {{--<div class="img"><a href=""><img src="/upload/images/online1.png"></a></div>--}}
                {{--<div class="img"><a href=""><img src="/upload/images/online1.png"></a></div>--}}
                {{--箭头--}}
                {{--<div class="arrow">--}}
                    {{--<div class="con_left"> ◀ </div>--}}
                    {{--<div class="con_right"> ▶ </div>--}}
                {{--</div>--}}
            {{--</div>--}}
        {{--</div>--}}
        {{--<br style="clear:both;">--}}

        <!-- 推荐产品 -->
        <div class="recommend">
            <p class="floor">
                <img src="/assets-home/images/floor_red.png" class="floor_img">
                <span class="floor_text">4F</span>
                <span class="floor_text2">&nbsp;推荐产品</span>
            </p>
            <div class="trait_con">
                <div class="img"><a href=""><img src="/upload/images/online1.png"></a></div>
                <div class="img"><a href=""><img src="/upload/images/online1.png"></a></div>
                <div class="img"><a href=""><img src="/upload/images/online1.png"></a></div>
                <div class="img"><a href=""><img src="/upload/images/online1.png"></a></div>
                <div class="img"><a href=""><img src="/upload/images/online1.png"></a></div>
                <div class="img"><a href=""><img src="/upload/images/online1.png"></a></div>
                {{--箭头--}}
                <div class="arrow">
                    <div class="con_left"> ◀ </div>
                    <div class="con_right"> ▶ </div>
                </div>
            </div>
        </div>
        <br style="clear:both;">

        <!-- 样片需求 -->
        <div class="demand">
            <p class="floor">
                <img src="/assets-home/images/floor_red.png" class="floor_img">
                <span class="floor_text">5F</span>
                <span class="floor_text2">&nbsp;样片需求</span>
            </p>
            <div class="demand_con">
                <div class="img"><a href=""><img src="/upload/images/online1.png"></a></div>
                <div class="img"><a href=""><img src="/upload/images/online1.png"></a></div>
                <div class="img"><a href=""><img src="/upload/images/online1.png"></a></div>
                <div class="img"><a href=""><img src="/upload/images/online1.png"></a></div>
                <div class="img"><a href=""><img src="/upload/images/online1.png"></a></div>
            </div>
        </div>
        {{-- 排行列表 --}}
        <div class="list">
            <p>排行列表</p>
            <div class="list_div">
                <div class="img_text">
                    <div class="img_num"> 1 </div>
                    <div class="img"><a href=""><img src="/upload/images/online1.png"></a></div>
                    <a href="">需求需求</a><br>
                    <a href="" class="click">点击量 <span>10</span></a>
                </div>
                <div class="img_text">
                    <div class="img_num"> 2 </div>
                    {{--<div class="img"><a href=""><img src="/upload/images/online1.png"></a></div>--}}
                    <a href="">需求需求</a><br>
                    {{--<a href="" class="click">点击量 <span>10</span></a>--}}
                </div>
                <div class="img_text">
                    <div class="img_num"> 3 </div>
                    {{--<div class="img"><a href=""><img src="/upload/images/online1.png"></a></div>--}}
                    <a href="">需求需求</a><br>
                    {{--<a href="" class="click">点击量 <span>10</span></a>--}}
                </div>
                <div class="img_text">
                    <div class="img_num"> 4 </div>
                    {{--<div class="img"><a href=""><img src="/upload/images/online1.png"></a></div>--}}
                    <a href="">需求需求</a><br>
                    {{--<a href="" class="click">点击量 <span>10</span></a>--}}
                </div>
                <div class="img_text">
                    <div class="img_num"> 5 </div>
                    {{--<div class="img"><a href=""><img src="/upload/images/online1.png"></a></div>--}}
                    <a href="">需求需求</a><br>
                    {{--<a href="" class="click">点击量 <span>10</span></a>--}}
                </div>
                <div class="img_text">
                    <div class="img_num"> 6 </div>
                    {{--<div class="img"><a href=""><img src="/upload/images/online1.png"></a></div>--}}
                    <a href="">需求需求</a><br>
                    {{--<a href="" class="click">点击量 <span>10</span></a>--}}
                </div>
            </div>
        </div>
        <br style="clear:both;">

        <!-- 娱乐信息：演员、广告、媒体等 -->
        <div class="fun">
            <p class="floor">
                <img src="/assets-home/images/floor_red.png" class="floor_img">
                <span class="floor_text">6F</span>
                <span class="floor_text2">&nbsp;娱乐信息</span>
            </p>
            <div class="fun_con">
                <div class="img_text">
                    <div class="img">
                        <a href=""><img src="/upload/images/online1.png"></a>
                    </div>
                    <div class="con_text"><a href="">娱乐娱乐</a></div>
                </div>
                <div class="img_text">
                    <div class="img">
                        <a href=""><img src="/upload/images/online1.png"></a>
                    </div>
                    <div class="con_text"><a href="">娱乐娱乐</a></div>
                </div>
                <div class="img_text">
                    <div class="img">
                        <a href=""><img src="/upload/images/online1.png"></a>
                    </div>
                    <div class="con_text"><a href="">娱乐娱乐</a></div>
                </div>
                <div class="img_text">
                    <div class="img">
                        <a href=""><img src="/upload/images/online1.png"></a>
                    </div>
                    <div class="con_text"><a href="">娱乐娱乐</a></div>
                </div>
                <div class="img_text">
                    <div class="img">
                        <a href=""><img src="/upload/images/online1.png"></a>
                    </div>
                    <div class="con_text"><a href="">娱乐娱乐</a></div>
                </div>
            </div>
        </div>
        {{--独家--}}
        <div class="sole">
            <p>独家策划</p>
            <div class="img_text">
                <div class="img">
                    <a href=""><img src="/upload/images/online1.png"></a>
                </div>
                <div class="con_text"><a href="">娱乐娱乐</a></div>
            </div>
        </div>
        <br style="clear:both;"><br>

        <!-- 租赁信息：拍摄器材 -->
        <div class="rent">
            <p class="floor">
                <img src="/assets-home/images/floor_red.png" class="floor_img">
                <span class="floor_text">7F</span>
                <span class="floor_text2">&nbsp;租赁信息</span>
            </p>
            <div class="rent_con">
                <div class="img_text">
                    <div class="img">
                        <a href=""><img src="/upload/images/online1.png"></a>
                    </div>
                    <div class="con_text"><a href="">租赁租赁</a></div>
                </div>
                <div class="img_text">
                    <div class="img">
                        <a href=""><img src="/upload/images/online1.png"></a>
                    </div>
                    <div class="con_text"><a href="">租赁租赁</a></div>
                </div>
                <div class="img_text">
                    <div class="img">
                        <a href=""><img src="/upload/images/online1.png"></a>
                    </div>
                    <div class="con_text"><a href="">租赁租赁</a></div>
                </div>
                <div class="img_text">
                    <div class="img">
                        <a href=""><img src="/upload/images/online1.png"></a>
                    </div>
                    <div class="con_text"><a href="">租赁租赁</a></div>
                </div>
                <div class="img_text">
                    <div class="img">
                        <a href=""><img src="/upload/images/online1.png"></a>
                    </div>
                    <div class="con_text"><a href="">租赁租赁</a></div>
                </div>
            </div>
        </div>
        {{--文字信息--}}
        <div class="rentinfo">
            <p>文字信息</p>
            <div class="img_text">
                {{--<div class="img">--}}
                    {{--<a href=""><img src="/upload/images/online1.png"></a>--}}
                {{--</div>--}}
                <div class="con_text"><a href=""><span>1</span> 租赁租赁</a></div>
            </div>
            <div class="img_text">
                {{--<div class="img">--}}
                    {{--<a href=""><img src="/upload/images/online1.png"></a>--}}
                {{--</div>--}}
                <div class="con_text"><a href=""><span>1</span> 租赁租赁</a></div>
            </div>
            <div class="img_text">
                {{--<div class="img">--}}
                    {{--<a href=""><img src="/upload/images/online1.png"></a>--}}
                {{--</div>--}}
                <div class="con_text"><a href=""><span>1</span> 租赁租赁</a></div>
            </div>
            <div class="img_text">
                {{--<div class="img">--}}
                    {{--<a href=""><img src="/upload/images/online1.png"></a>--}}
                {{--</div>--}}
                <div class="con_text"><a href=""><span>1</span> 租赁租赁</a></div>
            </div>
        </div>
        <br style="clear:both;"><br>

        <!-- 设计信息：建筑、效果图、平面 -->
        <div class="design">
            <p class="floor">
                <img src="/assets-home/images/floor_red.png" class="floor_img">
                <span class="floor_text">8F</span>
                <span class="floor_text2">&nbsp;设计信息</span>
            </p>
            <div class="design_con">
                <div class="img_text_first">
                    <div class="img">
                        <a href=""><img src="/upload/images/online1.png"></a>
                    </div>
                    {{--<div class="con_text"><a href="">租赁租赁</a></div>--}}
                </div>
                <div class="img_text">
                    <div class="img">
                        <a href=""><img src="/upload/images/online1.png"></a>
                    </div>
                    {{--<div class="con_text"><a href="">租赁租赁</a></div>--}}
                </div>
                <div class="img_text">
                    <div class="img">
                        <a href=""><img src="/upload/images/online1.png"></a>
                    </div>
                    {{--<div class="con_text"><a href="">租赁租赁</a></div>--}}
                </div>
                <div class="img_text">
                    <div class="img">
                        <a href=""><img src="/upload/images/online1.png"></a>
                    </div>
                    {{--<div class="con_text"><a href="">租赁租赁</a></div>--}}
                </div>
                <div class="img_text">
                    <div class="img">
                        <a href=""><img src="/upload/images/online1.png"></a>
                    </div>
                    {{--<div class="con_text"><a href="">租赁租赁</a></div>--}}
                </div>
                <div class="img_text">
                    <div class="img">
                        <a href=""><img src="/upload/images/online1.png"></a>
                    </div>
                    {{--<div class="con_text"><a href="">租赁租赁</a></div>--}}
                </div>
                <div class="img_text">
                    <div class="img">
                        <a href=""><img src="/upload/images/online1.png"></a>
                    </div>
                    {{--<div class="con_text"><a href="">租赁租赁</a></div>--}}
                </div>
                <div class="img_text">
                    <div class="img">
                        <a href=""><img src="/upload/images/online1.png"></a>
                    </div>
                    {{--<div class="con_text"><a href="">租赁租赁</a></div>--}}
                </div>
                <div class="img_text">
                    <div class="img">
                        <a href=""><img src="/upload/images/online1.png"></a>
                    </div>
                    {{--<div class="con_text"><a href="">租赁租赁</a></div>--}}
                </div>
            </div>
        </div>
        <br style="clear:both;">

        <!-- 实时数据 -->
        <div class="realtime">
            <p class="floor">
                <img src="/assets-home/images/floor_red.png" class="floor_img">
                <span class="floor_text">9F</span>
                <span class="floor_text2">&nbsp;实时数据</span>
            </p>
            <div class="realtime_con">
                <ul class="title">
                    <li>单号</li>
                    <li>名称</li>
                    <li>时间</li>
                </ul>
                <div class="con_wrap"></div>
            </div>
        </div>
        <br style="clear:both;">

        <!-- 合作机构 -->
        <div class="cooperation">
            <p class="floor">
                <img src="/assets-home/images/floor_red.png" class="floor_img">
                <span class="floor_text">10F</span>
                <span class="floor_text2">&nbsp;合作单位</span>
            </p>
            <div class="cooperation_con">
                <div class="img">
                    <a href=""><img src="/upload/images/online1.png"></a>
                </div>
                <div class="img">
                    <a href=""><img src="/upload/images/online1.png"></a>
                </div>
                <div class="img">
                    <a href=""><img src="/upload/images/online1.png"></a>
                </div>
                <div class="img">
                    <a href=""><img src="/upload/images/online1.png"></a>
                </div>
                <div class="img">
                    <a href=""><img src="/upload/images/online1.png"></a>
                </div>
                <div class="img">
                    <a href=""><img src="/upload/images/online1.png"></a>
                </div>
            </div>
        </div>
        <br style="clear:both;">

        <!-- 用户心声 -->
        <div class="voice">
            <p class="floor">
                <img src="/assets-home/images/floor_red.png" class="floor_img">
                <span class="floor_text">11F</span>
                <span class="floor_text2">&nbsp;用户心声</span>
            </p>
            <div class="trait_con"></div>
        </div>
        <!-- 空白 -->
        <div class="content_kongbai">&nbsp;</div>
    </div>
@stop