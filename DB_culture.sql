-- 增加网站配置，nginx重启
/etc/init.d/nginx restart
-- linux添加环境变量（全局添加）
vi /etc/profile
-- 文件末尾加上
export PATH=$PATH:/path1:/path2:/pahtN
source /etc/profile

-- 登陆mysql后台
/usr/local/mysql/bin/mysql -u root
set names gbk;

-- 用navicat登录mysql连接失败，分配权限：
grant all privileges on *.* to 'root'@'%' identified by '' with grant option;

-- 建立本地culture数据库
drop database if exists cul_business;
create database cul_business;

-- 数据库说明：项目cul(culture)
-- 数据库前缀：业务cul_business，用户cul_user
-- 表结构说明：业务b(business)，用户u(user)；系统后台a(admin)，会员后台m(member)，前台h(home)，前后通用(server)
-- 表前缀：系统后台(ba_)，会员后台(bm_)，前台(bh_)，全局(bs_)


-- 权限管理表设计
-- 管理员组表 ba_admin
php artisan make:migration create_ba_admin_table --create=ba_admin
	$table->string('name')->comment('管理员名称');
	$table->string('password')->comment('登陆密码');
php artisan migrate

-- 角色表 ba_role
php artisan make:migration create_ba_role_table --create=ba_role
	$table->string('name')->comment('角色名称');
	$table->string('password')->comment('登陆密码');
	$table->integer('admin_id')->comment('管理员ID，关联管理员表ba_admin');
php artisan migrate

-- 权限表 ba_action（系统管理员权限）
php artisan make:migration create_ba_action_table --create=ba_action
  $table->string('name')->comment('权限名称');
  $table->string('intro')->comment('说明');
  $table->string('namespace')->comment('命名空间');
  $table->string('controller_prefix')->comment('控制器前缀');
  $table->string('action')->comment('操作方法');
  $table->string('style_class')->comment('class样式');
  $table->integer('pid')->comment('父ID');
php artisan migrate

-- 角色权限对应表 ba_role_action
php artisan make:migration create_ba_action_table --create=ba_action
  $table->integer('role_id')->comment('角色ID');
  $table->integer('action_id')->comment('权限ID')
php artisan migrate

-- 插入数据
INSERT INTO `ba_action` (name,intro,namespace,controller_prefix,action,pid) VALUES ('首页','','App\\Http\\Controllers\\Admin','Home','index','0');
INSERT INTO `ba_action` (name,intro,namespace,controller_prefix,action,pid) VALUES ('权限管理','','App\\Http\\Controllers\\Action','Action','index','0');
INSERT INTO `ba_action` (name,intro,namespace,controller_prefix,action,pid) VALUES ('权限管理','','App\\Http\\Controllers\\Action','Action','index','2');


-- 权限表 bs_authorization（用户权限分配）
php artisan make:migration create_bs_authorization_table --create=bs_authorization
  $table->integer('uid')->comment('用户id');
  $table->integer('level_id')->comment('用户级别关联bs_user_level：匿名用户，普通用户，初级会员，...，全能会员');
php artisan migrate

-- 权限级别表 bs_user_level（用户会员级别）
php artisan make:migration create_bs_user_level_table --create=bs_user_level
  $table->string('name')->comment('级别名称');
  $table->string('intro')->comment('说明');
php artisan migrate

-- 功能表 bs_functions（前台功能）
php artisan make:migration create_bs_functions_table --create=bs_functions
  $table->integer('name')->comment('功能名称');
  $table->string('intro')->comment('说明');
  -- $table->integer('table_id')->comment('数据表id');
  $table->string('table_name')->comment('数据表名称');
  $table->string('action')->comment('操作名称');
  $table->integer('del')->comment('回收站功能：0不放入回收站，1放入回收站');
php artisan migrate

-- 权限功能表 bs_auth_func（前台用户功能分配）
php artisan make:migration create_bs_functions_table --create=bs_functions
  $table->integer('level_id')->comment('权限级别id');
  $table->integer('func_id')->comment('功能id');
php artisan migrate
-- 备注：用户组bs_auth_func中有记录，说明该用户有此功能


-- 网站链接表 bs_links
php artisan make:migration create_bs_links_table --create=bs_links
  $table->string('name')->comment('链接名称');
  -- $table->integer('type')->comment('链接用途：1header头链接，2navigate菜单导航栏链接，3footer脚部链接');
  $table->integer('type_id')->comment('类型id，关联bs_types');
  $table->string('intro')->comment('链接介绍');
  $table->string('pic_id')->comment('图片id，关联bs_pics');
  $table->string('link')->comment('访问地址链接');
  $table->integer('display_way')->comment('显示方式：1文字链接，2图片链接');
  $table->integer('isshow')->comment('在前台页面是否显示：0不显示，1显示');
  $table->integer('pid')->comment('父id');
php artisan migrate


