@extends('home.main')
@section('content')
    <!-- 广告PPT -->
    <div class="ppt">
        <ul class="ppt_pic">
            <li><a href="" title="ppt"><img src="/uploads/images/2016/ppt.png"></a></li>
            <li><a href="" title="ppt2"><img src="/uploads/images/2016/ppt2.png"></a></li>
            <li></li>
        </ul>
        <div class="ppt_change">
            <div class="ppt_change_bg"></div>
            {{--<span class="jiantou_left">◀</span>--}}
            {{--<span class="jiantou_right">▶</span>--}}
            <ul class="ppt_change_pic">
                <a href="##"><li><img src="/uploads/images/2016/ppt.png"></li></a>
                <a href=""><li><img src="/uploads/images/2016/ppt2.png"></li></a>
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
        <!-- 推荐创意 -->
        <div class="idea">
            <p class="floor">
                <img src="/assets-home/images/floor_red.png" class="floor_img">
                <span class="floor_text">{{ $number[1] }}F</span>
                <span class="floor_text2">&nbsp;{{ $floors[$number[1]] }}</span>
            </p>
            <div class="idea_con">
                <div class="left">主窗口</div>
                <div class="right">多记录</div>
            </div>
        </div>
        <br style="clear:both;"><br>

        <!-- 最新话题 -->
        <div class="talk">
            <p class="floor">
                <img src="/assets-home/images/floor_red.png" class="floor_img">
                <span class="floor_text">{{ $number[2] }}F</span>
                <span class="floor_text2">&nbsp;{{ $floors[$number[2]] }}</span>
            </p>
            <div class="talk_con">
                <div class="left">多记录</div>
                <div class="right">内容</div>
            </div>
        </div>
        <br style="clear:both;"><br>

        <!-- 在线创作 -->
        <div class="online">
            <p class="floor">
                <img src="/assets-home/images/floor_red.png" class="floor_img">
                <span class="floor_text">{{ $number[3] }}F</span>
                <span class="floor_text2">&nbsp;{{ $floors[$number[3]] }}</span>
            </p>
            <div class="online_con">
                <div class="online_first">
                    <a href="" title="online1">
                        <div class="con_img"><img src="/uploads/images/2016/online1.png"></div>
                    </a>
                </div>
                <div class="online_div">
                    <a href="" title="online1">
                        <div class="con_img"><img src="/uploads/images/2016/online2.png"></div>
                        <div class="con_text"><a href="">样片</a></div>
                    </a>
                </div>
                <div class="online_div">
                    <a href="" title="online1">
                        <div class="con_img"><img src="/uploads/images/2016/online3.png"></div>
                        <div class="con_text"><a href="">样片</a></div>
                    </a>
                </div>
                <div class="online_div">
                    <a href="" title="online1">
                        <div class="con_img"><img src="/uploads/images/2016/online4.png"></div>
                        <div class="con_text"><a href="">样片</a></div>
                    </a>
                </div>
                <div class="online_div">
                    <a href="" title="online1">
                        <div class="con_img"><img src="/uploads/images/2016/online2.png"></div>
                        <div class="con_text"><a href="">样片</a></div>
                    </a>
                </div>
                <div class="online_div">
                    <a href="" title="online1">
                        <div class="con_img"><img src="/uploads/images/2016/online3.png"></div>
                        <div class="con_text"><a href="">样片</a></div>
                    </a>
                </div>
                <div class="online_div">
                    <a href="" title="online1">
                        <div class="con_img"><img src="/uploads/images/2016/online4.png"></div>
                        <div class="con_text"><a href="">样片</a></div>
                    </a>
                </div>
            </div>
        </div>
        {{-- 精选 --}}
        <div class="selected">
            <p>精选</p>
            <div class="img"><a href=""><img src="/uploads/images/2016/online1.png"></a></div>
            <div class="img"><a href=""><img src="/uploads/images/2016/online1.png"></a></div>
            <div class="img"><a href=""><img src="/uploads/images/2016/online1.png"></a></div>
        </div>
        <br style="clear:both;"><br>

        <!-- 特色产品：产品样片 -->
        <div class="trait">
            <p class="floor">
                <img src="/assets-home/images/floor_red.png" class="floor_img">
                <span class="floor_text">{{ $number[4] }}F</span>
                <span class="floor_text2">&nbsp;{{ $floors[$number[4]] }}</span>
            </p>
            <div class="trait_con">
                <div class="img"><a href=""><img src="/uploads/images/2016/online1.png"></a></div>
                <div class="img"><a href=""><img src="/uploads/images/2016/online1.png"></a></div>
                <div class="img"><a href=""><img src="/uploads/images/2016/online1.png"></a></div>
                <div class="img"><a href=""><img src="/uploads/images/2016/online1.png"></a></div>
                <div class="img"><a href=""><img src="/uploads/images/2016/online1.png"></a></div>
                <div class="img"><a href=""><img src="/uploads/images/2016/online1.png"></a></div>
                {{--箭头--}}
                <div class="arrow">
                    <div class="con_left"> ◀ </div>
                    <div class="con_right"> ▶ </div>
                </div>
            </div>
        </div>
        <br style="clear:both;">
        
        <!-- 热门品牌：供应单位 -->
        <div class="hot">
            <p class="floor">
                <img src="/assets-home/images/floor_red.png" class="floor_img">
                <span class="floor_text">{{ $number[5] }}F</span>
                <span class="floor_text2">&nbsp;{{ $floors[$number[5]] }}</span>
            </p>
            <div class="trait_con">
                <div class="img"><a href=""><img src="/uploads/images/2016/online1.png"></a></div>
                <div class="img"><a href=""><img src="/uploads/images/2016/online1.png"></a></div>
                <div class="img"><a href=""><img src="/uploads/images/2016/online1.png"></a></div>
                <div class="img"><a href=""><img src="/uploads/images/2016/online1.png"></a></div>
                <div class="img"><a href=""><img src="/uploads/images/2016/online1.png"></a></div>
                <div class="img"><a href=""><img src="/uploads/images/2016/online1.png"></a></div>
                {{--箭头--}}
                <div class="arrow">
                    <div class="con_left"> ◀ </div>
                    <div class="con_right"> ▶ </div>
                </div>
            </div>
        </div>
        <br style="clear:both;">

        <!-- 推荐产品 -->
        <div class="recommend">
            <p class="floor">
                <img src="/assets-home/images/floor_red.png" class="floor_img">
                <span class="floor_text">{{ $number[6] }}F</span>
                <span class="floor_text2">&nbsp;{{ $floors[$number[6]] }}</span>
            </p>
            <div class="trait_con">
                <div class="img"><a href=""><img src="/uploads/images/2016/online1.png"></a></div>
                <div class="img"><a href=""><img src="/uploads/images/2016/online1.png"></a></div>
                <div class="img"><a href=""><img src="/uploads/images/2016/online1.png"></a></div>
                <div class="img"><a href=""><img src="/uploads/images/2016/online1.png"></a></div>
                <div class="img"><a href=""><img src="/uploads/images/2016/online1.png"></a></div>
                <div class="img"><a href=""><img src="/uploads/images/2016/online1.png"></a></div>
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
                <span class="floor_text">{{ $number[7] }}F</span>
                <span class="floor_text2">&nbsp;{{ $floors[$number[7]] }}</span>
            </p>
            <div class="demand_con">
                <div class="img"><a href=""><img src="/uploads/images/2016/online1.png"></a></div>
                <div class="img"><a href=""><img src="/uploads/images/2016/online1.png"></a></div>
                <div class="img"><a href=""><img src="/uploads/images/2016/online1.png"></a></div>
                <div class="img"><a href=""><img src="/uploads/images/2016/online1.png"></a></div>
                <div class="img"><a href=""><img src="/uploads/images/2016/online1.png"></a></div>
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
                <span class="floor_text">{{ $number[8] }}F</span>
                <span class="floor_text2">&nbsp;{{ $floors[$number[8]] }}</span>
            </p>
            <div class="fun_con">
                <div class="img_text">
                    <div class="img">
                        <a href=""><img src="/uploads/images/2016/online1.png"></a>
                    </div>
                    <div class="con_text"><a href="">娱乐娱乐</a></div>
                </div>
                <div class="img_text">
                    <div class="img">
                        <a href=""><img src="/uploads/images/2016/online1.png"></a>
                    </div>
                    <div class="con_text"><a href="">娱乐娱乐</a></div>
                </div>
                <div class="img_text">
                    <div class="img">
                        <a href=""><img src="/uploads/images/2016/online1.png"></a>
                    </div>
                    <div class="con_text"><a href="">娱乐娱乐</a></div>
                </div>
                <div class="img_text">
                    <div class="img">
                        <a href=""><img src="/uploads/images/2016/online1.png"></a>
                    </div>
                    <div class="con_text"><a href="">娱乐娱乐</a></div>
                </div>
                <div class="img_text">
                    <div class="img">
                        <a href=""><img src="/uploads/images/2016/online1.png"></a>
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
                    <a href=""><img src="/uploads/images/2016/online1.png"></a>
                </div>
                <div class="con_text"><a href="">娱乐娱乐</a></div>
            </div>
        </div>
        <br style="clear:both;"><br>

        <!-- 租赁信息：拍摄器材 -->
        <div class="rent">
            <p class="floor">
                <img src="/assets-home/images/floor_red.png" class="floor_img">
                <span class="floor_text">{{ $number[9] }}F</span>
                <span class="floor_text2">&nbsp;{{ $floors[$number[9]] }}</span>
            </p>
            <div class="rent_con">
                <div class="img_text">
                    <div class="img">
                        <a href=""><img src="/uploads/images/2016/online1.png"></a>
                    </div>
                    <div class="con_text"><a href="">租赁租赁</a></div>
                </div>
                <div class="img_text">
                    <div class="img">
                        <a href=""><img src="/uploads/images/2016/online1.png"></a>
                    </div>
                    <div class="con_text"><a href="">租赁租赁</a></div>
                </div>
                <div class="img_text">
                    <div class="img">
                        <a href=""><img src="/uploads/images/2016/online1.png"></a>
                    </div>
                    <div class="con_text"><a href="">租赁租赁</a></div>
                </div>
                <div class="img_text">
                    <div class="img">
                        <a href=""><img src="/uploads/images/2016/online1.png"></a>
                    </div>
                    <div class="con_text"><a href="">租赁租赁</a></div>
                </div>
                <div class="img_text">
                    <div class="img">
                        <a href=""><img src="/uploads/images/2016/online1.png"></a>
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
                    {{--<a href=""><img src="/uploads/images/2016/online1.png"></a>--}}
                {{--</div>--}}
                <div class="con_text"><a href=""><span>1</span> 租赁租赁</a></div>
            </div>
            <div class="img_text">
                {{--<div class="img">--}}
                    {{--<a href=""><img src="/uploads/images/2016/online1.png"></a>--}}
                {{--</div>--}}
                <div class="con_text"><a href=""><span>1</span> 租赁租赁</a></div>
            </div>
            <div class="img_text">
                {{--<div class="img">--}}
                    {{--<a href=""><img src="/uploads/images/2016/online1.png"></a>--}}
                {{--</div>--}}
                <div class="con_text"><a href=""><span>1</span> 租赁租赁</a></div>
            </div>
            <div class="img_text">
                {{--<div class="img">--}}
                    {{--<a href=""><img src="/uploads/images/2016/online1.png"></a>--}}
                {{--</div>--}}
                <div class="con_text"><a href=""><span>1</span> 租赁租赁</a></div>
            </div>
        </div>
        <br style="clear:both;"><br>

        <!-- 设计信息：建筑、效果图、平面 -->
        <div class="design">
            <p class="floor">
                <img src="/assets-home/images/floor_red.png" class="floor_img">
                <span class="floor_text">{{ $number[10] }}F</span>
                <span class="floor_text2">&nbsp;{{ $floors[$number[10]] }}</span>
            </p>
            <div class="design_con">
                <div class="img_text_first">
                    <div class="img">
                        <a href=""><img src="/uploads/images/2016/online1.png"></a>
                    </div>
                    {{--<div class="con_text"><a href="">租赁租赁</a></div>--}}
                </div>
                <div class="img_text">
                    <div class="img">
                        <a href=""><img src="/uploads/images/2016/online1.png"></a>
                    </div>
                    {{--<div class="con_text"><a href="">租赁租赁</a></div>--}}
                </div>
                <div class="img_text">
                    <div class="img">
                        <a href=""><img src="/uploads/images/2016/online1.png"></a>
                    </div>
                    {{--<div class="con_text"><a href="">租赁租赁</a></div>--}}
                </div>
                <div class="img_text">
                    <div class="img">
                        <a href=""><img src="/uploads/images/2016/online1.png"></a>
                    </div>
                    {{--<div class="con_text"><a href="">租赁租赁</a></div>--}}
                </div>
                <div class="img_text">
                    <div class="img">
                        <a href=""><img src="/uploads/images/2016/online1.png"></a>
                    </div>
                    {{--<div class="con_text"><a href="">租赁租赁</a></div>--}}
                </div>
                <div class="img_text">
                    <div class="img">
                        <a href=""><img src="/uploads/images/2016/online1.png"></a>
                    </div>
                    {{--<div class="con_text"><a href="">租赁租赁</a></div>--}}
                </div>
                <div class="img_text">
                    <div class="img">
                        <a href=""><img src="/uploads/images/2016/online1.png"></a>
                    </div>
                    {{--<div class="con_text"><a href="">租赁租赁</a></div>--}}
                </div>
                <div class="img_text">
                    <div class="img">
                        <a href=""><img src="/uploads/images/2016/online1.png"></a>
                    </div>
                    {{--<div class="con_text"><a href="">租赁租赁</a></div>--}}
                </div>
                <div class="img_text">
                    <div class="img">
                        <a href=""><img src="/uploads/images/2016/online1.png"></a>
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
                <span class="floor_text">{{ $number[11] }}F</span>
                <span class="floor_text2">&nbsp;{{ $floors[$number[11]] }}</span>
            </p>
            <div class="realtime_con">
                <ul class="title">
                    <li class="t1">单号</li>
                    <li class="t2">名称</li>
                    <li class="t3">时间</li>
                </ul>
                <div class="con_wrap">
                    <div class="animate">
                        <ul>
                            <li class="t1">单号1</li>
                            <li class="t2">名称1</li>
                            <li class="t3">时间1</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <br style="clear:both;">

        <!-- 合作机构 -->
        <div class="cooperation">
            <p class="floor">
                <img src="/assets-home/images/floor_red.png" class="floor_img">
                <span class="floor_text">{{ $number[12] }}F</span>
                <span class="floor_text2">&nbsp;{{ $floors[$number[12]] }}</span>
            </p>
            <div class="cooperation_con">
                <div class="img">
                    <a href=""><img src="/uploads/images/2016/online1.png"></a>
                </div>
                <div class="img">
                    <a href=""><img src="/uploads/images/2016/online1.png"></a>
                </div>
                <div class="img">
                    <a href=""><img src="/uploads/images/2016/online1.png"></a>
                </div>
                <div class="img">
                    <a href=""><img src="/uploads/images/2016/online1.png"></a>
                </div>
                <div class="img">
                    <a href=""><img src="/uploads/images/2016/online1.png"></a>
                </div>
                <div class="img">
                    <a href=""><img src="/uploads/images/2016/online1.png"></a>
                </div>
            </div>
        </div>
        <br style="clear:both;">

        <!-- 用户心声 -->
        <div class="voice">
            <p class="floor">
                <img src="/assets-home/images/floor_red.png" class="floor_img">
                <span class="floor_text">{{ $number[13] }}F</span>
                <span class="floor_text2">&nbsp;{{ $floors[$number[13]] }}</span>
            </p>
            <div class="voice_con">
                <div class="img"><img src="/uploads/images/2016/online1.png"></div>
                <div class="text">文字</div>
                <div class="con">内容</div>
            </div>
        </div>
        <!-- 空白 -->
        <div class="content_kongbai">&nbsp;</div>
    </div>
@stop