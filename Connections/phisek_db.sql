-- phpMyAdmin SQL Dump
-- version 2.10.3
-- http://www.phpmyadmin.net
-- 
-- โฮสต์: localhost
-- เวลาในการสร้าง: 
-- รุ่นของเซิร์ฟเวอร์: 5.0.51
-- รุ่นของ PHP: 5.2.6

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";

-- 
-- ฐานข้อมูล: `phisek_db`
-- 

-- --------------------------------------------------------

-- 
-- โครงสร้างตาราง `admin_system`
-- 

CREATE TABLE `admin_system` (
  `id` int(4) NOT NULL auto_increment,
  `user_name` varchar(30) NOT NULL,
  `user_pass` varchar(30) NOT NULL,
  `myname` varchar(15) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

-- 
-- dump ตาราง `admin_system`
-- 

INSERT INTO `admin_system` VALUES (1, 'adminsystem', 'phisek', 'boss');

-- --------------------------------------------------------

-- 
-- โครงสร้างตาราง `number_register`
-- 

CREATE TABLE `number_register` (
  `id_register` mediumint(4) NOT NULL auto_increment,
  `user_register` varchar(15) NOT NULL,
  `pass_register` varchar(15) NOT NULL,
  `email_register` varchar(50) NOT NULL,
  `name_register` varchar(30) NOT NULL,
  `lass_register` varchar(30) NOT NULL,
  `add_register` longtext NOT NULL,
  `tel_register` varchar(10) NOT NULL,
  PRIMARY KEY  (`id_register`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

-- 
-- dump ตาราง `number_register`
-- 

INSERT INTO `number_register` VALUES (1, 'test', '1234', 'phisek@gmail.com', 'ภิเษก', 'ปิ่นเปีย', '248 หมู่ 1 ต.วิหารแดง อ.วิหารแดง จ.สระบุรี', '0892423187');
INSERT INTO `number_register` VALUES (2, 'abc', '1234', 'phisek@gmail.com', 'คมสัน', 'พิมสา', '12/2 ต.หินกอง อ.หนองแค จ.สระบุรี', '0892423187');