-- 消息管理表 bs_message
php artisan make:migration create_bs_message_table --create=bs_message
  $table->string('title')->comment('消息标题');
  $table->integer('genre')->comment('消息主体：1个人消息，2企业消息');
  $table->integer('type')->comment('消息类型：1在线消息，2离线消息');
  $table->string('content')->comment('消息内容');
  $table->integer('sender')->comment('发件人id');
  $table->integer('sender_time')->comment('发送时间');
  $table->integer('accept')->comment('收件人id');
  $table->integer('accept_time')->comment('收件时间');
  $table->integer('status')->comment('消息状态：1未发送，2已发送未接收，3已接收未读，4已读');
  $table->integer('del')->comment('回收站功能：0不放入回收站，1放入回收站');
php artisan migrate


-- 用户心声表 bs_user_voice
php artisan make:migration create_bs_user_voice_table --create=bs_user_voice
  $table->string('title')->comment('心声标题');
  $table->integer('uid')->comment('用户id');
  $table->string('content')->comment('心声内容');
  $table->integer('isshow')->comment('在前台页面是否显示：0不显示，1显示');
php artisan migrate


-- 类型表 bs_types
php artisan make:migration create_bs_types_table --create=bs_types
  $table->string('name')->comment('类型名称');
  $table->string('intro')->comment('类型说明');
  $table->integer('table_id')->comment('所在表id');
  $table->string('table_name')->comment('所在表名称');
  $table->string('field')->comment('字段名');
  $table->integer('del')->comment('回收站功能：0不放入回收站，1放入回收站');
php artisan migrate


-- 图片表 bs_pics
php artisan make:migration create_bs_pics_table --create=bs_pics
  $table->string('name')->comment('图片名称');
  $table->integer('type_id')->comment('类型id，关联bs_types');
  $table->string('pic')->comment('图片路径');
  $table->string('intro')->comment('图片说明');
php artisan migrate


-- 广告表 bs_ad
php artisan make:migration create_bs_ad_table --create=bs_ad
  $table->string('name')->comment('广告名称');
  $table->integer('ad_place_id')->comment('广告位id，关联bs_ad_place');
  $table->string('intro')->comment('广告简介');
  $table->integer('pic_id')->comment('图片链接id，关联bs_pics');
  $table->string('link')->comment('广告链接');
  $table->integer('fromtime')->comment('投放开始时间');
  $table->integer('totime')->comment('投放结束时间');
  $table->integer('uid')->comment('发布会员id');
  $table->integer('auth')->comment('审核状态：0未审核，1未通过审核，2通过审核');
  $table->integer('status')->comment('投放状态：0未投放，1已过期，2投放中');
  $table->integer('del')->comment('回收站功能：0不放入回收站，1放入回收站');
php artisan migrate

-- 广告位表 bs_ad_place
php artisan make:migration create_bs_ad_place_table --create=bs_ad_place
  $table->string('name')->comment('广告位名称');
  $table->string('intro')->comment('广告位简介');
  $table->integer('type_id')->comment('广告位类型：图片，幻灯片，赞助商，排名');
  $table->integer('uid')->comment('用户id');
  $table->integer('width')->comment('广告位宽度，单位px');
  $table->integer('height')->comment('广告位高度，单位px');
  $table->decimal('price')->comment('广告位价格，单位元/月');
  $table->integer('number')->comment('广告数量');
  $table->integer('del')->comment('回收站功能：0不放入回收站，1放入回收站');
php artisan migrate


-- 上传的视频表 bs_videos
-- (供应方提供的产品、需求方提供的需求样片)
php artisan make:migration create_bs_videos_table --create=bs_videos
  $table->string('name')->comment('视频名称');
  $table->integer('cate_id')->comment('视频分类：关联bs_videos_category');
  $table->string('intro')->comment('视频简介');
  $table->string('link')->comment('视频链接');
  $table->integer('uid')->comment('提供者：需求用户，设计师，公司');
  $table->string('uname')->comment('提供者：需求用户，设计师，公司');
  $table->integer('del')->comment('回收站功能：0不放入回收站，1放入回收站');
php artisan migrate

-- 上传的视频类别表 bs_videos_cateory
-- (供应方提供的产品、需求方提供的需求样片)
php artisan make:migration create_bs_videos_category_table --create=bs_videos_category
  $table->string('name')->comment('视频分类名称');
  $table->integer('type_id')->comment('类型划分依据，关联bs_types');
  $table->integer('pid')->comment('父id');
php artisan migrate


-- 在线视频表 bs_products
-- (在线写的模板)
php artisan make:migration create_bs_products_table --create=bs_products
  $table->string('name')->comment('视频名称');
  $table->string('intro')->comment('视频简介');
  $table->integer('uid')->comment('提供者：需求用户，设计师，公司');
  $table->string('uname')->comment('提供者：需求用户，设计师，公司');
  $table->integer('css_id')->comment('css样式id');
  $table->integer('js_id')->comment('js文件id');
  $table->integer('del')->comment('回收站功能：0不放入回收站，1放入回收站');
php artisan migrate

