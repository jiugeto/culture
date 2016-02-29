-- MySQL dump 10.13  Distrib 5.6.27, for Linux (i686)
--
-- Host: localhost    Database: cul_user
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
-- Table structure for table `companys`
--

DROP TABLE IF EXISTS `companys`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `companys` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL COMMENT '公司名称',
  `type_id` tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT '公司类型：1普通企业，2租赁公司，3经纪公司，4制作公司，5电视台，6电影公司',
  `area` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '所在地ID',
  `address` varchar(255) DEFAULT NULL COMMENT '详细地址',
  `yyzzid` varchar(255) DEFAULT NULL COMMENT '营业执照注册码',
  `isauth` tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT '是否认证：0未认证，1未通过认证，2通过认证',
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
-- Table structure for table `members`
--

DROP TABLE IF EXISTS `members`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `members` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `realname` varchar(255) NOT NULL COMMENT '真实名称',
  `type_id` tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT '个人类型：1普通会员，2设计师会员',
  `sex` tinyint(3) unsigned NOT NULL DEFAULT '1' COMMENT '性别：1男，2女',
  `idcard` char(18) NOT NULL COMMENT '身份证号码，18位',
  `idfront` varchar(255) NOT NULL COMMENT '身份证正面照',
  `isauth` tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT '是否认证：0未认证，1未通过认证，2通过认证',
  `created_at` date NOT NULL DEFAULT '0000-00-00' COMMENT '创建时间',
  `updated_at` date NOT NULL DEFAULT '0000-00-00' COMMENT '更新时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='个人表 bs_members';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `members`
--

LOCK TABLES `members` WRITE;
/*!40000 ALTER TABLE `members` DISABLE KEYS */;
/*!40000 ALTER TABLE `members` ENABLE KEYS */;
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
  `qq` varchar(255) DEFAULT NULL COMMENT 'qq号码',
  `tel` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '电话',
  `mobile` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '手机号码',
  `isauth` tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT '用户认证：0未认证，1待认证，2认证失败，2认证成功',
  `emailck` tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT '邮箱认证：0未认证，1认证失败，2认证成功',
  `mid` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '会员id，关联bs_members：0代表未认证',
  `cid` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '企业id，关联bs_companys：0代表未认证',
  `created_at` date NOT NULL DEFAULT '0000-00-00' COMMENT '创建时间',
  `updated_at` date NOT NULL DEFAULT '0000-00-00' COMMENT '更新时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='用户表 bs_users';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
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

-- Dump completed on 2016-02-29 16:42:51
