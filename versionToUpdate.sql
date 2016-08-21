-- 此文件始于2016/04/24，是本站开发的更新修改情况

-- 2016/04/24
-- 免费图片服务器，参考QQ空间相册
-- 免费视频服务器，参考优酷，乐视

-- 2016/04/29
-- 去除bs_userlog表
-- 企业信息操作更新       ok

-- 2016/05/01
-- 企业后台图片和视频更新，需要视频上传的尺寸大小限制
-- 开始页面布局：企业页面上功能的显示否、排序
-- 开始单页管理：新功能页面
-- 开始宣传编辑：PPT广告栏
-- 基本设置：放一些各个功能点的开关、控制、设置等等
-- 后台权限：放所有企业功能和该企业所拥有的功能分配
-- 首页参数：？？

-- 2016/05/04
-- 公司数据表改造：转为模块表com_modules、功能表com_funcs
-- 基本设置：企业logo、...

-- 2016/05/08
-- 在线产品数据表改造：2表变3表
-- 在线产品数据表再改造：
-- 属性表：标签样式的属性
    margin:行-左右row 列-上下col
    padding:行-左右row 列-上下col
    width
    height
    color
--     font-family字体
    font-size
--     font-style:italic normal oblique
--     font-variant字体
--     font-weight:bold bolder lighter
--     letter-spacing字间距
    word-spacing字间距
    line-height
--     vertical-align:sub下标字 super上标字
--     text-decoration:line-through overline underline none
    text-transform:capitalize首字大写 uppercase英文大写 lowercase英文写 none
    text-align:center left right justify
--     text-decorator:none underline overline line-through blink
--     text-indent
    background-color
--     background-image:如url(image/bg.gif)
--     background-attachment:scroll fixed
--     background-repeat:repeat no-repeat repeat-x repeat-y
--     background-position:如90% 90% 图片与x,y轴位置
    border:top bottom left right 值 类型 颜色
    position:static fixed relative absolute top left right bottom
    overflow:scroll(始终显示滚动条) visible(不显示滚动条,但超出部分可见) auto(内容超出时显示滚动条) hidden(超出时隐藏内容)
--     z-index(position必需要指定为absolute才行)
--     cursor:设置DIV上光标的样式
--     clip(position指定为absolute):设置剪辑矩形 rect(top right bottom left)设置上下左右的距离
    opacity:filter:alpha(opacity=value) eg:filter:alpha(opacity=50);opacity:0.5;
-- 动画表：需要做动画的属性

-- 2016/05/10
-- 产品属性表，加入字段：
--    img序列化存储：url,margin,padding,border,width,height,
--    text序列化存储：con,margin,padding,border,font_size,color,
-- 增加动画内容表 bs_products_con，存放动画中的图片、文字信息

-- 2016/05/15
-- 产品属性表结构改造开始

-- 2016/05/23
-- 在线动画处理思路：由时间轴切成单帧画面修改尝试
-- 从创意到制作整个思路流程规划一下
-- 增加分镜、改造订单

-- 2016/05/24
-- 在线创作订单还要琢磨

-- 2016/06/01
-- 添加用户参数表 users_params
-- 在线创作：编辑页面的样式修改、动画内容修改、动画帧修改分离

-- 2016/06/02
-- 需要重新思考在线创作的步骤：定好产品》填选内容》确定样式》设置动画信息》调节动画帧
-- 2016/06/03
-- 在线产品：内容：attrid关联样式
--          样式：
--          动画帧：layerid关联动画设置，attrid关联样式
--          动画设置：

-- 2016/06/07
-- 上传大于8M视频时错误

-- 2016/06/09
-- 关于存储：先用乐视云，因为免费，但是操作麻烦些，
--         收费的参考七牛(10G免费空间)、阿里云
--         upyun一个开始免费的云存储，琢磨下

-- 2016/06/20
-- 订单流程改造


-- 支付接口问题、QQ登录问题、地图定位问题