-- 在线视频表 bs_products_attr
-- (在线写的模板)
php artisan make:migration create_bs_products_attr_table --create=bs_products_attr
  $table->string('name')->comment('属性名称');
  $table->integer('type_id')->comment('属性类型：css样式文件，js文件');
  $table->string('intro')->comment('属性简介');
  $table->string('url')->comment('属性文件路径');
php artisan migrate


-- 租赁管理表 bs_rents
php artisan make:migration create_bs_rents_table --create=bs_rents
  $table->string('name')->comment('设备名称');
  $table->integer('genre')->comment('类型：1供应，2需求')
  $table->string('intro')->comment('设备简介');
  $table->integer('uid')->comment('发布者id');
  $table->integer('price')->comment('价格，单位元');
  $table->integer('fromtime')->comment('租赁开始时间');
  $table->integer('totime')->comment('租赁结束时间');
  $table->integer('del')->comment('回收站功能：0不放入回收站，1放入回收站');
php artisan migrate

-- 租赁图片关联表 bs_rent_pic
php artisan make:migration create_bs_rent_pic_table --create=bs_rent_pic
  $table->integer('rent_id')->comment('租赁id');
  $table->integer('pic_id')->comment('图片id');
php artisan migrate


-- 娱乐管理表 bs_entertains
php artisan make:migration create_bs_entertains_table --create=bs_entertains
  $table->string('title')->comment('标题');
  $table->string('content')->comment('内容');
  $table->integer('uid')->comment('发布方id');
  $table->integer('del')->comment('回收站功能：0不放入回收站，1放入回收站');
php artisan migrate

-- 娱乐图片关联表 bs_entertain_pic
php artisan make:migration create_bs_entertain_pic_table --create=bs_entertain_pic
  $table->integer('entertain_id')->comment('娱乐id');
  $table->integer('pic_id')->comment('图片id');
php artisan migrate

-- 演员表 bs_actors
php artisan make:migration create_bs_actors_table --create=bs_actors
  $table->string('name')->comment('演员名称');
  $table->integer('sex')->comment('性别：1男，2女');
  $table->string('realname')->comment('真实名字');
  $table->string('origin')->comment('籍贯');
  $table->integer('education')->comment('学历');
  $table->integer('school')->comment('毕业学校');
  $table->integer('hobby')->comment('爱好');
  $table->integer('job')->comment('职业');
  $table->integer('area')->comment('所在地');
  $table->integer('height')->comment('身高，单位cm');
  $table->integer('work')->comment('作品');
php artisan migrate

-- 娱乐演员关联表 bs_entertain_actor
php artisan make:migration create_bs_entertain_actor_table --create=bs_entertain_actor
  $table->integer('entertain_id')->comment('娱乐id');
  $table->integer('actor_id')->comment('演员id');
php artisan migrate

-- 演员图片关联表 bs_actor_pic
php artisan make:migration create_bs_actor_pic_table --create=bs_actor_pic
  $table->integer('actor_id')->comment('演员id');
  $table->integer('pic_id')->comment('图片id');
php artisan migrate


-- 设计表 bs_designs
php artisan make:migration create_bs_designs_table --create=bs_designs
  $table->integer('name')->comment('设计名称');
  $table->integer('genre')->comment('供求类型：1供应，2需求');
  $table->integer('type_id')->comment('设计类型：房产，效果图，平面，漫游');
  $table->integer('uid')->comment('发布者id');
  $table->string('intro')->comment('设计简介');
  $table->decimal('price')->comment('价格，单位元');
  $table->integer('del')->comment('回收站功能：0不放入回收站，1放入回收站');
php artisan migrate


-- 订单表 bs_orders
php artisan make:migration create_bs_orders_table --create=bs_orders
  $table->integer('name')->comment('订单名称');
  $table->integer('serial')->comment('订单编号');
  $table->integer('seller')->comment('卖家id');
  $table->string('seller_name')->comment('卖家名称');
  $table->integer('buyer')->comment('买家id');
  $table->string('buyer_name')->comment('买家名称');
  $table->integer('number')->comment('数量');
  $table->integer('status')->comment('订单状态：申请，协商，确定，交易，结果');
php artisan migrate







======================================
-- 数据库切换
DB_HOST=192.168.1.100
DB_DATABASE=culture
DB_USERNAME=root
DB_PASSWORD=
======================================
-- 命令式操作
php artisan make:controller Admin/ActionController

======================================
cd /usr/local/mysql/bin/
-- 导出数据库
mysqldump -uroot -p cul_business > /var/wwwnew/culture/DB.sql
-- 导入数据库
mysqldump -uroot -p cul_business < /var/wwwnew/culture/DB.sql
======================================
-- 添加环境变量
-- 当前会话有用
export PATH=$PATH:/usr/local/php/bin
-- 全局方式
-- vim /etc/profile
-- 在文档最后，添加:
-- export PATH="/opt/STM/STLinux-2.3/devkit/sh4/bin:$PATH"
-- 保存，退出，然后运行：
-- source /etc/profile
-- 不报错则成功