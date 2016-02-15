@extends('home.main')
@section('content')
    <!-- 幻灯片和登录框 开始 -->
    <div class="slide">
        <div class="bd">
            <ul>
                <li class="l1"><a href="#"></a></li>
                <li class="l2"><a href="#"></a></li>
                <li class="l3"><a href="#"></a></li>
                <li class="l4"><a href="#"></a></li>
                <li class="l5"><a href="#"></a></li>
            </ul>
        </div>
        <div class="hd">
            <ul>
                <li></li>
                <li></li>
                <li></li>
                <li></li>
                <li></li>
            </ul>
        </div>
        <div class="timer"></div>
        <div class="w">
            <div class="login">
                <img src="" alt="图片描述文本" class="login-recom">
                <div class="user-login">
                    <div class="login-box">
                        <p>注册认证即<span class="reg-prom">送0元</span></p>
                        <p class="reg-btn"><a href="">立即注册</a></p>
                        <p class="login-link">已有账号？<a href="">立即登录></a></p>
                    </div>
                    <p class="phone-number">服务热线：<span>4007-451818</span></p>
                </div>
            </div>
        </div>
    </div>
    <!-- 幻灯片和登录框 结束 -->
    <div class="w">
        <div class="floor">
            <span class="fl floor-number">1F</span>
            <h3 class="fl">贷款专区</h3>
        </div>
        <div class="floor-content">
            <div class="fl floor-left">
                <div class="loan-banner">
                    <ul>
                        <li><a class="active" href="#">个人贷款</a></li>
                        <li><a href="#">企业贷款</a></li>
                    </ul>
                </div>
                <div class="tab">
                    <div class="tab-prom">
                        <div class="fl tab-slide">
                            <div class="hd">
                                <ul>
                                    <li></li>
                                    <li></li>
                                    <li></li>
                                    <li></li>
                                </ul>
                            </div>
                            <div class="bd">
                                <ul>
                                    <li><a href="#"><img src="debug-file/images/tab-slide.png" alt="图片描述文本"></a></li>
                                    <li><a href="#"><img src="debug-file/images/tab-slide.png" alt="图片描述文本"></a></li>
                                    <li><a href="#"><img src="debug-file/images/tab-slide.png" alt="图片描述文本"></a></li>
                                    <li><a href="#"><img src="debug-file/images/tab-slide.png" alt="图片描述文本"></a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="tab-banner">
                            <a href="#"><img src="debug-file/images/tab-banner.png" alt="图片描述文本"></a>
                        </div>
                    </div>
                    <div class="tab-list">
                        <ul>
                            <li>
                                <h3></h3>
                                <p>放款时间：天</p>
                                <p>结合费率：</p>
                                <p>参考月利率：</p>
                                <h4><span class="rate"></span></h4>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="floor-right">
                <div class="tip-slide">
                    <div class="hd">
                        <ul>
                            <li><a href="#">贷款攻略</a></li>
                        </ul>
                    </div>
                    <div class="bd" id="list-helps">
                        <ul>
                            <li><a href=""><br/></a></li>
                        </ul>
                        <ul>
                            <li><a href="#"></a></li>
                            <li><a href="#"></a></li>
                            <li><a href="#"></a></li>
                            <li><a href="#"></a></li>
                            <li><a href="#"></a></li>
                            <li><a href="#"></a></li>
                            <li><a href="#"></a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="floor">
            <span class="fl floor-number">2F</span>
            <h3 class="fl">推荐的服务商</h3>
        </div>
        <div class="floor-content">
            <div class="fl floor-left">
                <ul class="provider">
                    <li>
                        <h4>蓝商易贷<span class="fr more"><a href="/financeb/2">更多</a>>></span></h4>
                        <div class="provider-slide">
                            <div class="bd">
                                <ul>
                                    <li>
                                        <a href="#"><img src=""></a>
                                        <a class="bar" href="#"></a>
                                    </li>
                                </ul>
                            </div>
                            <div class="hd">
                                <ul>
                                    <li><img src=""></li>
                                </ul>
                            </div>
                        </div>
                    </li>
                    <li>
                        <h4>银行贷款<span class="fr more"><a href="/financeb/2">更多</a>>></span></h4>
                        <div class="provider-slide">
                            <div class="bd">
                                <ul>
                                    <li>
                                        <a href="#"><img src=""></a>
                                        <a class="bar" href="#"></a>
                                    </li>
                                </ul>
                            </div>
                            <div class="hd">
                                <ul>
                                    <li><img src=""></li>
                                </ul>
                            </div>
                        </div>
                    </li>
                    <li>
                        <h4>小额贷款<span class="fr more"><a href="/financeb/3">更多</a>>></span></h4>
                        <div class="provider-slide">
                            <div class="bd">
                                <ul>
                                    <li>
                                        <a href="#"><img src=""></a>
                                        <a class="bar" href="#"></a>
                                    </li>
                                </ul>
                            </div>
                            <div class="hd">
                                <ul>
                                    <li><img src=""></li>
                                </ul>
                            </div>
                        </div>
                    </li>
                    <li>
                        <h4>融资贷款<span class="fr more"><a href="#">更多</a>>></span></h4>
                        <div class="provider-slide">
                            <div class="bd">
                                <ul>
                                    <li>
                                        <a href="#"><img src=""></a>
                                        <a class="bar" href="#"></a>
                                    </li>
                                </ul>
                            </div>
                            <div class="hd">
                                <ul>
                                    <li><img src=""></li>
                                </ul>
                            </div>
                        </div>
                    </li>
                </ul>
            </div>
            <div class="floor-right">
                <div class="event">
                    <h4><a href="#">蓝商大事件</a></h4>
                    <a href="#"><img class="event-pic" src="debug-file/images/event-pic.png" alt="图片描述文本"></a>
                    <ul>
                        <li>
                            <a href=""></a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="floor">
            <span class="fl floor-number">3F</span>
            <h3 class="fl">实时数据</h3>
        </div>
        <div class="floor-content">
            <div class="fl floor-left">
                <div class="real-time-data">
                    <ul class="title">
                        <li class="t1">地区</li>
                        <li class="t2">类型</li>
                        <li class="t3">工单号</li>
                        <li class="t4">联系人</li>
                        <li class="t5">联系电话</li>
                        <li class="t6">申贷金额</li>
                        <li class="t7">生成时间</li>
                        <li class="t8">当前状态</li>
                    </ul>
                    <div class="cont"><ul class="detail">
                            <li class="t1"></li>
                            <li class="t2"></li>
                            <li class="t3"></li>
                            <li class="t4"></li>
                            <li class="t5"></li>
                            <li class="t6"></li>
                            <li class="t7"></li>
                            <li class="t8">
                                <span class="refinancing-status-1"></span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="floor-right">
                <div class="article">
                    <div class="news-slide">
                        <div class="hd">
                            <ul>
                                <li>媒体报道</li>
                                <li>社区精华热帖</li>
                            </ul>
                            <span class="fr news-more">
                                <a href="">更多</a>
                                <a href="" style="display:none">更多</a>>>
                            </span>
                        </div>
                        <div class="bd">
                            <ul>
                                <li>
                                    <a href=""></a>
                                </li>
                            </ul>
                            <ul>
                                <li>
                                    <a href=""></a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="prom-slide">
                        <div class="hd">
                            <ul>
                                <li></li>
                                <li></li>
                            </ul>
                        </div>
                        <div class="bd">
                            <ul>
                                <li><a href="#"><img src="debug-file/images/prom.png"></a></li>
                                <li><a href="#"><img src="debug-file/images/prom.png"></a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="notice">
                        <h3><a href="/news">平台公告</a></h3>
                        <ul>
                            <li>
                                <a href=""></a>
                                <span class="date"></span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="rec-title">合作机构<span class="rec-subtitle">平台有超过<span class="red">2000</span>家合作机构</span></div>
        <ul class="bank">
            <li><a href="#"><img src="images/abc.png" alt="图片描述文本"></a></li>
            <li><a href="#"><img src="images/bb.png" alt="图片描述文本"></a></li>
            <li><a href="#"><img src="images/bc.png" alt="图片描述文本"></a></li>
            <li><a href="#"><img src="images/boc.png" alt="图片描述文本"></a></li>
            <li><a href="#"><img src="images/ccb.png" alt="图片描述文本"></a></li>
            <li><a href="#"><img src="images/ccbc.png" alt="图片描述文本"></a></li>
            <li><a href="#"><img src="images/ceb.png" alt="图片描述文本"></a></li>
            <li><a href="#"><img src="images/chb.png" alt="图片描述文本"></a></li>
            <li><a href="#"><img src="images/citic.png" alt="图片描述文本"></a></li>
            <li><a href="#"><img src="images/cmcc.png" alt="图片描述文本"></a></li>
            <li><a href="#"><img src="images/pingan.png" alt="图片描述文本"></a></li>
            <li><a href="#"><img src="images/shbc.png" alt="图片描述文本"></a></li>
            <li><a href="#"><img src="images/psb.png" alt="图片描述文本"></a></li>
            <li><a href="#"><img src="images/icbc.png" alt="图片描述文本"></a></li>
        </ul>
        <div class="rec-title">用户心声<span class="rec-more"><a href="#">查看更多</a>>></span></div>
        <div class="customer-slide">
            <div class="hd"><a class="prev"></a><a class="next"></a></div>
            <div class="bd">
                <ul>
                    <li>
                        <div class="fl customer">
                            <img class="fl" src="debug-file/images/avatar.png">
                            <p class="name">春**</p>
                            <p class="txt">会计</p>
                            <p class="txt">投资经验：半年</p>
                        </div>
                        <p class="fl evaluate">朋友推荐了蓝商会，他成了我最爱的平台：安全可靠，回款及时；收益适中，它把投资人的资金安全和利益放在第一位。平台微信互动更是有朋友推荐了蓝商会，他成了我最爱的平台：安全可靠，回款及时；收益适中，它把投资人的资金安全和利益放在第一位。平台微信互动更是有朋友推荐了蓝商会，他成了我最爱的平台：安全可靠，回款及时；收益适中，它把投资人的资金安全和利益放在第一位。平台微信互动更是有</p>
                    </li>
                </ul>
            </div>
        </div>
    </div>
@stop