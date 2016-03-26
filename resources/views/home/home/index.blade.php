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
    <!-- 广告PPT -->

    <div class="content">
        <!-- 在线创作 -->
        <div class="online">
            <p class="floor">
                <img src="/assets-home/images/floor_red.png" class="floor_img">
                <span class="floor_text">1F</span>
                <span class="floor_text2">&nbsp;在线创作</span>
            </p>
            <table class="online_con">
                <tr>
                    <td rowspan="2" class="con_first"><a href="" title="online1"><img src="/upload/images/online1.png"></a></td>
                    <td class="img"><a href="" title="online2"><div><img src="/upload/images/online2.png"></div></a></td>
                    <td class="img"><a href="" title="online3"><div><img src="/upload/images/online3.png"></div></a></td>
                    <td class="img"><a href="" title="online4"><div><img src="/upload/images/online4.png"></div></a></td>
                </tr>
                <tr>
                    <td class="img"><a href="" title="online2"><div><img src="/upload/images/online2.png"></div></a></td>
                    <td class="img"><a href="" title="online3"><div><img src="/upload/images/online3.png"></div></a></td>
                    <td class="img"><a href="" title="online4"><div><img src="/upload/images/online4.png"></div></a></td>
                </tr>
            </table>
        </div>
        <!-- 特色产品：产品样片 -->
        <div class="trait">
            <p class="floor">
                <img src="/assets-home/images/floor_red.png" class="floor_img">
                <span class="floor_text">2F</span>
                <span class="floor_text2">&nbsp;特色产品</span>
            </p>
            <div class="trait_con">
                <table>
                    <tr>
                        <td><span>◀</span></td>
                        <td></td>
                        <td><span>▶</span></td>
                    </tr>
                </table>
            </div>
        </div>
        <!-- 热门品牌：供应单位 -->
        <div class="hot">
            <p class="floor">
                <img src="/assets-home/images/floor_red.png" class="floor_img">
                <span class="floor_text">3F</span>
                <span class="floor_text2">&nbsp;热门品牌</span>
            </p>
            <div class="trait_con"></div>
        </div>
        <!-- 推荐产品 -->
        <div class="recommend">
            <p class="floor">
                <img src="/assets-home/images/floor_red.png" class="floor_img">
                <span class="floor_text">4F</span>
                <span class="floor_text2">&nbsp;推荐产品</span>
            </p>
            <div class="trait_con">
            </div>
        </div>
        <!-- 样片需求 -->
        <div class="recommend">
            <p class="floor">
                <img src="/assets-home/images/floor_red.png" class="floor_img">
                <span class="floor_text">5F</span>
                <span class="floor_text2">&nbsp;样片需求</span>
            </p>
            <div class="trait_con"></div>
        </div>
        <!-- 娱乐信息：演员、广告、媒体等 -->
        <div class="recommend">
            <p class="floor">
                <img src="/assets-home/images/floor_red.png" class="floor_img">
                <span class="floor_text">6F</span>
                <span class="floor_text2">&nbsp;娱乐信息</span>
            </p>
            <div class="trait_con"></div>
        </div>
        <!-- 租赁信息：拍摄器材 -->
        <div class="recommend">
            <p class="floor">
                <img src="/assets-home/images/floor_red.png" class="floor_img">
                <span class="floor_text">7F</span>
                <span class="floor_text2">&nbsp;娱乐信息</span>
            </p>
            <div class="trait_con"></div>
        </div>
        <!-- 设计信息：建筑、效果图、平面 -->
        <div class="recommend">
            <p class="floor">
                <img src="/assets-home/images/floor_red.png" class="floor_img">
                <span class="floor_text">8F</span>
                <span class="floor_text2">&nbsp;娱乐信息</span>
            </p>
            <div class="trait_con"></div>
        </div>
        <!-- 实时数据 -->
        <div class="realtime">
            <p class="floor">
                <img src="/assets-home/images/floor_red.png" class="floor_img">
                <span class="floor_text">9F</span>
                <span class="floor_text2">&nbsp;实时数据</span>
            </p>
            <div class="trait_con"></div>
        </div>
        <!-- 合作机构 -->
        <div class="cooperation">
            <p class="floor">
                <img src="/assets-home/images/floor_red.png" class="floor_img">
                <span class="floor_text">10F</span>
                <span class="floor_text2">&nbsp;合作单位</span>
            </p>
            <div class="trait_con"></div>
        </div>
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