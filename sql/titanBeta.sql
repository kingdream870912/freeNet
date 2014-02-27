-- phpMyAdmin SQL Dump
-- version 4.1.4
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: 2014-02-27 16:34:32
-- 服务器版本： 5.5.34-0ubuntu0.12.04.1
-- PHP Version: 5.3.10-1ubuntu3.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `titanBeta`
--

-- --------------------------------------------------------

--
-- 表的结构 `ts_config`
--

CREATE TABLE IF NOT EXISTS `ts_config` (
  `id` int(3) NOT NULL AUTO_INCREMENT,
  `pid` int(3) NOT NULL,
  `code` varchar(32) NOT NULL,
  `value` varchar(32) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `pid` (`pid`,`code`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf16 AUTO_INCREMENT=2 ;

--
-- 转存表中的数据 `ts_config`
--

INSERT INTO `ts_config` (`id`, `pid`, `code`, `value`) VALUES
(1, 1, 'debugMode', '1');

-- --------------------------------------------------------

--
-- 表的结构 `ts_server_config`
--

CREATE TABLE IF NOT EXISTS `ts_server_config` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `sid` int(3) NOT NULL,
  `tokenKey` varchar(32) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf16 AUTO_INCREMENT=2 ;

--
-- 转存表中的数据 `ts_server_config`
--

INSERT INTO `ts_server_config` (`id`, `sid`, `tokenKey`) VALUES
(1, 1, 'fdfdsfdsfdsfdsa');

-- --------------------------------------------------------

--
-- 表的结构 `ts_user_s1`
--

CREATE TABLE IF NOT EXISTS `ts_user_s1` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `accountName` varchar(32) CHARACTER SET utf16 NOT NULL COMMENT '帐号信息',
  `regTime` int(11) NOT NULL COMMENT '注册时间',
  `lastLoginTime` int(11) NOT NULL COMMENT '最后登录时间',
  `nickName` varchar(32) CHARACTER SET utf16 NOT NULL COMMENT '昵称',
  `loginIp` varchar(32) CHARACTER SET utf16 NOT NULL,
  `loginStatus` int(3) NOT NULL,
  `channel` int(3) NOT NULL COMMENT '平台编码',
  PRIMARY KEY (`id`),
  KEY `accountName` (`accountName`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- 转存表中的数据 `ts_user_s1`
--

INSERT INTO `ts_user_s1` (`id`, `accountName`, `regTime`, `lastLoginTime`, `nickName`, `loginIp`, `loginStatus`, `channel`) VALUES
(1, '1da31c1027a398a5b341dc2ee552bebe', 1393403419, 1393403419, 'ee', '127.0.0.1', 1, 0),
(2, '19d5c4577b9f5a078c9eb95839ae36be', 1393410674, 1393410674, 'eeee', '127.0.0.1', 1, 0);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
