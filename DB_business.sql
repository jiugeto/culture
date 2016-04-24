-- MySQL dump 10.13  Distrib 5.6.27, for Linux (i686)
--
-- Host: localhost    Database: cul_business
-- ------------------------------------------------------
-- Server version	5.6.27

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `ba_action`
--

DROP TABLE IF EXISTS `ba_action`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ba_action` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL COMMENT '权限名称',
  `intro` varchar(255) DEFAULT NULL COMMENT '权限说明',
  `namespace` varchar(255) NOT NULL COMMENT '命名空间',
  `controller_prefix` varchar(255) NOT NULL DEFAULT '' COMMENT '控制器名称',
  `url` varchar(255) NOT NULL COMMENT '访问路径的部分 url',
  `action` varchar(255) NOT NULL COMMENT '操作方法名称',
  `style_class` varchar(255) DEFAULT NULL COMMENT 'class样式名称',
  `pid` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '上级ID',
  `sort` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '排序，数字越大越靠前面',
  `created_at` date NOT NULL DEFAULT '0000-00-00' COMMENT '创建时间',
  `updated_at` date NOT NULL DEFAULT '0000-00-00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=39 DEFAULT CHARSET=utf8 COMMENT='系统管理员权限表';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ba_action`
--

LOCK TABLES `ba_action` WRITE;
/*!40000 ALTER TABLE `ba_action` DISABLE KEYS */;
INSERT INTO `ba_action` VALUES (1,'首页','','App\\Http\\Controllers\\Admin','Home','home','index','am-cf',0,0,'2016-01-09','0000-00-00'),(2,'权限管理','','App\\Http\\Controllers\\Admin','Action','action','index','am-cf',0,0,'2016-01-09','0000-00-00'),(3,'操作管理','','App\\Http\\Controllers\\Admin','Action','action','index','am-cf',2,0,'2016-01-10','2016-01-12'),(4,'资料审核','','App\\Http\\Controllers\\Admin','Action','action','index','am-cf',0,0,'0000-00-00','2016-01-10'),(5,'供求管理','企业，设计师的','App\\Http\\Controllers\\Admin','Goods','goods','index','am-cf',0,0,'0000-00-00','2016-04-09'),(6,'角色管理','','App\\Http\\Controllers\\Admin','Role','role','index','am-cf',2,0,'0000-00-00','2016-01-12'),(7,'管理员管理','','App\\Http\\Controllers\\Admin','Admin','admin','index','am-cf',2,0,'2016-01-12','2016-01-12'),(8,'产品管理','','App\\Http\\Controllers\\Admin','Product','action','index','am-cf',0,0,'2016-01-12','2016-02-16'),(9,'系统管理','','App\\Http\\Controllers\\Admin','Action','action','index','am-cf',0,0,'2016-01-12','0000-00-00'),(10,'话题管理','','App\\Http\\Controllers\\Admin','Action','action','index','am-cf',0,0,'2016-01-12','0000-00-00'),(11,'其他管理2','','App\\Http\\Controllers\\Admin','Action','action','index','am-cf',0,0,'2016-01-12','0000-00-00'),(12,'功能管理','','App\\Http\\Controllers\\Admin','Action','action','index','am-cf',0,0,'2016-01-12','2016-04-04'),(13,'消息管理','','App\\Http\\Controllers\\Admin','Message','message','index','am-cf',12,0,'2016-01-12','0000-00-00'),(14,'链接管理','','App\\Http\\Controllers\\Admin','Link','link','index','am-cf',12,0,'2016-01-12','0000-00-00'),(15,'心声管理','','App\\Http\\Controllers\\Admin','UserVoice','uservoice','index','am-cf',12,0,'2016-01-12','2016-04-09'),(16,'类型管理','','App\\Http\\Controllers\\Admin','Type','type','index','am-cf',12,0,'2016-01-13','2016-04-11'),(17,'图片管理','','App\\Http\\Controllers\\Admin','Pic','pic','index','am-cf',12,0,'2016-01-13','2016-04-11'),(18,'广告管理','','App\\Http\\Controllers\\Admin','Ad','ad','index','am-cf',0,0,'2016-02-15','0000-00-00'),(19,'广告管理','','App\\Http\\Controllers\\Admin','Ad','ad','index','am-cf',18,0,'2016-02-15','0000-00-00'),(20,'广告位管理','','App\\Http\\Controllers\\Admin','AdPlace','place','index','am-cf',18,0,'2016-02-15','0000-00-00'),(21,'内部产品','','App\\Http\\Controllers\\Admin','Product','product','index','',8,0,'2016-02-16','2016-02-16'),(22,'产品属性','','App\\Http\\Controllers\\Admin','ProductAttr','productattr','index','',8,0,'2016-02-16','0000-00-00'),(23,'作品管理','制作公司，设计师的','App\\Http\\Controllers\\Admin','Goods','goods','index','',5,0,'2016-02-16','2016-04-09'),(24,'产品类型','','App\\Http\\Controllers\\Admin','Category','category','index','',12,5,'2016-02-16','2016-04-11'),(25,'租赁管理','','App\\Http\\Controllers\\Admin','Rent','rent','index','',5,0,'2016-02-16','0000-00-00'),(26,'娱乐管理','','App\\Http\\Controllers\\Admin','Entertain','entertain','index','',5,0,'2016-02-16','0000-00-00'),(27,'设计管理','','App\\Http\\Controllers\\Admin','Design','design','index','',5,0,'2016-02-17','0000-00-00'),(28,'用户权限','','App\\Http\\Controllers\\Admin','Authorization','authorization','index','',2,0,'2016-02-17','0000-00-00'),(29,'前台功能','','App\\Http\\Controllers\\Admin','Function','function','index','',2,0,'2016-02-17','0000-00-00'),(30,'前台控制菜单','','App\\Http\\Controllers\\Admin','Menus','menus','index','',2,0,'2016-02-29','0000-00-00'),(31,'意见管理','','App\\Http\\Controllers\\Admin','Opinions','opinions','index','',12,0,'2016-04-04','0000-00-00'),(32,'用户日志','','App\\Http\\Controllers\\Admin','Userlog','userlog','index','',9,0,'2016-04-07','2016-04-11'),(33,'会员管理','','App\\Http\\Controllers\\Admin','User','user','index','',4,0,'2016-04-11','0000-00-00'),(34,'地区管理','','App\\Http\\Controllers\\Admin','Area','area','index','',12,0,'2016-04-11','0000-00-00'),(35,'版本管理','','App\\Http\\Controllers\\Admin','Versionlog','versionlog','index','',9,0,'2016-04-15','0000-00-00'),(36,'创意管理','','App\\Http\\Controllers\\Admin','Idea','idea','index','',5,0,'2016-04-16','0000-00-00'),(37,'话题列表','','App\\Http\\Controllers\\Admin','Talk','talk','index','',10,0,'2016-04-17','0000-00-00'),(38,'演员管理','','App\\Http\\Controllers\\Admin','Actor','actor','index','',5,0,'2016-04-23','0000-00-00');
/*!40000 ALTER TABLE `ba_action` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ba_admin`
--

DROP TABLE IF EXISTS `ba_admin`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ba_admin` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(255) NOT NULL COMMENT '管理员名称',
  `realname` varchar(255) NOT NULL COMMENT '真实名字',
  `email` varchar(255) NOT NULL COMMENT '邮箱',
  `password` varchar(255) NOT NULL COMMENT '登陆密码',
  `role_id` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '管理员组别，关联ba_role',
  `intro` varchar(255) DEFAULT NULL COMMENT '管理员介绍',
  `limit` int(10) unsigned NOT NULL DEFAULT '10' COMMENT '列表每页记录数，默认10条',
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP COMMENT '创建时间',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP COMMENT '更新时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COMMENT='系统后台管理员表（登陆者）';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ba_admin`
--

LOCK TABLES `ba_admin` WRITE;
/*!40000 ALTER TABLE `ba_admin` DISABLE KEYS */;
INSERT INTO `ba_admin` VALUES (1,'jiuge','jiuge','','jiuge',1,'',10,'2016-04-04 16:00:00','0000-00-00 00:00:00');
/*!40000 ALTER TABLE `ba_admin` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ba_role`
--

DROP TABLE IF EXISTS `ba_role`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ba_role` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL COMMENT '角色名称',
  `intro` varchar(255) NOT NULL COMMENT '角色简介',
  `created_at` date NOT NULL DEFAULT '0000-00-00' COMMENT '创建时间',
  `updated_at` date NOT NULL DEFAULT '0000-00-00' COMMENT '更新时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COMMENT='系统后台角色表（管理组别）';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ba_role`
--

LOCK TABLES `ba_role` WRITE;
/*!40000 ALTER TABLE `ba_role` DISABLE KEYS */;
INSERT INTO `ba_role` VALUES (1,'超级管理员','最高权限','2016-04-05','0000-00-00');
/*!40000 ALTER TABLE `ba_role` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ba_role_action`
--

DROP TABLE IF EXISTS `ba_role_action`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ba_role_action` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `role_id` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '角色ID',
  `action_id` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '权限ID',
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP COMMENT '创建时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='管理组与权限对应表';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ba_role_action`
--

LOCK TABLES `ba_role_action` WRITE;
/*!40000 ALTER TABLE `ba_role_action` DISABLE KEYS */;
/*!40000 ALTER TABLE `ba_role_action` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ba_userlog`
--

DROP TABLE IF EXISTS `ba_userlog`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ba_userlog` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `plat` tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT '平台标识：1管理员登录，2用户登录',
  `uid` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '用户id',
  `uname` varchar(255) NOT NULL COMMENT '用户名称',
  `serial` varchar(20) NOT NULL COMMENT '序号，唯一标识',
  `loginTime` date NOT NULL DEFAULT '0000-00-00' COMMENT '登陆时间',
  `logoutTime` date NOT NULL DEFAULT '0000-00-00' COMMENT '退出时间',
  `created_at` date NOT NULL DEFAULT '0000-00-00' COMMENT '创建时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=40 DEFAULT CHARSET=utf8 COMMENT='用户日志表';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ba_userlog`
--

LOCK TABLES `ba_userlog` WRITE;
/*!40000 ALTER TABLE `ba_userlog` DISABLE KEYS */;
INSERT INTO `ba_userlog` VALUES (1,1,1,'jiuge','201604090047077935','2016-04-09','2016-04-09','2016-04-05'),(2,1,1,'jiuge','20160409004918108','2016-04-09','0000-00-00','2016-04-05'),(3,1,1,'jiuge','201604090437083847','2016-04-09','0000-00-00','2016-04-05'),(4,1,1,'jiuge','201604091015518376','2016-04-09','0000-00-00','2016-04-05'),(5,2,1,'jiuge','201604091059097936','2016-04-09','0000-00-00','2016-04-06'),(6,2,1,'jiuge','201604091412047608','2016-04-09','0000-00-00','2016-04-06'),(7,2,1,'jiuge','201604100215434109','2016-04-10','0000-00-00','2016-04-06'),(8,2,1,'jiuge','201604101055219452','2016-04-10','0000-00-00','2016-04-06'),(9,2,1,'jiuge','20160410132948873','2016-04-10','0000-00-00','2016-04-06'),(10,1,1,'jiuge','201604110108163281','2016-04-11','0000-00-00','2016-04-05'),(11,1,1,'jiuge','201604110902034586','2016-04-11','0000-00-00','2016-04-05'),(12,1,1,'jiuge','201604111319349561','2016-04-11','0000-00-00','2016-04-05'),(13,2,1,'jiuge','201604120033529357','2016-04-12','0000-00-00','2016-04-06'),(14,1,1,'jiuge','201604120034091653','2016-04-12','2016-04-12','2016-04-05'),(15,2,1,'jiuge','201604120037364998','2016-04-12','2016-04-12','2016-04-06'),(16,1,1,'jiuge','201604121221289312','2016-04-12','2016-04-12','2016-04-05'),(17,2,1,'jiuge','201604121231351384','2016-04-12','2016-04-12','2016-04-06'),(18,1,1,'jiuge','201604121233022375','2016-04-12','2016-04-12','2016-04-05'),(19,1,1,'jiuge','201604150217508806','2016-04-15','0000-00-00','2016-04-05'),(20,1,1,'jiuge','201604160759374265','2016-04-16','0000-00-00','2016-04-05'),(21,2,1,'jiuge','201604161520191699','2016-04-16','2016-04-16','2016-04-06'),(22,1,1,'jiuge','201604161522083742','2016-04-16','2016-04-16','2016-04-05'),(23,1,1,'jiuge','201604161527372619','2016-04-16','2016-04-16','2016-04-05'),(24,2,1,'jiuge','2016041700561299','2016-04-17','2016-04-17','2016-04-06'),(25,1,1,'jiuge','201604170248081428','2016-04-17','2016-04-17','2016-04-05'),(26,1,1,'jiuge','201604171200175488','2016-04-17','2016-04-17','2016-04-05'),(27,2,1,'jiuge','201604171203246134','2016-04-17','2016-04-17','2016-04-06'),(28,2,1,'jiuge','201604191526236409','2016-04-19','0000-00-00','2016-04-06'),(29,2,1,'jiuge','201604200124491317','2016-04-20','0000-00-00','2016-04-06'),(30,1,1,'jiuge','201604201245341735','2016-04-20','2016-04-20','2016-04-05'),(31,1,1,'jiuge','201604201400413759','2016-04-20','2016-04-20','2016-04-05'),(32,2,1,'jiuge','201604211438122098','2016-04-21','0000-00-00','2016-04-06'),(33,2,1,'jiuge','20160422014040960','2016-04-22','0000-00-00','2016-04-06'),(34,2,1,'jiuge','201604221345581795','2016-04-22','0000-00-00','2016-04-06'),(35,1,1,'jiuge','201604221436379033','2016-04-22','0000-00-00','2016-04-05'),(36,2,1,'jiuge','201604230059124482','2016-04-23','0000-00-00','2016-04-06'),(37,2,1,'jiuge','201604230818162321','2016-04-23','0000-00-00','2016-04-06'),(38,2,1,'jiuge','201604231516405256','2016-04-23','2016-04-23','2016-04-06'),(39,1,1,'jiuge','201604231634069910','2016-04-23','2016-04-23','2016-04-05');
/*!40000 ALTER TABLE `ba_userlog` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ba_versions`
--

DROP TABLE IF EXISTS `ba_versions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ba_versions` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL COMMENT '名称',
  `intro` varchar(2000) NOT NULL COMMENT '修改的内容',
  `created_at` datetime NOT NULL DEFAULT '0000-00-00 00:00:00' COMMENT '创建时间',
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COMMENT='修改（版本）日志表：开发者自己记录使用';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ba_versions`
--

LOCK TABLES `ba_versions` WRITE;
/*!40000 ALTER TABLE `ba_versions` DISABLE KEYS */;
INSERT INTO `ba_versions` VALUES (2,'修改2','<p>fdbfdbgnttghngfnghn不同风格日发布的个v</p><p>让他发布GV</p>','2016-04-16 14:46:20','0000-00-00 00:00:00');
/*!40000 ALTER TABLE `ba_versions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `bs_actor_pic`
--

DROP TABLE IF EXISTS `bs_actor_pic`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `bs_actor_pic` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `actor_id` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '演员id',
  `pic_id` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '图片id',
  `created_at` date NOT NULL DEFAULT '0000-00-00' COMMENT '创建时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='演员图片关联表 bs_actor_pic';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `bs_actor_pic`
--

LOCK TABLES `bs_actor_pic` WRITE;
/*!40000 ALTER TABLE `bs_actor_pic` DISABLE KEYS */;
/*!40000 ALTER TABLE `bs_actor_pic` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `bs_actor_work`
--

DROP TABLE IF EXISTS `bs_actor_work`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `bs_actor_work` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `actorid` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '演员id',
  `workid` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '影视作品id',
  `created_at` datetime NOT NULL DEFAULT '0000-00-00 00:00:00' COMMENT '创建时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='演员作品关联表';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `bs_actor_work`
--

LOCK TABLES `bs_actor_work` WRITE;
/*!40000 ALTER TABLE `bs_actor_work` DISABLE KEYS */;
/*!40000 ALTER TABLE `bs_actor_work` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `bs_actors`
--

DROP TABLE IF EXISTS `bs_actors`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `bs_actors` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL COMMENT '演员名称',
  `sex` tinyint(3) unsigned NOT NULL DEFAULT '1' COMMENT '性别：1男，2女',
  `realname` varchar(255) NOT NULL COMMENT '真实名字',
  `origin` varchar(255) NOT NULL COMMENT '籍贯',
  `education` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '学历',
  `school` varchar(255) NOT NULL COMMENT '毕业学校',
  `hobby` varchar(255) NOT NULL COMMENT '爱好',
  `job` varchar(255) NOT NULL DEFAULT '' COMMENT '职业',
  `area` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '所在地',
  `height` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '身高，单位cm',
  `created_at` datetime NOT NULL DEFAULT '0000-00-00 00:00:00' COMMENT '创建时间',
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COMMENT='演员表 bs_actors';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `bs_actors`
--

LOCK TABLES `bs_actors` WRITE;
/*!40000 ALTER TABLE `bs_actors` DISABLE KEYS */;
INSERT INTO `bs_actors` VALUES (1,'拿斧头男',1,'能否规范','个人方法',1,'他人观花','','',0,172,'2016-04-23 17:11:43','0000-00-00 00:00:00');
/*!40000 ALTER TABLE `bs_actors` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `bs_ad_places`
--

DROP TABLE IF EXISTS `bs_ad_places`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `bs_ad_places` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL COMMENT '广告位名称',
  `intro` varchar(500) DEFAULT NULL COMMENT '广告位简介 ',
  `type_id` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '广告位类型，关联bs_types',
  `uid` int(10) unsigned DEFAULT '0' COMMENT '用户id',
  `width` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '广告位宽度，单位px',
  `height` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '广告位高度，单位px',
  `price` decimal(10,0) unsigned NOT NULL DEFAULT '0' COMMENT '广告位价格，单位元/月',
  `number` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '广告数量',
  `del` tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT '回收站功能：0不放入回收站，1放入回收站',
  `created_at` date NOT NULL DEFAULT '0000-00-00' COMMENT '创建时间',
  `updated_at` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='类型表';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `bs_ad_places`
--

LOCK TABLES `bs_ad_places` WRITE;
/*!40000 ALTER TABLE `bs_ad_places` DISABLE KEYS */;
/*!40000 ALTER TABLE `bs_ad_places` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `bs_ads`
--

DROP TABLE IF EXISTS `bs_ads`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `bs_ads` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL COMMENT '广告名称',
  `ad_place_id` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '广告位id，关联bs_ad_place',
  `intro` varchar(500) DEFAULT NULL COMMENT '广告内容',
  `pic_id` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '图片链接id，关联bs_pics',
  `link` varchar(255) NOT NULL COMMENT '广告链接',
  `fromtime` int(10) unsigned NOT NULL COMMENT '投放开始时间',
  `totime` int(10) unsigned NOT NULL COMMENT '投放结束时间',
  `uid` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '发布会员id',
  `uname` varchar(255) NOT NULL COMMENT '用户名称',
  `auth` tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT '审核状态：0未审核，1未通过审核，2通过审核',
  `status` tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT '投放状态：0未投放，1已过期，2投放中',
  `del` tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT '回收站功能：0不放入回收站，1放入回收站',
  `created_at` date NOT NULL DEFAULT '0000-00-00' COMMENT '创建时间',
  `updated_at` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='类型表';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `bs_ads`
--

LOCK TABLES `bs_ads` WRITE;
/*!40000 ALTER TABLE `bs_ads` DISABLE KEYS */;
/*!40000 ALTER TABLE `bs_ads` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `bs_auth_func`
--

DROP TABLE IF EXISTS `bs_auth_func`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `bs_auth_func` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `level_id` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '权限级别id',
  `func_id` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '功能id',
  `created_at` date NOT NULL DEFAULT '0000-00-00' COMMENT '创建时间',
  `updated_at` date NOT NULL DEFAULT '0000-00-00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='权限功能表 bs_auth_func（前台用户功能分配）\r\n备注：用户组bs_auth_func中有记录，说明该用户有此功能\r\n';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `bs_auth_func`
--

LOCK TABLES `bs_auth_func` WRITE;
/*!40000 ALTER TABLE `bs_auth_func` DISABLE KEYS */;
/*!40000 ALTER TABLE `bs_auth_func` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `bs_authorizations`
--

DROP TABLE IF EXISTS `bs_authorizations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `bs_authorizations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `uid` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '用户id',
  `level_id` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '用户级别关联bs_user_level：匿名用户，普通用户，初级会员，',
  `created_at` date NOT NULL DEFAULT '0000-00-00' COMMENT '创建时间',
  `updated_at` date NOT NULL DEFAULT '0000-00-00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='权限表 bs_authorization（用户权限分配）';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `bs_authorizations`
--

LOCK TABLES `bs_authorizations` WRITE;
/*!40000 ALTER TABLE `bs_authorizations` DISABLE KEYS */;
/*!40000 ALTER TABLE `bs_authorizations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `bs_category`
--

DROP TABLE IF EXISTS `bs_category`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `bs_category` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL COMMENT '视频分类名称',
  `pid` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '父id',
  `intro` varchar(1000) DEFAULT NULL COMMENT '分类简介',
  `del` tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT '回收站功能：0不放入回收站，1放入回收站',
  `created_at` date NOT NULL DEFAULT '0000-00-00' COMMENT '创建时间',
  `updated_at` date NOT NULL DEFAULT '0000-00-00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8 COMMENT='分类表 bs_category';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `bs_category`
--

LOCK TABLES `bs_category` WRITE;
/*!40000 ALTER TABLE `bs_category` DISABLE KEYS */;
INSERT INTO `bs_category` VALUES (1,'专业',0,'按专业分类',0,'2016-03-13','2016-03-13'),(2,'行业',0,'按行业分类',0,'2016-03-17','0000-00-00'),(3,'年龄',0,'按年龄分类',0,'2016-03-17','0000-00-00'),(4,'视频',1,'视频组',0,'2016-03-17','0000-00-00'),(5,'平面设计',1,'平面组',0,'2016-03-17','0000-00-00'),(6,'建筑设计',1,'建筑组',0,'2016-03-17','0000-00-00'),(7,'房产漫游',1,'房产组，包括效果图',0,'2016-03-17','0000-00-00'),(8,'游戏制作',1,'游戏组，包括Unity 3D',0,'2016-03-17','0000-00-00');
/*!40000 ALTER TABLE `bs_category` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `bs_citys`
--

DROP TABLE IF EXISTS `bs_citys`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `bs_citys` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `parentid` int(11) NOT NULL COMMENT '父级省市ID',
  `cityname` varchar(60) NOT NULL COMMENT '城市名称',
  `nocode` int(6) NOT NULL DEFAULT '0' COMMENT '城市编号,身份证前6位,全国统一编号',
  `zipcode` int(6) NOT NULL DEFAULT '0' COMMENT '对应的邮政编码',
  `weathercode` int(9) NOT NULL DEFAULT '0' COMMENT '中国天气网对应的城市ID',
  `created_at` date NOT NULL COMMENT '创建时间',
  `updated_at` date NOT NULL COMMENT '更新时间',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3050 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `bs_citys`
--

LOCK TABLES `bs_citys` WRITE;
/*!40000 ALTER TABLE `bs_citys` DISABLE KEYS */;
INSERT INTO `bs_citys` VALUES (1,0,'北京市',110000,0,0,'0000-00-00','0000-00-00'),(2,0,'天津市',120000,0,0,'0000-00-00','0000-00-00'),(3,0,'河北省',130000,0,0,'0000-00-00','0000-00-00'),(4,0,'山西省',140000,0,0,'0000-00-00','0000-00-00'),(5,0,'内蒙古',150000,0,0,'0000-00-00','0000-00-00'),(6,0,'辽宁省',210000,0,0,'0000-00-00','0000-00-00'),(7,0,'吉林省',220000,0,0,'0000-00-00','0000-00-00'),(8,0,'黑龙江省',230000,0,0,'0000-00-00','0000-00-00'),(9,0,'上海市',310000,0,0,'0000-00-00','0000-00-00'),(10,0,'江苏省',320000,0,0,'0000-00-00','0000-00-00'),(11,0,'浙江省',330000,0,0,'0000-00-00','0000-00-00'),(12,0,'安徽省',340000,0,0,'0000-00-00','0000-00-00'),(13,0,'福建省',350000,0,0,'0000-00-00','0000-00-00'),(14,0,'江西省',360000,0,0,'0000-00-00','0000-00-00'),(15,0,'山东省',370000,0,0,'0000-00-00','0000-00-00'),(16,0,'河南省',410000,0,0,'0000-00-00','0000-00-00'),(17,0,'湖北省',420000,0,0,'0000-00-00','0000-00-00'),(18,0,'湖南省',430000,0,0,'0000-00-00','0000-00-00'),(19,0,'广东省',440000,0,0,'0000-00-00','0000-00-00'),(20,0,'广西',450000,0,0,'0000-00-00','0000-00-00'),(21,0,'海南省',460000,0,0,'0000-00-00','0000-00-00'),(22,0,'重庆市',500000,0,0,'0000-00-00','0000-00-00'),(23,0,'四川省',510000,0,0,'0000-00-00','0000-00-00'),(24,0,'贵州省',520000,0,0,'0000-00-00','0000-00-00'),(25,0,'云南省',530000,0,0,'0000-00-00','0000-00-00'),(26,0,'西藏',540000,0,0,'0000-00-00','0000-00-00'),(27,0,'陕西省',610000,0,0,'0000-00-00','0000-00-00'),(28,0,'甘肃省',620000,0,0,'0000-00-00','0000-00-00'),(29,0,'青海省',630000,0,0,'0000-00-00','0000-00-00'),(30,0,'宁夏',640000,0,0,'0000-00-00','0000-00-00'),(31,0,'新疆维吾尔',650000,0,0,'0000-00-00','0000-00-00'),(32,0,'香港',810000,0,0,'0000-00-00','0000-00-00'),(33,0,'澳门',820000,0,0,'0000-00-00','0000-00-00'),(34,1,'东城区',110101,0,0,'0000-00-00','0000-00-00'),(35,1,'西城区',110102,0,0,'0000-00-00','0000-00-00'),(36,1,'朝阳区',110105,0,0,'0000-00-00','0000-00-00'),(37,1,'丰台区',110106,0,0,'0000-00-00','0000-00-00'),(38,1,'石景山区',110107,0,0,'0000-00-00','0000-00-00'),(39,1,'海淀区',110108,0,0,'0000-00-00','0000-00-00'),(40,1,'门头沟区',110109,0,0,'0000-00-00','0000-00-00'),(41,1,'房山区',110111,0,0,'0000-00-00','0000-00-00'),(42,1,'通州区',110112,0,0,'0000-00-00','0000-00-00'),(43,1,'顺义区',110113,0,0,'0000-00-00','0000-00-00'),(44,1,'昌平区',110114,0,0,'0000-00-00','0000-00-00'),(45,1,'大兴区',110115,0,0,'0000-00-00','0000-00-00'),(46,1,'怀柔区',110116,0,0,'0000-00-00','0000-00-00'),(47,1,'平谷区',110117,0,0,'0000-00-00','0000-00-00'),(48,1,'密云县',110228,0,0,'0000-00-00','0000-00-00'),(49,1,'延庆县',110229,0,0,'0000-00-00','0000-00-00'),(50,2,'和平区',120101,0,0,'0000-00-00','0000-00-00'),(51,2,'河东区',120102,0,0,'0000-00-00','0000-00-00'),(52,2,'河西区',120103,0,0,'0000-00-00','0000-00-00'),(53,2,'南开区',120104,0,0,'0000-00-00','0000-00-00'),(54,2,'河北区',120105,0,0,'0000-00-00','0000-00-00'),(55,2,'红桥区',120106,0,0,'0000-00-00','0000-00-00'),(56,2,'东丽区',120110,0,0,'0000-00-00','0000-00-00'),(57,2,'西青区',120111,0,0,'0000-00-00','0000-00-00'),(58,2,'津南区',120112,0,0,'0000-00-00','0000-00-00'),(59,2,'北辰区',120113,0,0,'0000-00-00','0000-00-00'),(60,2,'武清区',120114,0,0,'0000-00-00','0000-00-00'),(61,2,'宝坻区',120115,0,0,'0000-00-00','0000-00-00'),(62,2,'滨海新区',120116,0,0,'0000-00-00','0000-00-00'),(63,2,'宁河县',120221,0,0,'0000-00-00','0000-00-00'),(64,2,'静海县',120223,0,0,'0000-00-00','0000-00-00'),(65,2,'蓟县',120225,0,0,'0000-00-00','0000-00-00'),(66,3,'石家庄市',130100,0,0,'0000-00-00','0000-00-00'),(67,3,'唐山市',130200,0,0,'0000-00-00','0000-00-00'),(68,3,'秦皇岛市',130300,0,0,'0000-00-00','0000-00-00'),(69,3,'邯郸市',130400,0,0,'0000-00-00','0000-00-00'),(70,3,'邢台市',130500,0,0,'0000-00-00','0000-00-00'),(71,3,'保定市',130600,0,0,'0000-00-00','0000-00-00'),(72,3,'张家口市',130700,0,0,'0000-00-00','0000-00-00'),(73,3,'承德市',130800,0,0,'0000-00-00','0000-00-00'),(74,3,'沧州市',130900,0,0,'0000-00-00','0000-00-00'),(75,3,'廊坊市',131000,0,0,'0000-00-00','0000-00-00'),(76,3,'衡水市',131100,0,0,'0000-00-00','0000-00-00'),(77,4,'太原市',140100,0,0,'0000-00-00','0000-00-00'),(78,4,'大同市',140200,0,0,'0000-00-00','0000-00-00'),(79,4,'阳泉市',140300,0,0,'0000-00-00','0000-00-00'),(80,4,'长治市',140400,0,0,'0000-00-00','0000-00-00'),(81,4,'晋城市',140500,0,0,'0000-00-00','0000-00-00'),(82,4,'朔州市',140600,0,0,'0000-00-00','0000-00-00'),(83,4,'晋中市',140700,0,0,'0000-00-00','0000-00-00'),(84,4,'运城市',140800,0,0,'0000-00-00','0000-00-00'),(85,4,'忻州市',140900,0,0,'0000-00-00','0000-00-00'),(86,4,'临汾市',141000,0,0,'0000-00-00','0000-00-00'),(87,4,'吕梁市',141100,0,0,'0000-00-00','0000-00-00'),(88,5,'呼和浩特市',150100,0,0,'0000-00-00','0000-00-00'),(89,5,'包头市',150200,0,0,'0000-00-00','0000-00-00'),(90,5,'乌海市',150300,0,0,'0000-00-00','0000-00-00'),(91,5,'赤峰市',150400,0,0,'0000-00-00','0000-00-00'),(92,5,'通辽市',150500,0,0,'0000-00-00','0000-00-00'),(93,5,'鄂尔多斯市',150600,0,0,'0000-00-00','0000-00-00'),(94,5,'呼伦贝尔市',150700,0,0,'0000-00-00','0000-00-00'),(95,5,'巴彦淖尔市',150800,0,0,'0000-00-00','0000-00-00'),(96,5,'乌兰察布市',150900,0,0,'0000-00-00','0000-00-00'),(97,5,'兴安盟',152200,0,0,'0000-00-00','0000-00-00'),(98,5,'锡林郭勒盟',152500,0,0,'0000-00-00','0000-00-00'),(99,5,'阿拉善盟',152900,0,0,'0000-00-00','0000-00-00'),(100,6,'沈阳市',210100,0,0,'0000-00-00','0000-00-00'),(101,6,'大连市',210200,0,0,'0000-00-00','0000-00-00'),(102,6,'鞍山市',210300,0,0,'0000-00-00','0000-00-00'),(103,6,'抚顺市',210400,0,0,'0000-00-00','0000-00-00'),(104,6,'本溪市',210500,0,0,'0000-00-00','0000-00-00'),(105,6,'丹东市',210600,0,0,'0000-00-00','0000-00-00'),(106,6,'锦州市',210700,0,0,'0000-00-00','0000-00-00'),(107,6,'营口市',210800,0,0,'0000-00-00','0000-00-00'),(108,6,'阜新市',210900,0,0,'0000-00-00','0000-00-00'),(109,6,'辽阳市',211000,0,0,'0000-00-00','0000-00-00'),(110,6,'盘锦市',211100,0,0,'0000-00-00','0000-00-00'),(111,6,'铁岭市',211200,0,0,'0000-00-00','0000-00-00'),(112,6,'朝阳市',211300,0,0,'0000-00-00','0000-00-00'),(113,6,'葫芦岛市',211400,0,0,'0000-00-00','0000-00-00'),(114,7,'长春市',220100,0,0,'0000-00-00','0000-00-00'),(115,7,'吉林市',220200,0,0,'0000-00-00','0000-00-00'),(116,7,'四平市',220300,0,0,'0000-00-00','0000-00-00'),(117,7,'辽源市',220400,0,0,'0000-00-00','0000-00-00'),(118,7,'通化市',220500,0,0,'0000-00-00','0000-00-00'),(119,7,'白山市',220600,0,0,'0000-00-00','0000-00-00'),(120,7,'松原市',220700,0,0,'0000-00-00','0000-00-00'),(121,7,'白城市',220800,0,0,'0000-00-00','0000-00-00'),(122,7,'延边朝鲜族',222400,0,0,'0000-00-00','0000-00-00'),(123,8,'哈尔滨市',230100,0,0,'0000-00-00','0000-00-00'),(124,8,'齐齐哈尔市',230200,0,0,'0000-00-00','0000-00-00'),(125,8,'鸡西市',230300,0,0,'0000-00-00','0000-00-00'),(126,8,'鹤岗市',230400,0,0,'0000-00-00','0000-00-00'),(127,8,'双鸭山市',230500,0,0,'0000-00-00','0000-00-00'),(128,8,'大庆市',230600,0,0,'0000-00-00','0000-00-00'),(129,8,'伊春市',230700,0,0,'0000-00-00','0000-00-00'),(130,8,'佳木斯市',230800,0,0,'0000-00-00','0000-00-00'),(131,8,'七台河市',230900,0,0,'0000-00-00','0000-00-00'),(132,8,'牡丹江市',231000,0,0,'0000-00-00','0000-00-00'),(133,8,'黑河市',231100,0,0,'0000-00-00','0000-00-00'),(134,8,'绥化市',231200,0,0,'0000-00-00','0000-00-00'),(135,8,'大兴安岭地区',232700,0,0,'0000-00-00','0000-00-00'),(136,9,'黄浦区',310101,0,0,'0000-00-00','0000-00-00'),(137,9,'徐汇区',310104,0,0,'0000-00-00','0000-00-00'),(138,9,'长宁区',310105,0,0,'0000-00-00','0000-00-00'),(139,9,'静安区',310106,0,0,'0000-00-00','0000-00-00'),(140,9,'普陀区',310107,0,0,'0000-00-00','0000-00-00'),(141,9,'闸北区',310108,0,0,'0000-00-00','0000-00-00'),(142,9,'虹口区',310109,0,0,'0000-00-00','0000-00-00'),(143,9,'杨浦区',310110,0,0,'0000-00-00','0000-00-00'),(144,9,'闵行区',310112,0,0,'0000-00-00','0000-00-00'),(145,9,'宝山区',310113,0,0,'0000-00-00','0000-00-00'),(146,9,'嘉定区',310114,0,0,'0000-00-00','0000-00-00'),(147,9,'浦东新区',310115,0,0,'0000-00-00','0000-00-00'),(148,9,'金山区',310116,0,0,'0000-00-00','0000-00-00'),(149,9,'松江区',310117,0,0,'0000-00-00','0000-00-00'),(150,9,'青浦区',310118,0,0,'0000-00-00','0000-00-00'),(151,9,'奉贤区',310120,0,0,'0000-00-00','0000-00-00'),(152,9,'崇明县',310230,0,0,'0000-00-00','0000-00-00'),(153,10,'南京市',320100,0,0,'0000-00-00','0000-00-00'),(154,10,'无锡市',320200,0,0,'0000-00-00','0000-00-00'),(155,10,'徐州市',320300,0,0,'0000-00-00','0000-00-00'),(156,10,'常州市',320400,0,0,'0000-00-00','0000-00-00'),(157,10,'苏州市',320500,0,0,'0000-00-00','0000-00-00'),(158,10,'南通市',320600,0,0,'0000-00-00','0000-00-00'),(159,10,'连云港市',320700,0,0,'0000-00-00','0000-00-00'),(160,10,'淮安市',320800,0,0,'0000-00-00','0000-00-00'),(161,10,'盐城市',320900,0,0,'0000-00-00','0000-00-00'),(162,10,'扬州市',321000,0,0,'0000-00-00','0000-00-00'),(163,10,'镇江市',321100,0,0,'0000-00-00','0000-00-00'),(164,10,'泰州市',321200,0,0,'0000-00-00','0000-00-00'),(165,10,'宿迁市',321300,0,0,'0000-00-00','0000-00-00'),(166,11,'杭州市',330100,0,0,'0000-00-00','0000-00-00'),(167,11,'宁波市',330200,0,0,'0000-00-00','0000-00-00'),(168,11,'温州市',330300,0,0,'0000-00-00','0000-00-00'),(169,11,'嘉兴市',330400,0,0,'0000-00-00','0000-00-00'),(170,11,'湖州市',330500,0,0,'0000-00-00','0000-00-00'),(171,11,'绍兴市',330600,0,0,'0000-00-00','0000-00-00'),(172,11,'金华市',330700,0,0,'0000-00-00','0000-00-00'),(173,11,'衢州市',330800,0,0,'0000-00-00','0000-00-00'),(174,11,'舟山市',330900,0,0,'0000-00-00','0000-00-00'),(175,11,'台州市',331000,0,0,'0000-00-00','0000-00-00'),(176,11,'丽水市',331100,0,0,'0000-00-00','0000-00-00'),(177,12,'合肥市',340100,0,0,'0000-00-00','0000-00-00'),(178,12,'芜湖市',340200,0,0,'0000-00-00','0000-00-00'),(179,12,'蚌埠市',340300,0,0,'0000-00-00','0000-00-00'),(180,12,'淮南市',340400,0,0,'0000-00-00','0000-00-00'),(181,12,'马鞍山市',340500,0,0,'0000-00-00','0000-00-00'),(182,12,'淮北市',340600,0,0,'0000-00-00','0000-00-00'),(183,12,'铜陵市',340700,0,0,'0000-00-00','0000-00-00'),(184,12,'安庆市',340800,0,0,'0000-00-00','0000-00-00'),(185,12,'黄山市',341000,0,0,'0000-00-00','0000-00-00'),(186,12,'滁州市',341100,0,0,'0000-00-00','0000-00-00'),(187,12,'阜阳市',341200,0,0,'0000-00-00','0000-00-00'),(188,12,'宿州市',341300,0,0,'0000-00-00','0000-00-00'),(189,12,'六安市',341500,0,0,'0000-00-00','0000-00-00'),(190,12,'亳州市',341600,0,0,'0000-00-00','0000-00-00'),(191,12,'池州市',341700,0,0,'0000-00-00','0000-00-00'),(192,12,'宣城市',341800,0,0,'0000-00-00','0000-00-00'),(193,13,'福州市',350100,0,0,'0000-00-00','0000-00-00'),(194,13,'厦门市',350200,0,0,'0000-00-00','0000-00-00'),(195,13,'莆田市',350300,0,0,'0000-00-00','0000-00-00'),(196,13,'三明市',350400,0,0,'0000-00-00','0000-00-00'),(197,13,'泉州市',350500,0,0,'0000-00-00','0000-00-00'),(198,13,'漳州市',350600,0,0,'0000-00-00','0000-00-00'),(199,13,'南平市',350700,0,0,'0000-00-00','0000-00-00'),(200,13,'龙岩市',350800,0,0,'0000-00-00','0000-00-00'),(201,13,'宁德市',350900,0,0,'0000-00-00','0000-00-00'),(202,14,'南昌市',360100,0,0,'0000-00-00','0000-00-00'),(203,14,'景德镇市',360200,0,0,'0000-00-00','0000-00-00'),(204,14,'萍乡市',360300,0,0,'0000-00-00','0000-00-00'),(205,14,'九江市',360400,0,0,'0000-00-00','0000-00-00'),(206,14,'新余市',360500,0,0,'0000-00-00','0000-00-00'),(207,14,'鹰潭市',360600,0,0,'0000-00-00','0000-00-00'),(208,14,'赣州市',360700,0,0,'0000-00-00','0000-00-00'),(209,14,'吉安市',360800,0,0,'0000-00-00','0000-00-00'),(210,14,'宜春市',360900,0,0,'0000-00-00','0000-00-00'),(211,14,'抚州市',361000,0,0,'0000-00-00','0000-00-00'),(212,14,'上饶市',361100,0,0,'0000-00-00','0000-00-00'),(213,15,'济南市',370100,0,0,'0000-00-00','0000-00-00'),(214,15,'青岛市',370200,0,0,'0000-00-00','0000-00-00'),(215,15,'淄博市',370300,0,0,'0000-00-00','0000-00-00'),(216,15,'枣庄市',370400,0,0,'0000-00-00','0000-00-00'),(217,15,'东营市',370500,0,0,'0000-00-00','0000-00-00'),(218,15,'烟台市',370600,0,0,'0000-00-00','0000-00-00'),(219,15,'潍坊市',370700,0,0,'0000-00-00','0000-00-00'),(220,15,'济宁市',370800,0,0,'0000-00-00','0000-00-00'),(221,15,'泰安市',370900,0,0,'0000-00-00','0000-00-00'),(222,15,'威海市',371000,0,0,'0000-00-00','0000-00-00'),(223,15,'日照市',371100,0,0,'0000-00-00','0000-00-00'),(224,15,'莱芜市',371200,0,0,'0000-00-00','0000-00-00'),(225,15,'临沂市',371300,0,0,'0000-00-00','0000-00-00'),(226,15,'德州市',371400,0,0,'0000-00-00','0000-00-00'),(227,15,'聊城市',371500,0,0,'0000-00-00','0000-00-00'),(228,15,'滨州市',371600,0,0,'0000-00-00','0000-00-00'),(229,15,'菏泽市',371700,0,0,'0000-00-00','0000-00-00'),(230,16,'郑州市',410100,0,0,'0000-00-00','0000-00-00'),(231,16,'开封市',410200,0,0,'0000-00-00','0000-00-00'),(232,16,'洛阳市',410300,0,0,'0000-00-00','0000-00-00'),(233,16,'平顶山市',410400,0,0,'0000-00-00','0000-00-00'),(234,16,'安阳市',410500,0,0,'0000-00-00','0000-00-00'),(235,16,'鹤壁市',410600,0,0,'0000-00-00','0000-00-00'),(236,16,'新乡市',410700,0,0,'0000-00-00','0000-00-00'),(237,16,'焦作市',410800,0,0,'0000-00-00','0000-00-00'),(238,16,'濮阳市',410900,0,0,'0000-00-00','0000-00-00'),(239,16,'许昌市',411000,0,0,'0000-00-00','0000-00-00'),(240,16,'漯河市',411100,0,0,'0000-00-00','0000-00-00'),(241,16,'三门峡市',411200,0,0,'0000-00-00','0000-00-00'),(242,16,'南阳市',411300,0,0,'0000-00-00','0000-00-00'),(243,16,'商丘市',411400,0,0,'0000-00-00','0000-00-00'),(244,16,'信阳市',411500,0,0,'0000-00-00','0000-00-00'),(245,16,'周口市',411600,0,0,'0000-00-00','0000-00-00'),(246,16,'驻马店市',411700,0,0,'0000-00-00','0000-00-00'),(247,16,'济源市',419001,0,0,'0000-00-00','0000-00-00'),(248,17,'武汉市',420100,0,0,'0000-00-00','0000-00-00'),(249,17,'黄石市',420200,0,0,'0000-00-00','0000-00-00'),(250,17,'十堰市',420300,0,0,'0000-00-00','0000-00-00'),(251,17,'宜昌市',420500,0,0,'0000-00-00','0000-00-00'),(252,17,'襄阳市',420600,0,0,'0000-00-00','0000-00-00'),(253,17,'鄂州市',420700,0,0,'0000-00-00','0000-00-00'),(254,17,'荆门市',420800,0,0,'0000-00-00','0000-00-00'),(255,17,'孝感市',420900,0,0,'0000-00-00','0000-00-00'),(256,17,'荆州市',421000,0,0,'0000-00-00','0000-00-00'),(257,17,'黄冈市',421100,0,0,'0000-00-00','0000-00-00'),(258,17,'咸宁市',421200,0,0,'0000-00-00','0000-00-00'),(259,17,'随州市',421300,0,0,'0000-00-00','0000-00-00'),(260,17,'恩施土家族苗族',422800,0,0,'0000-00-00','0000-00-00'),(261,17,'仙桃市',429004,0,0,'0000-00-00','0000-00-00'),(262,17,'潜江市',429005,0,0,'0000-00-00','0000-00-00'),(263,17,'天门市',429006,0,0,'0000-00-00','0000-00-00'),(264,17,'神农架林区',429021,0,0,'0000-00-00','0000-00-00'),(265,18,'长沙市',430100,0,0,'0000-00-00','0000-00-00'),(266,18,'株洲市',430200,0,0,'0000-00-00','0000-00-00'),(267,18,'湘潭市',430300,0,0,'0000-00-00','0000-00-00'),(268,18,'衡阳市',430400,0,0,'0000-00-00','0000-00-00'),(269,18,'邵阳市',430500,0,0,'0000-00-00','0000-00-00'),(270,18,'岳阳市',430600,0,0,'0000-00-00','0000-00-00'),(271,18,'常德市',430700,0,0,'0000-00-00','0000-00-00'),(272,18,'张家界市',430800,0,0,'0000-00-00','0000-00-00'),(273,18,'益阳市',430900,0,0,'0000-00-00','0000-00-00'),(274,18,'郴州市',431000,0,0,'0000-00-00','0000-00-00'),(275,18,'永州市',431100,0,0,'0000-00-00','0000-00-00'),(276,18,'怀化市',431200,0,0,'0000-00-00','0000-00-00'),(277,18,'娄底市',431300,0,0,'0000-00-00','0000-00-00'),(278,18,'湘西土家族苗族',433100,0,0,'0000-00-00','0000-00-00'),(279,19,'广州市',440100,0,0,'0000-00-00','0000-00-00'),(280,19,'韶关市',440200,0,0,'0000-00-00','0000-00-00'),(281,19,'深圳市',440300,0,0,'0000-00-00','0000-00-00'),(282,19,'珠海市',440400,0,0,'0000-00-00','0000-00-00'),(283,19,'汕头市',440500,0,0,'0000-00-00','0000-00-00'),(284,19,'佛山市',440600,0,0,'0000-00-00','0000-00-00'),(285,19,'江门市',440700,0,0,'0000-00-00','0000-00-00'),(286,19,'湛江市',440800,0,0,'0000-00-00','0000-00-00'),(287,19,'茂名市',440900,0,0,'0000-00-00','0000-00-00'),(288,19,'肇庆市',441200,0,0,'0000-00-00','0000-00-00'),(289,19,'惠州市',441300,0,0,'0000-00-00','0000-00-00'),(290,19,'梅州市',441400,0,0,'0000-00-00','0000-00-00'),(291,19,'汕尾市',441500,0,0,'0000-00-00','0000-00-00'),(292,19,'河源市',441600,0,0,'0000-00-00','0000-00-00'),(293,19,'阳江市',441700,0,0,'0000-00-00','0000-00-00'),(294,19,'清远市',441800,0,0,'0000-00-00','0000-00-00'),(295,19,'东莞市',441900,0,0,'0000-00-00','0000-00-00'),(296,19,'中山市',442000,0,0,'0000-00-00','0000-00-00'),(297,19,'潮州市',445100,0,0,'0000-00-00','0000-00-00'),(298,19,'揭阳市',445200,0,0,'0000-00-00','0000-00-00'),(299,19,'云浮市',445300,0,0,'0000-00-00','0000-00-00'),(300,20,'南宁市',450100,0,0,'0000-00-00','0000-00-00'),(301,20,'柳州市',450200,0,0,'0000-00-00','0000-00-00'),(302,20,'桂林市',450300,0,0,'0000-00-00','0000-00-00'),(303,20,'梧州市',450400,0,0,'0000-00-00','0000-00-00'),(304,20,'北海市',450500,0,0,'0000-00-00','0000-00-00'),(305,20,'防城港市',450600,0,0,'0000-00-00','0000-00-00'),(306,20,'钦州市',450700,0,0,'0000-00-00','0000-00-00'),(307,20,'贵港市',450800,0,0,'0000-00-00','0000-00-00'),(308,20,'玉林市',450900,0,0,'0000-00-00','0000-00-00'),(309,20,'百色市',451000,0,0,'0000-00-00','0000-00-00'),(310,20,'贺州市',451100,0,0,'0000-00-00','0000-00-00'),(311,20,'河池市',451200,0,0,'0000-00-00','0000-00-00'),(312,20,'来宾市',451300,0,0,'0000-00-00','0000-00-00'),(313,20,'崇左市',451400,0,0,'0000-00-00','0000-00-00'),(314,21,'海口市',460100,0,0,'0000-00-00','0000-00-00'),(315,21,'三亚市',460200,0,0,'0000-00-00','0000-00-00'),(316,21,'三沙市',460300,0,0,'0000-00-00','0000-00-00'),(317,21,'儋州市',460400,0,0,'0000-00-00','0000-00-00'),(318,21,'五指山市',469001,0,0,'0000-00-00','0000-00-00'),(319,21,'琼海市',469002,0,0,'0000-00-00','0000-00-00'),(320,21,'文昌市',469005,0,0,'0000-00-00','0000-00-00'),(321,21,'万宁市',469006,0,0,'0000-00-00','0000-00-00'),(322,21,'东方市',469007,0,0,'0000-00-00','0000-00-00'),(323,21,'定安县',469021,0,0,'0000-00-00','0000-00-00'),(324,21,'屯昌县',469022,0,0,'0000-00-00','0000-00-00'),(325,21,'澄迈县',469023,0,0,'0000-00-00','0000-00-00'),(326,21,'临高县',469024,0,0,'0000-00-00','0000-00-00'),(327,21,'白沙黎族',469025,0,0,'0000-00-00','0000-00-00'),(328,21,'昌江黎族',469026,0,0,'0000-00-00','0000-00-00'),(329,21,'乐东黎族',469027,0,0,'0000-00-00','0000-00-00'),(330,21,'陵水黎族',469028,0,0,'0000-00-00','0000-00-00'),(331,21,'保亭黎族苗族',469029,0,0,'0000-00-00','0000-00-00'),(332,21,'琼中黎族苗族',469030,0,0,'0000-00-00','0000-00-00'),(333,22,'万州区',500101,0,0,'0000-00-00','0000-00-00'),(334,22,'涪陵区',500102,0,0,'0000-00-00','0000-00-00'),(335,22,'渝中区',500103,0,0,'0000-00-00','0000-00-00'),(336,22,'大渡口区',500104,0,0,'0000-00-00','0000-00-00'),(337,22,'江北区',500105,0,0,'0000-00-00','0000-00-00'),(338,22,'沙坪坝区',500106,0,0,'0000-00-00','0000-00-00'),(339,22,'九龙坡区',500107,0,0,'0000-00-00','0000-00-00'),(340,22,'南岸区',500108,0,0,'0000-00-00','0000-00-00'),(341,22,'北碚区',500109,0,0,'0000-00-00','0000-00-00'),(342,22,'綦江区',500110,0,0,'0000-00-00','0000-00-00'),(343,22,'大足区',500111,0,0,'0000-00-00','0000-00-00'),(344,22,'渝北区',500112,0,0,'0000-00-00','0000-00-00'),(345,22,'巴南区',500113,0,0,'0000-00-00','0000-00-00'),(346,22,'黔江区',500114,0,0,'0000-00-00','0000-00-00'),(347,22,'长寿区',500115,0,0,'0000-00-00','0000-00-00'),(348,22,'江津区',500116,0,0,'0000-00-00','0000-00-00'),(349,22,'合川区',500117,0,0,'0000-00-00','0000-00-00'),(350,22,'永川区',500118,0,0,'0000-00-00','0000-00-00'),(351,22,'南川区',500119,0,0,'0000-00-00','0000-00-00'),(352,22,'璧山区',500120,0,0,'0000-00-00','0000-00-00'),(353,22,'铜梁区',500151,0,0,'0000-00-00','0000-00-00'),(354,22,'潼南区',500223,0,0,'0000-00-00','0000-00-00'),(355,22,'荣昌区',500226,0,0,'0000-00-00','0000-00-00'),(356,22,'梁平县',500228,0,0,'0000-00-00','0000-00-00'),(357,22,'城口县',500229,0,0,'0000-00-00','0000-00-00'),(358,22,'丰都县',500230,0,0,'0000-00-00','0000-00-00'),(359,22,'垫江县',500231,0,0,'0000-00-00','0000-00-00'),(360,22,'武隆县',500232,0,0,'0000-00-00','0000-00-00'),(361,22,'忠县',500233,0,0,'0000-00-00','0000-00-00'),(362,22,'开县',500234,0,0,'0000-00-00','0000-00-00'),(363,22,'云阳县',500235,0,0,'0000-00-00','0000-00-00'),(364,22,'奉节县',500236,0,0,'0000-00-00','0000-00-00'),(365,22,'巫山县',500237,0,0,'0000-00-00','0000-00-00'),(366,22,'巫溪县',500238,0,0,'0000-00-00','0000-00-00'),(367,22,'石柱土家族',500240,0,0,'0000-00-00','0000-00-00'),(368,22,'秀山土家族苗族',500241,0,0,'0000-00-00','0000-00-00'),(369,22,'酉阳土家族苗族',500242,0,0,'0000-00-00','0000-00-00'),(370,22,'彭水苗族土家族',500243,0,0,'0000-00-00','0000-00-00'),(371,24,'贵阳市',520100,0,0,'0000-00-00','0000-00-00'),(372,24,'六盘水市',520200,0,0,'0000-00-00','0000-00-00'),(373,24,'遵义市',520300,0,0,'0000-00-00','0000-00-00'),(374,24,'安顺市',520400,0,0,'0000-00-00','0000-00-00'),(375,24,'毕节市',520500,0,0,'0000-00-00','0000-00-00'),(376,24,'铜仁市',520600,0,0,'0000-00-00','0000-00-00'),(377,24,'黔西南布依族苗族',522300,0,0,'0000-00-00','0000-00-00'),(378,24,'黔东南苗族侗族',522600,0,0,'0000-00-00','0000-00-00'),(379,24,'黔南布依族苗族',522700,0,0,'0000-00-00','0000-00-00'),(380,25,'昆明市',530100,0,0,'0000-00-00','0000-00-00'),(381,25,'曲靖市',530300,0,0,'0000-00-00','0000-00-00'),(382,25,'玉溪市',530400,0,0,'0000-00-00','0000-00-00'),(383,25,'保山市',530500,0,0,'0000-00-00','0000-00-00'),(384,25,'昭通市',530600,0,0,'0000-00-00','0000-00-00'),(385,25,'丽江市',530700,0,0,'0000-00-00','0000-00-00'),(386,25,'普洱市',530800,0,0,'0000-00-00','0000-00-00'),(387,25,'临沧市',530900,0,0,'0000-00-00','0000-00-00'),(388,25,'楚雄彝族',532300,0,0,'0000-00-00','0000-00-00'),(389,25,'红河哈尼族彝族',532500,0,0,'0000-00-00','0000-00-00'),(390,25,'文山壮族苗族',532600,0,0,'0000-00-00','0000-00-00'),(391,25,'西双版纳傣族',532800,0,0,'0000-00-00','0000-00-00'),(392,25,'大理白族',532900,0,0,'0000-00-00','0000-00-00'),(393,25,'德宏傣族景颇族',533100,0,0,'0000-00-00','0000-00-00'),(394,25,'怒江傈僳族',533300,0,0,'0000-00-00','0000-00-00'),(395,25,'迪庆藏族',533400,0,0,'0000-00-00','0000-00-00'),(396,26,'拉萨市',540100,0,0,'0000-00-00','0000-00-00'),(397,26,'日喀则市',540200,0,0,'0000-00-00','0000-00-00'),(398,26,'昌都市',540300,0,0,'0000-00-00','0000-00-00'),(399,26,'山南地区',542200,0,0,'0000-00-00','0000-00-00'),(400,26,'那曲地区',542400,0,0,'0000-00-00','0000-00-00'),(401,26,'阿里地区',542500,0,0,'0000-00-00','0000-00-00'),(402,26,'林芝市',542600,0,0,'0000-00-00','0000-00-00'),(403,27,'西安市',610100,0,0,'0000-00-00','0000-00-00'),(404,27,'铜川市',610200,0,0,'0000-00-00','0000-00-00'),(405,27,'宝鸡市',610300,0,0,'0000-00-00','0000-00-00'),(406,27,'咸阳市',610400,0,0,'0000-00-00','0000-00-00'),(407,27,'渭南市',610500,0,0,'0000-00-00','0000-00-00'),(408,27,'延安市',610600,0,0,'0000-00-00','0000-00-00'),(409,27,'汉中市',610700,0,0,'0000-00-00','0000-00-00'),(410,27,'榆林市',610800,0,0,'0000-00-00','0000-00-00'),(411,27,'安康市',610900,0,0,'0000-00-00','0000-00-00'),(412,27,'商洛市',611000,0,0,'0000-00-00','0000-00-00'),(413,28,'兰州市',620100,0,0,'0000-00-00','0000-00-00'),(414,28,'嘉峪关市',620200,0,0,'0000-00-00','0000-00-00'),(415,28,'金昌市',620300,0,0,'0000-00-00','0000-00-00'),(416,28,'白银市',620400,0,0,'0000-00-00','0000-00-00'),(417,28,'天水市',620500,0,0,'0000-00-00','0000-00-00'),(418,28,'武威市',620600,0,0,'0000-00-00','0000-00-00'),(419,28,'张掖市',620700,0,0,'0000-00-00','0000-00-00'),(420,28,'平凉市',620800,0,0,'0000-00-00','0000-00-00'),(421,28,'酒泉市',620900,0,0,'0000-00-00','0000-00-00'),(422,28,'庆阳市',621000,0,0,'0000-00-00','0000-00-00'),(423,28,'定西市',621100,0,0,'0000-00-00','0000-00-00'),(424,28,'陇南市',621200,0,0,'0000-00-00','0000-00-00'),(425,28,'临夏回族',622900,0,0,'0000-00-00','0000-00-00'),(426,28,'甘南藏族',623000,0,0,'0000-00-00','0000-00-00'),(427,29,'西宁市',630100,0,0,'0000-00-00','0000-00-00'),(428,29,'海东市',630200,0,0,'0000-00-00','0000-00-00'),(429,29,'海北藏族',632200,0,0,'0000-00-00','0000-00-00'),(430,29,'黄南藏族',632300,0,0,'0000-00-00','0000-00-00'),(431,29,'海南藏族',632500,0,0,'0000-00-00','0000-00-00'),(432,29,'果洛藏族',632600,0,0,'0000-00-00','0000-00-00'),(433,29,'玉树藏族',632700,0,0,'0000-00-00','0000-00-00'),(434,29,'海西蒙古族藏族',632800,0,0,'0000-00-00','0000-00-00'),(435,30,'银川市',640100,0,0,'0000-00-00','0000-00-00'),(436,30,'石嘴山市',640200,0,0,'0000-00-00','0000-00-00'),(437,30,'吴忠市',640300,0,0,'0000-00-00','0000-00-00'),(438,30,'固原市',640400,0,0,'0000-00-00','0000-00-00'),(439,30,'中卫市',640500,0,0,'0000-00-00','0000-00-00'),(440,31,'乌鲁木齐市',650100,0,0,'0000-00-00','0000-00-00'),(441,31,'克拉玛依市',650200,0,0,'0000-00-00','0000-00-00'),(442,31,'吐鲁番市',652100,0,0,'0000-00-00','0000-00-00'),(443,31,'哈密地区',652200,0,0,'0000-00-00','0000-00-00'),(444,31,'昌吉回族',652300,0,0,'0000-00-00','0000-00-00'),(445,31,'博尔塔拉蒙古',652700,0,0,'0000-00-00','0000-00-00'),(446,31,'巴音郭楞蒙古',652800,0,0,'0000-00-00','0000-00-00'),(447,31,'阿克苏地区',652900,0,0,'0000-00-00','0000-00-00'),(448,31,'克孜勒苏柯尔克孜',653000,0,0,'0000-00-00','0000-00-00'),(449,31,'喀什地区',653100,0,0,'0000-00-00','0000-00-00'),(450,31,'和田地区',653200,0,0,'0000-00-00','0000-00-00'),(451,31,'伊犁哈萨克',654000,0,0,'0000-00-00','0000-00-00'),(452,31,'塔城地区',654200,0,0,'0000-00-00','0000-00-00'),(453,31,'阿勒泰地区',654300,0,0,'0000-00-00','0000-00-00'),(454,31,'石河子市',659001,0,0,'0000-00-00','0000-00-00'),(455,31,'阿拉尔市',659002,0,0,'0000-00-00','0000-00-00'),(456,31,'图木舒克市',659003,0,0,'0000-00-00','0000-00-00'),(457,31,'五家渠市',659004,0,0,'0000-00-00','0000-00-00'),(458,31,'北屯市',659005,0,0,'0000-00-00','0000-00-00'),(459,31,'铁门关市',659006,0,0,'0000-00-00','0000-00-00'),(460,31,'双河市',659007,0,0,'0000-00-00','0000-00-00'),(461,31,'可克达拉市',659008,0,0,'0000-00-00','0000-00-00'),(462,32,'中西区',810001,0,0,'0000-00-00','0000-00-00'),(463,32,'湾仔区',810002,0,0,'0000-00-00','0000-00-00'),(464,32,'东区',810003,0,0,'0000-00-00','0000-00-00'),(465,32,'南区',810004,0,0,'0000-00-00','0000-00-00'),(466,32,'油尖旺区',810005,0,0,'0000-00-00','0000-00-00'),(467,32,'深水埗区',810006,0,0,'0000-00-00','0000-00-00'),(468,32,'九龙城区',810007,0,0,'0000-00-00','0000-00-00'),(469,32,'黄大仙区',810008,0,0,'0000-00-00','0000-00-00'),(470,32,'观塘区',810009,0,0,'0000-00-00','0000-00-00'),(471,32,'荃湾区',810010,0,0,'0000-00-00','0000-00-00'),(472,32,'屯门区',810011,0,0,'0000-00-00','0000-00-00'),(473,32,'元朗区',810012,0,0,'0000-00-00','0000-00-00'),(474,32,'北区',810013,0,0,'0000-00-00','0000-00-00'),(475,32,'大埔区',810014,0,0,'0000-00-00','0000-00-00'),(476,32,'西贡区',810015,0,0,'0000-00-00','0000-00-00'),(477,32,'沙田区',810016,0,0,'0000-00-00','0000-00-00'),(478,32,'葵青区',810017,0,0,'0000-00-00','0000-00-00'),(479,32,'离岛区',810018,0,0,'0000-00-00','0000-00-00'),(480,33,'花地玛堂区',820001,0,0,'0000-00-00','0000-00-00'),(481,33,'花王堂区',820002,0,0,'0000-00-00','0000-00-00'),(482,33,'望德堂区',820003,0,0,'0000-00-00','0000-00-00'),(483,33,'大堂区',820004,0,0,'0000-00-00','0000-00-00'),(484,33,'风顺堂区',820005,0,0,'0000-00-00','0000-00-00'),(485,33,'嘉模堂区',820006,0,0,'0000-00-00','0000-00-00'),(486,33,'路氹填海区',820007,0,0,'0000-00-00','0000-00-00'),(487,33,'聖方濟各堂区',820008,0,0,'0000-00-00','0000-00-00'),(488,66,'长安区',130102,0,0,'0000-00-00','0000-00-00'),(489,66,'桥西区',130104,0,0,'0000-00-00','0000-00-00'),(490,66,'新华区',130105,0,0,'0000-00-00','0000-00-00'),(491,66,'井陉矿区',130107,0,0,'0000-00-00','0000-00-00'),(492,66,'裕华区',130108,0,0,'0000-00-00','0000-00-00'),(493,66,'藁城区',130109,0,0,'0000-00-00','0000-00-00'),(494,66,'鹿泉区',130110,0,0,'0000-00-00','0000-00-00'),(495,66,'栾城区',130111,0,0,'0000-00-00','0000-00-00'),(496,66,'井陉县',130121,0,0,'0000-00-00','0000-00-00'),(497,66,'正定县',130123,0,0,'0000-00-00','0000-00-00'),(498,66,'行唐县',130125,0,0,'0000-00-00','0000-00-00'),(499,66,'灵寿县',130126,0,0,'0000-00-00','0000-00-00'),(500,66,'高邑县',130127,0,0,'0000-00-00','0000-00-00'),(501,66,'深泽县',130128,0,0,'0000-00-00','0000-00-00'),(502,66,'赞皇县',130129,0,0,'0000-00-00','0000-00-00'),(503,66,'无极县',130130,0,0,'0000-00-00','0000-00-00'),(504,66,'平山县',130131,0,0,'0000-00-00','0000-00-00'),(505,66,'元氏县',130132,0,0,'0000-00-00','0000-00-00'),(506,66,'赵县',130133,0,0,'0000-00-00','0000-00-00'),(507,66,'辛集市',130181,0,0,'0000-00-00','0000-00-00'),(508,66,'晋州市',130183,0,0,'0000-00-00','0000-00-00'),(509,66,'新乐市',130184,0,0,'0000-00-00','0000-00-00'),(510,67,'路南区',130202,0,0,'0000-00-00','0000-00-00'),(511,67,'路北区',130203,0,0,'0000-00-00','0000-00-00'),(512,67,'古冶区',130204,0,0,'0000-00-00','0000-00-00'),(513,67,'开平区',130205,0,0,'0000-00-00','0000-00-00'),(514,67,'丰南区',130207,0,0,'0000-00-00','0000-00-00'),(515,67,'丰润区',130208,0,0,'0000-00-00','0000-00-00'),(516,67,'曹妃甸区',130209,0,0,'0000-00-00','0000-00-00'),(517,67,'滦县',130223,0,0,'0000-00-00','0000-00-00'),(518,67,'滦南县',130224,0,0,'0000-00-00','0000-00-00'),(519,67,'乐亭县',130225,0,0,'0000-00-00','0000-00-00'),(520,67,'迁西县',130227,0,0,'0000-00-00','0000-00-00'),(521,67,'玉田县',130229,0,0,'0000-00-00','0000-00-00'),(522,67,'遵化市',130281,0,0,'0000-00-00','0000-00-00'),(523,67,'迁安市',130283,0,0,'0000-00-00','0000-00-00'),(524,68,'海港区',130302,0,0,'0000-00-00','0000-00-00'),(525,68,'山海关区',130303,0,0,'0000-00-00','0000-00-00'),(526,68,'北戴河区',130304,0,0,'0000-00-00','0000-00-00'),(527,68,'青龙满族',130321,0,0,'0000-00-00','0000-00-00'),(528,68,'昌黎县',130322,0,0,'0000-00-00','0000-00-00'),(529,68,'抚宁县',130323,0,0,'0000-00-00','0000-00-00'),(530,68,'卢龙县',130324,0,0,'0000-00-00','0000-00-00'),(531,69,'邯山区',130402,0,0,'0000-00-00','0000-00-00'),(532,69,'丛台区',130403,0,0,'0000-00-00','0000-00-00'),(533,69,'复兴区',130404,0,0,'0000-00-00','0000-00-00'),(534,69,'峰峰矿区',130406,0,0,'0000-00-00','0000-00-00'),(535,69,'邯郸县',130421,0,0,'0000-00-00','0000-00-00'),(536,69,'临漳县',130423,0,0,'0000-00-00','0000-00-00'),(537,69,'成安县',130424,0,0,'0000-00-00','0000-00-00'),(538,69,'大名县',130425,0,0,'0000-00-00','0000-00-00'),(539,69,'涉县',130426,0,0,'0000-00-00','0000-00-00'),(540,69,'磁县',130427,0,0,'0000-00-00','0000-00-00'),(541,69,'肥乡县',130428,0,0,'0000-00-00','0000-00-00'),(542,69,'永年县',130429,0,0,'0000-00-00','0000-00-00'),(543,69,'邱县',130430,0,0,'0000-00-00','0000-00-00'),(544,69,'鸡泽县',130431,0,0,'0000-00-00','0000-00-00'),(545,69,'广平县',130432,0,0,'0000-00-00','0000-00-00'),(546,69,'馆陶县',130433,0,0,'0000-00-00','0000-00-00'),(547,69,'魏县',130434,0,0,'0000-00-00','0000-00-00'),(548,69,'曲周县',130435,0,0,'0000-00-00','0000-00-00'),(549,69,'武安市',130481,0,0,'0000-00-00','0000-00-00'),(550,70,'桥东区',130502,0,0,'0000-00-00','0000-00-00'),(551,70,'桥西区',130503,0,0,'0000-00-00','0000-00-00'),(552,70,'邢台县',130521,0,0,'0000-00-00','0000-00-00'),(553,70,'临城县',130522,0,0,'0000-00-00','0000-00-00'),(554,70,'内丘县',130523,0,0,'0000-00-00','0000-00-00'),(555,70,'柏乡县',130524,0,0,'0000-00-00','0000-00-00'),(556,70,'隆尧县',130525,0,0,'0000-00-00','0000-00-00'),(557,70,'任县',130526,0,0,'0000-00-00','0000-00-00'),(558,70,'南和县',130527,0,0,'0000-00-00','0000-00-00'),(559,70,'宁晋县',130528,0,0,'0000-00-00','0000-00-00'),(560,70,'巨鹿县',130529,0,0,'0000-00-00','0000-00-00'),(561,70,'新河县',130530,0,0,'0000-00-00','0000-00-00'),(562,70,'广宗县',130531,0,0,'0000-00-00','0000-00-00'),(563,70,'平乡县',130532,0,0,'0000-00-00','0000-00-00'),(564,70,'威县',130533,0,0,'0000-00-00','0000-00-00'),(565,70,'清河县',130534,0,0,'0000-00-00','0000-00-00'),(566,70,'临西县',130535,0,0,'0000-00-00','0000-00-00'),(567,70,'南宫市',130581,0,0,'0000-00-00','0000-00-00'),(568,70,'沙河市',130582,0,0,'0000-00-00','0000-00-00'),(569,71,'竞秀区',130602,0,0,'0000-00-00','0000-00-00'),(570,71,'莲池区',130603,0,0,'0000-00-00','0000-00-00'),(571,71,'满城区',130621,0,0,'0000-00-00','0000-00-00'),(572,71,'清苑区',130622,0,0,'0000-00-00','0000-00-00'),(573,71,'涞水县',130623,0,0,'0000-00-00','0000-00-00'),(574,71,'阜平县',130624,0,0,'0000-00-00','0000-00-00'),(575,71,'徐水区',130625,0,0,'0000-00-00','0000-00-00'),(576,71,'定兴县',130626,0,0,'0000-00-00','0000-00-00'),(577,71,'唐县',130627,0,0,'0000-00-00','0000-00-00'),(578,71,'高阳县',130628,0,0,'0000-00-00','0000-00-00'),(579,71,'容城县',130629,0,0,'0000-00-00','0000-00-00'),(580,71,'涞源县',130630,0,0,'0000-00-00','0000-00-00'),(581,71,'望都县',130631,0,0,'0000-00-00','0000-00-00'),(582,71,'安新县',130632,0,0,'0000-00-00','0000-00-00'),(583,71,'易县',130633,0,0,'0000-00-00','0000-00-00'),(584,71,'曲阳县',130634,0,0,'0000-00-00','0000-00-00'),(585,71,'蠡县',130635,0,0,'0000-00-00','0000-00-00'),(586,71,'顺平县',130636,0,0,'0000-00-00','0000-00-00'),(587,71,'博野县',130637,0,0,'0000-00-00','0000-00-00'),(588,71,'雄县',130638,0,0,'0000-00-00','0000-00-00'),(589,71,'涿州市',130681,0,0,'0000-00-00','0000-00-00'),(590,71,'定州市',130682,0,0,'0000-00-00','0000-00-00'),(591,71,'安国市',130683,0,0,'0000-00-00','0000-00-00'),(592,71,'高碑店市',130684,0,0,'0000-00-00','0000-00-00'),(593,72,'桥东区',130702,0,0,'0000-00-00','0000-00-00'),(594,72,'桥西区',130703,0,0,'0000-00-00','0000-00-00'),(595,72,'宣化区',130705,0,0,'0000-00-00','0000-00-00'),(596,72,'下花园区',130706,0,0,'0000-00-00','0000-00-00'),(597,72,'宣化县',130721,0,0,'0000-00-00','0000-00-00'),(598,72,'张北县',130722,0,0,'0000-00-00','0000-00-00'),(599,72,'康保县',130723,0,0,'0000-00-00','0000-00-00'),(600,72,'沽源县',130724,0,0,'0000-00-00','0000-00-00'),(601,72,'尚义县',130725,0,0,'0000-00-00','0000-00-00'),(602,72,'蔚县',130726,0,0,'0000-00-00','0000-00-00'),(603,72,'阳原县',130727,0,0,'0000-00-00','0000-00-00'),(604,72,'怀安县',130728,0,0,'0000-00-00','0000-00-00'),(605,72,'万全县',130729,0,0,'0000-00-00','0000-00-00'),(606,72,'怀来县',130730,0,0,'0000-00-00','0000-00-00'),(607,72,'涿鹿县',130731,0,0,'0000-00-00','0000-00-00'),(608,72,'赤城县',130732,0,0,'0000-00-00','0000-00-00'),(609,72,'崇礼县',130733,0,0,'0000-00-00','0000-00-00'),(610,73,'双桥区',130802,0,0,'0000-00-00','0000-00-00'),(611,73,'双滦区',130803,0,0,'0000-00-00','0000-00-00'),(612,73,'鹰手营子矿区',130804,0,0,'0000-00-00','0000-00-00'),(613,73,'承德县',130821,0,0,'0000-00-00','0000-00-00'),(614,73,'兴隆县',130822,0,0,'0000-00-00','0000-00-00'),(615,73,'平泉县',130823,0,0,'0000-00-00','0000-00-00'),(616,73,'滦平县',130824,0,0,'0000-00-00','0000-00-00'),(617,73,'隆化县',130825,0,0,'0000-00-00','0000-00-00'),(618,73,'丰宁满族',130826,0,0,'0000-00-00','0000-00-00'),(619,73,'宽城满族',130827,0,0,'0000-00-00','0000-00-00'),(620,73,'围场满族蒙古族',130828,0,0,'0000-00-00','0000-00-00'),(621,74,'新华区',130902,0,0,'0000-00-00','0000-00-00'),(622,74,'运河区',130903,0,0,'0000-00-00','0000-00-00'),(623,74,'沧县',130921,0,0,'0000-00-00','0000-00-00'),(624,74,'青县',130922,0,0,'0000-00-00','0000-00-00'),(625,74,'东光县',130923,0,0,'0000-00-00','0000-00-00'),(626,74,'海兴县',130924,0,0,'0000-00-00','0000-00-00'),(627,74,'盐山县',130925,0,0,'0000-00-00','0000-00-00'),(628,74,'肃宁县',130926,0,0,'0000-00-00','0000-00-00'),(629,74,'南皮县',130927,0,0,'0000-00-00','0000-00-00'),(630,74,'吴桥县',130928,0,0,'0000-00-00','0000-00-00'),(631,74,'献县',130929,0,0,'0000-00-00','0000-00-00'),(632,74,'孟村回族',130930,0,0,'0000-00-00','0000-00-00'),(633,74,'泊头市',130981,0,0,'0000-00-00','0000-00-00'),(634,74,'任丘市',130982,0,0,'0000-00-00','0000-00-00'),(635,74,'黄骅市',130983,0,0,'0000-00-00','0000-00-00'),(636,74,'河间市',130984,0,0,'0000-00-00','0000-00-00'),(637,75,'安次区',131002,0,0,'0000-00-00','0000-00-00'),(638,75,'广阳区',131003,0,0,'0000-00-00','0000-00-00'),(639,75,'固安县',131022,0,0,'0000-00-00','0000-00-00'),(640,75,'永清县',131023,0,0,'0000-00-00','0000-00-00'),(641,75,'香河县',131024,0,0,'0000-00-00','0000-00-00'),(642,75,'大城县',131025,0,0,'0000-00-00','0000-00-00'),(643,75,'文安县',131026,0,0,'0000-00-00','0000-00-00'),(644,75,'大厂回族',131028,0,0,'0000-00-00','0000-00-00'),(645,75,'霸州市',131081,0,0,'0000-00-00','0000-00-00'),(646,75,'三河市',131082,0,0,'0000-00-00','0000-00-00'),(647,76,'桃城区',131102,0,0,'0000-00-00','0000-00-00'),(648,76,'枣强县',131121,0,0,'0000-00-00','0000-00-00'),(649,76,'武邑县',131122,0,0,'0000-00-00','0000-00-00'),(650,76,'武强县',131123,0,0,'0000-00-00','0000-00-00'),(651,76,'饶阳县',131124,0,0,'0000-00-00','0000-00-00'),(652,76,'安平县',131125,0,0,'0000-00-00','0000-00-00'),(653,76,'故城县',131126,0,0,'0000-00-00','0000-00-00'),(654,76,'景县',131127,0,0,'0000-00-00','0000-00-00'),(655,76,'阜城县',131128,0,0,'0000-00-00','0000-00-00'),(656,76,'冀州市',131181,0,0,'0000-00-00','0000-00-00'),(657,76,'深州市',131182,0,0,'0000-00-00','0000-00-00'),(658,77,'小店区',140105,0,0,'0000-00-00','0000-00-00'),(659,77,'迎泽区',140106,0,0,'0000-00-00','0000-00-00'),(660,77,'杏花岭区',140107,0,0,'0000-00-00','0000-00-00'),(661,77,'尖草坪区',140108,0,0,'0000-00-00','0000-00-00'),(662,77,'万柏林区',140109,0,0,'0000-00-00','0000-00-00'),(663,77,'晋源区',140110,0,0,'0000-00-00','0000-00-00'),(664,77,'清徐县',140121,0,0,'0000-00-00','0000-00-00'),(665,77,'阳曲县',140122,0,0,'0000-00-00','0000-00-00'),(666,77,'娄烦县',140123,0,0,'0000-00-00','0000-00-00'),(667,77,'古交市',140181,0,0,'0000-00-00','0000-00-00'),(668,78,'城区',140202,0,0,'0000-00-00','0000-00-00'),(669,78,'矿区',140203,0,0,'0000-00-00','0000-00-00'),(670,78,'南郊区',140211,0,0,'0000-00-00','0000-00-00'),(671,78,'新荣区',140212,0,0,'0000-00-00','0000-00-00'),(672,78,'阳高县',140221,0,0,'0000-00-00','0000-00-00'),(673,78,'天镇县',140222,0,0,'0000-00-00','0000-00-00'),(674,78,'广灵县',140223,0,0,'0000-00-00','0000-00-00'),(675,78,'灵丘县',140224,0,0,'0000-00-00','0000-00-00'),(676,78,'浑源县',140225,0,0,'0000-00-00','0000-00-00'),(677,78,'左云县',140226,0,0,'0000-00-00','0000-00-00'),(678,78,'大同县',140227,0,0,'0000-00-00','0000-00-00'),(679,79,'城区',140302,0,0,'0000-00-00','0000-00-00'),(680,79,'矿区',140303,0,0,'0000-00-00','0000-00-00'),(681,79,'郊区',140311,0,0,'0000-00-00','0000-00-00'),(682,79,'平定县',140321,0,0,'0000-00-00','0000-00-00'),(683,79,'盂县',140322,0,0,'0000-00-00','0000-00-00'),(684,80,'城区',140402,0,0,'0000-00-00','0000-00-00'),(685,80,'郊区',140411,0,0,'0000-00-00','0000-00-00'),(686,80,'长治县',140421,0,0,'0000-00-00','0000-00-00'),(687,80,'襄垣县',140423,0,0,'0000-00-00','0000-00-00'),(688,80,'屯留县',140424,0,0,'0000-00-00','0000-00-00'),(689,80,'平顺县',140425,0,0,'0000-00-00','0000-00-00'),(690,80,'黎城县',140426,0,0,'0000-00-00','0000-00-00'),(691,80,'壶关县',140427,0,0,'0000-00-00','0000-00-00'),(692,80,'长子县',140428,0,0,'0000-00-00','0000-00-00'),(693,80,'武乡县',140429,0,0,'0000-00-00','0000-00-00'),(694,80,'沁县',140430,0,0,'0000-00-00','0000-00-00'),(695,80,'沁源县',140431,0,0,'0000-00-00','0000-00-00'),(696,80,'潞城市',140481,0,0,'0000-00-00','0000-00-00'),(697,81,'城区',140502,0,0,'0000-00-00','0000-00-00'),(698,81,'沁水县',140521,0,0,'0000-00-00','0000-00-00'),(699,81,'阳城县',140522,0,0,'0000-00-00','0000-00-00'),(700,81,'陵川县',140524,0,0,'0000-00-00','0000-00-00'),(701,81,'泽州县',140525,0,0,'0000-00-00','0000-00-00'),(702,81,'高平市',140581,0,0,'0000-00-00','0000-00-00'),(703,82,'朔城区',140602,0,0,'0000-00-00','0000-00-00'),(704,82,'平鲁区',140603,0,0,'0000-00-00','0000-00-00'),(705,82,'山阴县',140621,0,0,'0000-00-00','0000-00-00'),(706,82,'应县',140622,0,0,'0000-00-00','0000-00-00'),(707,82,'右玉县',140623,0,0,'0000-00-00','0000-00-00'),(708,82,'怀仁县',140624,0,0,'0000-00-00','0000-00-00'),(709,83,'榆次区',140702,0,0,'0000-00-00','0000-00-00'),(710,83,'榆社县',140721,0,0,'0000-00-00','0000-00-00'),(711,83,'左权县',140722,0,0,'0000-00-00','0000-00-00'),(712,83,'和顺县',140723,0,0,'0000-00-00','0000-00-00'),(713,83,'昔阳县',140724,0,0,'0000-00-00','0000-00-00'),(714,83,'寿阳县',140725,0,0,'0000-00-00','0000-00-00'),(715,83,'太谷县',140726,0,0,'0000-00-00','0000-00-00'),(716,83,'祁县',140727,0,0,'0000-00-00','0000-00-00'),(717,83,'平遥县',140728,0,0,'0000-00-00','0000-00-00'),(718,83,'灵石县',140729,0,0,'0000-00-00','0000-00-00'),(719,83,'介休市',140781,0,0,'0000-00-00','0000-00-00'),(720,84,'盐湖区',140802,0,0,'0000-00-00','0000-00-00'),(721,84,'临猗县',140821,0,0,'0000-00-00','0000-00-00'),(722,84,'万荣县',140822,0,0,'0000-00-00','0000-00-00'),(723,84,'闻喜县',140823,0,0,'0000-00-00','0000-00-00'),(724,84,'稷山县',140824,0,0,'0000-00-00','0000-00-00'),(725,84,'新绛县',140825,0,0,'0000-00-00','0000-00-00'),(726,84,'绛县',140826,0,0,'0000-00-00','0000-00-00'),(727,84,'垣曲县',140827,0,0,'0000-00-00','0000-00-00'),(728,84,'夏县',140828,0,0,'0000-00-00','0000-00-00'),(729,84,'平陆县',140829,0,0,'0000-00-00','0000-00-00'),(730,84,'芮城县',140830,0,0,'0000-00-00','0000-00-00'),(731,84,'永济市',140881,0,0,'0000-00-00','0000-00-00'),(732,84,'河津市',140882,0,0,'0000-00-00','0000-00-00'),(733,85,'忻府区',140902,0,0,'0000-00-00','0000-00-00'),(734,85,'定襄县',140921,0,0,'0000-00-00','0000-00-00'),(735,85,'五台县',140922,0,0,'0000-00-00','0000-00-00'),(736,85,'代县',140923,0,0,'0000-00-00','0000-00-00'),(737,85,'繁峙县',140924,0,0,'0000-00-00','0000-00-00'),(738,85,'宁武县',140925,0,0,'0000-00-00','0000-00-00'),(739,85,'静乐县',140926,0,0,'0000-00-00','0000-00-00'),(740,85,'神池县',140927,0,0,'0000-00-00','0000-00-00'),(741,85,'五寨县',140928,0,0,'0000-00-00','0000-00-00'),(742,85,'岢岚县',140929,0,0,'0000-00-00','0000-00-00'),(743,85,'河曲县',140930,0,0,'0000-00-00','0000-00-00'),(744,85,'保德县',140931,0,0,'0000-00-00','0000-00-00'),(745,85,'偏关县',140932,0,0,'0000-00-00','0000-00-00'),(746,85,'原平市',140981,0,0,'0000-00-00','0000-00-00'),(747,86,'尧都区',141002,0,0,'0000-00-00','0000-00-00'),(748,86,'曲沃县',141021,0,0,'0000-00-00','0000-00-00'),(749,86,'翼城县',141022,0,0,'0000-00-00','0000-00-00'),(750,86,'襄汾县',141023,0,0,'0000-00-00','0000-00-00'),(751,86,'洪洞县',141024,0,0,'0000-00-00','0000-00-00'),(752,86,'古县',141025,0,0,'0000-00-00','0000-00-00'),(753,86,'安泽县',141026,0,0,'0000-00-00','0000-00-00'),(754,86,'浮山县',141027,0,0,'0000-00-00','0000-00-00'),(755,86,'吉县',141028,0,0,'0000-00-00','0000-00-00'),(756,86,'乡宁县',141029,0,0,'0000-00-00','0000-00-00'),(757,86,'大宁县',141030,0,0,'0000-00-00','0000-00-00'),(758,86,'隰县',141031,0,0,'0000-00-00','0000-00-00'),(759,86,'永和县',141032,0,0,'0000-00-00','0000-00-00'),(760,86,'蒲县',141033,0,0,'0000-00-00','0000-00-00'),(761,86,'汾西县',141034,0,0,'0000-00-00','0000-00-00'),(762,86,'侯马市',141081,0,0,'0000-00-00','0000-00-00'),(763,86,'霍州市',141082,0,0,'0000-00-00','0000-00-00'),(764,87,'离石区',141102,0,0,'0000-00-00','0000-00-00'),(765,87,'文水县',141121,0,0,'0000-00-00','0000-00-00'),(766,87,'交城县',141122,0,0,'0000-00-00','0000-00-00'),(767,87,'兴县',141123,0,0,'0000-00-00','0000-00-00'),(768,87,'临县',141124,0,0,'0000-00-00','0000-00-00'),(769,87,'柳林县',141125,0,0,'0000-00-00','0000-00-00'),(770,87,'石楼县',141126,0,0,'0000-00-00','0000-00-00'),(771,87,'岚县',141127,0,0,'0000-00-00','0000-00-00'),(772,87,'方山县',141128,0,0,'0000-00-00','0000-00-00'),(773,87,'中阳县',141129,0,0,'0000-00-00','0000-00-00'),(774,87,'交口县',141130,0,0,'0000-00-00','0000-00-00'),(775,87,'孝义市',141181,0,0,'0000-00-00','0000-00-00'),(776,87,'汾阳市',141182,0,0,'0000-00-00','0000-00-00'),(777,88,'新城区',150102,0,0,'0000-00-00','0000-00-00'),(778,88,'回民区',150103,0,0,'0000-00-00','0000-00-00'),(779,88,'玉泉区',150104,0,0,'0000-00-00','0000-00-00'),(780,88,'赛罕区',150105,0,0,'0000-00-00','0000-00-00'),(781,88,'土默特左旗',150121,0,0,'0000-00-00','0000-00-00'),(782,88,'托克托县',150122,0,0,'0000-00-00','0000-00-00'),(783,88,'和林格尔县',150123,0,0,'0000-00-00','0000-00-00'),(784,88,'清水河县',150124,0,0,'0000-00-00','0000-00-00'),(785,88,'武川县',150125,0,0,'0000-00-00','0000-00-00'),(786,89,'东河区',150202,0,0,'0000-00-00','0000-00-00'),(787,89,'昆都仑区',150203,0,0,'0000-00-00','0000-00-00'),(788,89,'青山区',150204,0,0,'0000-00-00','0000-00-00'),(789,89,'石拐区',150205,0,0,'0000-00-00','0000-00-00'),(790,89,'白云鄂博矿区',150206,0,0,'0000-00-00','0000-00-00'),(791,89,'九原区',150207,0,0,'0000-00-00','0000-00-00'),(792,89,'土默特右旗',150221,0,0,'0000-00-00','0000-00-00'),(793,89,'固阳县',150222,0,0,'0000-00-00','0000-00-00'),(794,89,'达尔罕茂明安联合旗',150223,0,0,'0000-00-00','0000-00-00'),(795,90,'海勃湾区',150302,0,0,'0000-00-00','0000-00-00'),(796,90,'海南区',150303,0,0,'0000-00-00','0000-00-00'),(797,90,'乌达区',150304,0,0,'0000-00-00','0000-00-00'),(798,91,'红山区',150402,0,0,'0000-00-00','0000-00-00'),(799,91,'元宝山区',150403,0,0,'0000-00-00','0000-00-00'),(800,91,'松山区',150404,0,0,'0000-00-00','0000-00-00'),(801,91,'阿鲁科尔沁旗',150421,0,0,'0000-00-00','0000-00-00'),(802,91,'巴林左旗',150422,0,0,'0000-00-00','0000-00-00'),(803,91,'巴林右旗',150423,0,0,'0000-00-00','0000-00-00'),(804,91,'林西县',150424,0,0,'0000-00-00','0000-00-00'),(805,91,'克什克腾旗',150425,0,0,'0000-00-00','0000-00-00'),(806,91,'翁牛特旗',150426,0,0,'0000-00-00','0000-00-00'),(807,91,'喀喇沁旗',150428,0,0,'0000-00-00','0000-00-00'),(808,91,'宁城县',150429,0,0,'0000-00-00','0000-00-00'),(809,91,'敖汉旗',150430,0,0,'0000-00-00','0000-00-00'),(810,92,'科尔沁区',150502,0,0,'0000-00-00','0000-00-00'),(811,92,'科尔沁左翼中旗',150521,0,0,'0000-00-00','0000-00-00'),(812,92,'科尔沁左翼后旗',150522,0,0,'0000-00-00','0000-00-00'),(813,92,'开鲁县',150523,0,0,'0000-00-00','0000-00-00'),(814,92,'库伦旗',150524,0,0,'0000-00-00','0000-00-00'),(815,92,'奈曼旗',150525,0,0,'0000-00-00','0000-00-00'),(816,92,'扎鲁特旗',150526,0,0,'0000-00-00','0000-00-00'),(817,92,'霍林郭勒市',150581,0,0,'0000-00-00','0000-00-00'),(818,93,'东胜区',150602,0,0,'0000-00-00','0000-00-00'),(819,93,'达拉特旗',150621,0,0,'0000-00-00','0000-00-00'),(820,93,'准格尔旗',150622,0,0,'0000-00-00','0000-00-00'),(821,93,'鄂托克前旗',150623,0,0,'0000-00-00','0000-00-00'),(822,93,'鄂托克旗',150624,0,0,'0000-00-00','0000-00-00'),(823,93,'杭锦旗',150625,0,0,'0000-00-00','0000-00-00'),(824,93,'乌审旗',150626,0,0,'0000-00-00','0000-00-00'),(825,93,'伊金霍洛旗',150627,0,0,'0000-00-00','0000-00-00'),(826,94,'海拉尔区',150702,0,0,'0000-00-00','0000-00-00'),(827,94,'扎赉诺尔区',150703,0,0,'0000-00-00','0000-00-00'),(828,94,'阿荣旗',150721,0,0,'0000-00-00','0000-00-00'),(829,94,'莫力达瓦达斡尔族',150722,0,0,'0000-00-00','0000-00-00'),(830,94,'鄂伦春',150723,0,0,'0000-00-00','0000-00-00'),(831,94,'鄂温克族',150724,0,0,'0000-00-00','0000-00-00'),(832,94,'陈巴尔虎旗',150725,0,0,'0000-00-00','0000-00-00'),(833,94,'新巴尔虎左旗',150726,0,0,'0000-00-00','0000-00-00'),(834,94,'新巴尔虎右旗',150727,0,0,'0000-00-00','0000-00-00'),(835,94,'满洲里市',150781,0,0,'0000-00-00','0000-00-00'),(836,94,'牙克石市',150782,0,0,'0000-00-00','0000-00-00'),(837,94,'扎兰屯市',150783,0,0,'0000-00-00','0000-00-00'),(838,94,'额尔古纳市',150784,0,0,'0000-00-00','0000-00-00'),(839,94,'根河市',150785,0,0,'0000-00-00','0000-00-00'),(840,95,'临河区',150802,0,0,'0000-00-00','0000-00-00'),(841,95,'五原县',150821,0,0,'0000-00-00','0000-00-00'),(842,95,'磴口县',150822,0,0,'0000-00-00','0000-00-00'),(843,95,'乌拉特前旗',150823,0,0,'0000-00-00','0000-00-00'),(844,95,'乌拉特中旗',150824,0,0,'0000-00-00','0000-00-00'),(845,95,'乌拉特后旗',150825,0,0,'0000-00-00','0000-00-00'),(846,95,'杭锦后旗',150826,0,0,'0000-00-00','0000-00-00'),(847,96,'集宁区',150902,0,0,'0000-00-00','0000-00-00'),(848,96,'卓资县',150921,0,0,'0000-00-00','0000-00-00'),(849,96,'化德县',150922,0,0,'0000-00-00','0000-00-00'),(850,96,'商都县',150923,0,0,'0000-00-00','0000-00-00'),(851,96,'兴和县',150924,0,0,'0000-00-00','0000-00-00'),(852,96,'凉城县',150925,0,0,'0000-00-00','0000-00-00'),(853,96,'察哈尔右翼前旗',150926,0,0,'0000-00-00','0000-00-00'),(854,96,'察哈尔右翼中旗',150927,0,0,'0000-00-00','0000-00-00'),(855,96,'察哈尔右翼后旗',150928,0,0,'0000-00-00','0000-00-00'),(856,96,'四子王旗',150929,0,0,'0000-00-00','0000-00-00'),(857,96,'丰镇市',150981,0,0,'0000-00-00','0000-00-00'),(858,97,'乌兰浩特市',152201,0,0,'0000-00-00','0000-00-00'),(859,97,'阿尔山市',152202,0,0,'0000-00-00','0000-00-00'),(860,97,'科尔沁右翼前旗',152221,0,0,'0000-00-00','0000-00-00'),(861,97,'科尔沁右翼中旗',152222,0,0,'0000-00-00','0000-00-00'),(862,97,'扎赉特旗',152223,0,0,'0000-00-00','0000-00-00'),(863,97,'突泉县',152224,0,0,'0000-00-00','0000-00-00'),(864,98,'二连浩特市',152501,0,0,'0000-00-00','0000-00-00'),(865,98,'锡林浩特市',152502,0,0,'0000-00-00','0000-00-00'),(866,98,'阿巴嘎旗',152522,0,0,'0000-00-00','0000-00-00'),(867,98,'苏尼特左旗',152523,0,0,'0000-00-00','0000-00-00'),(868,98,'苏尼特右旗',152524,0,0,'0000-00-00','0000-00-00'),(869,98,'东乌珠穆沁旗',152525,0,0,'0000-00-00','0000-00-00'),(870,98,'西乌珠穆沁旗',152526,0,0,'0000-00-00','0000-00-00'),(871,98,'太仆寺旗',152527,0,0,'0000-00-00','0000-00-00'),(872,98,'镶黄旗',152528,0,0,'0000-00-00','0000-00-00'),(873,98,'正镶白旗',152529,0,0,'0000-00-00','0000-00-00'),(874,98,'正蓝旗',152530,0,0,'0000-00-00','0000-00-00'),(875,98,'多伦县',152531,0,0,'0000-00-00','0000-00-00'),(876,99,'阿拉善左旗',152921,0,0,'0000-00-00','0000-00-00'),(877,99,'阿拉善右旗',152922,0,0,'0000-00-00','0000-00-00'),(878,99,'额济纳旗',152923,0,0,'0000-00-00','0000-00-00'),(879,100,'和平区',210102,0,0,'0000-00-00','0000-00-00'),(880,100,'沈河区',210103,0,0,'0000-00-00','0000-00-00'),(881,100,'大东区',210104,0,0,'0000-00-00','0000-00-00'),(882,100,'皇姑区',210105,0,0,'0000-00-00','0000-00-00'),(883,100,'铁西区',210106,0,0,'0000-00-00','0000-00-00'),(884,100,'苏家屯区',210111,0,0,'0000-00-00','0000-00-00'),(885,100,'浑南区',210112,0,0,'0000-00-00','0000-00-00'),(886,100,'沈北新区',210113,0,0,'0000-00-00','0000-00-00'),(887,100,'于洪区',210114,0,0,'0000-00-00','0000-00-00'),(888,100,'辽中县',210122,0,0,'0000-00-00','0000-00-00'),(889,100,'康平县',210123,0,0,'0000-00-00','0000-00-00'),(890,100,'法库县',210124,0,0,'0000-00-00','0000-00-00'),(891,100,'新民市',210181,0,0,'0000-00-00','0000-00-00'),(892,101,'中山区',210202,0,0,'0000-00-00','0000-00-00'),(893,101,'西岗区',210203,0,0,'0000-00-00','0000-00-00'),(894,101,'沙河口区',210204,0,0,'0000-00-00','0000-00-00'),(895,101,'甘井子区',210211,0,0,'0000-00-00','0000-00-00'),(896,101,'旅顺口区',210212,0,0,'0000-00-00','0000-00-00'),(897,101,'金州区',210213,0,0,'0000-00-00','0000-00-00'),(898,101,'长海县',210224,0,0,'0000-00-00','0000-00-00'),(899,101,'瓦房店市',210281,0,0,'0000-00-00','0000-00-00'),(900,101,'普兰店市',210282,0,0,'0000-00-00','0000-00-00'),(901,101,'庄河市',210283,0,0,'0000-00-00','0000-00-00'),(902,102,'铁东区',210302,0,0,'0000-00-00','0000-00-00'),(903,102,'铁西区',210303,0,0,'0000-00-00','0000-00-00'),(904,102,'立山区',210304,0,0,'0000-00-00','0000-00-00'),(905,102,'千山区',210311,0,0,'0000-00-00','0000-00-00'),(906,102,'台安县',210321,0,0,'0000-00-00','0000-00-00'),(907,102,'岫岩满族',210323,0,0,'0000-00-00','0000-00-00'),(908,102,'海城市',210381,0,0,'0000-00-00','0000-00-00'),(909,103,'新抚区',210402,0,0,'0000-00-00','0000-00-00'),(910,103,'东洲区',210403,0,0,'0000-00-00','0000-00-00'),(911,103,'望花区',210404,0,0,'0000-00-00','0000-00-00'),(912,103,'顺城区',210411,0,0,'0000-00-00','0000-00-00'),(913,103,'抚顺县',210421,0,0,'0000-00-00','0000-00-00'),(914,103,'新宾满族',210422,0,0,'0000-00-00','0000-00-00'),(915,103,'清原满族',210423,0,0,'0000-00-00','0000-00-00'),(916,104,'平山区',210502,0,0,'0000-00-00','0000-00-00'),(917,104,'溪湖区',210503,0,0,'0000-00-00','0000-00-00'),(918,104,'明山区',210504,0,0,'0000-00-00','0000-00-00'),(919,104,'南芬区',210505,0,0,'0000-00-00','0000-00-00'),(920,104,'本溪满族',210521,0,0,'0000-00-00','0000-00-00'),(921,104,'桓仁满族',210522,0,0,'0000-00-00','0000-00-00'),(922,105,'元宝区',210602,0,0,'0000-00-00','0000-00-00'),(923,105,'振兴区',210603,0,0,'0000-00-00','0000-00-00'),(924,105,'振安区',210604,0,0,'0000-00-00','0000-00-00'),(925,105,'宽甸满族',210624,0,0,'0000-00-00','0000-00-00'),(926,105,'东港市',210681,0,0,'0000-00-00','0000-00-00'),(927,105,'凤城市',210682,0,0,'0000-00-00','0000-00-00'),(928,106,'古塔区',210702,0,0,'0000-00-00','0000-00-00'),(929,106,'凌河区',210703,0,0,'0000-00-00','0000-00-00'),(930,106,'太和区',210711,0,0,'0000-00-00','0000-00-00'),(931,106,'黑山县',210726,0,0,'0000-00-00','0000-00-00'),(932,106,'义县',210727,0,0,'0000-00-00','0000-00-00'),(933,106,'凌海市',210781,0,0,'0000-00-00','0000-00-00'),(934,106,'北镇市',210782,0,0,'0000-00-00','0000-00-00'),(935,107,'站前区',210802,0,0,'0000-00-00','0000-00-00'),(936,107,'西市区',210803,0,0,'0000-00-00','0000-00-00'),(937,107,'鲅鱼圈区',210804,0,0,'0000-00-00','0000-00-00'),(938,107,'老边区',210811,0,0,'0000-00-00','0000-00-00'),(939,107,'盖州市',210881,0,0,'0000-00-00','0000-00-00'),(940,107,'大石桥市',210882,0,0,'0000-00-00','0000-00-00'),(941,108,'海州区',210902,0,0,'0000-00-00','0000-00-00'),(942,108,'新邱区',210903,0,0,'0000-00-00','0000-00-00'),(943,108,'太平区',210904,0,0,'0000-00-00','0000-00-00'),(944,108,'清河门区',210905,0,0,'0000-00-00','0000-00-00'),(945,108,'细河区',210911,0,0,'0000-00-00','0000-00-00'),(946,108,'阜新蒙古族',210921,0,0,'0000-00-00','0000-00-00'),(947,108,'彰武县',210922,0,0,'0000-00-00','0000-00-00'),(948,109,'白塔区',211002,0,0,'0000-00-00','0000-00-00'),(949,109,'文圣区',211003,0,0,'0000-00-00','0000-00-00'),(950,109,'宏伟区',211004,0,0,'0000-00-00','0000-00-00'),(951,109,'弓长岭区',211005,0,0,'0000-00-00','0000-00-00'),(952,109,'太子河区',211011,0,0,'0000-00-00','0000-00-00'),(953,109,'辽阳县',211021,0,0,'0000-00-00','0000-00-00'),(954,109,'灯塔市',211081,0,0,'0000-00-00','0000-00-00'),(955,110,'双台子区',211102,0,0,'0000-00-00','0000-00-00'),(956,110,'兴隆台区',211103,0,0,'0000-00-00','0000-00-00'),(957,110,'大洼县',211121,0,0,'0000-00-00','0000-00-00'),(958,110,'盘山县',211122,0,0,'0000-00-00','0000-00-00'),(959,111,'银州区',211202,0,0,'0000-00-00','0000-00-00'),(960,111,'清河区',211204,0,0,'0000-00-00','0000-00-00'),(961,111,'铁岭县',211221,0,0,'0000-00-00','0000-00-00'),(962,111,'西丰县',211223,0,0,'0000-00-00','0000-00-00'),(963,111,'昌图县',211224,0,0,'0000-00-00','0000-00-00'),(964,111,'调兵山市',211281,0,0,'0000-00-00','0000-00-00'),(965,111,'开原市',211282,0,0,'0000-00-00','0000-00-00'),(966,112,'双塔区',211302,0,0,'0000-00-00','0000-00-00'),(967,112,'龙城区',211303,0,0,'0000-00-00','0000-00-00'),(968,112,'朝阳县',211321,0,0,'0000-00-00','0000-00-00'),(969,112,'建平县',211322,0,0,'0000-00-00','0000-00-00'),(970,112,'喀喇沁左翼蒙古族',211324,0,0,'0000-00-00','0000-00-00'),(971,112,'北票市',211381,0,0,'0000-00-00','0000-00-00'),(972,112,'凌源市',211382,0,0,'0000-00-00','0000-00-00'),(973,113,'连山区',211402,0,0,'0000-00-00','0000-00-00'),(974,113,'龙港区',211403,0,0,'0000-00-00','0000-00-00'),(975,113,'南票区',211404,0,0,'0000-00-00','0000-00-00'),(976,113,'绥中县',211421,0,0,'0000-00-00','0000-00-00'),(977,113,'建昌县',211422,0,0,'0000-00-00','0000-00-00'),(978,113,'兴城市',211481,0,0,'0000-00-00','0000-00-00'),(979,114,'南关区',220102,0,0,'0000-00-00','0000-00-00'),(980,114,'宽城区',220103,0,0,'0000-00-00','0000-00-00'),(981,114,'朝阳区',220104,0,0,'0000-00-00','0000-00-00'),(982,114,'二道区',220105,0,0,'0000-00-00','0000-00-00'),(983,114,'绿园区',220106,0,0,'0000-00-00','0000-00-00'),(984,114,'双阳区',220112,0,0,'0000-00-00','0000-00-00'),(985,114,'九台区',220113,0,0,'0000-00-00','0000-00-00'),(986,114,'农安县',220122,0,0,'0000-00-00','0000-00-00'),(987,114,'榆树市',220182,0,0,'0000-00-00','0000-00-00'),(988,114,'德惠市',220183,0,0,'0000-00-00','0000-00-00'),(989,115,'昌邑区',220202,0,0,'0000-00-00','0000-00-00'),(990,115,'龙潭区',220203,0,0,'0000-00-00','0000-00-00'),(991,115,'船营区',220204,0,0,'0000-00-00','0000-00-00'),(992,115,'丰满区',220211,0,0,'0000-00-00','0000-00-00'),(993,115,'永吉县',220221,0,0,'0000-00-00','0000-00-00'),(994,115,'蛟河市',220281,0,0,'0000-00-00','0000-00-00'),(995,115,'桦甸市',220282,0,0,'0000-00-00','0000-00-00'),(996,115,'舒兰市',220283,0,0,'0000-00-00','0000-00-00'),(997,115,'磐石市',220284,0,0,'0000-00-00','0000-00-00'),(998,116,'铁西区',220302,0,0,'0000-00-00','0000-00-00'),(999,116,'铁东区',220303,0,0,'0000-00-00','0000-00-00'),(1000,116,'梨树县',220322,0,0,'0000-00-00','0000-00-00'),(1001,116,'伊通满族',220323,0,0,'0000-00-00','0000-00-00'),(1002,116,'公主岭市',220381,0,0,'0000-00-00','0000-00-00'),(1003,116,'双辽市',220382,0,0,'0000-00-00','0000-00-00'),(1004,117,'龙山区',220402,0,0,'0000-00-00','0000-00-00'),(1005,117,'西安区',220403,0,0,'0000-00-00','0000-00-00'),(1006,117,'东丰县',220421,0,0,'0000-00-00','0000-00-00'),(1007,117,'东辽县',220422,0,0,'0000-00-00','0000-00-00'),(1008,118,'东昌区',220502,0,0,'0000-00-00','0000-00-00'),(1009,118,'二道江区',220503,0,0,'0000-00-00','0000-00-00'),(1010,118,'通化县',220521,0,0,'0000-00-00','0000-00-00'),(1011,118,'辉南县',220523,0,0,'0000-00-00','0000-00-00'),(1012,118,'柳河县',220524,0,0,'0000-00-00','0000-00-00'),(1013,118,'梅河口市',220581,0,0,'0000-00-00','0000-00-00'),(1014,118,'集安市',220582,0,0,'0000-00-00','0000-00-00'),(1015,119,'浑江区',220602,0,0,'0000-00-00','0000-00-00'),(1016,119,'江源区',220605,0,0,'0000-00-00','0000-00-00'),(1017,119,'抚松县',220621,0,0,'0000-00-00','0000-00-00'),(1018,119,'靖宇县',220622,0,0,'0000-00-00','0000-00-00'),(1019,119,'长白朝鲜族',220623,0,0,'0000-00-00','0000-00-00'),(1020,119,'临江市',220681,0,0,'0000-00-00','0000-00-00'),(1021,120,'宁江区',220702,0,0,'0000-00-00','0000-00-00'),(1022,120,'前郭尔罗斯蒙古族',220721,0,0,'0000-00-00','0000-00-00'),(1023,120,'长岭县',220722,0,0,'0000-00-00','0000-00-00'),(1024,120,'乾安县',220723,0,0,'0000-00-00','0000-00-00'),(1025,120,'扶余市',220781,0,0,'0000-00-00','0000-00-00'),(1026,121,'洮北区',220802,0,0,'0000-00-00','0000-00-00'),(1027,121,'镇赉县',220821,0,0,'0000-00-00','0000-00-00'),(1028,121,'通榆县',220822,0,0,'0000-00-00','0000-00-00'),(1029,121,'洮南市',220881,0,0,'0000-00-00','0000-00-00'),(1030,121,'大安市',220882,0,0,'0000-00-00','0000-00-00'),(1031,122,'延吉市',222401,0,0,'0000-00-00','0000-00-00'),(1032,122,'图们市',222402,0,0,'0000-00-00','0000-00-00'),(1033,122,'敦化市',222403,0,0,'0000-00-00','0000-00-00'),(1034,122,'珲春市',222404,0,0,'0000-00-00','0000-00-00'),(1035,122,'龙井市',222405,0,0,'0000-00-00','0000-00-00'),(1036,122,'和龙市',222406,0,0,'0000-00-00','0000-00-00'),(1037,122,'汪清县',222424,0,0,'0000-00-00','0000-00-00'),(1038,122,'安图县',222426,0,0,'0000-00-00','0000-00-00'),(1039,123,'道里区',230102,0,0,'0000-00-00','0000-00-00'),(1040,123,'南岗区',230103,0,0,'0000-00-00','0000-00-00'),(1041,123,'道外区',230104,0,0,'0000-00-00','0000-00-00'),(1042,123,'平房区',230108,0,0,'0000-00-00','0000-00-00'),(1043,123,'松北区',230109,0,0,'0000-00-00','0000-00-00'),(1044,123,'香坊区',230110,0,0,'0000-00-00','0000-00-00'),(1045,123,'呼兰区',230111,0,0,'0000-00-00','0000-00-00'),(1046,123,'阿城区',230112,0,0,'0000-00-00','0000-00-00'),(1047,123,'双城区',230113,0,0,'0000-00-00','0000-00-00'),(1048,123,'依兰县',230123,0,0,'0000-00-00','0000-00-00'),(1049,123,'方正县',230124,0,0,'0000-00-00','0000-00-00'),(1050,123,'宾县',230125,0,0,'0000-00-00','0000-00-00'),(1051,123,'巴彦县',230126,0,0,'0000-00-00','0000-00-00'),(1052,123,'木兰县',230127,0,0,'0000-00-00','0000-00-00'),(1053,123,'通河县',230128,0,0,'0000-00-00','0000-00-00'),(1054,123,'延寿县',230129,0,0,'0000-00-00','0000-00-00'),(1055,123,'尚志市',230183,0,0,'0000-00-00','0000-00-00'),(1056,123,'五常市',230184,0,0,'0000-00-00','0000-00-00'),(1057,124,'龙沙区',230202,0,0,'0000-00-00','0000-00-00'),(1058,124,'建华区',230203,0,0,'0000-00-00','0000-00-00'),(1059,124,'铁锋区',230204,0,0,'0000-00-00','0000-00-00'),(1060,124,'昂昂溪区',230205,0,0,'0000-00-00','0000-00-00'),(1061,124,'富拉尔基区',230206,0,0,'0000-00-00','0000-00-00'),(1062,124,'碾子山区',230207,0,0,'0000-00-00','0000-00-00'),(1063,124,'梅里斯达斡尔族区',230208,0,0,'0000-00-00','0000-00-00'),(1064,124,'龙江县',230221,0,0,'0000-00-00','0000-00-00'),(1065,124,'依安县',230223,0,0,'0000-00-00','0000-00-00'),(1066,124,'泰来县',230224,0,0,'0000-00-00','0000-00-00'),(1067,124,'甘南县',230225,0,0,'0000-00-00','0000-00-00'),(1068,124,'富裕县',230227,0,0,'0000-00-00','0000-00-00'),(1069,124,'克山县',230229,0,0,'0000-00-00','0000-00-00'),(1070,124,'克东县',230230,0,0,'0000-00-00','0000-00-00'),(1071,124,'拜泉县',230231,0,0,'0000-00-00','0000-00-00'),(1072,124,'讷河市',230281,0,0,'0000-00-00','0000-00-00'),(1073,125,'鸡冠区',230302,0,0,'0000-00-00','0000-00-00'),(1074,125,'恒山区',230303,0,0,'0000-00-00','0000-00-00'),(1075,125,'滴道区',230304,0,0,'0000-00-00','0000-00-00'),(1076,125,'梨树区',230305,0,0,'0000-00-00','0000-00-00'),(1077,125,'城子河区',230306,0,0,'0000-00-00','0000-00-00'),(1078,125,'麻山区',230307,0,0,'0000-00-00','0000-00-00'),(1079,125,'鸡东县',230321,0,0,'0000-00-00','0000-00-00'),(1080,125,'虎林市',230381,0,0,'0000-00-00','0000-00-00'),(1081,125,'密山市',230382,0,0,'0000-00-00','0000-00-00'),(1082,126,'向阳区',230402,0,0,'0000-00-00','0000-00-00'),(1083,126,'工农区',230403,0,0,'0000-00-00','0000-00-00'),(1084,126,'南山区',230404,0,0,'0000-00-00','0000-00-00'),(1085,126,'兴安区',230405,0,0,'0000-00-00','0000-00-00'),(1086,126,'东山区',230406,0,0,'0000-00-00','0000-00-00'),(1087,126,'兴山区',230407,0,0,'0000-00-00','0000-00-00'),(1088,126,'萝北县',230421,0,0,'0000-00-00','0000-00-00'),(1089,126,'绥滨县',230422,0,0,'0000-00-00','0000-00-00'),(1090,127,'尖山区',230502,0,0,'0000-00-00','0000-00-00'),(1091,127,'岭东区',230503,0,0,'0000-00-00','0000-00-00'),(1092,127,'四方台区',230505,0,0,'0000-00-00','0000-00-00'),(1093,127,'宝山区',230506,0,0,'0000-00-00','0000-00-00'),(1094,127,'集贤县',230521,0,0,'0000-00-00','0000-00-00'),(1095,127,'友谊县',230522,0,0,'0000-00-00','0000-00-00'),(1096,127,'宝清县',230523,0,0,'0000-00-00','0000-00-00'),(1097,127,'饶河县',230524,0,0,'0000-00-00','0000-00-00'),(1098,128,'萨尔图区',230602,0,0,'0000-00-00','0000-00-00'),(1099,128,'龙凤区',230603,0,0,'0000-00-00','0000-00-00'),(1100,128,'让胡路区',230604,0,0,'0000-00-00','0000-00-00'),(1101,128,'红岗区',230605,0,0,'0000-00-00','0000-00-00'),(1102,128,'大同区',230606,0,0,'0000-00-00','0000-00-00'),(1103,128,'肇州县',230621,0,0,'0000-00-00','0000-00-00'),(1104,128,'肇源县',230622,0,0,'0000-00-00','0000-00-00'),(1105,128,'林甸县',230623,0,0,'0000-00-00','0000-00-00'),(1106,128,'杜尔伯特蒙古族',230624,0,0,'0000-00-00','0000-00-00'),(1107,129,'伊春区',230702,0,0,'0000-00-00','0000-00-00'),(1108,129,'南岔区',230703,0,0,'0000-00-00','0000-00-00'),(1109,129,'友好区',230704,0,0,'0000-00-00','0000-00-00'),(1110,129,'西林区',230705,0,0,'0000-00-00','0000-00-00'),(1111,129,'翠峦区',230706,0,0,'0000-00-00','0000-00-00'),(1112,129,'新青区',230707,0,0,'0000-00-00','0000-00-00'),(1113,129,'美溪区',230708,0,0,'0000-00-00','0000-00-00'),(1114,129,'金山屯区',230709,0,0,'0000-00-00','0000-00-00'),(1115,129,'五营区',230710,0,0,'0000-00-00','0000-00-00'),(1116,129,'乌马河区',230711,0,0,'0000-00-00','0000-00-00'),(1117,129,'汤旺河区',230712,0,0,'0000-00-00','0000-00-00'),(1118,129,'带岭区',230713,0,0,'0000-00-00','0000-00-00'),(1119,129,'乌伊岭区',230714,0,0,'0000-00-00','0000-00-00'),(1120,129,'红星区',230715,0,0,'0000-00-00','0000-00-00'),(1121,129,'上甘岭区',230716,0,0,'0000-00-00','0000-00-00'),(1122,129,'嘉荫县',230722,0,0,'0000-00-00','0000-00-00'),(1123,129,'铁力市',230781,0,0,'0000-00-00','0000-00-00'),(1124,130,'向阳区',230803,0,0,'0000-00-00','0000-00-00'),(1125,130,'前进区',230804,0,0,'0000-00-00','0000-00-00'),(1126,130,'东风区',230805,0,0,'0000-00-00','0000-00-00'),(1127,130,'郊区',230811,0,0,'0000-00-00','0000-00-00'),(1128,130,'桦南县',230822,0,0,'0000-00-00','0000-00-00'),(1129,130,'桦川县',230826,0,0,'0000-00-00','0000-00-00'),(1130,130,'汤原县',230828,0,0,'0000-00-00','0000-00-00'),(1131,130,'抚远县',230833,0,0,'0000-00-00','0000-00-00'),(1132,130,'同江市',230881,0,0,'0000-00-00','0000-00-00'),(1133,130,'富锦市',230882,0,0,'0000-00-00','0000-00-00'),(1134,131,'新兴区',230902,0,0,'0000-00-00','0000-00-00'),(1135,131,'桃山区',230903,0,0,'0000-00-00','0000-00-00'),(1136,131,'茄子河区',230904,0,0,'0000-00-00','0000-00-00'),(1137,131,'勃利县',230921,0,0,'0000-00-00','0000-00-00'),(1138,132,'东安区',231002,0,0,'0000-00-00','0000-00-00'),(1139,132,'阳明区',231003,0,0,'0000-00-00','0000-00-00'),(1140,132,'爱民区',231004,0,0,'0000-00-00','0000-00-00'),(1141,132,'西安区',231005,0,0,'0000-00-00','0000-00-00'),(1142,132,'东宁县',231024,0,0,'0000-00-00','0000-00-00'),(1143,132,'林口县',231025,0,0,'0000-00-00','0000-00-00'),(1144,132,'绥芬河市',231081,0,0,'0000-00-00','0000-00-00'),(1145,132,'海林市',231083,0,0,'0000-00-00','0000-00-00'),(1146,132,'宁安市',231084,0,0,'0000-00-00','0000-00-00'),(1147,132,'穆棱市',231085,0,0,'0000-00-00','0000-00-00'),(1148,133,'爱辉区',231102,0,0,'0000-00-00','0000-00-00'),(1149,133,'嫩江县',231121,0,0,'0000-00-00','0000-00-00'),(1150,133,'逊克县',231123,0,0,'0000-00-00','0000-00-00'),(1151,133,'孙吴县',231124,0,0,'0000-00-00','0000-00-00'),(1152,133,'北安市',231181,0,0,'0000-00-00','0000-00-00'),(1153,133,'五大连池市',231182,0,0,'0000-00-00','0000-00-00'),(1154,134,'北林区',231202,0,0,'0000-00-00','0000-00-00'),(1155,134,'望奎县',231221,0,0,'0000-00-00','0000-00-00'),(1156,134,'兰西县',231222,0,0,'0000-00-00','0000-00-00'),(1157,134,'青冈县',231223,0,0,'0000-00-00','0000-00-00'),(1158,134,'庆安县',231224,0,0,'0000-00-00','0000-00-00'),(1159,134,'明水县',231225,0,0,'0000-00-00','0000-00-00'),(1160,134,'绥棱县',231226,0,0,'0000-00-00','0000-00-00'),(1161,134,'安达市',231281,0,0,'0000-00-00','0000-00-00'),(1162,134,'肇东市',231282,0,0,'0000-00-00','0000-00-00'),(1163,134,'海伦市',231283,0,0,'0000-00-00','0000-00-00'),(1164,135,'加格达奇区',232701,0,0,'0000-00-00','0000-00-00'),(1165,135,'呼玛县',232721,0,0,'0000-00-00','0000-00-00'),(1166,135,'塔河县',232722,0,0,'0000-00-00','0000-00-00'),(1167,135,'漠河县',232723,0,0,'0000-00-00','0000-00-00'),(1168,153,'玄武区',320102,0,0,'0000-00-00','0000-00-00'),(1169,153,'秦淮区',320104,0,0,'0000-00-00','0000-00-00'),(1170,153,'建邺区',320105,0,0,'0000-00-00','0000-00-00'),(1171,153,'鼓楼区',320106,0,0,'0000-00-00','0000-00-00'),(1172,153,'浦口区',320111,0,0,'0000-00-00','0000-00-00'),(1173,153,'栖霞区',320113,0,0,'0000-00-00','0000-00-00'),(1174,153,'雨花台区',320114,0,0,'0000-00-00','0000-00-00'),(1175,153,'江宁区',320115,0,0,'0000-00-00','0000-00-00'),(1176,153,'六合区',320116,0,0,'0000-00-00','0000-00-00'),(1177,153,'溧水区',320117,0,0,'0000-00-00','0000-00-00'),(1178,153,'高淳区',320118,0,0,'0000-00-00','0000-00-00'),(1179,154,'崇安区',320202,0,0,'0000-00-00','0000-00-00'),(1180,154,'南长区',320203,0,0,'0000-00-00','0000-00-00'),(1181,154,'北塘区',320204,0,0,'0000-00-00','0000-00-00'),(1182,154,'锡山区',320205,0,0,'0000-00-00','0000-00-00'),(1183,154,'惠山区',320206,0,0,'0000-00-00','0000-00-00'),(1184,154,'滨湖区',320211,0,0,'0000-00-00','0000-00-00'),(1185,154,'江阴市',320281,0,0,'0000-00-00','0000-00-00'),(1186,154,'宜兴市',320282,0,0,'0000-00-00','0000-00-00'),(1187,155,'鼓楼区',320302,0,0,'0000-00-00','0000-00-00'),(1188,155,'云龙区',320303,0,0,'0000-00-00','0000-00-00'),(1189,155,'贾汪区',320305,0,0,'0000-00-00','0000-00-00'),(1190,155,'泉山区',320311,0,0,'0000-00-00','0000-00-00'),(1191,155,'铜山区',320312,0,0,'0000-00-00','0000-00-00'),(1192,155,'丰县',320321,0,0,'0000-00-00','0000-00-00'),(1193,155,'沛县',320322,0,0,'0000-00-00','0000-00-00'),(1194,155,'睢宁县',320324,0,0,'0000-00-00','0000-00-00'),(1195,155,'新沂市',320381,0,0,'0000-00-00','0000-00-00'),(1196,155,'邳州市',320382,0,0,'0000-00-00','0000-00-00'),(1197,156,'天宁区',320402,0,0,'0000-00-00','0000-00-00'),(1198,156,'钟楼区',320404,0,0,'0000-00-00','0000-00-00'),(1199,156,'新北区',320411,0,0,'0000-00-00','0000-00-00'),(1200,156,'武进区',320412,0,0,'0000-00-00','0000-00-00'),(1201,156,'溧阳市',320481,0,0,'0000-00-00','0000-00-00'),(1202,156,'金坛区',320482,0,0,'0000-00-00','0000-00-00'),(1203,157,'虎丘区',320505,0,0,'0000-00-00','0000-00-00'),(1204,157,'吴中区',320506,0,0,'0000-00-00','0000-00-00'),(1205,157,'相城区',320507,0,0,'0000-00-00','0000-00-00'),(1206,157,'姑苏区',320508,0,0,'0000-00-00','0000-00-00'),(1207,157,'吴江区',320509,0,0,'0000-00-00','0000-00-00'),(1208,157,'常熟市',320581,0,0,'0000-00-00','0000-00-00'),(1209,157,'张家港市',320582,0,0,'0000-00-00','0000-00-00'),(1210,157,'昆山市',320583,0,0,'0000-00-00','0000-00-00'),(1211,157,'太仓市',320585,0,0,'0000-00-00','0000-00-00'),(1212,158,'崇川区',320602,0,0,'0000-00-00','0000-00-00'),(1213,158,'港闸区',320611,0,0,'0000-00-00','0000-00-00'),(1214,158,'通州区',320612,0,0,'0000-00-00','0000-00-00'),(1215,158,'海安县',320621,0,0,'0000-00-00','0000-00-00'),(1216,158,'如东县',320623,0,0,'0000-00-00','0000-00-00'),(1217,158,'启东市',320681,0,0,'0000-00-00','0000-00-00'),(1218,158,'如皋市',320682,0,0,'0000-00-00','0000-00-00'),(1219,158,'海门市',320684,0,0,'0000-00-00','0000-00-00'),(1220,159,'连云区',320703,0,0,'0000-00-00','0000-00-00'),(1221,159,'海州区',320706,0,0,'0000-00-00','0000-00-00'),(1222,159,'赣榆区',320707,0,0,'0000-00-00','0000-00-00'),(1223,159,'东海县',320722,0,0,'0000-00-00','0000-00-00'),(1224,159,'灌云县',320723,0,0,'0000-00-00','0000-00-00'),(1225,159,'灌南县',320724,0,0,'0000-00-00','0000-00-00'),(1226,160,'清河区',320802,0,0,'0000-00-00','0000-00-00'),(1227,160,'淮安区',320803,0,0,'0000-00-00','0000-00-00'),(1228,160,'淮阴区',320804,0,0,'0000-00-00','0000-00-00'),(1229,160,'清浦区',320811,0,0,'0000-00-00','0000-00-00'),(1230,160,'涟水县',320826,0,0,'0000-00-00','0000-00-00'),(1231,160,'洪泽县',320829,0,0,'0000-00-00','0000-00-00'),(1232,160,'盱眙县',320830,0,0,'0000-00-00','0000-00-00'),(1233,160,'金湖县',320831,0,0,'0000-00-00','0000-00-00'),(1234,161,'亭湖区',320902,0,0,'0000-00-00','0000-00-00'),(1235,161,'盐都区',320903,0,0,'0000-00-00','0000-00-00'),(1236,161,'响水县',320921,0,0,'0000-00-00','0000-00-00'),(1237,161,'滨海县',320922,0,0,'0000-00-00','0000-00-00'),(1238,161,'阜宁县',320923,0,0,'0000-00-00','0000-00-00'),(1239,161,'射阳县',320924,0,0,'0000-00-00','0000-00-00'),(1240,161,'建湖县',320925,0,0,'0000-00-00','0000-00-00'),(1241,161,'东台市',320981,0,0,'0000-00-00','0000-00-00'),(1242,161,'大丰市',320982,0,0,'0000-00-00','0000-00-00'),(1243,162,'广陵区',321002,0,0,'0000-00-00','0000-00-00'),(1244,162,'邗江区',321003,0,0,'0000-00-00','0000-00-00'),(1245,162,'江都区',321012,0,0,'0000-00-00','0000-00-00'),(1246,162,'宝应县',321023,0,0,'0000-00-00','0000-00-00'),(1247,162,'仪征市',321081,0,0,'0000-00-00','0000-00-00'),(1248,162,'高邮市',321084,0,0,'0000-00-00','0000-00-00'),(1249,163,'京口区',321102,0,0,'0000-00-00','0000-00-00'),(1250,163,'润州区',321111,0,0,'0000-00-00','0000-00-00'),(1251,163,'丹徒区',321112,0,0,'0000-00-00','0000-00-00'),(1252,163,'丹阳市',321181,0,0,'0000-00-00','0000-00-00'),(1253,163,'扬中市',321182,0,0,'0000-00-00','0000-00-00'),(1254,163,'句容市',321183,0,0,'0000-00-00','0000-00-00'),(1255,164,'海陵区',321202,0,0,'0000-00-00','0000-00-00'),(1256,164,'高港区',321203,0,0,'0000-00-00','0000-00-00'),(1257,164,'姜堰区',321204,0,0,'0000-00-00','0000-00-00'),(1258,164,'兴化市',321281,0,0,'0000-00-00','0000-00-00'),(1259,164,'靖江市',321282,0,0,'0000-00-00','0000-00-00'),(1260,164,'泰兴市',321283,0,0,'0000-00-00','0000-00-00'),(1261,165,'宿城区',321302,0,0,'0000-00-00','0000-00-00'),(1262,165,'宿豫区',321311,0,0,'0000-00-00','0000-00-00'),(1263,165,'沭阳县',321322,0,0,'0000-00-00','0000-00-00'),(1264,165,'泗阳县',321323,0,0,'0000-00-00','0000-00-00'),(1265,165,'泗洪县',321324,0,0,'0000-00-00','0000-00-00'),(1266,166,'上城区',330102,0,0,'0000-00-00','0000-00-00'),(1267,166,'下城区',330103,0,0,'0000-00-00','0000-00-00'),(1268,166,'江干区',330104,0,0,'0000-00-00','0000-00-00'),(1269,166,'拱墅区',330105,0,0,'0000-00-00','0000-00-00'),(1270,166,'西湖区',330106,0,0,'0000-00-00','0000-00-00'),(1271,166,'滨江区',330108,0,0,'0000-00-00','0000-00-00'),(1272,166,'萧山区',330109,0,0,'0000-00-00','0000-00-00'),(1273,166,'余杭区',330110,0,0,'0000-00-00','0000-00-00'),(1274,166,'富阳区',330111,0,0,'0000-00-00','0000-00-00'),(1275,166,'桐庐县',330122,0,0,'0000-00-00','0000-00-00'),(1276,166,'淳安县',330127,0,0,'0000-00-00','0000-00-00'),(1277,166,'建德市',330182,0,0,'0000-00-00','0000-00-00'),(1278,166,'临安市',330185,0,0,'0000-00-00','0000-00-00'),(1279,167,'海曙区',330203,0,0,'0000-00-00','0000-00-00'),(1280,167,'江东区',330204,0,0,'0000-00-00','0000-00-00'),(1281,167,'江北区',330205,0,0,'0000-00-00','0000-00-00'),(1282,167,'北仑区',330206,0,0,'0000-00-00','0000-00-00'),(1283,167,'镇海区',330211,0,0,'0000-00-00','0000-00-00'),(1284,167,'鄞州区',330212,0,0,'0000-00-00','0000-00-00'),(1285,167,'象山县',330225,0,0,'0000-00-00','0000-00-00'),(1286,167,'宁海县',330226,0,0,'0000-00-00','0000-00-00'),(1287,167,'余姚市',330281,0,0,'0000-00-00','0000-00-00'),(1288,167,'慈溪市',330282,0,0,'0000-00-00','0000-00-00'),(1289,167,'奉化市',330283,0,0,'0000-00-00','0000-00-00'),(1290,168,'鹿城区',330302,0,0,'0000-00-00','0000-00-00'),(1291,168,'龙湾区',330303,0,0,'0000-00-00','0000-00-00'),(1292,168,'瓯海区',330304,0,0,'0000-00-00','0000-00-00'),(1293,168,'洞头县',330322,0,0,'0000-00-00','0000-00-00'),(1294,168,'永嘉县',330324,0,0,'0000-00-00','0000-00-00'),(1295,168,'平阳县',330326,0,0,'0000-00-00','0000-00-00'),(1296,168,'苍南县',330327,0,0,'0000-00-00','0000-00-00'),(1297,168,'文成县',330328,0,0,'0000-00-00','0000-00-00'),(1298,168,'泰顺县',330329,0,0,'0000-00-00','0000-00-00'),(1299,168,'瑞安市',330381,0,0,'0000-00-00','0000-00-00'),(1300,168,'乐清市',330382,0,0,'0000-00-00','0000-00-00'),(1301,169,'南湖区',330402,0,0,'0000-00-00','0000-00-00'),(1302,169,'秀洲区',330411,0,0,'0000-00-00','0000-00-00'),(1303,169,'嘉善县',330421,0,0,'0000-00-00','0000-00-00'),(1304,169,'海盐县',330424,0,0,'0000-00-00','0000-00-00'),(1305,169,'海宁市',330481,0,0,'0000-00-00','0000-00-00'),(1306,169,'平湖市',330482,0,0,'0000-00-00','0000-00-00'),(1307,169,'桐乡市',330483,0,0,'0000-00-00','0000-00-00'),(1308,170,'吴兴区',330502,0,0,'0000-00-00','0000-00-00'),(1309,170,'南浔区',330503,0,0,'0000-00-00','0000-00-00'),(1310,170,'德清县',330521,0,0,'0000-00-00','0000-00-00'),(1311,170,'长兴县',330522,0,0,'0000-00-00','0000-00-00'),(1312,170,'安吉县',330523,0,0,'0000-00-00','0000-00-00'),(1313,171,'越城区',330602,0,0,'0000-00-00','0000-00-00'),(1314,171,'柯桥区',330603,0,0,'0000-00-00','0000-00-00'),(1315,171,'上虞区',330604,0,0,'0000-00-00','0000-00-00'),(1316,171,'新昌县',330624,0,0,'0000-00-00','0000-00-00'),(1317,171,'诸暨市',330681,0,0,'0000-00-00','0000-00-00'),(1318,171,'嵊州市',330683,0,0,'0000-00-00','0000-00-00'),(1319,172,'婺城区',330702,0,0,'0000-00-00','0000-00-00'),(1320,172,'金东区',330703,0,0,'0000-00-00','0000-00-00'),(1321,172,'武义县',330723,0,0,'0000-00-00','0000-00-00'),(1322,172,'浦江县',330726,0,0,'0000-00-00','0000-00-00'),(1323,172,'磐安县',330727,0,0,'0000-00-00','0000-00-00'),(1324,172,'兰溪市',330781,0,0,'0000-00-00','0000-00-00'),(1325,172,'义乌市',330782,0,0,'0000-00-00','0000-00-00'),(1326,172,'东阳市',330783,0,0,'0000-00-00','0000-00-00'),(1327,172,'永康市',330784,0,0,'0000-00-00','0000-00-00'),(1328,173,'柯城区',330802,0,0,'0000-00-00','0000-00-00'),(1329,173,'衢江区',330803,0,0,'0000-00-00','0000-00-00'),(1330,173,'常山县',330822,0,0,'0000-00-00','0000-00-00'),(1331,173,'开化县',330824,0,0,'0000-00-00','0000-00-00'),(1332,173,'龙游县',330825,0,0,'0000-00-00','0000-00-00'),(1333,173,'江山市',330881,0,0,'0000-00-00','0000-00-00'),(1334,174,'定海区',330902,0,0,'0000-00-00','0000-00-00'),(1335,174,'普陀区',330903,0,0,'0000-00-00','0000-00-00'),(1336,174,'岱山县',330921,0,0,'0000-00-00','0000-00-00'),(1337,174,'嵊泗县',330922,0,0,'0000-00-00','0000-00-00'),(1338,175,'椒江区',331002,0,0,'0000-00-00','0000-00-00'),(1339,175,'黄岩区',331003,0,0,'0000-00-00','0000-00-00'),(1340,175,'路桥区',331004,0,0,'0000-00-00','0000-00-00'),(1341,175,'玉环县',331021,0,0,'0000-00-00','0000-00-00'),(1342,175,'三门县',331022,0,0,'0000-00-00','0000-00-00'),(1343,175,'天台县',331023,0,0,'0000-00-00','0000-00-00'),(1344,175,'仙居县',331024,0,0,'0000-00-00','0000-00-00'),(1345,175,'温岭市',331081,0,0,'0000-00-00','0000-00-00'),(1346,175,'临海市',331082,0,0,'0000-00-00','0000-00-00'),(1347,176,'莲都区',331102,0,0,'0000-00-00','0000-00-00'),(1348,176,'青田县',331121,0,0,'0000-00-00','0000-00-00'),(1349,176,'缙云县',331122,0,0,'0000-00-00','0000-00-00'),(1350,176,'遂昌县',331123,0,0,'0000-00-00','0000-00-00'),(1351,176,'松阳县',331124,0,0,'0000-00-00','0000-00-00'),(1352,176,'云和县',331125,0,0,'0000-00-00','0000-00-00'),(1353,176,'庆元县',331126,0,0,'0000-00-00','0000-00-00'),(1354,176,'景宁畲族',331127,0,0,'0000-00-00','0000-00-00'),(1355,176,'龙泉市',331181,0,0,'0000-00-00','0000-00-00'),(1356,177,'瑶海区',340102,0,0,'0000-00-00','0000-00-00'),(1357,177,'庐阳区',340103,0,0,'0000-00-00','0000-00-00'),(1358,177,'蜀山区',340104,0,0,'0000-00-00','0000-00-00'),(1359,177,'包河区',340111,0,0,'0000-00-00','0000-00-00'),(1360,177,'长丰县',340121,0,0,'0000-00-00','0000-00-00'),(1361,177,'肥东县',340122,0,0,'0000-00-00','0000-00-00'),(1362,177,'肥西县',340123,0,0,'0000-00-00','0000-00-00'),(1363,177,'庐江县',340124,0,0,'0000-00-00','0000-00-00'),(1364,177,'巢湖市',340181,0,0,'0000-00-00','0000-00-00'),(1365,178,'镜湖区',340202,0,0,'0000-00-00','0000-00-00'),(1366,178,'弋江区',340203,0,0,'0000-00-00','0000-00-00'),(1367,178,'鸠江区',340207,0,0,'0000-00-00','0000-00-00'),(1368,178,'三山区',340208,0,0,'0000-00-00','0000-00-00'),(1369,178,'芜湖县',340221,0,0,'0000-00-00','0000-00-00'),(1370,178,'繁昌县',340222,0,0,'0000-00-00','0000-00-00'),(1371,178,'南陵县',340223,0,0,'0000-00-00','0000-00-00'),(1372,178,'无为县',340225,0,0,'0000-00-00','0000-00-00'),(1373,179,'龙子湖区',340302,0,0,'0000-00-00','0000-00-00'),(1374,179,'蚌山区',340303,0,0,'0000-00-00','0000-00-00'),(1375,179,'禹会区',340304,0,0,'0000-00-00','0000-00-00'),(1376,179,'淮上区',340311,0,0,'0000-00-00','0000-00-00'),(1377,179,'怀远县',340321,0,0,'0000-00-00','0000-00-00'),(1378,179,'五河县',340322,0,0,'0000-00-00','0000-00-00'),(1379,179,'固镇县',340323,0,0,'0000-00-00','0000-00-00'),(1380,180,'大通区',340402,0,0,'0000-00-00','0000-00-00'),(1381,180,'田家庵区',340403,0,0,'0000-00-00','0000-00-00'),(1382,180,'谢家集区',340404,0,0,'0000-00-00','0000-00-00'),(1383,180,'八公山区',340405,0,0,'0000-00-00','0000-00-00'),(1384,180,'潘集区',340406,0,0,'0000-00-00','0000-00-00'),(1385,180,'凤台县',340421,0,0,'0000-00-00','0000-00-00'),(1386,181,'花山区',340503,0,0,'0000-00-00','0000-00-00'),(1387,181,'雨山区',340504,0,0,'0000-00-00','0000-00-00'),(1388,181,'博望区',340506,0,0,'0000-00-00','0000-00-00'),(1389,181,'当涂县',340521,0,0,'0000-00-00','0000-00-00'),(1390,181,'含山县',340522,0,0,'0000-00-00','0000-00-00'),(1391,181,'和县',340523,0,0,'0000-00-00','0000-00-00'),(1392,182,'杜集区',340602,0,0,'0000-00-00','0000-00-00'),(1393,182,'相山区',340603,0,0,'0000-00-00','0000-00-00'),(1394,182,'烈山区',340604,0,0,'0000-00-00','0000-00-00'),(1395,182,'濉溪县',340621,0,0,'0000-00-00','0000-00-00'),(1396,183,'铜官山区',340702,0,0,'0000-00-00','0000-00-00'),(1397,183,'狮子山区',340703,0,0,'0000-00-00','0000-00-00'),(1398,183,'郊区',340711,0,0,'0000-00-00','0000-00-00'),(1399,183,'铜陵县',340721,0,0,'0000-00-00','0000-00-00'),(1400,184,'迎江区',340802,0,0,'0000-00-00','0000-00-00'),(1401,184,'大观区',340803,0,0,'0000-00-00','0000-00-00'),(1402,184,'宜秀区',340811,0,0,'0000-00-00','0000-00-00'),(1403,184,'怀宁县',340822,0,0,'0000-00-00','0000-00-00'),(1404,184,'枞阳县',340823,0,0,'0000-00-00','0000-00-00'),(1405,184,'潜山县',340824,0,0,'0000-00-00','0000-00-00'),(1406,184,'太湖县',340825,0,0,'0000-00-00','0000-00-00'),(1407,184,'宿松县',340826,0,0,'0000-00-00','0000-00-00'),(1408,184,'望江县',340827,0,0,'0000-00-00','0000-00-00'),(1409,184,'岳西县',340828,0,0,'0000-00-00','0000-00-00'),(1410,184,'桐城市',340881,0,0,'0000-00-00','0000-00-00'),(1411,185,'屯溪区',341002,0,0,'0000-00-00','0000-00-00'),(1412,185,'黄山区',341003,0,0,'0000-00-00','0000-00-00'),(1413,185,'徽州区',341004,0,0,'0000-00-00','0000-00-00'),(1414,185,'歙县',341021,0,0,'0000-00-00','0000-00-00'),(1415,185,'休宁县',341022,0,0,'0000-00-00','0000-00-00'),(1416,185,'黟县',341023,0,0,'0000-00-00','0000-00-00'),(1417,185,'祁门县',341024,0,0,'0000-00-00','0000-00-00'),(1418,186,'琅琊区',341102,0,0,'0000-00-00','0000-00-00'),(1419,186,'南谯区',341103,0,0,'0000-00-00','0000-00-00'),(1420,186,'来安县',341122,0,0,'0000-00-00','0000-00-00'),(1421,186,'全椒县',341124,0,0,'0000-00-00','0000-00-00'),(1422,186,'定远县',341125,0,0,'0000-00-00','0000-00-00'),(1423,186,'凤阳县',341126,0,0,'0000-00-00','0000-00-00'),(1424,186,'天长市',341181,0,0,'0000-00-00','0000-00-00'),(1425,186,'明光市',341182,0,0,'0000-00-00','0000-00-00'),(1426,187,'颍州区',341202,0,0,'0000-00-00','0000-00-00'),(1427,187,'颍东区',341203,0,0,'0000-00-00','0000-00-00'),(1428,187,'颍泉区',341204,0,0,'0000-00-00','0000-00-00'),(1429,187,'临泉县',341221,0,0,'0000-00-00','0000-00-00'),(1430,187,'太和县',341222,0,0,'0000-00-00','0000-00-00'),(1431,187,'阜南县',341225,0,0,'0000-00-00','0000-00-00'),(1432,187,'颍上县',341226,0,0,'0000-00-00','0000-00-00'),(1433,187,'界首市',341282,0,0,'0000-00-00','0000-00-00'),(1434,188,'埇桥区',341302,0,0,'0000-00-00','0000-00-00'),(1435,188,'砀山县',341321,0,0,'0000-00-00','0000-00-00'),(1436,188,'萧县',341322,0,0,'0000-00-00','0000-00-00'),(1437,188,'灵璧县',341323,0,0,'0000-00-00','0000-00-00'),(1438,188,'泗县',341324,0,0,'0000-00-00','0000-00-00'),(1439,189,'金安区',341502,0,0,'0000-00-00','0000-00-00'),(1440,189,'裕安区',341503,0,0,'0000-00-00','0000-00-00'),(1441,189,'寿县',341521,0,0,'0000-00-00','0000-00-00'),(1442,189,'霍邱县',341522,0,0,'0000-00-00','0000-00-00'),(1443,189,'舒城县',341523,0,0,'0000-00-00','0000-00-00'),(1444,189,'金寨县',341524,0,0,'0000-00-00','0000-00-00'),(1445,189,'霍山县',341525,0,0,'0000-00-00','0000-00-00'),(1446,190,'谯城区',341602,0,0,'0000-00-00','0000-00-00'),(1447,190,'涡阳县',341621,0,0,'0000-00-00','0000-00-00'),(1448,190,'蒙城县',341622,0,0,'0000-00-00','0000-00-00'),(1449,190,'利辛县',341623,0,0,'0000-00-00','0000-00-00'),(1450,191,'贵池区',341702,0,0,'0000-00-00','0000-00-00'),(1451,191,'东至县',341721,0,0,'0000-00-00','0000-00-00'),(1452,191,'石台县',341722,0,0,'0000-00-00','0000-00-00'),(1453,191,'青阳县',341723,0,0,'0000-00-00','0000-00-00'),(1454,192,'宣州区',341802,0,0,'0000-00-00','0000-00-00'),(1455,192,'郎溪县',341821,0,0,'0000-00-00','0000-00-00'),(1456,192,'广德县',341822,0,0,'0000-00-00','0000-00-00'),(1457,192,'泾县',341823,0,0,'0000-00-00','0000-00-00'),(1458,192,'绩溪县',341824,0,0,'0000-00-00','0000-00-00'),(1459,192,'旌德县',341825,0,0,'0000-00-00','0000-00-00'),(1460,192,'宁国市',341881,0,0,'0000-00-00','0000-00-00'),(1461,193,'鼓楼区',350102,0,0,'0000-00-00','0000-00-00'),(1462,193,'台江区',350103,0,0,'0000-00-00','0000-00-00'),(1463,193,'仓山区',350104,0,0,'0000-00-00','0000-00-00'),(1464,193,'马尾区',350105,0,0,'0000-00-00','0000-00-00'),(1465,193,'晋安区',350111,0,0,'0000-00-00','0000-00-00'),(1466,193,'闽侯县',350121,0,0,'0000-00-00','0000-00-00'),(1467,193,'连江县',350122,0,0,'0000-00-00','0000-00-00'),(1468,193,'罗源县',350123,0,0,'0000-00-00','0000-00-00'),(1469,193,'闽清县',350124,0,0,'0000-00-00','0000-00-00'),(1470,193,'永泰县',350125,0,0,'0000-00-00','0000-00-00'),(1471,193,'平潭县',350128,0,0,'0000-00-00','0000-00-00'),(1472,193,'福清市',350181,0,0,'0000-00-00','0000-00-00'),(1473,193,'长乐市',350182,0,0,'0000-00-00','0000-00-00'),(1474,194,'思明区',350203,0,0,'0000-00-00','0000-00-00'),(1475,194,'海沧区',350205,0,0,'0000-00-00','0000-00-00'),(1476,194,'湖里区',350206,0,0,'0000-00-00','0000-00-00'),(1477,194,'集美区',350211,0,0,'0000-00-00','0000-00-00'),(1478,194,'同安区',350212,0,0,'0000-00-00','0000-00-00'),(1479,194,'翔安区',350213,0,0,'0000-00-00','0000-00-00'),(1480,195,'城厢区',350302,0,0,'0000-00-00','0000-00-00'),(1481,195,'涵江区',350303,0,0,'0000-00-00','0000-00-00'),(1482,195,'荔城区',350304,0,0,'0000-00-00','0000-00-00'),(1483,195,'秀屿区',350305,0,0,'0000-00-00','0000-00-00'),(1484,195,'仙游县',350322,0,0,'0000-00-00','0000-00-00'),(1485,196,'梅列区',350402,0,0,'0000-00-00','0000-00-00'),(1486,196,'三元区',350403,0,0,'0000-00-00','0000-00-00'),(1487,196,'明溪县',350421,0,0,'0000-00-00','0000-00-00'),(1488,196,'清流县',350423,0,0,'0000-00-00','0000-00-00'),(1489,196,'宁化县',350424,0,0,'0000-00-00','0000-00-00'),(1490,196,'大田县',350425,0,0,'0000-00-00','0000-00-00'),(1491,196,'尤溪县',350426,0,0,'0000-00-00','0000-00-00'),(1492,196,'沙县',350427,0,0,'0000-00-00','0000-00-00'),(1493,196,'将乐县',350428,0,0,'0000-00-00','0000-00-00'),(1494,196,'泰宁县',350429,0,0,'0000-00-00','0000-00-00'),(1495,196,'建宁县',350430,0,0,'0000-00-00','0000-00-00'),(1496,196,'永安市',350481,0,0,'0000-00-00','0000-00-00'),(1497,197,'鲤城区',350502,0,0,'0000-00-00','0000-00-00'),(1498,197,'丰泽区',350503,0,0,'0000-00-00','0000-00-00'),(1499,197,'洛江区',350504,0,0,'0000-00-00','0000-00-00'),(1500,197,'泉港区',350505,0,0,'0000-00-00','0000-00-00'),(1501,197,'惠安县',350521,0,0,'0000-00-00','0000-00-00'),(1502,197,'安溪县',350524,0,0,'0000-00-00','0000-00-00'),(1503,197,'永春县',350525,0,0,'0000-00-00','0000-00-00'),(1504,197,'德化县',350526,0,0,'0000-00-00','0000-00-00'),(1505,197,'金门县',350527,0,0,'0000-00-00','0000-00-00'),(1506,197,'石狮市',350581,0,0,'0000-00-00','0000-00-00'),(1507,197,'晋江市',350582,0,0,'0000-00-00','0000-00-00'),(1508,197,'南安市',350583,0,0,'0000-00-00','0000-00-00'),(1509,198,'芗城区',350602,0,0,'0000-00-00','0000-00-00'),(1510,198,'龙文区',350603,0,0,'0000-00-00','0000-00-00'),(1511,198,'云霄县',350622,0,0,'0000-00-00','0000-00-00'),(1512,198,'漳浦县',350623,0,0,'0000-00-00','0000-00-00'),(1513,198,'诏安县',350624,0,0,'0000-00-00','0000-00-00'),(1514,198,'长泰县',350625,0,0,'0000-00-00','0000-00-00'),(1515,198,'东山县',350626,0,0,'0000-00-00','0000-00-00'),(1516,198,'南靖县',350627,0,0,'0000-00-00','0000-00-00'),(1517,198,'平和县',350628,0,0,'0000-00-00','0000-00-00'),(1518,198,'华安县',350629,0,0,'0000-00-00','0000-00-00'),(1519,198,'龙海市',350681,0,0,'0000-00-00','0000-00-00'),(1520,199,'延平区',350702,0,0,'0000-00-00','0000-00-00'),(1521,199,'建阳区',350703,0,0,'0000-00-00','0000-00-00'),(1522,199,'顺昌县',350721,0,0,'0000-00-00','0000-00-00'),(1523,199,'浦城县',350722,0,0,'0000-00-00','0000-00-00'),(1524,199,'光泽县',350723,0,0,'0000-00-00','0000-00-00'),(1525,199,'松溪县',350724,0,0,'0000-00-00','0000-00-00'),(1526,199,'政和县',350725,0,0,'0000-00-00','0000-00-00'),(1527,199,'邵武市',350781,0,0,'0000-00-00','0000-00-00'),(1528,199,'武夷山市',350782,0,0,'0000-00-00','0000-00-00'),(1529,199,'建瓯市',350783,0,0,'0000-00-00','0000-00-00'),(1530,200,'新罗区',350802,0,0,'0000-00-00','0000-00-00'),(1531,200,'永定区',350803,0,0,'0000-00-00','0000-00-00'),(1532,200,'长汀县',350821,0,0,'0000-00-00','0000-00-00'),(1533,200,'上杭县',350823,0,0,'0000-00-00','0000-00-00'),(1534,200,'武平县',350824,0,0,'0000-00-00','0000-00-00'),(1535,200,'连城县',350825,0,0,'0000-00-00','0000-00-00'),(1536,200,'漳平市',350881,0,0,'0000-00-00','0000-00-00'),(1537,201,'蕉城区',350902,0,0,'0000-00-00','0000-00-00'),(1538,201,'霞浦县',350921,0,0,'0000-00-00','0000-00-00'),(1539,201,'古田县',350922,0,0,'0000-00-00','0000-00-00'),(1540,201,'屏南县',350923,0,0,'0000-00-00','0000-00-00'),(1541,201,'寿宁县',350924,0,0,'0000-00-00','0000-00-00'),(1542,201,'周宁县',350925,0,0,'0000-00-00','0000-00-00'),(1543,201,'柘荣县',350926,0,0,'0000-00-00','0000-00-00'),(1544,201,'福安市',350981,0,0,'0000-00-00','0000-00-00'),(1545,201,'福鼎市',350982,0,0,'0000-00-00','0000-00-00'),(1546,202,'东湖区',360102,0,0,'0000-00-00','0000-00-00'),(1547,202,'西湖区',360103,0,0,'0000-00-00','0000-00-00'),(1548,202,'青云谱区',360104,0,0,'0000-00-00','0000-00-00'),(1549,202,'湾里区',360105,0,0,'0000-00-00','0000-00-00'),(1550,202,'青山湖区',360111,0,0,'0000-00-00','0000-00-00'),(1551,202,'南昌县',360121,0,0,'0000-00-00','0000-00-00'),(1552,202,'新建县',360122,0,0,'0000-00-00','0000-00-00'),(1553,202,'安义县',360123,0,0,'0000-00-00','0000-00-00'),(1554,202,'进贤县',360124,0,0,'0000-00-00','0000-00-00'),(1555,203,'昌江区',360202,0,0,'0000-00-00','0000-00-00'),(1556,203,'珠山区',360203,0,0,'0000-00-00','0000-00-00'),(1557,203,'浮梁县',360222,0,0,'0000-00-00','0000-00-00'),(1558,203,'乐平市',360281,0,0,'0000-00-00','0000-00-00'),(1559,204,'安源区',360302,0,0,'0000-00-00','0000-00-00'),(1560,204,'湘东区',360313,0,0,'0000-00-00','0000-00-00'),(1561,204,'莲花县',360321,0,0,'0000-00-00','0000-00-00'),(1562,204,'上栗县',360322,0,0,'0000-00-00','0000-00-00'),(1563,204,'芦溪县',360323,0,0,'0000-00-00','0000-00-00'),(1564,205,'庐山区',360402,0,0,'0000-00-00','0000-00-00'),(1565,205,'浔阳区',360403,0,0,'0000-00-00','0000-00-00'),(1566,205,'九江县',360421,0,0,'0000-00-00','0000-00-00'),(1567,205,'武宁县',360423,0,0,'0000-00-00','0000-00-00'),(1568,205,'修水县',360424,0,0,'0000-00-00','0000-00-00'),(1569,205,'永修县',360425,0,0,'0000-00-00','0000-00-00'),(1570,205,'德安县',360426,0,0,'0000-00-00','0000-00-00'),(1571,205,'星子县',360427,0,0,'0000-00-00','0000-00-00'),(1572,205,'都昌县',360428,0,0,'0000-00-00','0000-00-00'),(1573,205,'湖口县',360429,0,0,'0000-00-00','0000-00-00'),(1574,205,'彭泽县',360430,0,0,'0000-00-00','0000-00-00'),(1575,205,'瑞昌市',360481,0,0,'0000-00-00','0000-00-00'),(1576,205,'共青城市',360482,0,0,'0000-00-00','0000-00-00'),(1577,206,'渝水区',360502,0,0,'0000-00-00','0000-00-00'),(1578,206,'分宜县',360521,0,0,'0000-00-00','0000-00-00'),(1579,207,'月湖区',360602,0,0,'0000-00-00','0000-00-00'),(1580,207,'余江县',360622,0,0,'0000-00-00','0000-00-00'),(1581,207,'贵溪市',360681,0,0,'0000-00-00','0000-00-00'),(1582,208,'章贡区',360702,0,0,'0000-00-00','0000-00-00'),(1583,208,'南康区',360703,0,0,'0000-00-00','0000-00-00'),(1584,208,'赣县',360721,0,0,'0000-00-00','0000-00-00'),(1585,208,'信丰县',360722,0,0,'0000-00-00','0000-00-00'),(1586,208,'大余县',360723,0,0,'0000-00-00','0000-00-00'),(1587,208,'上犹县',360724,0,0,'0000-00-00','0000-00-00'),(1588,208,'崇义县',360725,0,0,'0000-00-00','0000-00-00'),(1589,208,'安远县',360726,0,0,'0000-00-00','0000-00-00'),(1590,208,'龙南县',360727,0,0,'0000-00-00','0000-00-00'),(1591,208,'定南县',360728,0,0,'0000-00-00','0000-00-00'),(1592,208,'全南县',360729,0,0,'0000-00-00','0000-00-00'),(1593,208,'宁都县',360730,0,0,'0000-00-00','0000-00-00'),(1594,208,'于都县',360731,0,0,'0000-00-00','0000-00-00'),(1595,208,'兴国县',360732,0,0,'0000-00-00','0000-00-00'),(1596,208,'会昌县',360733,0,0,'0000-00-00','0000-00-00'),(1597,208,'寻乌县',360734,0,0,'0000-00-00','0000-00-00'),(1598,208,'石城县',360735,0,0,'0000-00-00','0000-00-00'),(1599,208,'瑞金市',360781,0,0,'0000-00-00','0000-00-00'),(1600,209,'吉州区',360802,0,0,'0000-00-00','0000-00-00'),(1601,209,'青原区',360803,0,0,'0000-00-00','0000-00-00'),(1602,209,'吉安县',360821,0,0,'0000-00-00','0000-00-00'),(1603,209,'吉水县',360822,0,0,'0000-00-00','0000-00-00'),(1604,209,'峡江县',360823,0,0,'0000-00-00','0000-00-00'),(1605,209,'新干县',360824,0,0,'0000-00-00','0000-00-00'),(1606,209,'永丰县',360825,0,0,'0000-00-00','0000-00-00'),(1607,209,'泰和县',360826,0,0,'0000-00-00','0000-00-00'),(1608,209,'遂川县',360827,0,0,'0000-00-00','0000-00-00'),(1609,209,'万安县',360828,0,0,'0000-00-00','0000-00-00'),(1610,209,'安福县',360829,0,0,'0000-00-00','0000-00-00'),(1611,209,'永新县',360830,0,0,'0000-00-00','0000-00-00'),(1612,209,'井冈山市',360881,0,0,'0000-00-00','0000-00-00'),(1613,210,'袁州区',360902,0,0,'0000-00-00','0000-00-00'),(1614,210,'奉新县',360921,0,0,'0000-00-00','0000-00-00'),(1615,210,'万载县',360922,0,0,'0000-00-00','0000-00-00'),(1616,210,'上高县',360923,0,0,'0000-00-00','0000-00-00'),(1617,210,'宜丰县',360924,0,0,'0000-00-00','0000-00-00'),(1618,210,'靖安县',360925,0,0,'0000-00-00','0000-00-00'),(1619,210,'铜鼓县',360926,0,0,'0000-00-00','0000-00-00'),(1620,210,'丰城市',360981,0,0,'0000-00-00','0000-00-00'),(1621,210,'樟树市',360982,0,0,'0000-00-00','0000-00-00'),(1622,210,'高安市',360983,0,0,'0000-00-00','0000-00-00'),(1623,211,'临川区',361002,0,0,'0000-00-00','0000-00-00'),(1624,211,'南城县',361021,0,0,'0000-00-00','0000-00-00'),(1625,211,'黎川县',361022,0,0,'0000-00-00','0000-00-00'),(1626,211,'南丰县',361023,0,0,'0000-00-00','0000-00-00'),(1627,211,'崇仁县',361024,0,0,'0000-00-00','0000-00-00'),(1628,211,'乐安县',361025,0,0,'0000-00-00','0000-00-00'),(1629,211,'宜黄县',361026,0,0,'0000-00-00','0000-00-00'),(1630,211,'金溪县',361027,0,0,'0000-00-00','0000-00-00'),(1631,211,'资溪县',361028,0,0,'0000-00-00','0000-00-00'),(1632,211,'东乡县',361029,0,0,'0000-00-00','0000-00-00'),(1633,211,'广昌县',361030,0,0,'0000-00-00','0000-00-00'),(1634,212,'信州区',361102,0,0,'0000-00-00','0000-00-00'),(1635,212,'广丰区',361103,0,0,'0000-00-00','0000-00-00'),(1636,212,'上饶县',361121,0,0,'0000-00-00','0000-00-00'),(1637,212,'玉山县',361123,0,0,'0000-00-00','0000-00-00'),(1638,212,'铅山县',361124,0,0,'0000-00-00','0000-00-00'),(1639,212,'横峰县',361125,0,0,'0000-00-00','0000-00-00'),(1640,212,'弋阳县',361126,0,0,'0000-00-00','0000-00-00'),(1641,212,'余干县',361127,0,0,'0000-00-00','0000-00-00'),(1642,212,'鄱阳县',361128,0,0,'0000-00-00','0000-00-00'),(1643,212,'万年县',361129,0,0,'0000-00-00','0000-00-00'),(1644,212,'婺源县',361130,0,0,'0000-00-00','0000-00-00'),(1645,212,'德兴市',361181,0,0,'0000-00-00','0000-00-00'),(1646,213,'历下区',370102,0,0,'0000-00-00','0000-00-00'),(1647,213,'市中区',370103,0,0,'0000-00-00','0000-00-00'),(1648,213,'槐荫区',370104,0,0,'0000-00-00','0000-00-00'),(1649,213,'天桥区',370105,0,0,'0000-00-00','0000-00-00'),(1650,213,'历城区',370112,0,0,'0000-00-00','0000-00-00'),(1651,213,'长清区',370113,0,0,'0000-00-00','0000-00-00'),(1652,213,'平阴县',370124,0,0,'0000-00-00','0000-00-00'),(1653,213,'济阳县',370125,0,0,'0000-00-00','0000-00-00'),(1654,213,'商河县',370126,0,0,'0000-00-00','0000-00-00'),(1655,213,'章丘市',370181,0,0,'0000-00-00','0000-00-00'),(1656,214,'市南区',370202,0,0,'0000-00-00','0000-00-00'),(1657,214,'市北区',370203,0,0,'0000-00-00','0000-00-00'),(1658,214,'黄岛区',370211,0,0,'0000-00-00','0000-00-00'),(1659,214,'崂山区',370212,0,0,'0000-00-00','0000-00-00'),(1660,214,'李沧区',370213,0,0,'0000-00-00','0000-00-00'),(1661,214,'城阳区',370214,0,0,'0000-00-00','0000-00-00'),(1662,214,'胶州市',370281,0,0,'0000-00-00','0000-00-00'),(1663,214,'即墨市',370282,0,0,'0000-00-00','0000-00-00'),(1664,214,'平度市',370283,0,0,'0000-00-00','0000-00-00'),(1665,214,'莱西市',370285,0,0,'0000-00-00','0000-00-00'),(1666,215,'淄川区',370302,0,0,'0000-00-00','0000-00-00'),(1667,215,'张店区',370303,0,0,'0000-00-00','0000-00-00'),(1668,215,'博山区',370304,0,0,'0000-00-00','0000-00-00'),(1669,215,'临淄区',370305,0,0,'0000-00-00','0000-00-00'),(1670,215,'周村区',370306,0,0,'0000-00-00','0000-00-00'),(1671,215,'桓台县',370321,0,0,'0000-00-00','0000-00-00'),(1672,215,'高青县',370322,0,0,'0000-00-00','0000-00-00'),(1673,215,'沂源县',370323,0,0,'0000-00-00','0000-00-00'),(1674,216,'市中区',370402,0,0,'0000-00-00','0000-00-00'),(1675,216,'薛城区',370403,0,0,'0000-00-00','0000-00-00'),(1676,216,'峄城区',370404,0,0,'0000-00-00','0000-00-00'),(1677,216,'台儿庄区',370405,0,0,'0000-00-00','0000-00-00'),(1678,216,'山亭区',370406,0,0,'0000-00-00','0000-00-00'),(1679,216,'滕州市',370481,0,0,'0000-00-00','0000-00-00'),(1680,217,'东营区',370502,0,0,'0000-00-00','0000-00-00'),(1681,217,'河口区',370503,0,0,'0000-00-00','0000-00-00'),(1682,217,'垦利县',370521,0,0,'0000-00-00','0000-00-00'),(1683,217,'利津县',370522,0,0,'0000-00-00','0000-00-00'),(1684,217,'广饶县',370523,0,0,'0000-00-00','0000-00-00'),(1685,218,'芝罘区',370602,0,0,'0000-00-00','0000-00-00'),(1686,218,'福山区',370611,0,0,'0000-00-00','0000-00-00'),(1687,218,'牟平区',370612,0,0,'0000-00-00','0000-00-00'),(1688,218,'莱山区',370613,0,0,'0000-00-00','0000-00-00'),(1689,218,'长岛县',370634,0,0,'0000-00-00','0000-00-00'),(1690,218,'龙口市',370681,0,0,'0000-00-00','0000-00-00'),(1691,218,'莱阳市',370682,0,0,'0000-00-00','0000-00-00'),(1692,218,'莱州市',370683,0,0,'0000-00-00','0000-00-00'),(1693,218,'蓬莱市',370684,0,0,'0000-00-00','0000-00-00'),(1694,218,'招远市',370685,0,0,'0000-00-00','0000-00-00'),(1695,218,'栖霞市',370686,0,0,'0000-00-00','0000-00-00'),(1696,218,'海阳市',370687,0,0,'0000-00-00','0000-00-00'),(1697,219,'潍城区',370702,0,0,'0000-00-00','0000-00-00'),(1698,219,'寒亭区',370703,0,0,'0000-00-00','0000-00-00'),(1699,219,'坊子区',370704,0,0,'0000-00-00','0000-00-00'),(1700,219,'奎文区',370705,0,0,'0000-00-00','0000-00-00'),(1701,219,'临朐县',370724,0,0,'0000-00-00','0000-00-00'),(1702,219,'昌乐县',370725,0,0,'0000-00-00','0000-00-00'),(1703,219,'青州市',370781,0,0,'0000-00-00','0000-00-00'),(1704,219,'诸城市',370782,0,0,'0000-00-00','0000-00-00'),(1705,219,'寿光市',370783,0,0,'0000-00-00','0000-00-00'),(1706,219,'安丘市',370784,0,0,'0000-00-00','0000-00-00'),(1707,219,'高密市',370785,0,0,'0000-00-00','0000-00-00'),(1708,219,'昌邑市',370786,0,0,'0000-00-00','0000-00-00'),(1709,220,'任城区',370811,0,0,'0000-00-00','0000-00-00'),(1710,220,'兖州区',370812,0,0,'0000-00-00','0000-00-00'),(1711,220,'微山县',370826,0,0,'0000-00-00','0000-00-00'),(1712,220,'鱼台县',370827,0,0,'0000-00-00','0000-00-00'),(1713,220,'金乡县',370828,0,0,'0000-00-00','0000-00-00'),(1714,220,'嘉祥县',370829,0,0,'0000-00-00','0000-00-00'),(1715,220,'汶上县',370830,0,0,'0000-00-00','0000-00-00'),(1716,220,'泗水县',370831,0,0,'0000-00-00','0000-00-00'),(1717,220,'梁山县',370832,0,0,'0000-00-00','0000-00-00'),(1718,220,'曲阜市',370881,0,0,'0000-00-00','0000-00-00'),(1719,220,'邹城市',370883,0,0,'0000-00-00','0000-00-00'),(1720,221,'泰山区',370902,0,0,'0000-00-00','0000-00-00'),(1721,221,'岱岳区',370911,0,0,'0000-00-00','0000-00-00'),(1722,221,'宁阳县',370921,0,0,'0000-00-00','0000-00-00'),(1723,221,'东平县',370923,0,0,'0000-00-00','0000-00-00'),(1724,221,'新泰市',370982,0,0,'0000-00-00','0000-00-00'),(1725,221,'肥城市',370983,0,0,'0000-00-00','0000-00-00'),(1726,222,'环翠区',371002,0,0,'0000-00-00','0000-00-00'),(1727,222,'文登区',371003,0,0,'0000-00-00','0000-00-00'),(1728,222,'荣成市',371082,0,0,'0000-00-00','0000-00-00'),(1729,222,'乳山市',371083,0,0,'0000-00-00','0000-00-00'),(1730,223,'东港区',371102,0,0,'0000-00-00','0000-00-00'),(1731,223,'岚山区',371103,0,0,'0000-00-00','0000-00-00'),(1732,223,'五莲县',371121,0,0,'0000-00-00','0000-00-00'),(1733,223,'莒县',371122,0,0,'0000-00-00','0000-00-00'),(1734,224,'莱城区',371202,0,0,'0000-00-00','0000-00-00'),(1735,224,'钢城区',371203,0,0,'0000-00-00','0000-00-00'),(1736,225,'兰山区',371302,0,0,'0000-00-00','0000-00-00'),(1737,225,'罗庄区',371311,0,0,'0000-00-00','0000-00-00'),(1738,225,'河东区',371312,0,0,'0000-00-00','0000-00-00'),(1739,225,'沂南县',371321,0,0,'0000-00-00','0000-00-00'),(1740,225,'郯城县',371322,0,0,'0000-00-00','0000-00-00'),(1741,225,'沂水县',371323,0,0,'0000-00-00','0000-00-00'),(1742,225,'兰陵县',371324,0,0,'0000-00-00','0000-00-00'),(1743,225,'费县',371325,0,0,'0000-00-00','0000-00-00'),(1744,225,'平邑县',371326,0,0,'0000-00-00','0000-00-00'),(1745,225,'莒南县',371327,0,0,'0000-00-00','0000-00-00'),(1746,225,'蒙阴县',371328,0,0,'0000-00-00','0000-00-00'),(1747,225,'临沭县',371329,0,0,'0000-00-00','0000-00-00'),(1748,226,'德城区',371402,0,0,'0000-00-00','0000-00-00'),(1749,226,'陵城区',371403,0,0,'0000-00-00','0000-00-00'),(1750,226,'宁津县',371422,0,0,'0000-00-00','0000-00-00'),(1751,226,'庆云县',371423,0,0,'0000-00-00','0000-00-00'),(1752,226,'临邑县',371424,0,0,'0000-00-00','0000-00-00'),(1753,226,'齐河县',371425,0,0,'0000-00-00','0000-00-00'),(1754,226,'平原县',371426,0,0,'0000-00-00','0000-00-00'),(1755,226,'夏津县',371427,0,0,'0000-00-00','0000-00-00'),(1756,226,'武城县',371428,0,0,'0000-00-00','0000-00-00'),(1757,226,'乐陵市',371481,0,0,'0000-00-00','0000-00-00'),(1758,226,'禹城市',371482,0,0,'0000-00-00','0000-00-00'),(1759,227,'东昌府区',371502,0,0,'0000-00-00','0000-00-00'),(1760,227,'阳谷县',371521,0,0,'0000-00-00','0000-00-00'),(1761,227,'莘县',371522,0,0,'0000-00-00','0000-00-00'),(1762,227,'茌平县',371523,0,0,'0000-00-00','0000-00-00'),(1763,227,'东阿县',371524,0,0,'0000-00-00','0000-00-00'),(1764,227,'冠县',371525,0,0,'0000-00-00','0000-00-00'),(1765,227,'高唐县',371526,0,0,'0000-00-00','0000-00-00'),(1766,227,'临清市',371581,0,0,'0000-00-00','0000-00-00'),(1767,228,'滨城区',371602,0,0,'0000-00-00','0000-00-00'),(1768,228,'沾化区',371603,0,0,'0000-00-00','0000-00-00'),(1769,228,'惠民县',371621,0,0,'0000-00-00','0000-00-00'),(1770,228,'阳信县',371622,0,0,'0000-00-00','0000-00-00'),(1771,228,'无棣县',371623,0,0,'0000-00-00','0000-00-00'),(1772,228,'博兴县',371625,0,0,'0000-00-00','0000-00-00'),(1773,228,'邹平县',371626,0,0,'0000-00-00','0000-00-00'),(1774,229,'牡丹区',371702,0,0,'0000-00-00','0000-00-00'),(1775,229,'曹县',371721,0,0,'0000-00-00','0000-00-00'),(1776,229,'单县',371722,0,0,'0000-00-00','0000-00-00'),(1777,229,'成武县',371723,0,0,'0000-00-00','0000-00-00'),(1778,229,'巨野县',371724,0,0,'0000-00-00','0000-00-00'),(1779,229,'郓城县',371725,0,0,'0000-00-00','0000-00-00'),(1780,229,'鄄城县',371726,0,0,'0000-00-00','0000-00-00'),(1781,229,'定陶县',371727,0,0,'0000-00-00','0000-00-00'),(1782,229,'东明县',371728,0,0,'0000-00-00','0000-00-00'),(1783,230,'中原区',410102,0,0,'0000-00-00','0000-00-00'),(1784,230,'二七区',410103,0,0,'0000-00-00','0000-00-00'),(1785,230,'管城回族区',410104,0,0,'0000-00-00','0000-00-00'),(1786,230,'金水区',410105,0,0,'0000-00-00','0000-00-00'),(1787,230,'上街区',410106,0,0,'0000-00-00','0000-00-00'),(1788,230,'惠济区',410108,0,0,'0000-00-00','0000-00-00'),(1789,230,'中牟县',410122,0,0,'0000-00-00','0000-00-00'),(1790,230,'巩义市',410181,0,0,'0000-00-00','0000-00-00'),(1791,230,'荥阳市',410182,0,0,'0000-00-00','0000-00-00'),(1792,230,'新密市',410183,0,0,'0000-00-00','0000-00-00'),(1793,230,'新郑市',410184,0,0,'0000-00-00','0000-00-00'),(1794,230,'登封市',410185,0,0,'0000-00-00','0000-00-00'),(1795,231,'龙亭区',410202,0,0,'0000-00-00','0000-00-00'),(1796,231,'顺河回族区',410203,0,0,'0000-00-00','0000-00-00'),(1797,231,'鼓楼区',410204,0,0,'0000-00-00','0000-00-00'),(1798,231,'禹王台区',410205,0,0,'0000-00-00','0000-00-00'),(1799,231,'祥符区',410212,0,0,'0000-00-00','0000-00-00'),(1800,231,'杞县',410221,0,0,'0000-00-00','0000-00-00'),(1801,231,'通许县',410222,0,0,'0000-00-00','0000-00-00'),(1802,231,'尉氏县',410223,0,0,'0000-00-00','0000-00-00'),(1803,231,'兰考县',410225,0,0,'0000-00-00','0000-00-00'),(1804,232,'老城区',410302,0,0,'0000-00-00','0000-00-00'),(1805,232,'西工区',410303,0,0,'0000-00-00','0000-00-00'),(1806,232,'瀍河回族区',410304,0,0,'0000-00-00','0000-00-00'),(1807,232,'涧西区',410305,0,0,'0000-00-00','0000-00-00'),(1808,232,'吉利区',410306,0,0,'0000-00-00','0000-00-00'),(1809,232,'洛龙区',410311,0,0,'0000-00-00','0000-00-00'),(1810,232,'孟津县',410322,0,0,'0000-00-00','0000-00-00'),(1811,232,'新安县',410323,0,0,'0000-00-00','0000-00-00'),(1812,232,'栾川县',410324,0,0,'0000-00-00','0000-00-00'),(1813,232,'嵩县',410325,0,0,'0000-00-00','0000-00-00'),(1814,232,'汝阳县',410326,0,0,'0000-00-00','0000-00-00'),(1815,232,'宜阳县',410327,0,0,'0000-00-00','0000-00-00'),(1816,232,'洛宁县',410328,0,0,'0000-00-00','0000-00-00'),(1817,232,'伊川县',410329,0,0,'0000-00-00','0000-00-00'),(1818,232,'偃师市',410381,0,0,'0000-00-00','0000-00-00'),(1819,233,'新华区',410402,0,0,'0000-00-00','0000-00-00'),(1820,233,'卫东区',410403,0,0,'0000-00-00','0000-00-00'),(1821,233,'石龙区',410404,0,0,'0000-00-00','0000-00-00'),(1822,233,'湛河区',410411,0,0,'0000-00-00','0000-00-00'),(1823,233,'宝丰县',410421,0,0,'0000-00-00','0000-00-00'),(1824,233,'叶县',410422,0,0,'0000-00-00','0000-00-00'),(1825,233,'鲁山县',410423,0,0,'0000-00-00','0000-00-00'),(1826,233,'郏县',410425,0,0,'0000-00-00','0000-00-00'),(1827,233,'舞钢市',410481,0,0,'0000-00-00','0000-00-00'),(1828,233,'汝州市',410482,0,0,'0000-00-00','0000-00-00'),(1829,234,'文峰区',410502,0,0,'0000-00-00','0000-00-00'),(1830,234,'北关区',410503,0,0,'0000-00-00','0000-00-00'),(1831,234,'殷都区',410505,0,0,'0000-00-00','0000-00-00'),(1832,234,'龙安区',410506,0,0,'0000-00-00','0000-00-00'),(1833,234,'安阳县',410522,0,0,'0000-00-00','0000-00-00'),(1834,234,'汤阴县',410523,0,0,'0000-00-00','0000-00-00'),(1835,234,'滑县',410526,0,0,'0000-00-00','0000-00-00'),(1836,234,'内黄县',410527,0,0,'0000-00-00','0000-00-00'),(1837,234,'林州市',410581,0,0,'0000-00-00','0000-00-00'),(1838,235,'鹤山区',410602,0,0,'0000-00-00','0000-00-00'),(1839,235,'山城区',410603,0,0,'0000-00-00','0000-00-00'),(1840,235,'淇滨区',410611,0,0,'0000-00-00','0000-00-00'),(1841,235,'浚县',410621,0,0,'0000-00-00','0000-00-00'),(1842,235,'淇县',410622,0,0,'0000-00-00','0000-00-00'),(1843,236,'红旗区',410702,0,0,'0000-00-00','0000-00-00'),(1844,236,'卫滨区',410703,0,0,'0000-00-00','0000-00-00'),(1845,236,'凤泉区',410704,0,0,'0000-00-00','0000-00-00'),(1846,236,'牧野区',410711,0,0,'0000-00-00','0000-00-00'),(1847,236,'新乡县',410721,0,0,'0000-00-00','0000-00-00'),(1848,236,'获嘉县',410724,0,0,'0000-00-00','0000-00-00'),(1849,236,'原阳县',410725,0,0,'0000-00-00','0000-00-00'),(1850,236,'延津县',410726,0,0,'0000-00-00','0000-00-00'),(1851,236,'封丘县',410727,0,0,'0000-00-00','0000-00-00'),(1852,236,'长垣县',410728,0,0,'0000-00-00','0000-00-00'),(1853,236,'卫辉市',410781,0,0,'0000-00-00','0000-00-00'),(1854,236,'辉县市',410782,0,0,'0000-00-00','0000-00-00'),(1855,237,'解放区',410802,0,0,'0000-00-00','0000-00-00'),(1856,237,'中站区',410803,0,0,'0000-00-00','0000-00-00'),(1857,237,'马村区',410804,0,0,'0000-00-00','0000-00-00'),(1858,237,'山阳区',410811,0,0,'0000-00-00','0000-00-00'),(1859,237,'修武县',410821,0,0,'0000-00-00','0000-00-00'),(1860,237,'博爱县',410822,0,0,'0000-00-00','0000-00-00'),(1861,237,'武陟县',410823,0,0,'0000-00-00','0000-00-00'),(1862,237,'温县',410825,0,0,'0000-00-00','0000-00-00'),(1863,237,'沁阳市',410882,0,0,'0000-00-00','0000-00-00'),(1864,237,'孟州市',410883,0,0,'0000-00-00','0000-00-00'),(1865,238,'华龙区',410902,0,0,'0000-00-00','0000-00-00'),(1866,238,'清丰县',410922,0,0,'0000-00-00','0000-00-00'),(1867,238,'南乐县',410923,0,0,'0000-00-00','0000-00-00'),(1868,238,'范县',410926,0,0,'0000-00-00','0000-00-00'),(1869,238,'台前县',410927,0,0,'0000-00-00','0000-00-00'),(1870,238,'濮阳县',410928,0,0,'0000-00-00','0000-00-00'),(1871,239,'魏都区',411002,0,0,'0000-00-00','0000-00-00'),(1872,239,'许昌县',411023,0,0,'0000-00-00','0000-00-00'),(1873,239,'鄢陵县',411024,0,0,'0000-00-00','0000-00-00'),(1874,239,'襄城县',411025,0,0,'0000-00-00','0000-00-00'),(1875,239,'禹州市',411081,0,0,'0000-00-00','0000-00-00'),(1876,239,'长葛市',411082,0,0,'0000-00-00','0000-00-00'),(1877,240,'源汇区',411102,0,0,'0000-00-00','0000-00-00'),(1878,240,'郾城区',411103,0,0,'0000-00-00','0000-00-00'),(1879,240,'召陵区',411104,0,0,'0000-00-00','0000-00-00'),(1880,240,'舞阳县',411121,0,0,'0000-00-00','0000-00-00'),(1881,240,'临颍县',411122,0,0,'0000-00-00','0000-00-00'),(1882,241,'湖滨区',411202,0,0,'0000-00-00','0000-00-00'),(1883,241,'陕州区',411203,0,0,'0000-00-00','0000-00-00'),(1884,241,'渑池县',411221,0,0,'0000-00-00','0000-00-00'),(1885,241,'卢氏县',411224,0,0,'0000-00-00','0000-00-00'),(1886,241,'义马市',411281,0,0,'0000-00-00','0000-00-00'),(1887,241,'灵宝市',411282,0,0,'0000-00-00','0000-00-00'),(1888,242,'宛城区',411302,0,0,'0000-00-00','0000-00-00'),(1889,242,'卧龙区',411303,0,0,'0000-00-00','0000-00-00'),(1890,242,'南召县',411321,0,0,'0000-00-00','0000-00-00'),(1891,242,'方城县',411322,0,0,'0000-00-00','0000-00-00'),(1892,242,'西峡县',411323,0,0,'0000-00-00','0000-00-00'),(1893,242,'镇平县',411324,0,0,'0000-00-00','0000-00-00'),(1894,242,'内乡县',411325,0,0,'0000-00-00','0000-00-00'),(1895,242,'淅川县',411326,0,0,'0000-00-00','0000-00-00'),(1896,242,'社旗县',411327,0,0,'0000-00-00','0000-00-00'),(1897,242,'唐河县',411328,0,0,'0000-00-00','0000-00-00'),(1898,242,'新野县',411329,0,0,'0000-00-00','0000-00-00'),(1899,242,'桐柏县',411330,0,0,'0000-00-00','0000-00-00'),(1900,242,'邓州市',411381,0,0,'0000-00-00','0000-00-00'),(1901,243,'梁园区',411402,0,0,'0000-00-00','0000-00-00'),(1902,243,'睢阳区',411403,0,0,'0000-00-00','0000-00-00'),(1903,243,'民权县',411421,0,0,'0000-00-00','0000-00-00'),(1904,243,'睢县',411422,0,0,'0000-00-00','0000-00-00'),(1905,243,'宁陵县',411423,0,0,'0000-00-00','0000-00-00'),(1906,243,'柘城县',411424,0,0,'0000-00-00','0000-00-00'),(1907,243,'虞城县',411425,0,0,'0000-00-00','0000-00-00'),(1908,243,'夏邑县',411426,0,0,'0000-00-00','0000-00-00'),(1909,243,'永城市',411481,0,0,'0000-00-00','0000-00-00'),(1910,244,'浉河区',411502,0,0,'0000-00-00','0000-00-00'),(1911,244,'平桥区',411503,0,0,'0000-00-00','0000-00-00'),(1912,244,'罗山县',411521,0,0,'0000-00-00','0000-00-00'),(1913,244,'光山县',411522,0,0,'0000-00-00','0000-00-00'),(1914,244,'新县',411523,0,0,'0000-00-00','0000-00-00'),(1915,244,'商城县',411524,0,0,'0000-00-00','0000-00-00'),(1916,244,'固始县',411525,0,0,'0000-00-00','0000-00-00'),(1917,244,'潢川县',411526,0,0,'0000-00-00','0000-00-00'),(1918,244,'淮滨县',411527,0,0,'0000-00-00','0000-00-00'),(1919,244,'息县',411528,0,0,'0000-00-00','0000-00-00'),(1920,245,'川汇区',411602,0,0,'0000-00-00','0000-00-00'),(1921,245,'扶沟县',411621,0,0,'0000-00-00','0000-00-00'),(1922,245,'西华县',411622,0,0,'0000-00-00','0000-00-00'),(1923,245,'商水县',411623,0,0,'0000-00-00','0000-00-00'),(1924,245,'沈丘县',411624,0,0,'0000-00-00','0000-00-00'),(1925,245,'郸城县',411625,0,0,'0000-00-00','0000-00-00'),(1926,245,'淮阳县',411626,0,0,'0000-00-00','0000-00-00'),(1927,245,'太康县',411627,0,0,'0000-00-00','0000-00-00'),(1928,245,'鹿邑县',411628,0,0,'0000-00-00','0000-00-00'),(1929,245,'项城市',411681,0,0,'0000-00-00','0000-00-00'),(1930,246,'驿城区',411702,0,0,'0000-00-00','0000-00-00'),(1931,246,'西平县',411721,0,0,'0000-00-00','0000-00-00'),(1932,246,'上蔡县',411722,0,0,'0000-00-00','0000-00-00'),(1933,246,'平舆县',411723,0,0,'0000-00-00','0000-00-00'),(1934,246,'正阳县',411724,0,0,'0000-00-00','0000-00-00'),(1935,246,'确山县',411725,0,0,'0000-00-00','0000-00-00'),(1936,246,'泌阳县',411726,0,0,'0000-00-00','0000-00-00'),(1937,246,'汝南县',411727,0,0,'0000-00-00','0000-00-00'),(1938,246,'遂平县',411728,0,0,'0000-00-00','0000-00-00'),(1939,246,'新蔡县',411729,0,0,'0000-00-00','0000-00-00'),(1940,248,'江岸区',420102,0,0,'0000-00-00','0000-00-00'),(1941,248,'江汉区',420103,0,0,'0000-00-00','0000-00-00'),(1942,248,'硚口区',420104,0,0,'0000-00-00','0000-00-00'),(1943,248,'汉阳区',420105,0,0,'0000-00-00','0000-00-00'),(1944,248,'武昌区',420106,0,0,'0000-00-00','0000-00-00'),(1945,248,'青山区',420107,0,0,'0000-00-00','0000-00-00'),(1946,248,'洪山区',420111,0,0,'0000-00-00','0000-00-00'),(1947,248,'东西湖区',420112,0,0,'0000-00-00','0000-00-00'),(1948,248,'汉南区',420113,0,0,'0000-00-00','0000-00-00'),(1949,248,'蔡甸区',420114,0,0,'0000-00-00','0000-00-00'),(1950,248,'江夏区',420115,0,0,'0000-00-00','0000-00-00'),(1951,248,'黄陂区',420116,0,0,'0000-00-00','0000-00-00'),(1952,248,'新洲区',420117,0,0,'0000-00-00','0000-00-00'),(1953,249,'黄石港区',420202,0,0,'0000-00-00','0000-00-00'),(1954,249,'西塞山区',420203,0,0,'0000-00-00','0000-00-00'),(1955,249,'下陆区',420204,0,0,'0000-00-00','0000-00-00'),(1956,249,'铁山区',420205,0,0,'0000-00-00','0000-00-00'),(1957,249,'阳新县',420222,0,0,'0000-00-00','0000-00-00'),(1958,249,'大冶市',420281,0,0,'0000-00-00','0000-00-00'),(1959,250,'茅箭区',420302,0,0,'0000-00-00','0000-00-00'),(1960,250,'张湾区',420303,0,0,'0000-00-00','0000-00-00'),(1961,250,'郧阳区',420304,0,0,'0000-00-00','0000-00-00'),(1962,250,'郧西县',420322,0,0,'0000-00-00','0000-00-00'),(1963,250,'竹山县',420323,0,0,'0000-00-00','0000-00-00'),(1964,250,'竹溪县',420324,0,0,'0000-00-00','0000-00-00'),(1965,250,'房县',420325,0,0,'0000-00-00','0000-00-00'),(1966,250,'丹江口市',420381,0,0,'0000-00-00','0000-00-00'),(1967,251,'西陵区',420502,0,0,'0000-00-00','0000-00-00'),(1968,251,'伍家岗区',420503,0,0,'0000-00-00','0000-00-00'),(1969,251,'点军区',420504,0,0,'0000-00-00','0000-00-00'),(1970,251,'猇亭区',420505,0,0,'0000-00-00','0000-00-00'),(1971,251,'夷陵区',420506,0,0,'0000-00-00','0000-00-00'),(1972,251,'远安县',420525,0,0,'0000-00-00','0000-00-00'),(1973,251,'兴山县',420526,0,0,'0000-00-00','0000-00-00'),(1974,251,'秭归县',420527,0,0,'0000-00-00','0000-00-00'),(1975,251,'长阳土家族',420528,0,0,'0000-00-00','0000-00-00'),(1976,251,'五峰土家族',420529,0,0,'0000-00-00','0000-00-00'),(1977,251,'宜都市',420581,0,0,'0000-00-00','0000-00-00'),(1978,251,'当阳市',420582,0,0,'0000-00-00','0000-00-00'),(1979,251,'枝江市',420583,0,0,'0000-00-00','0000-00-00'),(1980,252,'襄城区',420602,0,0,'0000-00-00','0000-00-00'),(1981,252,'樊城区',420606,0,0,'0000-00-00','0000-00-00'),(1982,252,'襄州区',420607,0,0,'0000-00-00','0000-00-00'),(1983,252,'南漳县',420624,0,0,'0000-00-00','0000-00-00'),(1984,252,'谷城县',420625,0,0,'0000-00-00','0000-00-00'),(1985,252,'保康县',420626,0,0,'0000-00-00','0000-00-00'),(1986,252,'老河口市',420682,0,0,'0000-00-00','0000-00-00'),(1987,252,'枣阳市',420683,0,0,'0000-00-00','0000-00-00'),(1988,252,'宜城市',420684,0,0,'0000-00-00','0000-00-00'),(1989,253,'梁子湖区',420702,0,0,'0000-00-00','0000-00-00'),(1990,253,'华容区',420703,0,0,'0000-00-00','0000-00-00'),(1991,253,'鄂城区',420704,0,0,'0000-00-00','0000-00-00'),(1992,254,'东宝区',420802,0,0,'0000-00-00','0000-00-00'),(1993,254,'掇刀区',420804,0,0,'0000-00-00','0000-00-00'),(1994,254,'京山县',420821,0,0,'0000-00-00','0000-00-00'),(1995,254,'沙洋县',420822,0,0,'0000-00-00','0000-00-00'),(1996,254,'钟祥市',420881,0,0,'0000-00-00','0000-00-00'),(1997,255,'孝南区',420902,0,0,'0000-00-00','0000-00-00'),(1998,255,'孝昌县',420921,0,0,'0000-00-00','0000-00-00'),(1999,255,'大悟县',420922,0,0,'0000-00-00','0000-00-00'),(2000,255,'云梦县',420923,0,0,'0000-00-00','0000-00-00'),(2001,255,'应城市',420981,0,0,'0000-00-00','0000-00-00'),(2002,255,'安陆市',420982,0,0,'0000-00-00','0000-00-00'),(2003,255,'汉川市',420984,0,0,'0000-00-00','0000-00-00'),(2004,256,'沙市区',421002,0,0,'0000-00-00','0000-00-00'),(2005,256,'荆州区',421003,0,0,'0000-00-00','0000-00-00'),(2006,256,'公安县',421022,0,0,'0000-00-00','0000-00-00'),(2007,256,'监利县',421023,0,0,'0000-00-00','0000-00-00'),(2008,256,'江陵县',421024,0,0,'0000-00-00','0000-00-00'),(2009,256,'石首市',421081,0,0,'0000-00-00','0000-00-00'),(2010,256,'洪湖市',421083,0,0,'0000-00-00','0000-00-00'),(2011,256,'松滋市',421087,0,0,'0000-00-00','0000-00-00'),(2012,257,'黄州区',421102,0,0,'0000-00-00','0000-00-00'),(2013,257,'团风县',421121,0,0,'0000-00-00','0000-00-00'),(2014,257,'红安县',421122,0,0,'0000-00-00','0000-00-00'),(2015,257,'罗田县',421123,0,0,'0000-00-00','0000-00-00'),(2016,257,'英山县',421124,0,0,'0000-00-00','0000-00-00'),(2017,257,'浠水县',421125,0,0,'0000-00-00','0000-00-00'),(2018,257,'蕲春县',421126,0,0,'0000-00-00','0000-00-00'),(2019,257,'黄梅县',421127,0,0,'0000-00-00','0000-00-00'),(2020,257,'麻城市',421181,0,0,'0000-00-00','0000-00-00'),(2021,257,'武穴市',421182,0,0,'0000-00-00','0000-00-00'),(2022,258,'咸安区',421202,0,0,'0000-00-00','0000-00-00'),(2023,258,'嘉鱼县',421221,0,0,'0000-00-00','0000-00-00'),(2024,258,'通城县',421222,0,0,'0000-00-00','0000-00-00'),(2025,258,'崇阳县',421223,0,0,'0000-00-00','0000-00-00'),(2026,258,'通山县',421224,0,0,'0000-00-00','0000-00-00'),(2027,258,'赤壁市',421281,0,0,'0000-00-00','0000-00-00'),(2028,259,'曾都区',421303,0,0,'0000-00-00','0000-00-00'),(2029,259,'随县',421321,0,0,'0000-00-00','0000-00-00'),(2030,259,'广水市',421381,0,0,'0000-00-00','0000-00-00'),(2031,260,'恩施市',422801,0,0,'0000-00-00','0000-00-00'),(2032,260,'利川市',422802,0,0,'0000-00-00','0000-00-00'),(2033,260,'建始县',422822,0,0,'0000-00-00','0000-00-00'),(2034,260,'巴东县',422823,0,0,'0000-00-00','0000-00-00'),(2035,260,'宣恩县',422825,0,0,'0000-00-00','0000-00-00'),(2036,260,'咸丰县',422826,0,0,'0000-00-00','0000-00-00'),(2037,260,'来凤县',422827,0,0,'0000-00-00','0000-00-00'),(2038,260,'鹤峰县',422828,0,0,'0000-00-00','0000-00-00'),(2039,265,'芙蓉区',430102,0,0,'0000-00-00','0000-00-00'),(2040,265,'天心区',430103,0,0,'0000-00-00','0000-00-00'),(2041,265,'岳麓区',430104,0,0,'0000-00-00','0000-00-00'),(2042,265,'开福区',430105,0,0,'0000-00-00','0000-00-00'),(2043,265,'雨花区',430111,0,0,'0000-00-00','0000-00-00'),(2044,265,'望城区',430112,0,0,'0000-00-00','0000-00-00'),(2045,265,'长沙县',430121,0,0,'0000-00-00','0000-00-00'),(2046,265,'宁乡县',430124,0,0,'0000-00-00','0000-00-00'),(2047,265,'浏阳市',430181,0,0,'0000-00-00','0000-00-00'),(2048,266,'荷塘区',430202,0,0,'0000-00-00','0000-00-00'),(2049,266,'芦淞区',430203,0,0,'0000-00-00','0000-00-00'),(2050,266,'石峰区',430204,0,0,'0000-00-00','0000-00-00'),(2051,266,'天元区',430211,0,0,'0000-00-00','0000-00-00'),(2052,266,'株洲县',430221,0,0,'0000-00-00','0000-00-00'),(2053,266,'攸县',430223,0,0,'0000-00-00','0000-00-00'),(2054,266,'茶陵县',430224,0,0,'0000-00-00','0000-00-00'),(2055,266,'炎陵县',430225,0,0,'0000-00-00','0000-00-00'),(2056,266,'醴陵市',430281,0,0,'0000-00-00','0000-00-00'),(2057,267,'雨湖区',430302,0,0,'0000-00-00','0000-00-00'),(2058,267,'岳塘区',430304,0,0,'0000-00-00','0000-00-00'),(2059,267,'湘潭县',430321,0,0,'0000-00-00','0000-00-00'),(2060,267,'湘乡市',430381,0,0,'0000-00-00','0000-00-00'),(2061,267,'韶山市',430382,0,0,'0000-00-00','0000-00-00'),(2062,268,'珠晖区',430405,0,0,'0000-00-00','0000-00-00'),(2063,268,'雁峰区',430406,0,0,'0000-00-00','0000-00-00'),(2064,268,'石鼓区',430407,0,0,'0000-00-00','0000-00-00'),(2065,268,'蒸湘区',430408,0,0,'0000-00-00','0000-00-00'),(2066,268,'南岳区',430412,0,0,'0000-00-00','0000-00-00'),(2067,268,'衡阳县',430421,0,0,'0000-00-00','0000-00-00'),(2068,268,'衡南县',430422,0,0,'0000-00-00','0000-00-00'),(2069,268,'衡山县',430423,0,0,'0000-00-00','0000-00-00'),(2070,268,'衡东县',430424,0,0,'0000-00-00','0000-00-00'),(2071,268,'祁东县',430426,0,0,'0000-00-00','0000-00-00'),(2072,268,'耒阳市',430481,0,0,'0000-00-00','0000-00-00'),(2073,268,'常宁市',430482,0,0,'0000-00-00','0000-00-00'),(2074,269,'双清区',430502,0,0,'0000-00-00','0000-00-00'),(2075,269,'大祥区',430503,0,0,'0000-00-00','0000-00-00'),(2076,269,'北塔区',430511,0,0,'0000-00-00','0000-00-00'),(2077,269,'邵东县',430521,0,0,'0000-00-00','0000-00-00'),(2078,269,'新邵县',430522,0,0,'0000-00-00','0000-00-00'),(2079,269,'邵阳县',430523,0,0,'0000-00-00','0000-00-00'),(2080,269,'隆回县',430524,0,0,'0000-00-00','0000-00-00'),(2081,269,'洞口县',430525,0,0,'0000-00-00','0000-00-00'),(2082,269,'绥宁县',430527,0,0,'0000-00-00','0000-00-00'),(2083,269,'新宁县',430528,0,0,'0000-00-00','0000-00-00'),(2084,269,'城步苗族',430529,0,0,'0000-00-00','0000-00-00'),(2085,269,'武冈市',430581,0,0,'0000-00-00','0000-00-00'),(2086,270,'岳阳楼区',430602,0,0,'0000-00-00','0000-00-00'),(2087,270,'云溪区',430603,0,0,'0000-00-00','0000-00-00'),(2088,270,'君山区',430611,0,0,'0000-00-00','0000-00-00'),(2089,270,'岳阳县',430621,0,0,'0000-00-00','0000-00-00'),(2090,270,'华容县',430623,0,0,'0000-00-00','0000-00-00'),(2091,270,'湘阴县',430624,0,0,'0000-00-00','0000-00-00'),(2092,270,'平江县',430626,0,0,'0000-00-00','0000-00-00'),(2093,270,'汨罗市',430681,0,0,'0000-00-00','0000-00-00'),(2094,270,'临湘市',430682,0,0,'0000-00-00','0000-00-00'),(2095,271,'武陵区',430702,0,0,'0000-00-00','0000-00-00'),(2096,271,'鼎城区',430703,0,0,'0000-00-00','0000-00-00'),(2097,271,'安乡县',430721,0,0,'0000-00-00','0000-00-00'),(2098,271,'汉寿县',430722,0,0,'0000-00-00','0000-00-00'),(2099,271,'澧县',430723,0,0,'0000-00-00','0000-00-00'),(2100,271,'临澧县',430724,0,0,'0000-00-00','0000-00-00'),(2101,271,'桃源县',430725,0,0,'0000-00-00','0000-00-00'),(2102,271,'石门县',430726,0,0,'0000-00-00','0000-00-00'),(2103,271,'津市市',430781,0,0,'0000-00-00','0000-00-00'),(2104,272,'永定区',430802,0,0,'0000-00-00','0000-00-00'),(2105,272,'武陵源区',430811,0,0,'0000-00-00','0000-00-00'),(2106,272,'慈利县',430821,0,0,'0000-00-00','0000-00-00'),(2107,272,'桑植县',430822,0,0,'0000-00-00','0000-00-00'),(2108,273,'资阳区',430902,0,0,'0000-00-00','0000-00-00'),(2109,273,'赫山区',430903,0,0,'0000-00-00','0000-00-00'),(2110,273,'南县',430921,0,0,'0000-00-00','0000-00-00'),(2111,273,'桃江县',430922,0,0,'0000-00-00','0000-00-00'),(2112,273,'安化县',430923,0,0,'0000-00-00','0000-00-00'),(2113,273,'沅江市',430981,0,0,'0000-00-00','0000-00-00'),(2114,274,'北湖区',431002,0,0,'0000-00-00','0000-00-00'),(2115,274,'苏仙区',431003,0,0,'0000-00-00','0000-00-00'),(2116,274,'桂阳县',431021,0,0,'0000-00-00','0000-00-00'),(2117,274,'宜章县',431022,0,0,'0000-00-00','0000-00-00'),(2118,274,'永兴县',431023,0,0,'0000-00-00','0000-00-00'),(2119,274,'嘉禾县',431024,0,0,'0000-00-00','0000-00-00'),(2120,274,'临武县',431025,0,0,'0000-00-00','0000-00-00'),(2121,274,'汝城县',431026,0,0,'0000-00-00','0000-00-00'),(2122,274,'桂东县',431027,0,0,'0000-00-00','0000-00-00'),(2123,274,'安仁县',431028,0,0,'0000-00-00','0000-00-00'),(2124,274,'资兴市',431081,0,0,'0000-00-00','0000-00-00'),(2125,275,'零陵区',431102,0,0,'0000-00-00','0000-00-00'),(2126,275,'冷水滩区',431103,0,0,'0000-00-00','0000-00-00'),(2127,275,'祁阳县',431121,0,0,'0000-00-00','0000-00-00'),(2128,275,'东安县',431122,0,0,'0000-00-00','0000-00-00'),(2129,275,'双牌县',431123,0,0,'0000-00-00','0000-00-00'),(2130,275,'道县',431124,0,0,'0000-00-00','0000-00-00'),(2131,275,'江永县',431125,0,0,'0000-00-00','0000-00-00'),(2132,275,'宁远县',431126,0,0,'0000-00-00','0000-00-00'),(2133,275,'蓝山县',431127,0,0,'0000-00-00','0000-00-00'),(2134,275,'新田县',431128,0,0,'0000-00-00','0000-00-00'),(2135,275,'江华瑶族',431129,0,0,'0000-00-00','0000-00-00'),(2136,276,'鹤城区',431202,0,0,'0000-00-00','0000-00-00'),(2137,276,'中方县',431221,0,0,'0000-00-00','0000-00-00'),(2138,276,'沅陵县',431222,0,0,'0000-00-00','0000-00-00'),(2139,276,'辰溪县',431223,0,0,'0000-00-00','0000-00-00'),(2140,276,'溆浦县',431224,0,0,'0000-00-00','0000-00-00'),(2141,276,'会同县',431225,0,0,'0000-00-00','0000-00-00'),(2142,276,'麻阳苗族',431226,0,0,'0000-00-00','0000-00-00'),(2143,276,'新晃侗族',431227,0,0,'0000-00-00','0000-00-00'),(2144,276,'芷江侗族',431228,0,0,'0000-00-00','0000-00-00'),(2145,276,'靖州苗族侗族',431229,0,0,'0000-00-00','0000-00-00'),(2146,276,'通道侗族',431230,0,0,'0000-00-00','0000-00-00'),(2147,276,'洪江市',431281,0,0,'0000-00-00','0000-00-00'),(2148,277,'娄星区',431302,0,0,'0000-00-00','0000-00-00'),(2149,277,'双峰县',431321,0,0,'0000-00-00','0000-00-00'),(2150,277,'新化县',431322,0,0,'0000-00-00','0000-00-00'),(2151,277,'冷水江市',431381,0,0,'0000-00-00','0000-00-00'),(2152,277,'涟源市',431382,0,0,'0000-00-00','0000-00-00'),(2153,278,'吉首市',433101,0,0,'0000-00-00','0000-00-00'),(2154,278,'泸溪县',433122,0,0,'0000-00-00','0000-00-00'),(2155,278,'凤凰县',433123,0,0,'0000-00-00','0000-00-00'),(2156,278,'花垣县',433124,0,0,'0000-00-00','0000-00-00'),(2157,278,'保靖县',433125,0,0,'0000-00-00','0000-00-00'),(2158,278,'古丈县',433126,0,0,'0000-00-00','0000-00-00'),(2159,278,'永顺县',433127,0,0,'0000-00-00','0000-00-00'),(2160,278,'龙山县',433130,0,0,'0000-00-00','0000-00-00'),(2161,279,'荔湾区',440103,0,0,'0000-00-00','0000-00-00'),(2162,279,'越秀区',440104,0,0,'0000-00-00','0000-00-00'),(2163,279,'海珠区',440105,0,0,'0000-00-00','0000-00-00'),(2164,279,'天河区',440106,0,0,'0000-00-00','0000-00-00'),(2165,279,'白云区',440111,0,0,'0000-00-00','0000-00-00'),(2166,279,'黄埔区',440112,0,0,'0000-00-00','0000-00-00'),(2167,279,'番禺区',440113,0,0,'0000-00-00','0000-00-00'),(2168,279,'花都区',440114,0,0,'0000-00-00','0000-00-00'),(2169,279,'南沙区',440115,0,0,'0000-00-00','0000-00-00'),(2170,279,'从化区',440117,0,0,'0000-00-00','0000-00-00'),(2171,279,'增城区',440118,0,0,'0000-00-00','0000-00-00'),(2172,280,'武江区',440203,0,0,'0000-00-00','0000-00-00'),(2173,280,'浈江区',440204,0,0,'0000-00-00','0000-00-00'),(2174,280,'曲江区',440205,0,0,'0000-00-00','0000-00-00'),(2175,280,'始兴县',440222,0,0,'0000-00-00','0000-00-00'),(2176,280,'仁化县',440224,0,0,'0000-00-00','0000-00-00'),(2177,280,'翁源县',440229,0,0,'0000-00-00','0000-00-00'),(2178,280,'乳源瑶族',440232,0,0,'0000-00-00','0000-00-00'),(2179,280,'新丰县',440233,0,0,'0000-00-00','0000-00-00'),(2180,280,'乐昌市',440281,0,0,'0000-00-00','0000-00-00'),(2181,280,'南雄市',440282,0,0,'0000-00-00','0000-00-00'),(2182,281,'罗湖区',440303,0,0,'0000-00-00','0000-00-00'),(2183,281,'福田区',440304,0,0,'0000-00-00','0000-00-00'),(2184,281,'南山区',440305,0,0,'0000-00-00','0000-00-00'),(2185,281,'宝安区',440306,0,0,'0000-00-00','0000-00-00'),(2186,281,'龙岗区',440307,0,0,'0000-00-00','0000-00-00'),(2187,281,'盐田区',440308,0,0,'0000-00-00','0000-00-00'),(2188,282,'香洲区',440402,0,0,'0000-00-00','0000-00-00'),(2189,282,'斗门区',440403,0,0,'0000-00-00','0000-00-00'),(2190,282,'金湾区',440404,0,0,'0000-00-00','0000-00-00'),(2191,283,'龙湖区',440507,0,0,'0000-00-00','0000-00-00'),(2192,283,'金平区',440511,0,0,'0000-00-00','0000-00-00'),(2193,283,'濠江区',440512,0,0,'0000-00-00','0000-00-00'),(2194,283,'潮阳区',440513,0,0,'0000-00-00','0000-00-00'),(2195,283,'潮南区',440514,0,0,'0000-00-00','0000-00-00'),(2196,283,'澄海区',440515,0,0,'0000-00-00','0000-00-00'),(2197,283,'南澳县',440523,0,0,'0000-00-00','0000-00-00'),(2198,284,'禅城区',440604,0,0,'0000-00-00','0000-00-00'),(2199,284,'南海区',440605,0,0,'0000-00-00','0000-00-00'),(2200,284,'顺德区',440606,0,0,'0000-00-00','0000-00-00'),(2201,284,'三水区',440607,0,0,'0000-00-00','0000-00-00'),(2202,284,'高明区',440608,0,0,'0000-00-00','0000-00-00'),(2203,285,'蓬江区',440703,0,0,'0000-00-00','0000-00-00'),(2204,285,'江海区',440704,0,0,'0000-00-00','0000-00-00'),(2205,285,'新会区',440705,0,0,'0000-00-00','0000-00-00'),(2206,285,'台山市',440781,0,0,'0000-00-00','0000-00-00'),(2207,285,'开平市',440783,0,0,'0000-00-00','0000-00-00'),(2208,285,'鹤山市',440784,0,0,'0000-00-00','0000-00-00'),(2209,285,'恩平市',440785,0,0,'0000-00-00','0000-00-00'),(2210,286,'赤坎区',440802,0,0,'0000-00-00','0000-00-00'),(2211,286,'霞山区',440803,0,0,'0000-00-00','0000-00-00'),(2212,286,'坡头区',440804,0,0,'0000-00-00','0000-00-00'),(2213,286,'麻章区',440811,0,0,'0000-00-00','0000-00-00'),(2214,286,'遂溪县',440823,0,0,'0000-00-00','0000-00-00'),(2215,286,'徐闻县',440825,0,0,'0000-00-00','0000-00-00'),(2216,286,'廉江市',440881,0,0,'0000-00-00','0000-00-00'),(2217,286,'雷州市',440882,0,0,'0000-00-00','0000-00-00'),(2218,286,'吴川市',440883,0,0,'0000-00-00','0000-00-00'),(2219,287,'茂南区',440902,0,0,'0000-00-00','0000-00-00'),(2220,287,'电白区',440904,0,0,'0000-00-00','0000-00-00'),(2221,287,'高州市',440981,0,0,'0000-00-00','0000-00-00'),(2222,287,'化州市',440982,0,0,'0000-00-00','0000-00-00'),(2223,287,'信宜市',440983,0,0,'0000-00-00','0000-00-00'),(2224,288,'端州区',441202,0,0,'0000-00-00','0000-00-00'),(2225,288,'鼎湖区',441203,0,0,'0000-00-00','0000-00-00'),(2226,288,'广宁县',441223,0,0,'0000-00-00','0000-00-00'),(2227,288,'怀集县',441224,0,0,'0000-00-00','0000-00-00'),(2228,288,'封开县',441225,0,0,'0000-00-00','0000-00-00'),(2229,288,'德庆县',441226,0,0,'0000-00-00','0000-00-00'),(2230,288,'高要区',441283,0,0,'0000-00-00','0000-00-00'),(2231,288,'四会市',441284,0,0,'0000-00-00','0000-00-00'),(2232,289,'惠城区',441302,0,0,'0000-00-00','0000-00-00'),(2233,289,'惠阳区',441303,0,0,'0000-00-00','0000-00-00'),(2234,289,'博罗县',441322,0,0,'0000-00-00','0000-00-00'),(2235,289,'惠东县',441323,0,0,'0000-00-00','0000-00-00'),(2236,289,'龙门县',441324,0,0,'0000-00-00','0000-00-00'),(2237,290,'梅江区',441402,0,0,'0000-00-00','0000-00-00'),(2238,290,'梅县区',441403,0,0,'0000-00-00','0000-00-00'),(2239,290,'大埔县',441422,0,0,'0000-00-00','0000-00-00'),(2240,290,'丰顺县',441423,0,0,'0000-00-00','0000-00-00'),(2241,290,'五华县',441424,0,0,'0000-00-00','0000-00-00'),(2242,290,'平远县',441426,0,0,'0000-00-00','0000-00-00'),(2243,290,'蕉岭县',441427,0,0,'0000-00-00','0000-00-00'),(2244,290,'兴宁市',441481,0,0,'0000-00-00','0000-00-00'),(2245,291,'城区',441502,0,0,'0000-00-00','0000-00-00'),(2246,291,'海丰县',441521,0,0,'0000-00-00','0000-00-00'),(2247,291,'陆河县',441523,0,0,'0000-00-00','0000-00-00'),(2248,291,'陆丰市',441581,0,0,'0000-00-00','0000-00-00'),(2249,292,'源城区',441602,0,0,'0000-00-00','0000-00-00'),(2250,292,'紫金县',441621,0,0,'0000-00-00','0000-00-00'),(2251,292,'龙川县',441622,0,0,'0000-00-00','0000-00-00'),(2252,292,'连平县',441623,0,0,'0000-00-00','0000-00-00'),(2253,292,'和平县',441624,0,0,'0000-00-00','0000-00-00'),(2254,292,'东源县',441625,0,0,'0000-00-00','0000-00-00'),(2255,293,'江城区',441702,0,0,'0000-00-00','0000-00-00'),(2256,293,'阳东区',441704,0,0,'0000-00-00','0000-00-00'),(2257,293,'阳西县',441721,0,0,'0000-00-00','0000-00-00'),(2258,293,'阳春市',441781,0,0,'0000-00-00','0000-00-00'),(2259,294,'清城区',441802,0,0,'0000-00-00','0000-00-00'),(2260,294,'清新区',441803,0,0,'0000-00-00','0000-00-00'),(2261,294,'佛冈县',441821,0,0,'0000-00-00','0000-00-00'),(2262,294,'阳山县',441823,0,0,'0000-00-00','0000-00-00'),(2263,294,'连山壮族瑶族',441825,0,0,'0000-00-00','0000-00-00'),(2264,294,'连南瑶族',441826,0,0,'0000-00-00','0000-00-00'),(2265,294,'英德市',441881,0,0,'0000-00-00','0000-00-00'),(2266,294,'连州市',441882,0,0,'0000-00-00','0000-00-00'),(2267,295,'三元里',441900,0,0,'0000-00-00','0000-00-00'),(2268,296,'湖滨北路',442000,0,0,'0000-00-00','0000-00-00'),(2269,297,'湘桥区',445102,0,0,'0000-00-00','0000-00-00'),(2270,297,'潮安区',445103,0,0,'0000-00-00','0000-00-00'),(2271,297,'饶平县',445122,0,0,'0000-00-00','0000-00-00'),(2272,298,'榕城区',445202,0,0,'0000-00-00','0000-00-00'),(2273,298,'揭东区',445203,0,0,'0000-00-00','0000-00-00'),(2274,298,'揭西县',445222,0,0,'0000-00-00','0000-00-00'),(2275,298,'惠来县',445224,0,0,'0000-00-00','0000-00-00'),(2276,298,'普宁市',445281,0,0,'0000-00-00','0000-00-00'),(2277,299,'云城区',445302,0,0,'0000-00-00','0000-00-00'),(2278,299,'云安区',445303,0,0,'0000-00-00','0000-00-00'),(2279,299,'新兴县',445321,0,0,'0000-00-00','0000-00-00'),(2280,299,'郁南县',445322,0,0,'0000-00-00','0000-00-00'),(2281,299,'罗定市',445381,0,0,'0000-00-00','0000-00-00'),(2282,300,'兴宁区',450102,0,0,'0000-00-00','0000-00-00'),(2283,300,'青秀区',450103,0,0,'0000-00-00','0000-00-00'),(2284,300,'江南区',450105,0,0,'0000-00-00','0000-00-00'),(2285,300,'西乡塘区',450107,0,0,'0000-00-00','0000-00-00'),(2286,300,'良庆区',450108,0,0,'0000-00-00','0000-00-00'),(2287,300,'邕宁区',450109,0,0,'0000-00-00','0000-00-00'),(2288,300,'武鸣区',450110,0,0,'0000-00-00','0000-00-00'),(2289,300,'隆安县',450123,0,0,'0000-00-00','0000-00-00'),(2290,300,'马山县',450124,0,0,'0000-00-00','0000-00-00'),(2291,300,'上林县',450125,0,0,'0000-00-00','0000-00-00'),(2292,300,'宾阳县',450126,0,0,'0000-00-00','0000-00-00'),(2293,300,'横县',450127,0,0,'0000-00-00','0000-00-00'),(2294,301,'城中区',450202,0,0,'0000-00-00','0000-00-00'),(2295,301,'鱼峰区',450203,0,0,'0000-00-00','0000-00-00'),(2296,301,'柳南区',450204,0,0,'0000-00-00','0000-00-00'),(2297,301,'柳北区',450205,0,0,'0000-00-00','0000-00-00'),(2298,301,'柳江县',450221,0,0,'0000-00-00','0000-00-00'),(2299,301,'柳城县',450222,0,0,'0000-00-00','0000-00-00'),(2300,301,'鹿寨县',450223,0,0,'0000-00-00','0000-00-00'),(2301,301,'融安县',450224,0,0,'0000-00-00','0000-00-00'),(2302,301,'融水苗族',450225,0,0,'0000-00-00','0000-00-00'),(2303,301,'三江侗族',450226,0,0,'0000-00-00','0000-00-00'),(2304,302,'秀峰区',450302,0,0,'0000-00-00','0000-00-00'),(2305,302,'叠彩区',450303,0,0,'0000-00-00','0000-00-00'),(2306,302,'象山区',450304,0,0,'0000-00-00','0000-00-00'),(2307,302,'七星区',450305,0,0,'0000-00-00','0000-00-00'),(2308,302,'雁山区',450311,0,0,'0000-00-00','0000-00-00'),(2309,302,'临桂区',450312,0,0,'0000-00-00','0000-00-00'),(2310,302,'阳朔县',450321,0,0,'0000-00-00','0000-00-00'),(2311,302,'灵川县',450323,0,0,'0000-00-00','0000-00-00'),(2312,302,'全州县',450324,0,0,'0000-00-00','0000-00-00'),(2313,302,'兴安县',450325,0,0,'0000-00-00','0000-00-00'),(2314,302,'永福县',450326,0,0,'0000-00-00','0000-00-00'),(2315,302,'灌阳县',450327,0,0,'0000-00-00','0000-00-00'),(2316,302,'龙胜各族',450328,0,0,'0000-00-00','0000-00-00'),(2317,302,'资源县',450329,0,0,'0000-00-00','0000-00-00'),(2318,302,'平乐县',450330,0,0,'0000-00-00','0000-00-00'),(2319,302,'荔浦县',450331,0,0,'0000-00-00','0000-00-00'),(2320,302,'恭城瑶族',450332,0,0,'0000-00-00','0000-00-00'),(2321,303,'万秀区',450403,0,0,'0000-00-00','0000-00-00'),(2322,303,'长洲区',450405,0,0,'0000-00-00','0000-00-00'),(2323,303,'龙圩区',450406,0,0,'0000-00-00','0000-00-00'),(2324,303,'苍梧县',450421,0,0,'0000-00-00','0000-00-00'),(2325,303,'藤县',450422,0,0,'0000-00-00','0000-00-00'),(2326,303,'蒙山县',450423,0,0,'0000-00-00','0000-00-00'),(2327,303,'岑溪市',450481,0,0,'0000-00-00','0000-00-00'),(2328,304,'海城区',450502,0,0,'0000-00-00','0000-00-00'),(2329,304,'银海区',450503,0,0,'0000-00-00','0000-00-00'),(2330,304,'铁山港区',450512,0,0,'0000-00-00','0000-00-00'),(2331,304,'合浦县',450521,0,0,'0000-00-00','0000-00-00'),(2332,305,'港口区',450602,0,0,'0000-00-00','0000-00-00'),(2333,305,'防城区',450603,0,0,'0000-00-00','0000-00-00'),(2334,305,'上思县',450621,0,0,'0000-00-00','0000-00-00'),(2335,305,'东兴市',450681,0,0,'0000-00-00','0000-00-00'),(2336,306,'钦南区',450702,0,0,'0000-00-00','0000-00-00'),(2337,306,'钦北区',450703,0,0,'0000-00-00','0000-00-00'),(2338,306,'灵山县',450721,0,0,'0000-00-00','0000-00-00'),(2339,306,'浦北县',450722,0,0,'0000-00-00','0000-00-00'),(2340,307,'港北区',450802,0,0,'0000-00-00','0000-00-00'),(2341,307,'港南区',450803,0,0,'0000-00-00','0000-00-00'),(2342,307,'覃塘区',450804,0,0,'0000-00-00','0000-00-00'),(2343,307,'平南县',450821,0,0,'0000-00-00','0000-00-00'),(2344,307,'桂平市',450881,0,0,'0000-00-00','0000-00-00'),(2345,308,'玉州区',450902,0,0,'0000-00-00','0000-00-00'),(2346,308,'福绵区',450903,0,0,'0000-00-00','0000-00-00'),(2347,308,'容县',450921,0,0,'0000-00-00','0000-00-00'),(2348,308,'陆川县',450922,0,0,'0000-00-00','0000-00-00'),(2349,308,'博白县',450923,0,0,'0000-00-00','0000-00-00'),(2350,308,'兴业县',450924,0,0,'0000-00-00','0000-00-00'),(2351,308,'北流市',450981,0,0,'0000-00-00','0000-00-00'),(2352,309,'右江区',451002,0,0,'0000-00-00','0000-00-00'),(2353,309,'田阳县',451021,0,0,'0000-00-00','0000-00-00'),(2354,309,'田东县',451022,0,0,'0000-00-00','0000-00-00'),(2355,309,'平果县',451023,0,0,'0000-00-00','0000-00-00'),(2356,309,'德保县',451024,0,0,'0000-00-00','0000-00-00'),(2357,309,'靖西县',451025,0,0,'0000-00-00','0000-00-00'),(2358,309,'那坡县',451026,0,0,'0000-00-00','0000-00-00'),(2359,309,'凌云县',451027,0,0,'0000-00-00','0000-00-00'),(2360,309,'乐业县',451028,0,0,'0000-00-00','0000-00-00'),(2361,309,'田林县',451029,0,0,'0000-00-00','0000-00-00'),(2362,309,'西林县',451030,0,0,'0000-00-00','0000-00-00'),(2363,309,'隆林各族',451031,0,0,'0000-00-00','0000-00-00'),(2364,310,'八步区',451102,0,0,'0000-00-00','0000-00-00'),(2365,310,'昭平县',451121,0,0,'0000-00-00','0000-00-00'),(2366,310,'钟山县',451122,0,0,'0000-00-00','0000-00-00'),(2367,310,'富川瑶族',451123,0,0,'0000-00-00','0000-00-00'),(2368,311,'金城江区',451202,0,0,'0000-00-00','0000-00-00'),(2369,311,'南丹县',451221,0,0,'0000-00-00','0000-00-00'),(2370,311,'天峨县',451222,0,0,'0000-00-00','0000-00-00'),(2371,311,'凤山县',451223,0,0,'0000-00-00','0000-00-00'),(2372,311,'东兰县',451224,0,0,'0000-00-00','0000-00-00'),(2373,311,'罗城仫佬族',451225,0,0,'0000-00-00','0000-00-00'),(2374,311,'环江毛南族',451226,0,0,'0000-00-00','0000-00-00'),(2375,311,'巴马瑶族',451227,0,0,'0000-00-00','0000-00-00'),(2376,311,'都安瑶族',451228,0,0,'0000-00-00','0000-00-00'),(2377,311,'大化瑶族',451229,0,0,'0000-00-00','0000-00-00'),(2378,311,'宜州市',451281,0,0,'0000-00-00','0000-00-00'),(2379,312,'兴宾区',451302,0,0,'0000-00-00','0000-00-00'),(2380,312,'忻城县',451321,0,0,'0000-00-00','0000-00-00'),(2381,312,'象州县',451322,0,0,'0000-00-00','0000-00-00'),(2382,312,'武宣县',451323,0,0,'0000-00-00','0000-00-00'),(2383,312,'金秀瑶族',451324,0,0,'0000-00-00','0000-00-00'),(2384,312,'合山市',451381,0,0,'0000-00-00','0000-00-00'),(2385,313,'江州区',451402,0,0,'0000-00-00','0000-00-00'),(2386,313,'扶绥县',451421,0,0,'0000-00-00','0000-00-00'),(2387,313,'宁明县',451422,0,0,'0000-00-00','0000-00-00'),(2388,313,'龙州县',451423,0,0,'0000-00-00','0000-00-00'),(2389,313,'大新县',451424,0,0,'0000-00-00','0000-00-00'),(2390,313,'天等县',451425,0,0,'0000-00-00','0000-00-00'),(2391,313,'凭祥市',451481,0,0,'0000-00-00','0000-00-00'),(2392,314,'秀英区',460105,0,0,'0000-00-00','0000-00-00'),(2393,314,'龙华区',460106,0,0,'0000-00-00','0000-00-00'),(2394,314,'琼山区',460107,0,0,'0000-00-00','0000-00-00'),(2395,314,'美兰区',460108,0,0,'0000-00-00','0000-00-00'),(2396,315,'三亚湾',460200,0,0,'0000-00-00','0000-00-00'),(2397,315,'海棠区',460202,0,0,'0000-00-00','0000-00-00'),(2398,315,'吉阳区',460203,0,0,'0000-00-00','0000-00-00'),(2399,315,'天涯区',460204,0,0,'0000-00-00','0000-00-00'),(2400,315,'崖州区',460205,0,0,'0000-00-00','0000-00-00'),(2401,316,'西沙群岛',460321,0,0,'0000-00-00','0000-00-00'),(2402,316,'南沙群岛',460322,0,0,'0000-00-00','0000-00-00'),(2403,316,'中沙群岛的岛礁及其海域',460323,0,0,'0000-00-00','0000-00-00'),(2404,371,'南明区',520102,0,0,'0000-00-00','0000-00-00'),(2405,371,'云岩区',520103,0,0,'0000-00-00','0000-00-00'),(2406,371,'花溪区',520111,0,0,'0000-00-00','0000-00-00'),(2407,371,'乌当区',520112,0,0,'0000-00-00','0000-00-00'),(2408,371,'白云区',520113,0,0,'0000-00-00','0000-00-00'),(2409,371,'观山湖区',520115,0,0,'0000-00-00','0000-00-00'),(2410,371,'开阳县',520121,0,0,'0000-00-00','0000-00-00'),(2411,371,'息烽县',520122,0,0,'0000-00-00','0000-00-00'),(2412,371,'修文县',520123,0,0,'0000-00-00','0000-00-00'),(2413,371,'清镇市',520181,0,0,'0000-00-00','0000-00-00'),(2414,372,'钟山区',520201,0,0,'0000-00-00','0000-00-00'),(2415,372,'六枝特区',520203,0,0,'0000-00-00','0000-00-00'),(2416,372,'水城县',520221,0,0,'0000-00-00','0000-00-00'),(2417,372,'盘县',520222,0,0,'0000-00-00','0000-00-00'),(2418,373,'红花岗区',520302,0,0,'0000-00-00','0000-00-00'),(2419,373,'汇川区',520303,0,0,'0000-00-00','0000-00-00'),(2420,373,'遵义县',520321,0,0,'0000-00-00','0000-00-00'),(2421,373,'桐梓县',520322,0,0,'0000-00-00','0000-00-00'),(2422,373,'绥阳县',520323,0,0,'0000-00-00','0000-00-00'),(2423,373,'正安县',520324,0,0,'0000-00-00','0000-00-00'),(2424,373,'道真仡佬族苗族',520325,0,0,'0000-00-00','0000-00-00'),(2425,373,'务川仡佬族苗族',520326,0,0,'0000-00-00','0000-00-00'),(2426,373,'凤冈县',520327,0,0,'0000-00-00','0000-00-00'),(2427,373,'湄潭县',520328,0,0,'0000-00-00','0000-00-00'),(2428,373,'余庆县',520329,0,0,'0000-00-00','0000-00-00'),(2429,373,'习水县',520330,0,0,'0000-00-00','0000-00-00'),(2430,373,'赤水市',520381,0,0,'0000-00-00','0000-00-00'),(2431,373,'仁怀市',520382,0,0,'0000-00-00','0000-00-00'),(2432,374,'西秀区',520402,0,0,'0000-00-00','0000-00-00'),(2433,374,'平坝区',520403,0,0,'0000-00-00','0000-00-00'),(2434,374,'普定县',520422,0,0,'0000-00-00','0000-00-00'),(2435,374,'镇宁布依族苗族',520423,0,0,'0000-00-00','0000-00-00'),(2436,374,'关岭布依族苗族',520424,0,0,'0000-00-00','0000-00-00'),(2437,374,'紫云苗族布依族',520425,0,0,'0000-00-00','0000-00-00'),(2438,375,'七星关区',520502,0,0,'0000-00-00','0000-00-00'),(2439,375,'大方县',520521,0,0,'0000-00-00','0000-00-00'),(2440,375,'黔西县',520522,0,0,'0000-00-00','0000-00-00'),(2441,375,'金沙县',520523,0,0,'0000-00-00','0000-00-00'),(2442,375,'织金县',520524,0,0,'0000-00-00','0000-00-00'),(2443,375,'纳雍县',520525,0,0,'0000-00-00','0000-00-00'),(2444,375,'威宁彝族回族苗族',520526,0,0,'0000-00-00','0000-00-00'),(2445,375,'赫章县',520527,0,0,'0000-00-00','0000-00-00'),(2446,376,'碧江区',520602,0,0,'0000-00-00','0000-00-00'),(2447,376,'万山区',520603,0,0,'0000-00-00','0000-00-00'),(2448,376,'江口县',520621,0,0,'0000-00-00','0000-00-00'),(2449,376,'玉屏侗族',520622,0,0,'0000-00-00','0000-00-00'),(2450,376,'石阡县',520623,0,0,'0000-00-00','0000-00-00'),(2451,376,'思南县',520624,0,0,'0000-00-00','0000-00-00'),(2452,376,'印江土家族苗族',520625,0,0,'0000-00-00','0000-00-00'),(2453,376,'德江县',520626,0,0,'0000-00-00','0000-00-00'),(2454,376,'沿河土家族',520627,0,0,'0000-00-00','0000-00-00'),(2455,376,'松桃苗族',520628,0,0,'0000-00-00','0000-00-00'),(2456,377,'兴义市',522301,0,0,'0000-00-00','0000-00-00'),(2457,377,'兴仁县',522322,0,0,'0000-00-00','0000-00-00'),(2458,377,'普安县',522323,0,0,'0000-00-00','0000-00-00'),(2459,377,'晴隆县',522324,0,0,'0000-00-00','0000-00-00'),(2460,377,'贞丰县',522325,0,0,'0000-00-00','0000-00-00'),(2461,377,'望谟县',522326,0,0,'0000-00-00','0000-00-00'),(2462,377,'册亨县',522327,0,0,'0000-00-00','0000-00-00'),(2463,377,'安龙县',522328,0,0,'0000-00-00','0000-00-00'),(2464,378,'凯里市',522601,0,0,'0000-00-00','0000-00-00'),(2465,378,'黄平县',522622,0,0,'0000-00-00','0000-00-00'),(2466,378,'施秉县',522623,0,0,'0000-00-00','0000-00-00'),(2467,378,'三穗县',522624,0,0,'0000-00-00','0000-00-00'),(2468,378,'镇远县',522625,0,0,'0000-00-00','0000-00-00'),(2469,378,'岑巩县',522626,0,0,'0000-00-00','0000-00-00'),(2470,378,'天柱县',522627,0,0,'0000-00-00','0000-00-00'),(2471,378,'锦屏县',522628,0,0,'0000-00-00','0000-00-00'),(2472,378,'剑河县',522629,0,0,'0000-00-00','0000-00-00'),(2473,378,'台江县',522630,0,0,'0000-00-00','0000-00-00'),(2474,378,'黎平县',522631,0,0,'0000-00-00','0000-00-00'),(2475,378,'榕江县',522632,0,0,'0000-00-00','0000-00-00'),(2476,378,'从江县',522633,0,0,'0000-00-00','0000-00-00'),(2477,378,'雷山县',522634,0,0,'0000-00-00','0000-00-00'),(2478,378,'麻江县',522635,0,0,'0000-00-00','0000-00-00'),(2479,378,'丹寨县',522636,0,0,'0000-00-00','0000-00-00'),(2480,379,'都匀市',522701,0,0,'0000-00-00','0000-00-00'),(2481,379,'福泉市',522702,0,0,'0000-00-00','0000-00-00'),(2482,379,'荔波县',522722,0,0,'0000-00-00','0000-00-00'),(2483,379,'贵定县',522723,0,0,'0000-00-00','0000-00-00'),(2484,379,'瓮安县',522725,0,0,'0000-00-00','0000-00-00'),(2485,379,'独山县',522726,0,0,'0000-00-00','0000-00-00'),(2486,379,'平塘县',522727,0,0,'0000-00-00','0000-00-00'),(2487,379,'罗甸县',522728,0,0,'0000-00-00','0000-00-00'),(2488,379,'长顺县',522729,0,0,'0000-00-00','0000-00-00'),(2489,379,'龙里县',522730,0,0,'0000-00-00','0000-00-00'),(2490,379,'惠水县',522731,0,0,'0000-00-00','0000-00-00'),(2491,379,'三都水族',522732,0,0,'0000-00-00','0000-00-00'),(2492,380,'五华区',530102,0,0,'0000-00-00','0000-00-00'),(2493,380,'盘龙区',530103,0,0,'0000-00-00','0000-00-00'),(2494,380,'官渡区',530111,0,0,'0000-00-00','0000-00-00'),(2495,380,'西山区',530112,0,0,'0000-00-00','0000-00-00'),(2496,380,'东川区',530113,0,0,'0000-00-00','0000-00-00'),(2497,380,'呈贡区',530114,0,0,'0000-00-00','0000-00-00'),(2498,380,'晋宁县',530122,0,0,'0000-00-00','0000-00-00'),(2499,380,'富民县',530124,0,0,'0000-00-00','0000-00-00'),(2500,380,'宜良县',530125,0,0,'0000-00-00','0000-00-00'),(2501,380,'石林彝族',530126,0,0,'0000-00-00','0000-00-00'),(2502,380,'嵩明县',530127,0,0,'0000-00-00','0000-00-00'),(2503,380,'禄劝彝族苗族',530128,0,0,'0000-00-00','0000-00-00'),(2504,380,'寻甸回族彝族',530129,0,0,'0000-00-00','0000-00-00'),(2505,380,'安宁市',530181,0,0,'0000-00-00','0000-00-00'),(2506,381,'麒麟区',530302,0,0,'0000-00-00','0000-00-00'),(2507,381,'马龙县',530321,0,0,'0000-00-00','0000-00-00'),(2508,381,'陆良县',530322,0,0,'0000-00-00','0000-00-00'),(2509,381,'师宗县',530323,0,0,'0000-00-00','0000-00-00'),(2510,381,'罗平县',530324,0,0,'0000-00-00','0000-00-00'),(2511,381,'富源县',530325,0,0,'0000-00-00','0000-00-00'),(2512,381,'会泽县',530326,0,0,'0000-00-00','0000-00-00'),(2513,381,'沾益县',530328,0,0,'0000-00-00','0000-00-00'),(2514,381,'宣威市',530381,0,0,'0000-00-00','0000-00-00'),(2515,382,'红塔区',530402,0,0,'0000-00-00','0000-00-00'),(2516,382,'江川县',530421,0,0,'0000-00-00','0000-00-00'),(2517,382,'澄江县',530422,0,0,'0000-00-00','0000-00-00'),(2518,382,'通海县',530423,0,0,'0000-00-00','0000-00-00'),(2519,382,'华宁县',530424,0,0,'0000-00-00','0000-00-00'),(2520,382,'易门县',530425,0,0,'0000-00-00','0000-00-00'),(2521,382,'峨山彝族',530426,0,0,'0000-00-00','0000-00-00'),(2522,382,'新平彝族傣族',530427,0,0,'0000-00-00','0000-00-00'),(2523,382,'元江哈尼族彝族傣族',530428,0,0,'0000-00-00','0000-00-00'),(2524,383,'隆阳区',530502,0,0,'0000-00-00','0000-00-00'),(2525,383,'施甸县',530521,0,0,'0000-00-00','0000-00-00'),(2526,383,'腾冲县',530522,0,0,'0000-00-00','0000-00-00'),(2527,383,'龙陵县',530523,0,0,'0000-00-00','0000-00-00'),(2528,383,'昌宁县',530524,0,0,'0000-00-00','0000-00-00'),(2529,384,'昭阳区',530602,0,0,'0000-00-00','0000-00-00'),(2530,384,'鲁甸县',530621,0,0,'0000-00-00','0000-00-00'),(2531,384,'巧家县',530622,0,0,'0000-00-00','0000-00-00'),(2532,384,'盐津县',530623,0,0,'0000-00-00','0000-00-00'),(2533,384,'大关县',530624,0,0,'0000-00-00','0000-00-00'),(2534,384,'永善县',530625,0,0,'0000-00-00','0000-00-00'),(2535,384,'绥江县',530626,0,0,'0000-00-00','0000-00-00'),(2536,384,'镇雄县',530627,0,0,'0000-00-00','0000-00-00'),(2537,384,'彝良县',530628,0,0,'0000-00-00','0000-00-00'),(2538,384,'威信县',530629,0,0,'0000-00-00','0000-00-00'),(2539,384,'水富县',530630,0,0,'0000-00-00','0000-00-00'),(2540,385,'古城区',530702,0,0,'0000-00-00','0000-00-00'),(2541,385,'玉龙纳西族',530721,0,0,'0000-00-00','0000-00-00'),(2542,385,'永胜县',530722,0,0,'0000-00-00','0000-00-00'),(2543,385,'华坪县',530723,0,0,'0000-00-00','0000-00-00'),(2544,385,'宁蒗彝族',530724,0,0,'0000-00-00','0000-00-00'),(2545,386,'思茅区',530802,0,0,'0000-00-00','0000-00-00'),(2546,386,'宁洱哈尼族彝族',530821,0,0,'0000-00-00','0000-00-00'),(2547,386,'墨江哈尼族',530822,0,0,'0000-00-00','0000-00-00'),(2548,386,'景东彝族',530823,0,0,'0000-00-00','0000-00-00'),(2549,386,'景谷傣族彝族',530824,0,0,'0000-00-00','0000-00-00'),(2550,386,'镇沅彝族哈尼族拉祜族',530825,0,0,'0000-00-00','0000-00-00'),(2551,386,'江城哈尼族彝族',530826,0,0,'0000-00-00','0000-00-00'),(2552,386,'孟连傣族拉祜族佤族',530827,0,0,'0000-00-00','0000-00-00'),(2553,386,'澜沧拉祜族',530828,0,0,'0000-00-00','0000-00-00'),(2554,386,'西盟佤族',530829,0,0,'0000-00-00','0000-00-00'),(2555,387,'临翔区',530902,0,0,'0000-00-00','0000-00-00'),(2556,387,'凤庆县',530921,0,0,'0000-00-00','0000-00-00'),(2557,387,'云县',530922,0,0,'0000-00-00','0000-00-00'),(2558,387,'永德县',530923,0,0,'0000-00-00','0000-00-00'),(2559,387,'镇康县',530924,0,0,'0000-00-00','0000-00-00'),(2560,387,'双江拉祜族佤族布朗族傣族',530925,0,0,'0000-00-00','0000-00-00'),(2561,387,'耿马傣族佤族',530926,0,0,'0000-00-00','0000-00-00'),(2562,387,'沧源佤族',530927,0,0,'0000-00-00','0000-00-00'),(2563,388,'楚雄市',532301,0,0,'0000-00-00','0000-00-00'),(2564,388,'双柏县',532322,0,0,'0000-00-00','0000-00-00'),(2565,388,'牟定县',532323,0,0,'0000-00-00','0000-00-00'),(2566,388,'南华县',532324,0,0,'0000-00-00','0000-00-00'),(2567,388,'姚安县',532325,0,0,'0000-00-00','0000-00-00'),(2568,388,'大姚县',532326,0,0,'0000-00-00','0000-00-00'),(2569,388,'永仁县',532327,0,0,'0000-00-00','0000-00-00'),(2570,388,'元谋县',532328,0,0,'0000-00-00','0000-00-00'),(2571,388,'武定县',532329,0,0,'0000-00-00','0000-00-00'),(2572,388,'禄丰县',532331,0,0,'0000-00-00','0000-00-00'),(2573,389,'个旧市',532501,0,0,'0000-00-00','0000-00-00'),(2574,389,'开远市',532502,0,0,'0000-00-00','0000-00-00'),(2575,389,'蒙自市',532503,0,0,'0000-00-00','0000-00-00'),(2576,389,'弥勒市',532504,0,0,'0000-00-00','0000-00-00'),(2577,389,'屏边苗族',532523,0,0,'0000-00-00','0000-00-00'),(2578,389,'建水县',532524,0,0,'0000-00-00','0000-00-00'),(2579,389,'石屏县',532525,0,0,'0000-00-00','0000-00-00'),(2580,389,'泸西县',532527,0,0,'0000-00-00','0000-00-00'),(2581,389,'元阳县',532528,0,0,'0000-00-00','0000-00-00'),(2582,389,'红河县',532529,0,0,'0000-00-00','0000-00-00'),(2583,389,'金平苗族瑶族傣族',532530,0,0,'0000-00-00','0000-00-00'),(2584,389,'绿春县',532531,0,0,'0000-00-00','0000-00-00'),(2585,389,'河口瑶族',532532,0,0,'0000-00-00','0000-00-00'),(2586,390,'文山市',532601,0,0,'0000-00-00','0000-00-00'),(2587,390,'砚山县',532622,0,0,'0000-00-00','0000-00-00'),(2588,390,'西畴县',532623,0,0,'0000-00-00','0000-00-00'),(2589,390,'麻栗坡县',532624,0,0,'0000-00-00','0000-00-00'),(2590,390,'马关县',532625,0,0,'0000-00-00','0000-00-00'),(2591,390,'丘北县',532626,0,0,'0000-00-00','0000-00-00'),(2592,390,'广南县',532627,0,0,'0000-00-00','0000-00-00'),(2593,390,'富宁县',532628,0,0,'0000-00-00','0000-00-00'),(2594,391,'景洪市',532801,0,0,'0000-00-00','0000-00-00'),(2595,391,'勐海县',532822,0,0,'0000-00-00','0000-00-00'),(2596,391,'勐腊县',532823,0,0,'0000-00-00','0000-00-00'),(2597,392,'大理市',532901,0,0,'0000-00-00','0000-00-00'),(2598,392,'漾濞彝族',532922,0,0,'0000-00-00','0000-00-00'),(2599,392,'祥云县',532923,0,0,'0000-00-00','0000-00-00'),(2600,392,'宾川县',532924,0,0,'0000-00-00','0000-00-00'),(2601,392,'弥渡县',532925,0,0,'0000-00-00','0000-00-00'),(2602,392,'南涧彝族',532926,0,0,'0000-00-00','0000-00-00'),(2603,392,'巍山彝族回族',532927,0,0,'0000-00-00','0000-00-00'),(2604,392,'永平县',532928,0,0,'0000-00-00','0000-00-00'),(2605,392,'云龙县',532929,0,0,'0000-00-00','0000-00-00'),(2606,392,'洱源县',532930,0,0,'0000-00-00','0000-00-00'),(2607,392,'剑川县',532931,0,0,'0000-00-00','0000-00-00'),(2608,392,'鹤庆县',532932,0,0,'0000-00-00','0000-00-00'),(2609,393,'瑞丽市',533102,0,0,'0000-00-00','0000-00-00'),(2610,393,'芒市',533103,0,0,'0000-00-00','0000-00-00'),(2611,393,'梁河县',533122,0,0,'0000-00-00','0000-00-00'),(2612,393,'盈江县',533123,0,0,'0000-00-00','0000-00-00'),(2613,393,'陇川县',533124,0,0,'0000-00-00','0000-00-00'),(2614,394,'泸水县',533321,0,0,'0000-00-00','0000-00-00'),(2615,394,'福贡县',533323,0,0,'0000-00-00','0000-00-00'),(2616,394,'贡山独龙族怒族',533324,0,0,'0000-00-00','0000-00-00'),(2617,394,'兰坪白族普米族',533325,0,0,'0000-00-00','0000-00-00'),(2618,395,'香格里拉市',533401,0,0,'0000-00-00','0000-00-00'),(2619,395,'德钦县',533422,0,0,'0000-00-00','0000-00-00'),(2620,395,'维西傈僳族',533423,0,0,'0000-00-00','0000-00-00'),(2621,396,'城关区',540102,0,0,'0000-00-00','0000-00-00'),(2622,396,'林周县',540121,0,0,'0000-00-00','0000-00-00'),(2623,396,'当雄县',540122,0,0,'0000-00-00','0000-00-00'),(2624,396,'尼木县',540123,0,0,'0000-00-00','0000-00-00'),(2625,396,'曲水县',540124,0,0,'0000-00-00','0000-00-00'),(2626,396,'堆龙德庆县',540125,0,0,'0000-00-00','0000-00-00'),(2627,396,'达孜县',540126,0,0,'0000-00-00','0000-00-00'),(2628,396,'墨竹工卡县',540127,0,0,'0000-00-00','0000-00-00'),(2629,397,'桑珠孜区',540202,0,0,'0000-00-00','0000-00-00'),(2630,397,'南木林县',540221,0,0,'0000-00-00','0000-00-00'),(2631,397,'江孜县',540222,0,0,'0000-00-00','0000-00-00'),(2632,397,'定日县',540223,0,0,'0000-00-00','0000-00-00'),(2633,397,'萨迦县',540224,0,0,'0000-00-00','0000-00-00'),(2634,397,'拉孜县',540225,0,0,'0000-00-00','0000-00-00'),(2635,397,'昂仁县',540226,0,0,'0000-00-00','0000-00-00'),(2636,397,'谢通门县',540227,0,0,'0000-00-00','0000-00-00'),(2637,397,'白朗县',540228,0,0,'0000-00-00','0000-00-00'),(2638,397,'仁布县',540229,0,0,'0000-00-00','0000-00-00'),(2639,397,'康马县',540230,0,0,'0000-00-00','0000-00-00'),(2640,397,'定结县',540231,0,0,'0000-00-00','0000-00-00'),(2641,397,'仲巴县',540232,0,0,'0000-00-00','0000-00-00'),(2642,397,'亚东县',540233,0,0,'0000-00-00','0000-00-00'),(2643,397,'吉隆县',540234,0,0,'0000-00-00','0000-00-00'),(2644,397,'聂拉木县',540235,0,0,'0000-00-00','0000-00-00'),(2645,397,'萨嘎县',540236,0,0,'0000-00-00','0000-00-00'),(2646,397,'岗巴县',540237,0,0,'0000-00-00','0000-00-00'),(2647,398,'卡若区',540302,0,0,'0000-00-00','0000-00-00'),(2648,398,'江达县',540321,0,0,'0000-00-00','0000-00-00'),(2649,398,'贡觉县',540322,0,0,'0000-00-00','0000-00-00'),(2650,398,'类乌齐县',540323,0,0,'0000-00-00','0000-00-00'),(2651,398,'丁青县',540324,0,0,'0000-00-00','0000-00-00'),(2652,398,'察雅县',540325,0,0,'0000-00-00','0000-00-00'),(2653,398,'八宿县',540326,0,0,'0000-00-00','0000-00-00'),(2654,398,'左贡县',540327,0,0,'0000-00-00','0000-00-00'),(2655,398,'芒康县',540328,0,0,'0000-00-00','0000-00-00'),(2656,398,'洛隆县',540329,0,0,'0000-00-00','0000-00-00'),(2657,398,'边坝县',540330,0,0,'0000-00-00','0000-00-00'),(2658,399,'乃东县',542221,0,0,'0000-00-00','0000-00-00'),(2659,399,'扎囊县',542222,0,0,'0000-00-00','0000-00-00'),(2660,399,'贡嘎县',542223,0,0,'0000-00-00','0000-00-00'),(2661,399,'桑日县',542224,0,0,'0000-00-00','0000-00-00'),(2662,399,'琼结县',542225,0,0,'0000-00-00','0000-00-00'),(2663,399,'曲松县',542226,0,0,'0000-00-00','0000-00-00'),(2664,399,'措美县',542227,0,0,'0000-00-00','0000-00-00'),(2665,399,'洛扎县',542228,0,0,'0000-00-00','0000-00-00'),(2666,399,'加查县',542229,0,0,'0000-00-00','0000-00-00'),(2667,399,'隆子县',542231,0,0,'0000-00-00','0000-00-00'),(2668,399,'错那县',542232,0,0,'0000-00-00','0000-00-00'),(2669,399,'浪卡子县',542233,0,0,'0000-00-00','0000-00-00'),(2670,400,'那曲县',542421,0,0,'0000-00-00','0000-00-00'),(2671,400,'嘉黎县',542422,0,0,'0000-00-00','0000-00-00'),(2672,400,'比如县',542423,0,0,'0000-00-00','0000-00-00'),(2673,400,'聂荣县',542424,0,0,'0000-00-00','0000-00-00'),(2674,400,'安多县',542425,0,0,'0000-00-00','0000-00-00'),(2675,400,'申扎县',542426,0,0,'0000-00-00','0000-00-00'),(2676,400,'索县',542427,0,0,'0000-00-00','0000-00-00'),(2677,400,'班戈县',542428,0,0,'0000-00-00','0000-00-00'),(2678,400,'巴青县',542429,0,0,'0000-00-00','0000-00-00'),(2679,400,'尼玛县',542430,0,0,'0000-00-00','0000-00-00'),(2680,400,'双湖县',542431,0,0,'0000-00-00','0000-00-00'),(2681,401,'普兰县',542521,0,0,'0000-00-00','0000-00-00'),(2682,401,'札达县',542522,0,0,'0000-00-00','0000-00-00'),(2683,401,'噶尔县',542523,0,0,'0000-00-00','0000-00-00'),(2684,401,'日土县',542524,0,0,'0000-00-00','0000-00-00'),(2685,401,'革吉县',542525,0,0,'0000-00-00','0000-00-00'),(2686,401,'改则县',542526,0,0,'0000-00-00','0000-00-00'),(2687,401,'措勤县',542527,0,0,'0000-00-00','0000-00-00'),(2688,402,'巴宜区',542621,0,0,'0000-00-00','0000-00-00'),(2689,402,'工布江达县',542622,0,0,'0000-00-00','0000-00-00'),(2690,402,'米林县',542623,0,0,'0000-00-00','0000-00-00'),(2691,402,'墨脱县',542624,0,0,'0000-00-00','0000-00-00'),(2692,402,'波密县',542625,0,0,'0000-00-00','0000-00-00'),(2693,402,'察隅县',542626,0,0,'0000-00-00','0000-00-00'),(2694,402,'朗县',542627,0,0,'0000-00-00','0000-00-00'),(2695,403,'新城区',610102,0,0,'0000-00-00','0000-00-00'),(2696,403,'碑林区',610103,0,0,'0000-00-00','0000-00-00'),(2697,403,'莲湖区',610104,0,0,'0000-00-00','0000-00-00'),(2698,403,'灞桥区',610111,0,0,'0000-00-00','0000-00-00'),(2699,403,'未央区',610112,0,0,'0000-00-00','0000-00-00'),(2700,403,'雁塔区',610113,0,0,'0000-00-00','0000-00-00'),(2701,403,'阎良区',610114,0,0,'0000-00-00','0000-00-00'),(2702,403,'临潼区',610115,0,0,'0000-00-00','0000-00-00'),(2703,403,'长安区',610116,0,0,'0000-00-00','0000-00-00'),(2704,403,'高陵区',610117,0,0,'0000-00-00','0000-00-00'),(2705,403,'蓝田县',610122,0,0,'0000-00-00','0000-00-00'),(2706,403,'周至县',610124,0,0,'0000-00-00','0000-00-00'),(2707,403,'户县',610125,0,0,'0000-00-00','0000-00-00'),(2708,404,'王益区',610202,0,0,'0000-00-00','0000-00-00'),(2709,404,'印台区',610203,0,0,'0000-00-00','0000-00-00'),(2710,404,'耀州区',610204,0,0,'0000-00-00','0000-00-00'),(2711,404,'宜君县',610222,0,0,'0000-00-00','0000-00-00'),(2712,405,'渭滨区',610302,0,0,'0000-00-00','0000-00-00'),(2713,405,'金台区',610303,0,0,'0000-00-00','0000-00-00'),(2714,405,'陈仓区',610304,0,0,'0000-00-00','0000-00-00'),(2715,405,'凤翔县',610322,0,0,'0000-00-00','0000-00-00'),(2716,405,'岐山县',610323,0,0,'0000-00-00','0000-00-00'),(2717,405,'扶风县',610324,0,0,'0000-00-00','0000-00-00'),(2718,405,'眉县',610326,0,0,'0000-00-00','0000-00-00'),(2719,405,'陇县',610327,0,0,'0000-00-00','0000-00-00'),(2720,405,'千阳县',610328,0,0,'0000-00-00','0000-00-00'),(2721,405,'麟游县',610329,0,0,'0000-00-00','0000-00-00'),(2722,405,'凤县',610330,0,0,'0000-00-00','0000-00-00'),(2723,405,'太白县',610331,0,0,'0000-00-00','0000-00-00'),(2724,406,'秦都区',610402,0,0,'0000-00-00','0000-00-00'),(2725,406,'杨陵区',610403,0,0,'0000-00-00','0000-00-00'),(2726,406,'渭城区',610404,0,0,'0000-00-00','0000-00-00'),(2727,406,'三原县',610422,0,0,'0000-00-00','0000-00-00'),(2728,406,'泾阳县',610423,0,0,'0000-00-00','0000-00-00'),(2729,406,'乾县',610424,0,0,'0000-00-00','0000-00-00'),(2730,406,'礼泉县',610425,0,0,'0000-00-00','0000-00-00'),(2731,406,'永寿县',610426,0,0,'0000-00-00','0000-00-00'),(2732,406,'彬县',610427,0,0,'0000-00-00','0000-00-00'),(2733,406,'长武县',610428,0,0,'0000-00-00','0000-00-00'),(2734,406,'旬邑县',610429,0,0,'0000-00-00','0000-00-00'),(2735,406,'淳化县',610430,0,0,'0000-00-00','0000-00-00'),(2736,406,'武功县',610431,0,0,'0000-00-00','0000-00-00'),(2737,406,'兴平市',610481,0,0,'0000-00-00','0000-00-00'),(2738,407,'临渭区',610502,0,0,'0000-00-00','0000-00-00'),(2739,407,'华县',610521,0,0,'0000-00-00','0000-00-00'),(2740,407,'潼关县',610522,0,0,'0000-00-00','0000-00-00'),(2741,407,'大荔县',610523,0,0,'0000-00-00','0000-00-00'),(2742,407,'合阳县',610524,0,0,'0000-00-00','0000-00-00'),(2743,407,'澄城县',610525,0,0,'0000-00-00','0000-00-00'),(2744,407,'蒲城县',610526,0,0,'0000-00-00','0000-00-00'),(2745,407,'白水县',610527,0,0,'0000-00-00','0000-00-00'),(2746,407,'富平县',610528,0,0,'0000-00-00','0000-00-00'),(2747,407,'韩城市',610581,0,0,'0000-00-00','0000-00-00'),(2748,407,'华阴市',610582,0,0,'0000-00-00','0000-00-00'),(2749,408,'宝塔区',610602,0,0,'0000-00-00','0000-00-00'),(2750,408,'延长县',610621,0,0,'0000-00-00','0000-00-00'),(2751,408,'延川县',610622,0,0,'0000-00-00','0000-00-00'),(2752,408,'子长县',610623,0,0,'0000-00-00','0000-00-00'),(2753,408,'安塞县',610624,0,0,'0000-00-00','0000-00-00'),(2754,408,'志丹县',610625,0,0,'0000-00-00','0000-00-00'),(2755,408,'吴起县',610626,0,0,'0000-00-00','0000-00-00'),(2756,408,'甘泉县',610627,0,0,'0000-00-00','0000-00-00'),(2757,408,'富县',610628,0,0,'0000-00-00','0000-00-00'),(2758,408,'洛川县',610629,0,0,'0000-00-00','0000-00-00'),(2759,408,'宜川县',610630,0,0,'0000-00-00','0000-00-00'),(2760,408,'黄龙县',610631,0,0,'0000-00-00','0000-00-00'),(2761,408,'黄陵县',610632,0,0,'0000-00-00','0000-00-00'),(2762,409,'汉台区',610702,0,0,'0000-00-00','0000-00-00'),(2763,409,'南郑县',610721,0,0,'0000-00-00','0000-00-00'),(2764,409,'城固县',610722,0,0,'0000-00-00','0000-00-00'),(2765,409,'洋县',610723,0,0,'0000-00-00','0000-00-00'),(2766,409,'西乡县',610724,0,0,'0000-00-00','0000-00-00'),(2767,409,'勉县',610725,0,0,'0000-00-00','0000-00-00'),(2768,409,'宁强县',610726,0,0,'0000-00-00','0000-00-00'),(2769,409,'略阳县',610727,0,0,'0000-00-00','0000-00-00'),(2770,409,'镇巴县',610728,0,0,'0000-00-00','0000-00-00'),(2771,409,'留坝县',610729,0,0,'0000-00-00','0000-00-00'),(2772,409,'佛坪县',610730,0,0,'0000-00-00','0000-00-00'),(2773,410,'榆阳区',610802,0,0,'0000-00-00','0000-00-00'),(2774,410,'神木县',610821,0,0,'0000-00-00','0000-00-00'),(2775,410,'府谷县',610822,0,0,'0000-00-00','0000-00-00'),(2776,410,'横山县',610823,0,0,'0000-00-00','0000-00-00'),(2777,410,'靖边县',610824,0,0,'0000-00-00','0000-00-00'),(2778,410,'定边县',610825,0,0,'0000-00-00','0000-00-00'),(2779,410,'绥德县',610826,0,0,'0000-00-00','0000-00-00'),(2780,410,'米脂县',610827,0,0,'0000-00-00','0000-00-00'),(2781,410,'佳县',610828,0,0,'0000-00-00','0000-00-00'),(2782,410,'吴堡县',610829,0,0,'0000-00-00','0000-00-00'),(2783,410,'清涧县',610830,0,0,'0000-00-00','0000-00-00'),(2784,410,'子洲县',610831,0,0,'0000-00-00','0000-00-00'),(2785,411,'汉滨区',610902,0,0,'0000-00-00','0000-00-00'),(2786,411,'汉阴县',610921,0,0,'0000-00-00','0000-00-00'),(2787,411,'石泉县',610922,0,0,'0000-00-00','0000-00-00'),(2788,411,'宁陕县',610923,0,0,'0000-00-00','0000-00-00'),(2789,411,'紫阳县',610924,0,0,'0000-00-00','0000-00-00'),(2790,411,'岚皋县',610925,0,0,'0000-00-00','0000-00-00'),(2791,411,'平利县',610926,0,0,'0000-00-00','0000-00-00'),(2792,411,'镇坪县',610927,0,0,'0000-00-00','0000-00-00'),(2793,411,'旬阳县',610928,0,0,'0000-00-00','0000-00-00'),(2794,411,'白河县',610929,0,0,'0000-00-00','0000-00-00'),(2795,412,'商州区',611002,0,0,'0000-00-00','0000-00-00'),(2796,412,'洛南县',611021,0,0,'0000-00-00','0000-00-00'),(2797,412,'丹凤县',611022,0,0,'0000-00-00','0000-00-00'),(2798,412,'商南县',611023,0,0,'0000-00-00','0000-00-00'),(2799,412,'山阳县',611024,0,0,'0000-00-00','0000-00-00'),(2800,412,'镇安县',611025,0,0,'0000-00-00','0000-00-00'),(2801,412,'柞水县',611026,0,0,'0000-00-00','0000-00-00'),(2802,413,'城关区',620102,0,0,'0000-00-00','0000-00-00'),(2803,413,'七里河区',620103,0,0,'0000-00-00','0000-00-00'),(2804,413,'西固区',620104,0,0,'0000-00-00','0000-00-00'),(2805,413,'安宁区',620105,0,0,'0000-00-00','0000-00-00'),(2806,413,'红古区',620111,0,0,'0000-00-00','0000-00-00'),(2807,413,'永登县',620121,0,0,'0000-00-00','0000-00-00'),(2808,413,'皋兰县',620122,0,0,'0000-00-00','0000-00-00'),(2809,413,'榆中县',620123,0,0,'0000-00-00','0000-00-00'),(2810,415,'金川区',620302,0,0,'0000-00-00','0000-00-00'),(2811,415,'永昌县',620321,0,0,'0000-00-00','0000-00-00'),(2812,416,'白银区',620402,0,0,'0000-00-00','0000-00-00'),(2813,416,'平川区',620403,0,0,'0000-00-00','0000-00-00'),(2814,416,'靖远县',620421,0,0,'0000-00-00','0000-00-00'),(2815,416,'会宁县',620422,0,0,'0000-00-00','0000-00-00'),(2816,416,'景泰县',620423,0,0,'0000-00-00','0000-00-00'),(2817,417,'秦州区',620502,0,0,'0000-00-00','0000-00-00'),(2818,417,'麦积区',620503,0,0,'0000-00-00','0000-00-00'),(2819,417,'清水县',620521,0,0,'0000-00-00','0000-00-00'),(2820,417,'秦安县',620522,0,0,'0000-00-00','0000-00-00'),(2821,417,'甘谷县',620523,0,0,'0000-00-00','0000-00-00'),(2822,417,'武山县',620524,0,0,'0000-00-00','0000-00-00'),(2823,417,'张家川回族',620525,0,0,'0000-00-00','0000-00-00'),(2824,418,'凉州区',620602,0,0,'0000-00-00','0000-00-00'),(2825,418,'民勤县',620621,0,0,'0000-00-00','0000-00-00'),(2826,418,'古浪县',620622,0,0,'0000-00-00','0000-00-00'),(2827,418,'天祝藏族',620623,0,0,'0000-00-00','0000-00-00'),(2828,419,'甘州区',620702,0,0,'0000-00-00','0000-00-00'),(2829,419,'肃南裕固族',620721,0,0,'0000-00-00','0000-00-00'),(2830,419,'民乐县',620722,0,0,'0000-00-00','0000-00-00'),(2831,419,'临泽县',620723,0,0,'0000-00-00','0000-00-00'),(2832,419,'高台县',620724,0,0,'0000-00-00','0000-00-00'),(2833,419,'山丹县',620725,0,0,'0000-00-00','0000-00-00'),(2834,420,'崆峒区',620802,0,0,'0000-00-00','0000-00-00'),(2835,420,'泾川县',620821,0,0,'0000-00-00','0000-00-00'),(2836,420,'灵台县',620822,0,0,'0000-00-00','0000-00-00'),(2837,420,'崇信县',620823,0,0,'0000-00-00','0000-00-00'),(2838,420,'华亭县',620824,0,0,'0000-00-00','0000-00-00'),(2839,420,'庄浪县',620825,0,0,'0000-00-00','0000-00-00'),(2840,420,'静宁县',620826,0,0,'0000-00-00','0000-00-00'),(2841,421,'肃州区',620902,0,0,'0000-00-00','0000-00-00'),(2842,421,'金塔县',620921,0,0,'0000-00-00','0000-00-00'),(2843,421,'瓜州县',620922,0,0,'0000-00-00','0000-00-00'),(2844,421,'肃北蒙古族',620923,0,0,'0000-00-00','0000-00-00'),(2845,421,'阿克塞哈萨克族',620924,0,0,'0000-00-00','0000-00-00'),(2846,421,'玉门市',620981,0,0,'0000-00-00','0000-00-00'),(2847,421,'敦煌市',620982,0,0,'0000-00-00','0000-00-00'),(2848,422,'西峰区',621002,0,0,'0000-00-00','0000-00-00'),(2849,422,'庆城县',621021,0,0,'0000-00-00','0000-00-00'),(2850,422,'环县',621022,0,0,'0000-00-00','0000-00-00'),(2851,422,'华池县',621023,0,0,'0000-00-00','0000-00-00'),(2852,422,'合水县',621024,0,0,'0000-00-00','0000-00-00'),(2853,422,'正宁县',621025,0,0,'0000-00-00','0000-00-00'),(2854,422,'宁县',621026,0,0,'0000-00-00','0000-00-00'),(2855,422,'镇原县',621027,0,0,'0000-00-00','0000-00-00'),(2856,423,'安定区',621102,0,0,'0000-00-00','0000-00-00'),(2857,423,'通渭县',621121,0,0,'0000-00-00','0000-00-00'),(2858,423,'陇西县',621122,0,0,'0000-00-00','0000-00-00'),(2859,423,'渭源县',621123,0,0,'0000-00-00','0000-00-00'),(2860,423,'临洮县',621124,0,0,'0000-00-00','0000-00-00'),(2861,423,'漳县',621125,0,0,'0000-00-00','0000-00-00'),(2862,423,'岷县',621126,0,0,'0000-00-00','0000-00-00'),(2863,424,'武都区',621202,0,0,'0000-00-00','0000-00-00'),(2864,424,'成县',621221,0,0,'0000-00-00','0000-00-00'),(2865,424,'文县',621222,0,0,'0000-00-00','0000-00-00'),(2866,424,'宕昌县',621223,0,0,'0000-00-00','0000-00-00'),(2867,424,'康县',621224,0,0,'0000-00-00','0000-00-00'),(2868,424,'西和县',621225,0,0,'0000-00-00','0000-00-00'),(2869,424,'礼县',621226,0,0,'0000-00-00','0000-00-00'),(2870,424,'徽县',621227,0,0,'0000-00-00','0000-00-00'),(2871,424,'两当县',621228,0,0,'0000-00-00','0000-00-00'),(2872,425,'临夏市',622901,0,0,'0000-00-00','0000-00-00'),(2873,425,'临夏县',622921,0,0,'0000-00-00','0000-00-00'),(2874,425,'康乐县',622922,0,0,'0000-00-00','0000-00-00'),(2875,425,'永靖县',622923,0,0,'0000-00-00','0000-00-00'),(2876,425,'广河县',622924,0,0,'0000-00-00','0000-00-00'),(2877,425,'和政县',622925,0,0,'0000-00-00','0000-00-00'),(2878,425,'东乡族',622926,0,0,'0000-00-00','0000-00-00'),(2879,425,'积石山保安族东乡族撒拉族',622927,0,0,'0000-00-00','0000-00-00'),(2880,426,'合作市',623001,0,0,'0000-00-00','0000-00-00'),(2881,426,'临潭县',623021,0,0,'0000-00-00','0000-00-00'),(2882,426,'卓尼县',623022,0,0,'0000-00-00','0000-00-00'),(2883,426,'舟曲县',623023,0,0,'0000-00-00','0000-00-00'),(2884,426,'迭部县',623024,0,0,'0000-00-00','0000-00-00'),(2885,426,'玛曲县',623025,0,0,'0000-00-00','0000-00-00'),(2886,426,'碌曲县',623026,0,0,'0000-00-00','0000-00-00'),(2887,426,'夏河县',623027,0,0,'0000-00-00','0000-00-00'),(2888,427,'城东区',630102,0,0,'0000-00-00','0000-00-00'),(2889,427,'城中区',630103,0,0,'0000-00-00','0000-00-00'),(2890,427,'城西区',630104,0,0,'0000-00-00','0000-00-00'),(2891,427,'城北区',630105,0,0,'0000-00-00','0000-00-00'),(2892,427,'大通回族土族',630121,0,0,'0000-00-00','0000-00-00'),(2893,427,'湟中县',630122,0,0,'0000-00-00','0000-00-00'),(2894,427,'湟源县',630123,0,0,'0000-00-00','0000-00-00'),(2895,428,'乐都区',630202,0,0,'0000-00-00','0000-00-00'),(2896,428,'平安区',630203,0,0,'0000-00-00','0000-00-00'),(2897,428,'民和回族土族',630222,0,0,'0000-00-00','0000-00-00'),(2898,428,'互助土族',630223,0,0,'0000-00-00','0000-00-00'),(2899,428,'化隆回族',630224,0,0,'0000-00-00','0000-00-00'),(2900,428,'循化撒拉族',630225,0,0,'0000-00-00','0000-00-00'),(2901,429,'门源回族',632221,0,0,'0000-00-00','0000-00-00'),(2902,429,'祁连县',632222,0,0,'0000-00-00','0000-00-00'),(2903,429,'海晏县',632223,0,0,'0000-00-00','0000-00-00'),(2904,429,'刚察县',632224,0,0,'0000-00-00','0000-00-00'),(2905,430,'同仁县',632321,0,0,'0000-00-00','0000-00-00'),(2906,430,'尖扎县',632322,0,0,'0000-00-00','0000-00-00'),(2907,430,'泽库县',632323,0,0,'0000-00-00','0000-00-00'),(2908,430,'河南蒙古族',632324,0,0,'0000-00-00','0000-00-00'),(2909,431,'共和县',632521,0,0,'0000-00-00','0000-00-00'),(2910,431,'同德县',632522,0,0,'0000-00-00','0000-00-00'),(2911,431,'贵德县',632523,0,0,'0000-00-00','0000-00-00'),(2912,431,'兴海县',632524,0,0,'0000-00-00','0000-00-00'),(2913,431,'贵南县',632525,0,0,'0000-00-00','0000-00-00'),(2914,432,'玛沁县',632621,0,0,'0000-00-00','0000-00-00'),(2915,432,'班玛县',632622,0,0,'0000-00-00','0000-00-00'),(2916,432,'甘德县',632623,0,0,'0000-00-00','0000-00-00'),(2917,432,'达日县',632624,0,0,'0000-00-00','0000-00-00'),(2918,432,'久治县',632625,0,0,'0000-00-00','0000-00-00'),(2919,432,'玛多县',632626,0,0,'0000-00-00','0000-00-00'),(2920,433,'玉树市',632701,0,0,'0000-00-00','0000-00-00'),(2921,433,'杂多县',632722,0,0,'0000-00-00','0000-00-00'),(2922,433,'称多县',632723,0,0,'0000-00-00','0000-00-00'),(2923,433,'治多县',632724,0,0,'0000-00-00','0000-00-00'),(2924,433,'囊谦县',632725,0,0,'0000-00-00','0000-00-00'),(2925,433,'曲麻莱县',632726,0,0,'0000-00-00','0000-00-00'),(2926,434,'格尔木市',632801,0,0,'0000-00-00','0000-00-00'),(2927,434,'德令哈市',632802,0,0,'0000-00-00','0000-00-00'),(2928,434,'乌兰县',632821,0,0,'0000-00-00','0000-00-00'),(2929,434,'都兰县',632822,0,0,'0000-00-00','0000-00-00'),(2930,434,'天峻县',632823,0,0,'0000-00-00','0000-00-00'),(2931,434,'海西蒙古族藏族',632825,0,0,'0000-00-00','0000-00-00'),(2932,435,'兴庆区',640104,0,0,'0000-00-00','0000-00-00'),(2933,435,'西夏区',640105,0,0,'0000-00-00','0000-00-00'),(2934,435,'金凤区',640106,0,0,'0000-00-00','0000-00-00'),(2935,435,'永宁县',640121,0,0,'0000-00-00','0000-00-00'),(2936,435,'贺兰县',640122,0,0,'0000-00-00','0000-00-00'),(2937,435,'灵武市',640181,0,0,'0000-00-00','0000-00-00'),(2938,436,'大武口区',640202,0,0,'0000-00-00','0000-00-00'),(2939,436,'惠农区',640205,0,0,'0000-00-00','0000-00-00'),(2940,436,'平罗县',640221,0,0,'0000-00-00','0000-00-00'),(2941,437,'利通区',640302,0,0,'0000-00-00','0000-00-00'),(2942,437,'红寺堡区',640303,0,0,'0000-00-00','0000-00-00'),(2943,437,'盐池县',640323,0,0,'0000-00-00','0000-00-00'),(2944,437,'同心县',640324,0,0,'0000-00-00','0000-00-00'),(2945,437,'青铜峡市',640381,0,0,'0000-00-00','0000-00-00'),(2946,438,'原州区',640402,0,0,'0000-00-00','0000-00-00'),(2947,438,'西吉县',640422,0,0,'0000-00-00','0000-00-00'),(2948,438,'隆德县',640423,0,0,'0000-00-00','0000-00-00'),(2949,438,'泾源县',640424,0,0,'0000-00-00','0000-00-00'),(2950,438,'彭阳县',640425,0,0,'0000-00-00','0000-00-00'),(2951,439,'沙坡头区',640502,0,0,'0000-00-00','0000-00-00'),(2952,439,'中宁县',640521,0,0,'0000-00-00','0000-00-00'),(2953,439,'海原县',640522,0,0,'0000-00-00','0000-00-00'),(2954,440,'天山区',650102,0,0,'0000-00-00','0000-00-00'),(2955,440,'沙依巴克区',650103,0,0,'0000-00-00','0000-00-00'),(2956,440,'新市区',650104,0,0,'0000-00-00','0000-00-00'),(2957,440,'水磨沟区',650105,0,0,'0000-00-00','0000-00-00'),(2958,440,'头屯河区',650106,0,0,'0000-00-00','0000-00-00'),(2959,440,'达坂城区',650107,0,0,'0000-00-00','0000-00-00'),(2960,440,'米东区',650109,0,0,'0000-00-00','0000-00-00'),(2961,440,'乌鲁木齐县',650121,0,0,'0000-00-00','0000-00-00'),(2962,441,'独山子区',650202,0,0,'0000-00-00','0000-00-00'),(2963,441,'克拉玛依区',650203,0,0,'0000-00-00','0000-00-00'),(2964,441,'白碱滩区',650204,0,0,'0000-00-00','0000-00-00'),(2965,441,'乌尔禾区',650205,0,0,'0000-00-00','0000-00-00'),(2966,442,'高昌区',652101,0,0,'0000-00-00','0000-00-00'),(2967,442,'鄯善县',652122,0,0,'0000-00-00','0000-00-00'),(2968,442,'托克逊县',652123,0,0,'0000-00-00','0000-00-00'),(2969,443,'哈密市',652201,0,0,'0000-00-00','0000-00-00'),(2970,443,'巴里坤哈萨克',652222,0,0,'0000-00-00','0000-00-00'),(2971,443,'伊吾县',652223,0,0,'0000-00-00','0000-00-00'),(2972,444,'昌吉市',652301,0,0,'0000-00-00','0000-00-00'),(2973,444,'阜康市',652302,0,0,'0000-00-00','0000-00-00'),(2974,444,'呼图壁县',652323,0,0,'0000-00-00','0000-00-00'),(2975,444,'玛纳斯县',652324,0,0,'0000-00-00','0000-00-00'),(2976,444,'奇台县',652325,0,0,'0000-00-00','0000-00-00'),(2977,444,'吉木萨尔县',652327,0,0,'0000-00-00','0000-00-00'),(2978,444,'木垒哈萨克',652328,0,0,'0000-00-00','0000-00-00'),(2979,445,'博乐市',652701,0,0,'0000-00-00','0000-00-00'),(2980,445,'阿拉山口市',652702,0,0,'0000-00-00','0000-00-00'),(2981,445,'精河县',652722,0,0,'0000-00-00','0000-00-00'),(2982,445,'温泉县',652723,0,0,'0000-00-00','0000-00-00'),(2983,446,'库尔勒市',652801,0,0,'0000-00-00','0000-00-00'),(2984,446,'轮台县',652822,0,0,'0000-00-00','0000-00-00'),(2985,446,'尉犁县',652823,0,0,'0000-00-00','0000-00-00'),(2986,446,'若羌县',652824,0,0,'0000-00-00','0000-00-00'),(2987,446,'且末县',652825,0,0,'0000-00-00','0000-00-00'),(2988,446,'焉耆回族',652826,0,0,'0000-00-00','0000-00-00'),(2989,446,'和静县',652827,0,0,'0000-00-00','0000-00-00'),(2990,446,'和硕县',652828,0,0,'0000-00-00','0000-00-00'),(2991,446,'博湖县',652829,0,0,'0000-00-00','0000-00-00'),(2992,447,'阿克苏市',652901,0,0,'0000-00-00','0000-00-00'),(2993,447,'温宿县',652922,0,0,'0000-00-00','0000-00-00'),(2994,447,'库车县',652923,0,0,'0000-00-00','0000-00-00'),(2995,447,'沙雅县',652924,0,0,'0000-00-00','0000-00-00'),(2996,447,'新和县',652925,0,0,'0000-00-00','0000-00-00'),(2997,447,'拜城县',652926,0,0,'0000-00-00','0000-00-00'),(2998,447,'乌什县',652927,0,0,'0000-00-00','0000-00-00'),(2999,447,'阿瓦提县',652928,0,0,'0000-00-00','0000-00-00'),(3000,447,'柯坪县',652929,0,0,'0000-00-00','0000-00-00'),(3001,448,'阿图什市',653001,0,0,'0000-00-00','0000-00-00'),(3002,448,'阿克陶县',653022,0,0,'0000-00-00','0000-00-00'),(3003,448,'阿合奇县',653023,0,0,'0000-00-00','0000-00-00'),(3004,448,'乌恰县',653024,0,0,'0000-00-00','0000-00-00'),(3005,449,'喀什市',653101,0,0,'0000-00-00','0000-00-00'),(3006,449,'疏附县',653121,0,0,'0000-00-00','0000-00-00'),(3007,449,'疏勒县',653122,0,0,'0000-00-00','0000-00-00'),(3008,449,'英吉沙县',653123,0,0,'0000-00-00','0000-00-00'),(3009,449,'泽普县',653124,0,0,'0000-00-00','0000-00-00'),(3010,449,'莎车县',653125,0,0,'0000-00-00','0000-00-00'),(3011,449,'叶城县',653126,0,0,'0000-00-00','0000-00-00'),(3012,449,'麦盖提县',653127,0,0,'0000-00-00','0000-00-00'),(3013,449,'岳普湖县',653128,0,0,'0000-00-00','0000-00-00'),(3014,449,'伽师县',653129,0,0,'0000-00-00','0000-00-00'),(3015,449,'巴楚县',653130,0,0,'0000-00-00','0000-00-00'),(3016,449,'塔什库尔干塔吉克',653131,0,0,'0000-00-00','0000-00-00'),(3017,450,'和田市',653201,0,0,'0000-00-00','0000-00-00'),(3018,450,'和田县',653221,0,0,'0000-00-00','0000-00-00'),(3019,450,'墨玉县',653222,0,0,'0000-00-00','0000-00-00'),(3020,450,'皮山县',653223,0,0,'0000-00-00','0000-00-00'),(3021,450,'洛浦县',653224,0,0,'0000-00-00','0000-00-00'),(3022,450,'策勒县',653225,0,0,'0000-00-00','0000-00-00'),(3023,450,'于田县',653226,0,0,'0000-00-00','0000-00-00'),(3024,450,'民丰县',653227,0,0,'0000-00-00','0000-00-00'),(3025,451,'伊宁市',654002,0,0,'0000-00-00','0000-00-00'),(3026,451,'奎屯市',654003,0,0,'0000-00-00','0000-00-00'),(3027,451,'霍尔果斯市',654004,0,0,'0000-00-00','0000-00-00'),(3028,451,'伊宁县',654021,0,0,'0000-00-00','0000-00-00'),(3029,451,'察布查尔锡伯',654022,0,0,'0000-00-00','0000-00-00'),(3030,451,'霍城县',654023,0,0,'0000-00-00','0000-00-00'),(3031,451,'巩留县',654024,0,0,'0000-00-00','0000-00-00'),(3032,451,'新源县',654025,0,0,'0000-00-00','0000-00-00'),(3033,451,'昭苏县',654026,0,0,'0000-00-00','0000-00-00'),(3034,451,'特克斯县',654027,0,0,'0000-00-00','0000-00-00'),(3035,451,'尼勒克县',654028,0,0,'0000-00-00','0000-00-00'),(3036,452,'塔城市',654201,0,0,'0000-00-00','0000-00-00'),(3037,452,'乌苏市',654202,0,0,'0000-00-00','0000-00-00'),(3038,452,'额敏县',654221,0,0,'0000-00-00','0000-00-00'),(3039,452,'沙湾县',654223,0,0,'0000-00-00','0000-00-00'),(3040,452,'托里县',654224,0,0,'0000-00-00','0000-00-00'),(3041,452,'裕民县',654225,0,0,'0000-00-00','0000-00-00'),(3042,452,'和布克赛尔蒙古',654226,0,0,'0000-00-00','0000-00-00'),(3043,453,'阿勒泰市',654301,0,0,'0000-00-00','0000-00-00'),(3044,453,'布尔津县',654321,0,0,'0000-00-00','0000-00-00'),(3045,453,'富蕴县',654322,0,0,'0000-00-00','0000-00-00'),(3046,453,'福海县',654323,0,0,'0000-00-00','0000-00-00'),(3047,453,'哈巴河县',654324,0,0,'0000-00-00','0000-00-00'),(3048,453,'青河县',654325,0,0,'0000-00-00','0000-00-00'),(3049,453,'吉木乃县',654326,0,0,'0000-00-00','0000-00-00');
/*!40000 ALTER TABLE `bs_citys` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `bs_designs`
--

DROP TABLE IF EXISTS `bs_designs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `bs_designs` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL COMMENT '设计名称',
  `genre` tinyint(3) unsigned NOT NULL DEFAULT '1' COMMENT '供求类型：1供应，2需求',
  `type_id` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '设计类型：房产，效果图，平面，漫游',
  `uid` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '发布者id',
  `intro` varchar(1000) DEFAULT NULL COMMENT '设计简介',
  `price` decimal(10,0) unsigned NOT NULL DEFAULT '0' COMMENT '价格，单位元',
  `sort` int(10) unsigned NOT NULL DEFAULT '10' COMMENT '排序字段，值越大越靠前，默认10',
  `del` tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT '回收站功能：0不放入回收站，1放入回收站',
  `created_at` date NOT NULL DEFAULT '0000-00-00' COMMENT '创建时间',
  `updated_at` date NOT NULL DEFAULT '0000-00-00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='设计表 bs_designs';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `bs_designs`
--

LOCK TABLES `bs_designs` WRITE;
/*!40000 ALTER TABLE `bs_designs` DISABLE KEYS */;
/*!40000 ALTER TABLE `bs_designs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `bs_entertain_actor`
--

DROP TABLE IF EXISTS `bs_entertain_actor`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `bs_entertain_actor` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `entertainid` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '娱乐id',
  `actorid` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '演员id',
  `created_at` date NOT NULL DEFAULT '0000-00-00' COMMENT '创建时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='娱乐演员关联表 bs_entertain_actor';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `bs_entertain_actor`
--

LOCK TABLES `bs_entertain_actor` WRITE;
/*!40000 ALTER TABLE `bs_entertain_actor` DISABLE KEYS */;
/*!40000 ALTER TABLE `bs_entertain_actor` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `bs_entertain_pic`
--

DROP TABLE IF EXISTS `bs_entertain_pic`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `bs_entertain_pic` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `entertain_id` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '娱乐id',
  `pic_id` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '图片id',
  `created_at` date NOT NULL DEFAULT '0000-00-00' COMMENT '创建时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='娱乐图片关联表 bs_entertain_pic';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `bs_entertain_pic`
--

LOCK TABLES `bs_entertain_pic` WRITE;
/*!40000 ALTER TABLE `bs_entertain_pic` DISABLE KEYS */;
/*!40000 ALTER TABLE `bs_entertain_pic` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `bs_entertain_work`
--

DROP TABLE IF EXISTS `bs_entertain_work`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `bs_entertain_work` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `entertainid` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '娱乐id',
  `workid` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '影视作品id',
  `created_at` date NOT NULL DEFAULT '0000-00-00' COMMENT '创建时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='娱乐公司与作品关联表 bs_entertain_work';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `bs_entertain_work`
--

LOCK TABLES `bs_entertain_work` WRITE;
/*!40000 ALTER TABLE `bs_entertain_work` DISABLE KEYS */;
/*!40000 ALTER TABLE `bs_entertain_work` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `bs_entertains`
--

DROP TABLE IF EXISTS `bs_entertains`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `bs_entertains` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL COMMENT '娱乐标题',
  `genre` tinyint(3) unsigned NOT NULL DEFAULT '1' COMMENT '供求列表：1需求，2供应',
  `content` text NOT NULL COMMENT '内容',
  `uid` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '发布方id',
  `sort` int(10) unsigned NOT NULL DEFAULT '10' COMMENT '排序字段，值越大越靠前，默认10',
  `del` tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT '回收站：0为不放入回收站，1为放入回收站',
  `created_at` date NOT NULL DEFAULT '0000-00-00' COMMENT '创建时间',
  `updated_at` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COMMENT='娱乐表';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `bs_entertains`
--

LOCK TABLES `bs_entertains` WRITE;
/*!40000 ALTER TABLE `bs_entertains` DISABLE KEYS */;
INSERT INTO `bs_entertains` VALUES (1,'娱乐001',1,'rthyngrthg',0,10,0,'2016-03-22','2016-03-22');
/*!40000 ALTER TABLE `bs_entertains` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `bs_functions`
--

DROP TABLE IF EXISTS `bs_functions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `bs_functions` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL COMMENT '功能名称',
  `intro` varchar(1000) DEFAULT NULL COMMENT '说明',
  `table_name` varchar(255) NOT NULL COMMENT '数据表名称',
  `action` varchar(255) NOT NULL COMMENT '操作名称',
  `del` tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT '回收站功能：0不放入回收站，1放入回收站',
  `created_at` date NOT NULL DEFAULT '0000-00-00' COMMENT '创建时间',
  `updated_at` date NOT NULL DEFAULT '0000-00-00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COMMENT='功能表 bs_functions（前台功能）';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `bs_functions`
--

LOCK TABLES `bs_functions` WRITE;
/*!40000 ALTER TABLE `bs_functions` DISABLE KEYS */;
INSERT INTO `bs_functions` VALUES (1,'ffffffrgfgrefvdbf','','bs_videos_category','index',0,'2016-02-17','2016-02-17');
/*!40000 ALTER TABLE `bs_functions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `bs_goods`
--

DROP TABLE IF EXISTS `bs_goods`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `bs_goods` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL COMMENT '视频名称',
  `type` tinyint(3) unsigned NOT NULL DEFAULT '1' COMMENT '产品主体：1个人需求，2设计师供应，3企业需求，4企业供应',
  `cate_id` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '视频分类：关联bs_videos_category',
  `intro` varchar(1000) NOT NULL COMMENT '视频简介',
  `pic_id` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '图片链接id，关联图片表bs_pics',
  `video_id` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '视频链接id，链接视频表bs_videos',
  `uid` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '发布人：需求用户，设计师，公司',
  `uname` varchar(255) NOT NULL COMMENT '发布人名称',
  `recommend` tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT '是否推荐：0不推荐，1不推荐，默认0',
  `sort` int(10) unsigned NOT NULL DEFAULT '10' COMMENT '排序字段，值越大越靠前，默认10',
  `isshow` tinyint(3) unsigned NOT NULL DEFAULT '1' COMMENT '前台列表是否显示：0不显示，1显示，默认1',
  `del` tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT '回收站功能：0不放入回收站，1放入回收站',
  `created_at` date NOT NULL DEFAULT '0000-00-00' COMMENT '创建时间',
  `updated_at` date NOT NULL DEFAULT '0000-00-00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COMMENT='上传的视频表：供应方提供的产品、需求方提供的需求样片';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `bs_goods`
--

LOCK TABLES `bs_goods` WRITE;
/*!40000 ALTER TABLE `bs_goods` DISABLE KEYS */;
INSERT INTO `bs_goods` VALUES (1,'作品1',0,0,'v部分的白癜风b',0,0,0,'',0,10,1,0,'2016-03-12','0000-00-00'),(2,'企业需求001',3,4,'',1,0,0,'',0,10,1,0,'2016-03-13','0000-00-00'),(3,'企业作品001',4,4,'',1,0,0,'',0,10,1,0,'2016-03-13','0000-00-00');
/*!40000 ALTER TABLE `bs_goods` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `bs_ideas`
--

DROP TABLE IF EXISTS `bs_ideas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `bs_ideas` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL COMMENT '名称',
  `cate_id` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '分类，关联分类表category',
  `content` text NOT NULL COMMENT '创意内容',
  `uid` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '发布的用户id',
  `sort` int(10) unsigned NOT NULL DEFAULT '10' COMMENT '排序，值越大越靠前，默认10',
  `isshow` tinyint(3) unsigned NOT NULL DEFAULT '1' COMMENT '前台列表是否显示：0前台列表不显示，1前台列表显示',
  `del` tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT '回收站功能：0不放入回收站，1放入回收站',
  `created_at` datetime NOT NULL DEFAULT '0000-00-00 00:00:00' COMMENT '创建时间',
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COMMENT='创意表';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `bs_ideas`
--

LOCK TABLES `bs_ideas` WRITE;
/*!40000 ALTER TABLE `bs_ideas` DISABLE KEYS */;
INSERT INTO `bs_ideas` VALUES (1,'创意1',4,'<p>而非v代表</p>',1,10,1,0,'2016-04-17 01:46:45','2016-04-17 02:24:47'),(2,'创意部分的白癜风',4,'<p>不辜负你发个你突然发红包让头发的非v别的人副本二本的日本</p>',1,10,1,0,'2016-04-21 14:42:17','0000-00-00 00:00:00'),(3,'创意123456',4,'<p>不同功能同一个男人太烦恼吧 不同人反复给你发给你发的吧v辅导班该方法v表单v废话么放入后天就能GV干嘛换个号部分或讲不出的生物科技获得鼠标不同人还能听任何人挺好投入和</p>',1,10,1,0,'2016-04-21 15:10:03','0000-00-00 00:00:00');
/*!40000 ALTER TABLE `bs_ideas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `bs_ideas_click`
--

DROP TABLE IF EXISTS `bs_ideas_click`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `bs_ideas_click` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `ideaid` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '创意id',
  `uid` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '登录用户id',
  `created_at` datetime NOT NULL DEFAULT '0000-00-00 00:00:00' COMMENT '创建时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='创意点赞表';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `bs_ideas_click`
--

LOCK TABLES `bs_ideas_click` WRITE;
/*!40000 ALTER TABLE `bs_ideas_click` DISABLE KEYS */;
/*!40000 ALTER TABLE `bs_ideas_click` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `bs_ideas_collect`
--

DROP TABLE IF EXISTS `bs_ideas_collect`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `bs_ideas_collect` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `ideaid` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '创意id',
  `uid` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '登录用户id',
  `created_at` datetime NOT NULL DEFAULT '0000-00-00 00:00:00' COMMENT '创建时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='创意收藏表';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `bs_ideas_collect`
--

LOCK TABLES `bs_ideas_collect` WRITE;
/*!40000 ALTER TABLE `bs_ideas_collect` DISABLE KEYS */;
/*!40000 ALTER TABLE `bs_ideas_collect` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `bs_ideas_copy备份`
--

DROP TABLE IF EXISTS `bs_ideas_copy备份`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `bs_ideas_copy备份` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL COMMENT '名称',
  `cate_id` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '分类，关联分类表category',
  `content` text NOT NULL COMMENT '创意内容',
  `uid` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '发布的用户id',
  `read` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '浏览次数',
  `click` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '点赞次数',
  `sort` int(10) unsigned NOT NULL DEFAULT '10' COMMENT '排序，值越大越靠前，默认10',
  `del` tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT '回收站功能：0不放入回收站，1放入回收站',
  `created_at` datetime NOT NULL DEFAULT '0000-00-00 00:00:00' COMMENT '创建时间',
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COMMENT='创意表';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `bs_ideas_copy备份`
--

LOCK TABLES `bs_ideas_copy备份` WRITE;
/*!40000 ALTER TABLE `bs_ideas_copy备份` DISABLE KEYS */;
INSERT INTO `bs_ideas_copy备份` VALUES (1,'创意1',4,'<p>而非v代表</p>',1,0,0,10,0,'2016-04-17 01:46:45','2016-04-17 02:24:47');
/*!40000 ALTER TABLE `bs_ideas_copy备份` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `bs_ideas_read`
--

DROP TABLE IF EXISTS `bs_ideas_read`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `bs_ideas_read` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `ideaid` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '创意id',
  `uid` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '登录用户id',
  `created_at` datetime NOT NULL DEFAULT '0000-00-00 00:00:00' COMMENT '创建时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='创意阅读表';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `bs_ideas_read`
--

LOCK TABLES `bs_ideas_read` WRITE;
/*!40000 ALTER TABLE `bs_ideas_read` DISABLE KEYS */;
/*!40000 ALTER TABLE `bs_ideas_read` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `bs_ideas_show`
--

DROP TABLE IF EXISTS `bs_ideas_show`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `bs_ideas_show` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `ideaid` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '创意id',
  `uid` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '允许查看的用户id',
  `created_at` datetime NOT NULL DEFAULT '0000-00-00 00:00:00' COMMENT '创建时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='创意查看权限表';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `bs_ideas_show`
--

LOCK TABLES `bs_ideas_show` WRITE;
/*!40000 ALTER TABLE `bs_ideas_show` DISABLE KEYS */;
/*!40000 ALTER TABLE `bs_ideas_show` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `bs_links`
--

DROP TABLE IF EXISTS `bs_links`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `bs_links` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL COMMENT '链接名称',
  `title` varchar(255) DEFAULT NULL COMMENT '鼠标移动的提示文字',
  `type_id` int(10) unsigned NOT NULL DEFAULT '1' COMMENT '类型id，关联bs_types',
  `pic_id` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '图片id，关联bs_pics',
  `intro` varchar(500) DEFAULT NULL COMMENT '链接介绍',
  `link` varchar(255) NOT NULL COMMENT '访问地址链接',
  `display_way` tinyint(3) unsigned NOT NULL DEFAULT '1' COMMENT '显示方式：1文字链接，2图片链接',
  `isshow` tinyint(3) unsigned NOT NULL DEFAULT '1' COMMENT '在前台页面是否显示：0不显示，1显示',
  `pid` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '父id',
  `sort` int(10) unsigned NOT NULL DEFAULT '10' COMMENT '排序字段，值越大越靠前，默认10',
  `created_at` date NOT NULL DEFAULT '0000-00-00' COMMENT '创建时间',
  `updated_at` date NOT NULL DEFAULT '0000-00-00' COMMENT '更新时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8 COMMENT='网站链接表：包含header头部链接、navigate菜单导航栏链接、footer脚部链接等';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `bs_links`
--

LOCK TABLES `bs_links` WRITE;
/*!40000 ALTER TABLE `bs_links` DISABLE KEYS */;
INSERT INTO `bs_links` VALUES (1,'首页','',2,0,'','/',1,1,0,10,'2016-01-13','0000-00-00'),(2,'产品样片','',2,0,'','product',1,1,0,10,'2016-04-17','0000-00-00'),(3,'在线作品','',2,0,'','creation',1,1,0,10,'2016-04-17','0000-00-00'),(4,'供应企业','',2,0,'','supply',1,1,0,10,'2016-04-17','0000-00-00'),(5,'需求信息','',2,0,'','demand',1,1,0,10,'2016-04-17','0000-00-00'),(6,'娱乐频道','',2,0,'','entertain',1,1,0,10,'2016-04-17','0000-00-00'),(7,'租赁频道','',2,0,'','rent',1,1,0,10,'2016-04-17','0000-00-00'),(8,'设计频道','',2,0,'','design',1,1,0,10,'2016-04-17','0000-00-00'),(9,'关于我们','',2,0,'','about',1,1,0,10,'2016-04-17','0000-00-00'),(10,'创意点子','',2,0,'','idea',1,1,0,10,'2016-04-17','0000-00-00'),(11,'用户意见','请留下您的宝贵意见哦',2,0,'','opinion',1,1,0,10,'2016-04-17','0000-00-00'),(12,'首页','底部链接，此链接带修改',3,0,'','home',1,1,0,10,'2016-04-17','2016-04-17'),(13,'友情链接','此链接带修改',3,0,'','home',1,1,0,10,'2016-04-17','2016-04-17'),(14,'安全网盾','此链接带修改',3,0,'','home',1,1,0,10,'2016-04-17','0000-00-00'),(15,'链接1','此链接带修改',3,0,'','home',1,1,0,10,'2016-04-17','0000-00-00'),(16,'链接2','此链接带修改',3,0,'','home',1,1,0,10,'2016-04-17','0000-00-00'),(17,'链接3','此链接带修改',3,0,'','home',1,1,0,10,'2016-04-17','0000-00-00');
/*!40000 ALTER TABLE `bs_links` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `bs_menu_user`
--

DROP TABLE IF EXISTS `bs_menu_user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `bs_menu_user` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `menuid` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '菜单id',
  `uid` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '用户id',
  `created_at` date NOT NULL DEFAULT '0000-00-00' COMMENT '创建时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8 COMMENT='会员后台用户与菜单关联表';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `bs_menu_user`
--

LOCK TABLES `bs_menu_user` WRITE;
/*!40000 ALTER TABLE `bs_menu_user` DISABLE KEYS */;
INSERT INTO `bs_menu_user` VALUES (1,0,0,'2016-03-06'),(2,0,0,'2016-02-29'),(3,0,0,'2016-03-12'),(4,0,0,'2016-02-29'),(5,0,0,'2016-03-12'),(6,0,0,'2016-03-12'),(7,0,0,'2016-03-12'),(8,0,0,'2016-03-12'),(9,0,0,'2016-03-12'),(10,0,0,'2016-03-12'),(11,0,0,'2016-03-12'),(12,0,0,'2016-03-13'),(13,0,0,'2016-03-13'),(14,0,0,'2016-04-16'),(15,0,0,'2016-04-17'),(16,0,0,'2016-04-17');
/*!40000 ALTER TABLE `bs_menu_user` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `bs_menus`
--

DROP TABLE IF EXISTS `bs_menus`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `bs_menus` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL COMMENT '权限名称',
  `type` tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT '菜单类型：1会员后台member，2个人后台person，3企业后台company',
  `intro` varchar(255) DEFAULT NULL COMMENT '权限说明',
  `namespace` varchar(255) NOT NULL COMMENT '命名空间',
  `controller_prefix` varchar(255) NOT NULL DEFAULT '' COMMENT '控制器名称',
  `platUrl` varchar(255) NOT NULL COMMENT '平台路由',
  `url` varchar(255) NOT NULL COMMENT '访问路径的部分 url',
  `action` varchar(255) NOT NULL COMMENT '操作方法名称',
  `style_class` varchar(255) DEFAULT NULL COMMENT 'class样式名称',
  `pid` tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT '上级ID',
  `isshow` tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT '前台是否显示：0不显示，1显示',
  `sort` int(10) unsigned NOT NULL DEFAULT '10' COMMENT '排序，默认10',
  `created_at` date NOT NULL DEFAULT '0000-00-00' COMMENT '创建时间',
  `updated_at` date NOT NULL DEFAULT '0000-00-00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8 COMMENT='前台左侧菜单控制表 bs_menus';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `bs_menus`
--

LOCK TABLES `bs_menus` WRITE;
/*!40000 ALTER TABLE `bs_menus` DISABLE KEYS */;
INSERT INTO `bs_menus` VALUES (1,'账户首页',1,'会员后台左侧菜单控制','App\\Http\\Controllers\\Member','Home','member','home','index','',0,1,10,'2016-03-06','2016-03-06'),(2,'会员账户',1,'','App\\Http\\Controllers\\Member','Setting','member','setting','index','',0,1,10,'2016-02-29','2016-04-12'),(3,'在线创作',1,'','App\\Http\\Controllers\\Member','Product','member','product','index','',0,1,10,'2016-03-12','2016-03-14'),(4,'个人供求',1,'','App\\Http\\Controllers\\Member','PersonD','member','personD','index','',0,1,10,'2016-02-29','2016-03-19'),(5,'企业供求',1,'','App\\Http\\Controllers\\Member','CompanyD','member','companyD','index','',0,1,10,'2016-03-12','2016-03-19'),(6,'个人需求',1,'','App\\Http\\Controllers\\Member','PersonD','member','personD','index','',4,1,10,'2016-03-12','2016-03-19'),(7,'个人作品',1,'','App\\Http\\Controllers\\Member','PersonS','member','personS','index','',4,1,10,'2016-03-12','2016-03-19'),(8,'企业需求',1,'','App\\Http\\Controllers\\Member','CompanyD','member','companyD','index','',5,1,10,'2016-03-12','2016-03-19'),(9,'企业作品',1,'','App\\Http\\Controllers\\Member','CompanyS','member','companyS','index','',5,1,10,'2016-03-12','2016-03-19'),(10,'租赁供求',1,'','App\\Http\\Controllers\\Member','Rent','member','rent','index','',5,1,10,'2016-03-12','2016-03-19'),(11,'娱乐供求',1,'','App\\Http\\Controllers\\Member','Entertain','member','entertain','index','',5,1,10,'2016-03-12','2016-03-13'),(12,'基本管理',1,'','App\\Http\\Controllers\\Member','Category','member','category','index','',0,1,10,'2016-03-13','0000-00-00'),(13,'分类管理',1,'','App\\Http\\Controllers\\Member','Category','member','category','index','',12,1,10,'2016-03-13','2016-03-19'),(14,'创意管理',1,'','App\\Http\\Controllers\\Member','Idea','member','idea','index','',12,1,10,'2016-04-16','0000-00-00'),(15,'个人主页',1,'','App\\Http\\Controllers\\Person','Home','person','home','index','',4,1,20,'2016-04-17','2016-04-22'),(16,'企业主页',1,'','App\\Http\\Controllers\\Company','Home','company','home','index','',5,1,20,'2016-04-17','2016-04-17'),(17,'演员管理',1,'','App\\Http\\Controllers\\Member','Actor','member','actor','index','',5,1,10,'2016-04-23','0000-00-00');
/*!40000 ALTER TABLE `bs_menus` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `bs_message`
--

DROP TABLE IF EXISTS `bs_message`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `bs_message` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL COMMENT '消息标题',
  `genre` tinyint(3) unsigned NOT NULL DEFAULT '1' COMMENT '消息主体：1个人消息，2企业消息',
  `type` tinyint(3) unsigned NOT NULL DEFAULT '2' COMMENT '消息类型：1在线消息，2离线消息',
  `content` varchar(500) DEFAULT NULL COMMENT '消息内容',
  `sender` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '发件人id',
  `sender_time` int(20) unsigned NOT NULL DEFAULT '0' COMMENT '发送时间',
  `accept` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '收件人id',
  `accept_time` int(20) unsigned NOT NULL DEFAULT '0' COMMENT '收件时间',
  `status` tinyint(3) unsigned NOT NULL DEFAULT '1' COMMENT '消息状态：1未发送，2已发送未接收，3已接收未读，4已读',
  `del` tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT '回收站功能：0不放入回收站，1放入回收站',
  `created_at` date NOT NULL DEFAULT '0000-00-00' COMMENT '创建时间',
  `updated_at` date NOT NULL DEFAULT '0000-00-00' COMMENT '更新时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='消息表';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `bs_message`
--

LOCK TABLES `bs_message` WRITE;
/*!40000 ALTER TABLE `bs_message` DISABLE KEYS */;
/*!40000 ALTER TABLE `bs_message` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `bs_opinions`
--

DROP TABLE IF EXISTS `bs_opinions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `bs_opinions` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL COMMENT '标题',
  `intro` varchar(2000) NOT NULL COMMENT '内容',
  `pic` varchar(255) DEFAULT NULL COMMENT '截图',
  `uid` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '用户id',
  `status` tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT '意见状态：1新意见，2已查看，3处理中，4不满意，5满意',
  `remarks` varchar(255) DEFAULT NULL COMMENT '不满意理由',
  `isreply` tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT '回复id：0表示无回复，1表示有回复',
  `reply` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '回复id，关联本表上级id，0是无回复',
  `isshow` tinyint(3) unsigned NOT NULL DEFAULT '2' COMMENT '在前台列表是否显示：1不显示，2显示，0代表全部显示',
  `del` tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT '回收站功能：0不放入回收站，1放入回收站',
  `created_at` date NOT NULL DEFAULT '0000-00-00' COMMENT '创建时间',
  `updated_at` date DEFAULT NULL COMMENT '更新时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COMMENT='用户意见表 (bs_opinions)：用户对本站的意见';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `bs_opinions`
--

LOCK TABLES `bs_opinions` WRITE;
/*!40000 ALTER TABLE `bs_opinions` DISABLE KEYS */;
INSERT INTO `bs_opinions` VALUES (1,'意见001','<p>ergtbfrgtbf</p>','/uploads/images/2016-04-03/5700c2d90606d.png',0,1,'',0,0,2,0,'2016-04-03',NULL);
/*!40000 ALTER TABLE `bs_opinions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `bs_orders`
--

DROP TABLE IF EXISTS `bs_orders`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `bs_orders` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL COMMENT '订单名称',
  `serial` int(20) unsigned NOT NULL DEFAULT '0' COMMENT '订单编号',
  `seller` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '卖家id ',
  `sellerName` varchar(255) NOT NULL COMMENT '卖家名称',
  `buyer` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '买家id',
  `buyerName` varchar(255) NOT NULL COMMENT '买家名称',
  `number` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '数量',
  `status` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '订单状态：申请，协商，确定，交易，结果',
  `isshow` tinyint(3) unsigned NOT NULL DEFAULT '1' COMMENT '前台列表是否显示：0不显示，1显示，默认1',
  `created_at` date NOT NULL DEFAULT '0000-00-00' COMMENT '创建时间',
  `updated_at` date NOT NULL DEFAULT '0000-00-00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='订单表 bs_orders';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `bs_orders`
--

LOCK TABLES `bs_orders` WRITE;
/*!40000 ALTER TABLE `bs_orders` DISABLE KEYS */;
/*!40000 ALTER TABLE `bs_orders` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `bs_pics`
--

DROP TABLE IF EXISTS `bs_pics`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `bs_pics` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL COMMENT '图片名称',
  `cate_id` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '类型id：关联bs_category',
  `url` varchar(255) NOT NULL COMMENT '图片路径',
  `intro` varchar(500) DEFAULT NULL COMMENT '图片介绍',
  `created_at` date NOT NULL DEFAULT '0000-00-00' COMMENT '创建时间',
  `updated_at` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='图片管理表（暂用QQ空间相册）';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `bs_pics`
--

LOCK TABLES `bs_pics` WRITE;
/*!40000 ALTER TABLE `bs_pics` DISABLE KEYS */;
/*!40000 ALTER TABLE `bs_pics` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `bs_products`
--

DROP TABLE IF EXISTS `bs_products`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `bs_products` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL COMMENT '视频名称',
  `genre` tinyint(3) unsigned NOT NULL DEFAULT '1' COMMENT '发布者身份：1个人，2企业',
  `gif` int(10) unsigned NOT NULL DEFAULT '0' COMMENT ' 动态缩略图，关联图片表bs_pics',
  `intro` varchar(1000) NOT NULL COMMENT '视频简介',
  `uid` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '提供者：需求用户，设计师，公司',
  `uname` varchar(255) NOT NULL COMMENT '提供者名称',
  `isauth` tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT '审核：0未审核，1未通过审核，2通过审核',
  `sort` int(10) unsigned NOT NULL DEFAULT '10' COMMENT '排序字段，值越大越靠前，默认10',
  `isshow` tinyint(3) unsigned NOT NULL DEFAULT '1' COMMENT '前台列表是否显示：0不显示，1显示',
  `del` tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT '回收站功能：0不放入回收站，1放入回收站',
  `created_at` date NOT NULL DEFAULT '0000-00-00' COMMENT '创建时间',
  `updated_at` date NOT NULL DEFAULT '0000-00-00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='在线视频表：在线写的模板';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `bs_products`
--

LOCK TABLES `bs_products` WRITE;
/*!40000 ALTER TABLE `bs_products` DISABLE KEYS */;
/*!40000 ALTER TABLE `bs_products` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `bs_products_attr`
--

DROP TABLE IF EXISTS `bs_products_attr`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `bs_products_attr` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL COMMENT '属性名称',
  `type_id` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '属性类型：css样式文件，js文件',
  `url` varchar(255) NOT NULL COMMENT '属性文件路径',
  `intro` varchar(1000) DEFAULT NULL COMMENT '属性简介',
  `created_at` date NOT NULL DEFAULT '0000-00-00' COMMENT '创建时间',
  `updated_at` date NOT NULL DEFAULT '0000-00-00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='在线视频属性表：在线写的属性模板';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `bs_products_attr`
--

LOCK TABLES `bs_products_attr` WRITE;
/*!40000 ALTER TABLE `bs_products_attr` DISABLE KEYS */;
/*!40000 ALTER TABLE `bs_products_attr` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `bs_rent_pic`
--

DROP TABLE IF EXISTS `bs_rent_pic`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `bs_rent_pic` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `rent_id` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '租赁id',
  `pic_id` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '图片id',
  `created_at` date NOT NULL DEFAULT '0000-00-00' COMMENT '创建时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='租赁图片关联表';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `bs_rent_pic`
--

LOCK TABLES `bs_rent_pic` WRITE;
/*!40000 ALTER TABLE `bs_rent_pic` DISABLE KEYS */;
/*!40000 ALTER TABLE `bs_rent_pic` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `bs_rents`
--

DROP TABLE IF EXISTS `bs_rents`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `bs_rents` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL COMMENT '设备名称',
  `genre` tinyint(3) unsigned NOT NULL DEFAULT '1' COMMENT '类型：1供应，2需求',
  `intro` varchar(500) NOT NULL COMMENT '设备介绍',
  `uid` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '发布者id',
  `price` decimal(10,2) unsigned NOT NULL DEFAULT '0.00' COMMENT '价格，单位元',
  `fromtime` int(20) unsigned NOT NULL DEFAULT '0' COMMENT '租赁开始时间',
  `totime` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '租赁结束时间',
  `sort` int(10) unsigned NOT NULL DEFAULT '10' COMMENT '排序字段，值越大越靠前，默认10',
  `del` tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT '回收站功能：0不放入回收站，1放入回收站',
  `created_at` date NOT NULL DEFAULT '0000-00-00' COMMENT '创建时间',
  `updated_at` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COMMENT='租赁表';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `bs_rents`
--

LOCK TABLES `bs_rents` WRITE;
/*!40000 ALTER TABLE `bs_rents` DISABLE KEYS */;
INSERT INTO `bs_rents` VALUES (1,'租赁供应0323',1,'yyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyy',0,0.00,0,0,10,0,'2016-03-23','2016-03-23');
/*!40000 ALTER TABLE `bs_rents` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `bs_talks`
--

DROP TABLE IF EXISTS `bs_talks`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `bs_talks` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL COMMENT '名称',
  `themeid` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '话题主题id',
  `content` text NOT NULL COMMENT '创意内容',
  `uid` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '发布的用户id',
  `read` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '浏览次数',
  `sort` int(10) unsigned NOT NULL DEFAULT '10' COMMENT '排序字段，值越大越靠前，默认10',
  `isshow` tinyint(3) unsigned NOT NULL DEFAULT '1' COMMENT '前台是否显示：0前台列表不显示，1前台列表显示',
  `del` tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT '回收站功能：0不放入回收站，1放入回收站',
  `created_at` datetime NOT NULL DEFAULT '0000-00-00 00:00:00' COMMENT '创建时间',
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COMMENT='话题表';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `bs_talks`
--

LOCK TABLES `bs_talks` WRITE;
/*!40000 ALTER TABLE `bs_talks` DISABLE KEYS */;
INSERT INTO `bs_talks` VALUES (1,'话题1',0,'<p>而非v代表而非v代表而非v代表而非v代表而非v代表而非v代表而非v代表而非v代表而非v代表而非v代表而非v代表而非v代表而非v代表而非v代表而非v代表而非v代表而非v代表而非v代表而非v代表而非v代表而非v代表而非v代表而非v代表而非v代表而非v代表而非v代表而非v代表而非v代表而非v代表而非v代表而非v代表而非v代表而非v代表而非v代表而非v代表而非v代表而非v代表而非v代表而非v代表而非v代表而非v代表而非v代表而非v代表而非v代表而非v代表而非v代表而非v代表而非v代表而非v代表而非v代表而非v代表而非v代表而非v代表而非v代表而非v代表而非v代表而非v代表而非v代表而非v代表而非v代表而非v代表而非v代表而非v代表而非v代表而非v代表而非v代表而非v代表而非v代表而非v代表而非v代表而非v代表而非v代表而非v代表而非v代表而非v代表而非v代表而非v代表而非v代表而非v代表而非v代表而非v代表而非v代表而非v代表而非v代表而非v代表</p>',1,0,10,1,0,'2016-04-17 01:46:45','2016-04-17 02:24:47'),(2,'话题2 222222222222',0,'<p>不服该办法呢GV热豆腐还不太高和今年投入富家女我我的是女附近的八个人工我可v别沮丧的v比对方不能交电费表肯定是你鄙视吧v那地方就不能hiu二个IE人根据IE如何隔日给举动被GV的人覅偶包过户的人发货不固定不v个is独具不</p><p>55555555555555555555555555555</p>',1,0,10,1,0,'2016-04-19 15:27:53','2016-04-22 01:44:00'),(3,'话题3333333',0,'<p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;这里可以排版文字，插入或粘贴图片\r\n &nbsp; &nbsp;&nbsp;</p><p>5151516515615165156165561562626516516515 &nbsp; &nbsp; &nbsp;&nbsp;</p>',1,0,10,1,0,'2016-04-22 01:44:27','2016-04-22 01:45:06');
/*!40000 ALTER TABLE `bs_talks` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `bs_talks_click`
--

DROP TABLE IF EXISTS `bs_talks_click`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `bs_talks_click` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `talkid` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '话题id',
  `uid` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '登录用户id',
  `created_at` datetime NOT NULL DEFAULT '0000-00-00 00:00:00' COMMENT '创建时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='话题点赞表';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `bs_talks_click`
--

LOCK TABLES `bs_talks_click` WRITE;
/*!40000 ALTER TABLE `bs_talks_click` DISABLE KEYS */;
/*!40000 ALTER TABLE `bs_talks_click` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `bs_talks_collect`
--

DROP TABLE IF EXISTS `bs_talks_collect`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `bs_talks_collect` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `talkid` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '话题id',
  `uid` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '登录用户id',
  `created_at` datetime NOT NULL DEFAULT '0000-00-00 00:00:00' COMMENT '创建时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='话题收藏表';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `bs_talks_collect`
--

LOCK TABLES `bs_talks_collect` WRITE;
/*!40000 ALTER TABLE `bs_talks_collect` DISABLE KEYS */;
/*!40000 ALTER TABLE `bs_talks_collect` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `bs_talks_copy备份`
--

DROP TABLE IF EXISTS `bs_talks_copy备份`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `bs_talks_copy备份` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL COMMENT '名称',
  `content` text NOT NULL COMMENT '创意内容',
  `uid` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '发布的用户id',
  `read` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '浏览次数',
  `click` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '点赞次数',
  `follow` varchar(255) NOT NULL DEFAULT '0' COMMENT '关注此话题的用户id组合',
  `thank` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '要感谢的用户id',
  `share` varchar(255) NOT NULL DEFAULT '0' COMMENT '分享其他用户id组合',
  `report` varchar(255) NOT NULL DEFAULT '0' COMMENT '举报者id组合，默认0无举报',
  `collect` varchar(255) NOT NULL DEFAULT '0' COMMENT '收藏此话题的用户id集合',
  `sort` int(10) unsigned NOT NULL DEFAULT '10' COMMENT '排序字段，值越大越靠前，默认10',
  `del` tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT '回收站功能：0不放入回收站，1放入回收站',
  `created_at` datetime NOT NULL DEFAULT '0000-00-00 00:00:00' COMMENT '创建时间',
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COMMENT='话题表';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `bs_talks_copy备份`
--

LOCK TABLES `bs_talks_copy备份` WRITE;
/*!40000 ALTER TABLE `bs_talks_copy备份` DISABLE KEYS */;
INSERT INTO `bs_talks_copy备份` VALUES (1,'话题1','<p>而非v代表而非v代表而非v代表而非v代表而非v代表而非v代表而非v代表而非v代表而非v代表而非v代表而非v代表而非v代表而非v代表而非v代表而非v代表而非v代表而非v代表而非v代表而非v代表而非v代表而非v代表而非v代表而非v代表而非v代表而非v代表而非v代表而非v代表而非v代表而非v代表而非v代表而非v代表而非v代表而非v代表而非v代表而非v代表而非v代表而非v代表而非v代表而非v代表而非v代表而非v代表而非v代表而非v代表而非v代表而非v代表而非v代表而非v代表而非v代表而非v代表而非v代表而非v代表而非v代表而非v代表而非v代表而非v代表而非v代表而非v代表而非v代表而非v代表而非v代表而非v代表而非v代表而非v代表而非v代表而非v代表而非v代表而非v代表而非v代表而非v代表而非v代表而非v代表而非v代表而非v代表而非v代表而非v代表而非v代表而非v代表而非v代表而非v代表而非v代表而非v代表而非v代表而非v代表而非v代表而非v代表</p>',1,0,0,'0',0,'0','0','0',10,0,'2016-04-17 01:46:45','2016-04-17 02:24:47'),(2,'标题2 ','<p>不服该办法呢GV热豆腐还不太高和今年投入富家女我我的是女附近的八个人工我可v别沮丧的v比对方不能交电费表肯定是你鄙视吧v那地方就不能hiu二个IE人根据IE如何隔日给举动被GV的人覅偶包过户的人发货不固定不v个is独具不</p>',1,0,0,'0',0,'0','0','0',10,0,'2016-04-19 15:27:53','0000-00-00 00:00:00');
/*!40000 ALTER TABLE `bs_talks_copy备份` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `bs_talks_follow`
--

DROP TABLE IF EXISTS `bs_talks_follow`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `bs_talks_follow` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `talkid` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '话题id',
  `uid` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '登录用户id',
  `created_at` datetime NOT NULL DEFAULT '0000-00-00 00:00:00' COMMENT '创建时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='话题关注表';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `bs_talks_follow`
--

LOCK TABLES `bs_talks_follow` WRITE;
/*!40000 ALTER TABLE `bs_talks_follow` DISABLE KEYS */;
/*!40000 ALTER TABLE `bs_talks_follow` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `bs_talks_report`
--

DROP TABLE IF EXISTS `bs_talks_report`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `bs_talks_report` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `talkid` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '话题id',
  `uid` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '登录用户id',
  `created_at` datetime NOT NULL DEFAULT '0000-00-00 00:00:00' COMMENT '创建时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='话题举报表';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `bs_talks_report`
--

LOCK TABLES `bs_talks_report` WRITE;
/*!40000 ALTER TABLE `bs_talks_report` DISABLE KEYS */;
/*!40000 ALTER TABLE `bs_talks_report` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `bs_talks_share`
--

DROP TABLE IF EXISTS `bs_talks_share`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `bs_talks_share` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `talkid` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '话题id',
  `uid` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '登录用户的id',
  `created_at` datetime NOT NULL DEFAULT '0000-00-00 00:00:00' COMMENT '创建时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='话题分享表';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `bs_talks_share`
--

LOCK TABLES `bs_talks_share` WRITE;
/*!40000 ALTER TABLE `bs_talks_share` DISABLE KEYS */;
/*!40000 ALTER TABLE `bs_talks_share` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `bs_talks_thank`
--

DROP TABLE IF EXISTS `bs_talks_thank`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `bs_talks_thank` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `talkid` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '话题id',
  `uid` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '登录用户id',
  `created_at` datetime NOT NULL DEFAULT '0000-00-00 00:00:00' COMMENT '创建时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='话题感谢表';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `bs_talks_thank`
--

LOCK TABLES `bs_talks_thank` WRITE;
/*!40000 ALTER TABLE `bs_talks_thank` DISABLE KEYS */;
/*!40000 ALTER TABLE `bs_talks_thank` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `bs_theme`
--

DROP TABLE IF EXISTS `bs_theme`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `bs_theme` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL COMMENT '主题名称',
  `intro` varchar(255) NOT NULL COMMENT '内容说明',
  `sort` int(10) unsigned NOT NULL DEFAULT '10' COMMENT '排序字段，值越大越靠前，默认10',
  `isshow` tinyint(3) unsigned NOT NULL DEFAULT '1' COMMENT '前台是否显示：0不显示，1显示',
  `created_at` datetime NOT NULL DEFAULT '0000-00-00 00:00:00' COMMENT '创建时间',
  `updated_at` datetime NOT NULL COMMENT '更新时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='话题主题表';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `bs_theme`
--

LOCK TABLES `bs_theme` WRITE;
/*!40000 ALTER TABLE `bs_theme` DISABLE KEYS */;
/*!40000 ALTER TABLE `bs_theme` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `bs_theme_talk`
--

DROP TABLE IF EXISTS `bs_theme_talk`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `bs_theme_talk` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `talkid` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '话题id',
  `themeid` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '话题主题id',
  `uid` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '收集的用户uid',
  `created_at` datetime NOT NULL DEFAULT '0000-00-00 00:00:00' COMMENT '创建时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='话题主题表';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `bs_theme_talk`
--

LOCK TABLES `bs_theme_talk` WRITE;
/*!40000 ALTER TABLE `bs_theme_talk` DISABLE KEYS */;
/*!40000 ALTER TABLE `bs_theme_talk` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `bs_types`
--

DROP TABLE IF EXISTS `bs_types`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `bs_types` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL COMMENT '类型名称',
  `intro` varchar(500) DEFAULT NULL COMMENT '类型说明',
  `table_id` int(10) unsigned NOT NULL COMMENT '所在表id',
  `table_name` varchar(255) NOT NULL COMMENT '所在表名称',
  `field` varchar(255) NOT NULL COMMENT '字段名',
  `del` tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT '回收站功能：0不放入回收站，1放入回收站',
  `created_at` date NOT NULL DEFAULT '0000-00-00' COMMENT '创建时间',
  `updated_at` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8 COMMENT='类型表';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `bs_types`
--

LOCK TABLES `bs_types` WRITE;
/*!40000 ALTER TABLE `bs_types` DISABLE KEYS */;
INSERT INTO `bs_types` VALUES (1,'header头链接','bs_links网站头部链接',1,'网站链接','type_id',0,'2016-01-13','2016-01-13'),(2,'navigate菜单导航栏链接','bs_links',1,'网站链接','type_id',0,'2016-01-13','0000-00-00'),(3,'footer脚部链接','bs_links',1,'网站链接','type_id',0,'2016-01-13','0000-00-00'),(4,'行业','bs_videos_category视频类型表的类型划分依据',2,'视频类别','type_id',0,'2016-02-16','2016-02-16'),(5,'地区','bs_videos_category视频类别表',2,'视频类别','type_id',0,'2016-02-16','0000-00-00'),(6,'人群','bs_videos_category视频类别表',2,'视频类别','type_id',0,'2016-02-16','0000-00-00'),(7,'行为','bs_videos_category视频类别表',2,'视频类别','type_id',0,'2016-02-16','0000-00-00'),(8,'内容','bs_videos_category视频类别表',2,'视频类别','type_id',0,'2016-02-16','0000-00-00'),(9,'幻灯片','bs_ad_places广告位表\r\n用于前台页面广告展示的位置',3,'广告位','type_id',0,'2016-02-16','0000-00-00'),(10,'图片','bs_ad_places广告位表\r\n前台页面广告展示的位置',3,'广告位','type_id',0,'2016-02-16','0000-00-00'),(11,'悬浮','bs_ad_places广告位表\r\n前台页面广告展示的位置',3,'广告位','type_id',0,'2016-02-16','0000-00-00'),(12,'赞助商','bs_ad_places广告位表\r\n前台页面广告展示的位置',3,'广告位','type_id',0,'2016-02-16','0000-00-00'),(13,'文字','bs_ad_places广告位表\r\n前台页面广告展示的位置',3,'广告位','type_id',0,'2016-02-16','0000-00-00');
/*!40000 ALTER TABLE `bs_types` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `bs_user_level`
--

DROP TABLE IF EXISTS `bs_user_level`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `bs_user_level` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL COMMENT '级别名称',
  `intro` varchar(1000) DEFAULT NULL COMMENT '说明',
  `created_at` date NOT NULL DEFAULT '0000-00-00' COMMENT '创建时间',
  `updated_at` date NOT NULL DEFAULT '0000-00-00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='权限级别表 bs_user_level（用户会员级别）';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `bs_user_level`
--

LOCK TABLES `bs_user_level` WRITE;
/*!40000 ALTER TABLE `bs_user_level` DISABLE KEYS */;
/*!40000 ALTER TABLE `bs_user_level` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `bs_user_voice`
--

DROP TABLE IF EXISTS `bs_user_voice`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `bs_user_voice` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL COMMENT '心声标题',
  `uid` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '用户id',
  `content` varchar(500) NOT NULL COMMENT '心声内容',
  `sort` int(10) unsigned NOT NULL DEFAULT '10' COMMENT '排序字段，值越大越靠前，默认10',
  `isshow` tinyint(3) unsigned NOT NULL DEFAULT '1' COMMENT '在前台页面是否显示：0不显示，1前台列表显示，2前台首页',
  `created_at` date NOT NULL DEFAULT '0000-00-00' COMMENT '创建时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='用户心声表';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `bs_user_voice`
--

LOCK TABLES `bs_user_voice` WRITE;
/*!40000 ALTER TABLE `bs_user_voice` DISABLE KEYS */;
/*!40000 ALTER TABLE `bs_user_voice` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `bs_userlog`
--

DROP TABLE IF EXISTS `bs_userlog`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `bs_userlog` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `plat` tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT '平台标识：1管理员登录，2用户登录',
  `uid` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '用户id',
  `uname` varchar(255) NOT NULL COMMENT '用户名称',
  `serial` varchar(20) NOT NULL COMMENT '序号，唯一标识',
  `loginTime` date NOT NULL DEFAULT '0000-00-00' COMMENT '登陆时间',
  `logoutTime` date NOT NULL DEFAULT '0000-00-00' COMMENT '退出时间',
  `created_at` date NOT NULL DEFAULT '0000-00-00' COMMENT '创建时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8 COMMENT='用户日志表';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `bs_userlog`
--

LOCK TABLES `bs_userlog` WRITE;
/*!40000 ALTER TABLE `bs_userlog` DISABLE KEYS */;
INSERT INTO `bs_userlog` VALUES (1,1,1,'jiuge','201604090047077935','2016-04-09','2016-04-09','2016-04-05'),(2,1,1,'jiuge','20160409004918108','2016-04-09','0000-00-00','2016-04-05'),(3,1,1,'jiuge','201604090437083847','2016-04-09','0000-00-00','2016-04-05'),(4,1,1,'jiuge','201604091015518376','2016-04-09','0000-00-00','2016-04-05'),(5,2,1,'jiuge','201604091059097936','2016-04-09','0000-00-00','2016-04-06'),(6,2,1,'jiuge','201604091412047608','2016-04-09','0000-00-00','2016-04-06'),(7,2,1,'jiuge','201604100215434109','2016-04-10','0000-00-00','2016-04-06'),(8,2,1,'jiuge','201604101055219452','2016-04-10','0000-00-00','2016-04-06'),(9,2,1,'jiuge','20160410132948873','2016-04-10','0000-00-00','2016-04-06'),(10,1,1,'jiuge','201604110108163281','2016-04-11','0000-00-00','2016-04-05'),(11,1,1,'jiuge','201604110902034586','2016-04-11','0000-00-00','2016-04-05'),(12,1,1,'jiuge','201604111319349561','2016-04-11','0000-00-00','2016-04-05'),(13,2,1,'jiuge','201604120033529357','2016-04-12','0000-00-00','2016-04-06'),(14,1,1,'jiuge','201604120034091653','2016-04-12','2016-04-12','2016-04-05'),(15,2,1,'jiuge','201604120037364998','2016-04-12','2016-04-12','2016-04-06'),(16,1,1,'jiuge','201604121543466480','2016-04-12','2016-04-12','2016-04-05'),(17,2,1,'jiuge','201604121623313154','2016-04-12','2016-04-12','2016-04-06'),(18,1,1,'jiuge','201604121631211713','2016-04-12','0000-00-00','2016-04-13'),(19,2,1,'jiuge','201604121634096116','2016-04-12','2016-04-12','2016-04-06'),(20,2,1,'jiuge','201604121637137906','2016-04-12','0000-00-00','2016-04-06');
/*!40000 ALTER TABLE `bs_userlog` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `bs_videos`
--

DROP TABLE IF EXISTS `bs_videos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `bs_videos` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL COMMENT '视频名称',
  `cate_id` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '类型id：关联bs_category',
  `url` varchar(255) NOT NULL COMMENT '视频链接',
  `intro` varchar(500) DEFAULT NULL COMMENT '图片介绍',
  `created_at` date NOT NULL DEFAULT '0000-00-00' COMMENT '创建时间',
  `updated_at` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='视频表（先将视频链接到优酷）';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `bs_videos`
--

LOCK TABLES `bs_videos` WRITE;
/*!40000 ALTER TABLE `bs_videos` DISABLE KEYS */;
/*!40000 ALTER TABLE `bs_videos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `bs_works`
--

DROP TABLE IF EXISTS `bs_works`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `bs_works` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL COMMENT '名称',
  `type` tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT '影片类型：1电视剧，2电影，3微电影，4广告',
  `detail` varchar(255) NOT NULL COMMENT '故事情节',
  `intro` varchar(255) DEFAULT NULL COMMENT '简单介绍',
  `startTime` datetime NOT NULL COMMENT '拍摄时间',
  `showTime` datetime NOT NULL COMMENT '开播时间',
  `created_at` datetime NOT NULL DEFAULT '0000-00-00 00:00:00' COMMENT '创建时间',
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='影视作品表 works';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `bs_works`
--

LOCK TABLES `bs_works` WRITE;
/*!40000 ALTER TABLE `bs_works` DISABLE KEYS */;
/*!40000 ALTER TABLE `bs_works` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `companys`
--

DROP TABLE IF EXISTS `companys`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `companys` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL COMMENT '公司名称',
  `area` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '所在地ID',
  `address` varchar(255) NOT NULL COMMENT '详细地址',
  `yyzzid` varchar(255) NOT NULL COMMENT '营业执照注册码',
  `uid` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '会员id',
  `sort` int(10) unsigned NOT NULL DEFAULT '10' COMMENT '排序字段，值越大越靠前，默认10',
  `created_at` date NOT NULL DEFAULT '0000-00-00' COMMENT '创建时间',
  `updated_at` date NOT NULL DEFAULT '0000-00-00' COMMENT '更新时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='企业表 bs_companys';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `companys`
--

LOCK TABLES `companys` WRITE;
/*!40000 ALTER TABLE `companys` DISABLE KEYS */;
/*!40000 ALTER TABLE `companys` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `persons`
--

DROP TABLE IF EXISTS `persons`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `persons` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `realname` varchar(255) NOT NULL COMMENT '真实名称',
  `sex` tinyint(3) unsigned NOT NULL DEFAULT '1' COMMENT '性别：1男，2女',
  `idcard` char(18) NOT NULL COMMENT '身份证号码，18位',
  `idfront` varchar(255) NOT NULL COMMENT '身份证正面照',
  `uid` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '会员id',
  `created_at` date NOT NULL DEFAULT '0000-00-00' COMMENT '创建时间',
  `updated_at` date NOT NULL DEFAULT '0000-00-00' COMMENT '更新时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COMMENT='个人表 bs_persons';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `persons`
--

LOCK TABLES `persons` WRITE;
/*!40000 ALTER TABLE `persons` DISABLE KEYS */;
INSERT INTO `persons` VALUES (1,'jiuge',1,'123456789012345678','',1,'2016-04-10','0000-00-00'),(2,'jiuge',1,'123456789012345678','',1,'2016-04-10','0000-00-00'),(3,'九哥',1,'123456789012345678','',1,'2016-04-10','0000-00-00'),(4,'九哥',1,'123456789012345678','',1,'2016-04-10','0000-00-00');
/*!40000 ALTER TABLE `persons` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(255) NOT NULL COMMENT '用户名称',
  `password` varchar(255) NOT NULL COMMENT '登陆密码，hash加密',
  `email` varchar(255) NOT NULL COMMENT '邮箱',
  `qq` varchar(255) NOT NULL COMMENT 'qq号码',
  `tel` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '电话',
  `mobile` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '手机号码',
  `area` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '用户所在地区id',
  `address` varchar(255) NOT NULL COMMENT '用户所在具体地址',
  `isauth` tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT '用户认证：0未认证，1认证中 ，2认证失败，2认证成功',
  `emailck` tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT '邮箱认证：0未认证，1认证失败，2认证成功',
  `isuser` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '会员身份：0非会员，1个人消费者，2普通企业，3设计师，4广告公司，5影视公司，6租赁公司',
  `isvip` tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT '是否vip：0非VIP，1是VIP',
  `limit` int(10) unsigned NOT NULL DEFAULT '10' COMMENT '列表每页记录数，默认10条',
  `created_at` date NOT NULL DEFAULT '0000-00-00' COMMENT '创建时间',
  `updated_at` date NOT NULL DEFAULT '0000-00-00' COMMENT '更新时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COMMENT='用户表 bs_users';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'jiuge','$2y$10$Ys0R.RAweFTJYXNTAH.tL.84VE8ZswnjMzJtrMr5P89Wg.4H26He.','jiuge@qq.com','946493655',63929131,4294967295,0,'',3,1,1,0,15,'2016-04-06','0000-00-00');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2016-04-24 11:14:06
