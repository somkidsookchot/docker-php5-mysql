-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 13, 2019 at 03:55 AM
-- Server version: 10.1.28-MariaDB
-- PHP Version: 7.1.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cremation`
--

-- --------------------------------------------------------

--
-- Table structure for table `administrator`
--

CREATE TABLE `administrator` (
  `member_id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL DEFAULT '',
  `password` varchar(200) NOT NULL DEFAULT '',
  `name` varchar(200) NOT NULL DEFAULT '',
  `lastlogin` datetime NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `administrator`
--

INSERT INTO `administrator` (`member_id`, `username`, `password`, `name`, `lastlogin`) VALUES
(1, 'admin', '123', 'admin', '2012-10-10 08:05:09');

-- --------------------------------------------------------

--
-- Table structure for table `expensescategory`
--

CREATE TABLE `expensescategory` (
  `exp_cat_id` int(11) NOT NULL,
  `exp_cat_title` varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `expenseslist`
--

CREATE TABLE `expenseslist` (
  `exp_id` int(11) NOT NULL,
  `exp_cat` int(11) NOT NULL,
  `exp_detail` varchar(300) NOT NULL,
  `exp_total` float NOT NULL,
  `exp_date` date NOT NULL,
  `exp_dispencer` varchar(100) NOT NULL,
  `exp_slipt_num` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `expresspayment`
--

CREATE TABLE `expresspayment` (
  `expr_id` int(11) NOT NULL,
  `t_code` varchar(11) NOT NULL,
  `village_id` int(11) NOT NULL,
  `subv_total` float NOT NULL DEFAULT '0',
  `subv_detail` varchar(100) DEFAULT NULL,
  `adv_total` float NOT NULL DEFAULT '0',
  `adv_detail` varchar(100) DEFAULT NULL,
  `rc_total` float DEFAULT '0',
  `rc_detail` varchar(100) DEFAULT NULL,
  `annual_total` float NOT NULL DEFAULT '0',
  `annual_detail` varchar(100) DEFAULT NULL,
  `regis_total` float NOT NULL DEFAULT '0',
  `regis_detail` varchar(100) DEFAULT NULL,
  `other_total` float NOT NULL DEFAULT '0',
  `other_detail` varchar(100) DEFAULT NULL,
  `expr_total` float NOT NULL DEFAULT '0',
  `expr_pay_date` date NOT NULL,
  `expr_note` varchar(256) DEFAULT NULL,
  `expr_slipt_num` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `gender`
--

CREATE TABLE `gender` (
  `gender_id` int(11) NOT NULL,
  `g_title` varchar(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `gender`
--

INSERT INTO `gender` (`gender_id`, `g_title`) VALUES
(1, 'ชาย'),
(2, 'หญิง');

-- --------------------------------------------------------

--
-- Table structure for table `members`
--

CREATE TABLE `members` (
  `member_id` int(11) NOT NULL,
  `member_type` int(11) DEFAULT NULL,
  `member_code` varchar(50) NOT NULL,
  `id_code` varchar(13) NOT NULL,
  `gender` varchar(5) NOT NULL,
  `prefix` varchar(10) NOT NULL,
  `fname` varchar(45) NOT NULL,
  `lname` varchar(45) NOT NULL,
  `birthdate` date DEFAULT NULL,
  `age` int(11) NOT NULL,
  `email` varchar(45) DEFAULT NULL,
  `phone` varchar(45) DEFAULT NULL,
  `address` varchar(10) DEFAULT NULL,
  `t_code` varchar(10) NOT NULL,
  `village_id` int(11) NOT NULL,
  `suffix` varchar(3) DEFAULT NULL,
  `bnfc1_name` varchar(45) DEFAULT NULL,
  `bnfc1_rel` varchar(45) DEFAULT NULL,
  `bnfc2_name` varchar(45) DEFAULT NULL,
  `bnfc2_rel` varchar(45) DEFAULT NULL,
  `bnfc3_name` varchar(45) DEFAULT NULL,
  `bnfc3_rel` varchar(45) DEFAULT NULL,
  `bnfc4_name` varchar(45) DEFAULT NULL,
  `bnfc4_rel` varchar(45) DEFAULT NULL,
  `attachment` varchar(10) DEFAULT NULL,
  `regis_date` date DEFAULT NULL,
  `effective_date` date NOT NULL,
  `resign_date` date DEFAULT NULL,
  `dead_date` date DEFAULT NULL,
  `terminate_date` date DEFAULT NULL,
  `member_status` varchar(10) DEFAULT 'ปกติ',
  `advance_budget` float DEFAULT '0',
  `dead_id` int(11) DEFAULT '0',
  `note` varchar(256) DEFAULT NULL,
  `update_detail` varchar(500) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `memberstatus`
--

CREATE TABLE `memberstatus` (
  `s_id` int(11) NOT NULL,
  `s_title` varchar(20) NOT NULL,
  `s_des` varchar(256) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `memberstatus`
--

INSERT INTO `memberstatus` (`s_id`, `s_title`, `s_des`) VALUES
(1, 'ปกติ', ''),
(2, 'เสียชีวิต', ''),
(3, 'ลาออก', ''),
(4, 'พ้นสภาพ', '');

-- --------------------------------------------------------

--
-- Table structure for table `memberupdatelog`
--

CREATE TABLE `memberupdatelog` (
  `mu_id` int(11) NOT NULL,
  `member_code` varchar(30) NOT NULL,
  `update_detail` varchar(500) NOT NULL,
  `update_date` datetime NOT NULL,
  `author` varchar(30) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `paymentsummary`
--

CREATE TABLE `paymentsummary` (
  `pay_sum_id` int(11) NOT NULL,
  `t_code` varchar(11) NOT NULL,
  `village_id` int(11) NOT NULL,
  `member_code` varchar(20) DEFAULT NULL,
  `pay_sum_type` int(11) DEFAULT NULL,
  `pay_death_begin` int(11) DEFAULT NULL,
  `pay_death_end` int(11) DEFAULT NULL,
  `pay_annual_year` varchar(4) DEFAULT NULL,
  `pay_sum_date` date DEFAULT NULL,
  `pay_sum_total` float DEFAULT '0',
  `pay_sum_detail` varchar(100) DEFAULT NULL,
  `pay_sum_adv_num` int(11) NOT NULL,
  `pay_sum_adv_count` int(11) DEFAULT NULL,
  `pay_sum_note` varchar(256) DEFAULT NULL,
  `flag` int(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `paymenttype`
--

CREATE TABLE `paymenttype` (
  `pt_id` int(11) NOT NULL,
  `pt_title` varchar(100) NOT NULL,
  `pt_des` varchar(100) CHARACTER SET utf8mb4 NOT NULL,
  `pt_order` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `paymenttype`
--

INSERT INTO `paymenttype` (`pt_id`, `pt_title`, `pt_des`, `pt_order`) VALUES
(1, 'ค่าสงเคราะห์ศพ', '', 1),
(2, 'ค่าสงเคราะห์ศพล่วงหน้า', '', 2),
(3, 'ค่าบำรุงประจำปี', '', 4),
(4, 'ค่าสมัครสมาชิก', '', 5),
(5, 'อื่นๆ', '', 6),
(6, 'ค่าสงเคราะห์ย้อนหลัง', '-', 3);

-- --------------------------------------------------------

--
-- Table structure for table `permission`
--

CREATE TABLE `permission` (
  `permission_id` int(11) NOT NULL,
  `member_id` int(11) NOT NULL,
  `admin` int(11) DEFAULT '0',
  `upload` int(11) DEFAULT '0',
  `download` int(11) DEFAULT '0',
  `readonly` int(11) DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `permission`
--

INSERT INTO `permission` (`permission_id`, `member_id`, `admin`, `upload`, `download`, `readonly`) VALUES
(1, 1, 1, 1, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `prefix`
--

CREATE TABLE `prefix` (
  `prefix_id` int(11) NOT NULL,
  `p_title` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `prefix`
--

INSERT INTO `prefix` (`prefix_id`, `p_title`) VALUES
(1, 'นาย'),
(2, 'นาง'),
(3, 'นางสาว');

-- --------------------------------------------------------

--
-- Table structure for table `refundable`
--

CREATE TABLE `refundable` (
  `refund_id` int(11) NOT NULL,
  `member_code` varchar(100) NOT NULL,
  `refund_total` float NOT NULL,
  `assc_percent` int(11) NOT NULL,
  `assc_total` float NOT NULL,
  `refund_status` varchar(20) NOT NULL DEFAULT 'รอจ่าย',
  `refund_slipt_num` int(11) NOT NULL,
  `calculate_date` date NOT NULL,
  `sub_total` float NOT NULL,
  `pay_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `setting`
--

CREATE TABLE `setting` (
  `setting_id` int(11) NOT NULL,
  `regis_rate` float DEFAULT '0',
  `annual_rate` float DEFAULT '0',
  `subvention_rate` float DEFAULT '0',
  `max_subvention` int(11) NOT NULL,
  `rc_rate` int(11) NOT NULL,
  `assc_percent` int(11) DEFAULT '0',
  `max_age` int(11) DEFAULT '0',
  `chairman_name` varchar(100) DEFAULT NULL,
  `min_advance_subv` int(11) DEFAULT NULL,
  `max_advance_subv` int(11) DEFAULT '0',
  `quoted_advance_subv` float NOT NULL DEFAULT '0',
  `notice_duedate` int(11) DEFAULT '15',
  `invoice_duedate` int(11) DEFAULT '15',
  `annual_fee_duedate` date NOT NULL,
  `logo` varchar(100) DEFAULT NULL,
  `chairman_signature` varchar(100) DEFAULT NULL,
  `receiver_name` varchar(100) DEFAULT NULL,
  `receiver_signature` varchar(100) DEFAULT NULL,
  `contact_info` varchar(256) DEFAULT NULL,
  `export_path` varchar(100) NOT NULL,
  `export_date` int(11) NOT NULL,
  `last_export` date NOT NULL,
  `start_date` date NOT NULL,
  `old_member` int(11) NOT NULL DEFAULT '0',
  `new_member` int(11) NOT NULL DEFAULT '0',
  `dead_member` int(11) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `setting`
--

INSERT INTO `setting` (`setting_id`, `regis_rate`, `annual_rate`, `subvention_rate`, `max_subvention`, `rc_rate`, `assc_percent`, `max_age`, `chairman_name`, `min_advance_subv`, `max_advance_subv`, `quoted_advance_subv`, `notice_duedate`, `invoice_duedate`, `annual_fee_duedate`, `logo`, `chairman_signature`, `receiver_name`, `receiver_signature`, `contact_info`, `export_path`, `export_date`, `last_export`, `start_date`, `old_member`, `new_member`, `dead_member`) VALUES
(1, 100, 20, 10, 29600, 10, 5, 60, 'นายอัครเดช    คัมภีระมนต์', 100, 250, 50000, 15, 30, '2012-11-29', 'logo.png', 'chairman_signature.png', 'นายสมชาย นามสมมุติ', 'chairman_signature.png', 'งานธุรการ โทร. 08-4370-3484', 'D:\\backup', 15, '2012-12-12', '2011-11-04', 2391, 569, 1);

-- --------------------------------------------------------

--
-- Table structure for table `sliptnumber`
--

CREATE TABLE `sliptnumber` (
  `slipt_id` int(11) NOT NULL,
  `number` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `sliptnumber`
--

INSERT INTO `sliptnumber` (`slipt_id`, `number`) VALUES
(1, 0),
(2, 0),
(3, 0);

-- --------------------------------------------------------

--
-- Table structure for table `subvcalculate`
--

CREATE TABLE `subvcalculate` (
  `svc_id` int(11) NOT NULL,
  `t_code` varchar(11) NOT NULL,
  `village_id` int(11) NOT NULL,
  `member_code` varchar(20) NOT NULL,
  `cal_type` int(11) NOT NULL,
  `cal_detail` varchar(256) DEFAULT NULL,
  `adv_num` int(11) NOT NULL,
  `cal_date` date NOT NULL,
  `count_member` int(11) NOT NULL,
  `all_member` int(11) NOT NULL,
  `unit_rate` float NOT NULL,
  `total` float NOT NULL,
  `cal_status` varchar(100) NOT NULL,
  `invoice_senddate` date NOT NULL,
  `invoice_duedate` date NOT NULL,
  `notice_senddate` date NOT NULL,
  `notice_duedate` date NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `subvcharge`
--

CREATE TABLE `subvcharge` (
  `subvc_id` int(11) NOT NULL,
  `member_code` varchar(100) NOT NULL,
  `all_member` int(11) NOT NULL,
  `subv_rate` float NOT NULL,
  `subvc_total` float NOT NULL,
  `assc_percent` int(11) NOT NULL,
  `assc_total` float NOT NULL,
  `bnfc_total` float NOT NULL,
  `dead_count` int(11) NOT NULL,
  `resign_count` int(11) NOT NULL,
  `terminate_count` int(11) NOT NULL,
  `alive_count` int(11) NOT NULL,
  `can_pay_count` int(11) NOT NULL,
  `cant_pay_count` int(11) NOT NULL,
  `cant_pay_detail` varchar(256) NOT NULL,
  `canculate_date` date NOT NULL,
  `subvc_status` varchar(50) NOT NULL DEFAULT 'รอจ่าย',
  `subvc_date` date NOT NULL,
  `subvc_slipt_num` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `subventionpayment`
--

CREATE TABLE `subventionpayment` (
  `payment_id` int(11) NOT NULL,
  `dead_id` int(11) DEFAULT NULL,
  `payment_date` datetime DEFAULT NULL,
  `subvent_total` float DEFAULT '0',
  `payee` varchar(45) DEFAULT NULL,
  `pay_des` varchar(256) DEFAULT NULL,
  `donate_total` float NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tambon`
--

CREATE TABLE `tambon` (
  `t_id` int(11) NOT NULL,
  `t_code` varchar(256) NOT NULL,
  `t_title` varchar(45) DEFAULT NULL,
  `t_order` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tambon`
--

INSERT INTO `tambon` (`t_id`, `t_code`, `t_title`, `t_order`) VALUES
(1, '04', 'ลี้', 1),
(2, '02', 'แม่ตืน', 2),
(3, '05', 'นาทราย', 3),
(4, '06', 'ดงดำ', 4),
(5, '08', 'ก้อ', 5),
(6, '07', 'แม่ลาน', 6),
(7, '03', 'ป่าไผ่', 7),
(8, '01', 'ศรีวิชัย', 8);

-- --------------------------------------------------------

--
-- Table structure for table `unpaylist`
--

CREATE TABLE `unpaylist` (
  `unpay_id` int(11) NOT NULL,
  `svc_id` int(11) NOT NULL,
  `un_member_id` int(11) NOT NULL,
  `un_pay_type` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `userlevelpermissions`
--

CREATE TABLE `userlevelpermissions` (
  `userlevelid` int(11) NOT NULL,
  `tablename` varchar(80) NOT NULL,
  `permission` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `userlevels`
--

CREATE TABLE `userlevels` (
  `userlevelid` int(11) NOT NULL,
  `userlevelname` varchar(80) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `userlevels`
--

INSERT INTO `userlevels` (`userlevelid`, `userlevelname`) VALUES
(-1, 'Administrator'),
(0, 'Default');

-- --------------------------------------------------------

--
-- Table structure for table `village`
--

CREATE TABLE `village` (
  `village_id` int(11) NOT NULL,
  `v_code` int(11) NOT NULL,
  `v_title` varchar(100) NOT NULL,
  `t_code` varchar(20) NOT NULL,
  `flag` int(1) NOT NULL DEFAULT '2'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `village`
--

INSERT INTO `village` (`village_id`, `v_code`, `v_title`, `t_code`, `flag`) VALUES
(1, 1, 'บ้านแวนนาริน', '04', 2),
(2, 2, 'บ้านนากลาง', '04', 2),
(3, 3, 'บ้านปู', '04', 2),
(4, 2, 'บ้านไร่', '02', 2),
(5, 13, 'บ้านแพะพหนองห้า', '04', 2),
(6, 6, 'บ้านลี้', '04', 2),
(7, 16, 'บ้านใหม่น้ำผึ้ง', '04', 2),
(8, 10, 'บ้านกลาง', '04', 2),
(9, 12, 'บ้านใหม่ศรีวิไล', '04', 2),
(10, 15, 'บ้านพระธาตุห้าดวง', '04', 2),
(11, 4, 'บ้านวังดิน', '04', 2),
(12, 8, 'บ้านม่วงสามปี', '04', 2),
(13, 9, 'บ้านปวงคำ', '04', 2),
(14, 5, 'บ้านฮ่อมต้อ', '04', 2),
(15, 11, 'บ้านโฮ่ง', '04', 2),
(16, 7, 'บ้านป่าหก', '04', 2),
(17, 4, 'บ้านแม่กองวะ', '07', 2),
(18, 5, 'บ้านเด่นเหม้า', '07', 2),
(19, 6, 'บ้านผาต้ายเหนือ', '07', 2),
(20, 3, 'บ้านแม่ลาน', '07', 2),
(21, 1, 'บ้านผาต้าย', '07', 2),
(22, 2, 'บ้านหนองมะล้อ', '07', 2),
(23, 1, 'บ้านก้อทุ่ง', '08', 2),
(24, 2, 'บ้านก้อหนอง', '08', 2),
(25, 3, 'บ้านก้อจอก', '08', 2),
(26, 4, 'บ้านก้อท่า', '08', 2),
(27, 2, 'บ้านดงดำ', '06', 2),
(28, 3, 'บ้านบวก', '06', 2),
(29, 1, 'บ้านป่าคา', '06', 2),
(30, 5, 'บ้านปางส้าน', '06', 2),
(31, 6, 'บ้านแม่ลอง', '06', 2),
(32, 4, 'บ้านห้วยหญ้าไซ', '06', 2),
(33, 17, 'บ้านผายอง', '04', 2),
(34, 16, 'บ้านนามน', '05', 2),
(35, 1, 'บ้านนาเลี่ยง', '05', 2),
(36, 17, 'บ้านแม่หละ', '05', 2),
(37, 5, 'บ้านแม่หว่างบน', '05', 2),
(38, 15, 'บ้านผาลาดเหนือ', '05', 2),
(39, 6, 'บ้านฮั่ว', '05', 2),
(40, 20, 'บ้านนาทรายสามหลัง', '05', 2),
(41, 7, 'บ้านแม่หว่างลุ่ม', '05', 2),
(42, 3, 'บ้านผาลาด', '05', 2),
(43, 2, 'บ้านแม่หว่างพัฒนา', '05', 2),
(44, 4, 'บ้านนาทราย', '05', 2),
(45, 8, 'บ้านพระบาทห้วยต้ม', '05', 2),
(46, 9, 'บ้านหนองปู', '05', 2),
(47, 10, 'บ้านแม่หว่างห้วยริน', '05', 2),
(48, 11, 'บ้านหนองบอน', '05', 2),
(49, 12, 'บ้านเด่นยางมูล', '05', 2),
(50, 13, 'บ้านหนองนา', '05', 2),
(51, 14, 'บ้านเด่นทรายมูล', '05', 2),
(52, 18, 'บ้านหนองเกี๋ยง', '05', 2),
(53, 19, 'บ้านแพะเจริญ', '05', 2),
(57, 4, 'บ้านหล่ายท่า', '03', 2),
(55, 21, 'บ้านศรีเวียงชัย', '05', 2),
(58, 6, 'บ้านดงสักงาม', '03', 2),
(59, 12, 'บ้านผาหนาม', '03', 2),
(60, 11, 'บ้านวังน้ำลี้', '03', 2),
(61, 8, 'บ้านจัดสรรคอกช้าง', '03', 2),
(62, 5, 'บ้านชีวิตใหม่', '03', 2),
(63, 3, 'บ้านป่าจี้', '03', 2),
(64, 1, 'บ้านป่าไผ่', '03', 2),
(65, 2, 'บ้านห้วยแหน', '03', 2),
(66, 9, 'บ้านห้วยแหนพัฒนา', '03', 2),
(67, 7, 'บ้านห้วยน้ำเย็น', '03', 2),
(68, 10, 'บ้านน้ำดิบชมภู', '03', 2),
(69, 1, 'บ้านวงศ์ษาพัฒนา', '02', 2),
(70, 3, 'บ้านแม่ตืน', '02', 2),
(71, 4, 'บ้านวังมน', '02', 2),
(72, 5, 'บ้านสันป่าสัก', '02', 2),
(73, 6, 'บ้านแม่เทย', '02', 2),
(74, 7, 'บ้านห้วยศาลา', '02', 2),
(75, 9, 'บ้านสันวิไล', '02', 2),
(76, 10, 'บ้านหนองบัวคำ', '02', 2),
(77, 14, 'บ้านแม่เทยพัฒนา', '02', 2),
(78, 12, 'บ้านห้วยเรือแม่เอิบ', '02', 2),
(79, 13, 'บ้านแม่เทยสามัคคี', '02', 2),
(80, 15, 'บ้านสว่างวงค์พัฒนา', '02', 2),
(81, 16, 'บ้านเด่นสวรรค์', '02', 2),
(82, 17, 'บ้านสันวิไลพัฒนา', '02', 2),
(83, 11, 'บ้านห้วยโป่งสามัคคี', '02', 2),
(84, 7, 'บ้านห้วยทรายขาว', '07', 2),
(85, 7, 'บ้านแม่จ๋อง', '01', 2),
(86, 2, 'บ้านแม่อีไฮ', '01', 2),
(87, 3, 'บ้านห้วยบง', '01', 2),
(88, 5, 'บ้านแม่ป๊อกเหนือ', '01', 2),
(89, 6, 'บ้านแม่ป๊อก', '01', 2),
(90, 8, 'บ้านใหม่สุขสันต์', '01', 2),
(91, 9, 'บ้านศรีบุญเรือง', '01', 2),
(92, 10, 'บ้านศรีวิชัย', '01', 2),
(93, 11, 'บ้านใหม่สวรรค์', '01', 2),
(94, 12, 'บ้านอุดมพัฒนา', '01', 2),
(95, 13, 'บ้านบารมีศรีวิชัย', '01', 2),
(96, 4, 'บ้านแม่ป๊อกใน', '01', 2),
(97, 1, 'บ้านปาง', '01', 2),
(98, 8, 'บ้านแม่แนต', '02', 2),
(99, 22, 'บ้านชัยวงษา', '05', 2),
(100, 23, 'บ้านพระบาทพัฒนา', '05', 2),
(101, 14, 'วังดินใหม่', '04', 2);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `expensescategory`
--
ALTER TABLE `expensescategory`
  ADD PRIMARY KEY (`exp_cat_id`);

--
-- Indexes for table `expenseslist`
--
ALTER TABLE `expenseslist`
  ADD PRIMARY KEY (`exp_id`),
  ADD KEY `exp_cat` (`exp_cat`);

--
-- Indexes for table `expresspayment`
--
ALTER TABLE `expresspayment`
  ADD PRIMARY KEY (`expr_id`);

--
-- Indexes for table `gender`
--
ALTER TABLE `gender`
  ADD PRIMARY KEY (`gender_id`);

--
-- Indexes for table `members`
--
ALTER TABLE `members`
  ADD PRIMARY KEY (`member_id`),
  ADD UNIQUE KEY `member_code` (`member_code`),
  ADD KEY `member_code_2` (`member_code`),
  ADD KEY `member_id` (`member_id`);

--
-- Indexes for table `memberstatus`
--
ALTER TABLE `memberstatus`
  ADD PRIMARY KEY (`s_id`);

--
-- Indexes for table `memberupdatelog`
--
ALTER TABLE `memberupdatelog`
  ADD PRIMARY KEY (`mu_id`),
  ADD KEY `member_id` (`member_code`);

--
-- Indexes for table `paymentsummary`
--
ALTER TABLE `paymentsummary`
  ADD PRIMARY KEY (`pay_sum_id`),
  ADD KEY `pay_sum_id` (`pay_sum_id`),
  ADD KEY `member_code` (`member_code`);

--
-- Indexes for table `paymenttype`
--
ALTER TABLE `paymenttype`
  ADD PRIMARY KEY (`pt_id`);

--
-- Indexes for table `permission`
--
ALTER TABLE `permission`
  ADD PRIMARY KEY (`permission_id`,`member_id`);

--
-- Indexes for table `prefix`
--
ALTER TABLE `prefix`
  ADD PRIMARY KEY (`prefix_id`);

--
-- Indexes for table `refundable`
--
ALTER TABLE `refundable`
  ADD PRIMARY KEY (`refund_id`);

--
-- Indexes for table `setting`
--
ALTER TABLE `setting`
  ADD PRIMARY KEY (`setting_id`);

--
-- Indexes for table `sliptnumber`
--
ALTER TABLE `sliptnumber`
  ADD PRIMARY KEY (`slipt_id`);

--
-- Indexes for table `subvcalculate`
--
ALTER TABLE `subvcalculate`
  ADD PRIMARY KEY (`svc_id`),
  ADD KEY `svc_id` (`svc_id`),
  ADD KEY `member_code` (`member_code`);

--
-- Indexes for table `subvcharge`
--
ALTER TABLE `subvcharge`
  ADD PRIMARY KEY (`subvc_id`),
  ADD KEY `subvc_id` (`subvc_id`,`member_code`),
  ADD KEY `member_code` (`member_code`),
  ADD KEY `member_code_2` (`member_code`),
  ADD KEY `member_code_3` (`member_code`);

--
-- Indexes for table `subventionpayment`
--
ALTER TABLE `subventionpayment`
  ADD PRIMARY KEY (`payment_id`);

--
-- Indexes for table `tambon`
--
ALTER TABLE `tambon`
  ADD PRIMARY KEY (`t_id`);

--
-- Indexes for table `unpaylist`
--
ALTER TABLE `unpaylist`
  ADD PRIMARY KEY (`unpay_id`),
  ADD KEY `svc_id` (`svc_id`),
  ADD KEY `svc_id_2` (`svc_id`),
  ADD KEY `unpay_id` (`unpay_id`);

--
-- Indexes for table `userlevelpermissions`
--
ALTER TABLE `userlevelpermissions`
  ADD PRIMARY KEY (`userlevelid`,`tablename`);

--
-- Indexes for table `userlevels`
--
ALTER TABLE `userlevels`
  ADD PRIMARY KEY (`userlevelid`);

--
-- Indexes for table `village`
--
ALTER TABLE `village`
  ADD PRIMARY KEY (`village_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `expensescategory`
--
ALTER TABLE `expensescategory`
  MODIFY `exp_cat_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `expenseslist`
--
ALTER TABLE `expenseslist`
  MODIFY `exp_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `expresspayment`
--
ALTER TABLE `expresspayment`
  MODIFY `expr_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `gender`
--
ALTER TABLE `gender`
  MODIFY `gender_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `members`
--
ALTER TABLE `members`
  MODIFY `member_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `memberstatus`
--
ALTER TABLE `memberstatus`
  MODIFY `s_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `memberupdatelog`
--
ALTER TABLE `memberupdatelog`
  MODIFY `mu_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `paymentsummary`
--
ALTER TABLE `paymentsummary`
  MODIFY `pay_sum_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `paymenttype`
--
ALTER TABLE `paymenttype`
  MODIFY `pt_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `permission`
--
ALTER TABLE `permission`
  MODIFY `permission_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `prefix`
--
ALTER TABLE `prefix`
  MODIFY `prefix_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `refundable`
--
ALTER TABLE `refundable`
  MODIFY `refund_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `setting`
--
ALTER TABLE `setting`
  MODIFY `setting_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `sliptnumber`
--
ALTER TABLE `sliptnumber`
  MODIFY `slipt_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `subvcalculate`
--
ALTER TABLE `subvcalculate`
  MODIFY `svc_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `subvcharge`
--
ALTER TABLE `subvcharge`
  MODIFY `subvc_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `subventionpayment`
--
ALTER TABLE `subventionpayment`
  MODIFY `payment_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tambon`
--
ALTER TABLE `tambon`
  MODIFY `t_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `unpaylist`
--
ALTER TABLE `unpaylist`
  MODIFY `unpay_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `village`
--
ALTER TABLE `village`
  MODIFY `village_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=102;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
