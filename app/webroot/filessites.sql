-- phpMyAdmin SQL Dump
-- version 4.4.6.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jul 28, 2015 at 11:06 AM
-- Server version: 5.5.32-log
-- PHP Version: 5.3.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `compare`
--

-- --------------------------------------------------------

--
-- Table structure for table `sites`
--

CREATE TABLE IF NOT EXISTS `sites` (
  `id` int(11) NOT NULL,
  `merit_site` varchar(128) NOT NULL,
  `demerite_site` varchar(128) NOT NULL,
  `site_image` text NOT NULL,
  `site_name` varchar(24) NOT NULL,
  `site_url_display` varchar(64) NOT NULL,
  `site_url_link` varchar(128) NOT NULL,
  `company_name` varchar(24) NOT NULL,
  `trial_lesson` varchar(24) NOT NULL,
  `admission_fee` varchar(24) NOT NULL,
  `rate_plan` varchar(400) NOT NULL,
  `textbook` varchar(24) NOT NULL,
  `lesson_time` varchar(24) NOT NULL,
  `lowest_price` int(24) NOT NULL,
  `payment_method` varchar(24) NOT NULL,
  `nationality` varchar(48) NOT NULL,
  `group_lesson` text NOT NULL,
  `certified` text NOT NULL,
  `bus_conv_course` text NOT NULL,
  `kisd_course` text NOT NULL,
  `no_teachers` int(24) NOT NULL,
  `smartphone_support` varchar(12) NOT NULL,
  `duty_system` varchar(12) NOT NULL,
  `required_device` varchar(24) NOT NULL,
  `support_system` varchar(24) NOT NULL,
  `likes_no` bigint(20) NOT NULL,
  `dislikes_no` bigint(20) NOT NULL,
  `del_flag` int(1) NOT NULL DEFAULT '1' COMMENT '0 = inactive, 1 = active',
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `sites`
--

INSERT INTO `sites` (`id`, `merit_site`, `demerite_site`, `site_image`, `site_name`, `site_url_display`, `site_url_link`, `company_name`, `trial_lesson`, `admission_fee`, `rate_plan`, `textbook`, `lesson_time`, `lowest_price`, `payment_method`, `nationality`, `group_lesson`, `certified`, `bus_conv_course`, `kisd_course`, `no_teachers`, `smartphone_support`, `duty_system`, `required_device`, `support_system`, `likes_no`, `dislikes_no`, `del_flag`, `created`, `modified`) VALUES
(1, '', '', 'best-teacher1438009230.png', 'ベストティーチャー(Best Teacher)', 'http://www.best-teacher-inc.com/', 'http://www.best-teacher-inc.com/', '', '', '', '', '', '', 0, '', '', '', '', '', '', 0, '', '', '', '', 0, 0, 1, '2015-07-27 18:59:19', '2015-07-28 11:06:19'),
(2, '', '', 'bizmates1438009251.png', 'www.bizmates.jp', 'http://www.bizmates.jp/', 'http://www.bizmates.jp/', '', '', '', '', '', '', 0, 'ã¯ã¬ã¸ããã«ã¼ã', '', '', '', '', '', 0, '', '', '', '', 0, 0, 1, '0000-00-00 00:00:00', '2015-07-28 00:00:51'),
(3, '', '', 'eikaiwa1438009272.png', '', 'http://eikaiwa.dmm.com/', 'http://eikaiwa.dmm.com/', '株式会社DMM.com（コーポレートサイト）', '25分のレッスンが３回受けられます!', '', '', '', 'オフィス＆在宅', 1, '', '', '', '', '', '', 0, '', '', '', '', 0, 0, 1, '2015-07-27 02:59:46', '2015-07-28 00:01:12'),
(4, '', '', 'geos1438009293.png', 'GEOS Online', 'http://geos.jp/', 'http://geos.jp/', 'GEOS ONLINE ENGLISH PHIL', '', '', '1日1回 - 7,980円\n1日2回 - 14,900円\n週1回(4回) - 3,000円\n週2回(8回) - 5,600円\n週3回(12回) - 7,800円\n週4回(16回) - 9,600円\n週5回(20回) - 11,000円\n週6回(24回) - 12,000円\n1回 - 500円\n週1回(4回) - 5,000円\n週2回(8回) - 8,320円\n週3回(12回) - 12,360円\n週4回(16回) - 16,320円\n20回 - 16,600円\n2ヶ月 - 50回\n39,000円 - デイプラン\n6,000円 - 20回\n11,000円 - 【ビジネス初級～中級】\n', 'オリジナルテキスト1冊 2,000円\n', '24時間いつでもレッスン可能', 0, '\n ジオスオンラインではプランによって「PayP', '', '', '', '', '', 0, '', '', '', '', 0, 0, 1, '2015-07-27 02:59:57', '2015-07-28 00:01:33'),
(5, '', '', 'gge1438009316.jpeg', '', 'http://www.gge.co.jp/', 'http://www.gge.co.jp/', '株式会社ぐんぐん', '', '', '', '', '6:00〜25:00', 0, '', '', '', '', '', '', 0, '', '', '', '', 0, 0, 1, '2015-07-27 03:00:09', '2015-07-28 00:01:56'),
(6, '', '', 'default-thumb.gif', '', 'http://www.gge.co.jp/', 'http://www.gge.co.jp/', '株式会社ぐんぐん', '', '', '', '', '6:00〜25:00', 0, '', '', '', '', '', '', 0, '', '', '', '', 0, 0, 1, '2015-07-27 19:00:18', '2015-07-27 19:00:18'),
(7, '', '', 'hanaso1438009337.jpeg', '', 'http://www.hanaso.jp/', 'http://www.hanaso.jp/', '株式会社 アンフープ', '', '', '', '', 'どのプランでも、1回（1コマ）25分、好きな曜日', 0, '', '', '', '', '', '', 0, '', '', '', '', 0, 0, 1, '2015-07-27 03:00:20', '2015-07-28 00:02:17'),
(8, '', '', 'default-thumb.gif', '', 'http://www.hanaso.jp/', 'http://www.hanaso.jp/', '株式会社 アンフープ', '', '', '', '', 'どのプランでも、1回（1コマ）25分、好きな曜日', 0, '', '', '', '', '', '', 0, '', '', '', '', 0, 0, 1, '2015-07-27 03:00:29', '2015-07-27 03:00:29'),
(9, '', '', 'italkenglish1438009362.gif', '', 'http://www.italkenglish.jp/', 'http://www.italkenglish.jp/', '', '', '', '', '642', '', 0, '銀行振り込み・PAYPAL・各種クレジットカード', '', '', '', '', '', 0, '', '', '', '', 0, 0, 1, '2015-07-27 03:00:31', '2015-07-28 00:02:42'),
(10, '', '', 'default-thumb.gif', '', 'http://www.italkenglish.jp/', 'http://www.italkenglish.jp/', '', '', '', '', '642', '', 0, '銀行振り込み・PAYPAL・各種クレジットカード', '', '', '', '', '', 0, '', '', '', '', 0, 0, 1, '2015-07-27 03:00:40', '2015-07-27 03:00:40'),
(11, '', '', 'langrich1438009384.png', '', 'http://langrich.com/', 'http://langrich.com/', '', '', '', '1回25分6,000円\n1回25分10,000円', '', '', 0, '\n\n\n世界最大のオンライン決済サービスPayPa', '', '', '', '', '', 0, '', '', '', '', 0, 0, 1, '2015-07-27 03:00:42', '2015-07-28 00:03:04'),
(12, '', '', 'default-thumb.gif', '', 'http://langrich.com/', 'http://langrich.com/', '', '', '', '1回25分6,000円\n1回25分10,000円', '', '', 0, '\n\n\n世界最大のオンライン決済サービスPayPa', '', '', '', '', '', 0, '', '', '', '', 0, 0, 1, '2015-07-27 03:00:52', '2015-07-27 03:00:52'),
(13, '', '', 'nativecamp1438009542.png', '', 'https://nativecamp.net/', 'https://nativecamp.net/', 'VJソリューションズ株式会社', '', '', '', '', 'レッスン受講可能時間は、日本時間の朝6時～深夜2', 0, 'お支払い方法は、クレジット決済に対応しております', '', '', '', '', '', 0, '', '', '', '', 0, 0, 1, '2015-07-27 03:01:05', '2015-07-28 00:05:42'),
(14, '', '', 'default-thumb.gif', '', 'https://nativecamp.net/', 'https://nativecamp.net/', 'VJソリューションズ株式会社', '', '', '', '', 'レッスン受講可能時間は、日本時間の朝6時～深夜2', 0, 'お支払い方法は、クレジット決済に対応しております', '', '', '', '', '', 0, '', '', '', '', 0, 0, 1, '2015-07-27 03:01:15', '2015-07-27 03:01:15'),
(15, '', '', 'onlineecc1438009406.png', 'ECCオンライン英会話', 'http://online.ecc.co.jp/', 'http://online.ecc.co.jp/', '', '', '', '', '', '', 0, '', '', '', '', '', '', 0, '', '', '', '', 0, 0, 1, '2015-07-27 03:01:17', '2015-07-28 00:03:26'),
(16, '', '', 'default-thumb.gif', 'ECCオンライン英会話', 'http://online.ecc.co.jp/', 'http://online.ecc.co.jp/', '', '', '', '', '', '', 0, '', '', '', '', '', '', 0, '', '', '', '', 0, 0, 1, '2015-07-27 03:01:27', '2015-07-27 03:01:27'),
(17, '', '', 'qqeng1438009427.png', '', 'http://www.qqeng.com/', 'http://www.qqeng.com/', '株式会社キュウ急便', '', '', '', '', '', 0, '', '', '', '', '', '', 0, '', '', '', '', 0, 0, 1, '2015-07-27 03:01:32', '2015-07-28 00:03:47'),
(18, '', '', 'default-thumb.gif', '', 'http://www.qqeng.com/', 'http://www.qqeng.com/', '株式会社キュウ急便', '', '', '', '', '', 0, '', '', '', '', '', '', 0, '', '', '', '', 0, 0, 1, '2015-07-27 03:01:37', '2015-07-27 03:01:37'),
(19, '', '', 'rarejob1438009448.png', '', 'https://www.rarejob.com/', 'https://www.rarejob.com/', '株式会社レアジョブ設立', '', '一切不要', '', '', '6時～25時', 0, '', '', '', '', '', '', 0, '', '', '', '', 0, 0, 1, '2015-07-27 03:01:50', '2015-07-28 00:04:08'),
(20, '', '', 'default-thumb.gif', '', 'https://www.rarejob.com/', 'https://www.rarejob.com/', '株式会社レアジョブ設立', '', '一切不要', '', '', '6時～25時', 0, '', '', '', '', '', '', 0, '', '', '', '', 0, 0, 1, '2015-07-27 03:01:55', '2015-07-27 03:01:55'),
(21, '', '', 'default-thumb.gif', '', 'https://www.rarejob.com/', 'https://www.rarejob.com/', '株式会社レアジョブ設立', '', '一切不要', '', '', '6時～25時', 0, '', '', '', '', '', '', 0, '', '', '', '', 0, 0, 1, '2015-07-27 03:02:04', '2015-07-27 03:02:04'),
(22, '', '', 'venglish1438009485.gif', '', 'http://v-english.jp/', 'http://v-english.jp/', ' NTT Learning Systems Co', '', '無料', 'レギュラープラン\r\n\r\n		（月最大12回）月額定額6,980円（税抜）', '', '', 0, '現在、以下のお支払い方法をご選択いただけます。\r', '', '', '', '', '', 0, '', '', '', '', 0, 0, 1, '2015-07-27 03:02:06', '2015-07-28 00:04:45'),
(23, '', '', 'default-thumb.gif', '', 'http://v-english.jp/', 'http://v-english.jp/', ' NTT Learning Systems Co', '', '無料', 'レギュラープラン\r\n\r\n		（月最大12回）月額定額6,980円（税抜）', '', '', 0, '現在、以下のお支払い方法をご選択いただけます。\r', '', '', '', '', '', 0, '', '', '', '', 0, 0, 1, '2015-07-27 03:02:11', '2015-07-27 03:02:11'),
(24, '', '', 'default-thumb.gif', '', 'http://v-english.jp/', 'http://v-english.jp/', ' NTT Learning Systems Co', '', '無料', 'レギュラープラン\r\n\r\n		（月最大12回）月額定額6,980円（税抜）', '', '', 0, '現在、以下のお支払い方法をご選択いただけます。\r', '', '', '', '', '', 0, '', '', '', '', 0, 0, 1, '2015-07-27 03:02:20', '2015-07-27 03:02:20'),
(25, '', '', 'woman1438009505.png', 'woman-online.co.jp', 'http://woman-online.co.jp/', 'http://woman-online.co.jp/', '', '', '', '', '', '', 0, '', '', '', '', '', '', 0, '', '', '', '', 0, 0, 1, '0000-00-00 00:00:00', '2015-07-28 00:05:05'),
(26, '', '', 'esyaberitai1438009521.jpeg', '', 'http://e-syaberitai.com/', 'http://e-syaberitai.com/', '株式会社CASCATA', '', '', '', '', '', 0, '●PAYPALクレジット決済●ジャパンネットバン', '', '', '', '', '', 0, '', '', '', '', 0, 0, 1, '2015-07-27 03:02:32', '2015-07-28 00:05:21'),
(27, '', '', 'default-thumb.gif', '', 'http://e-syaberitai.com/', 'http://e-syaberitai.com/', '株式会社CASCATA', '', '', '', '', '', 0, '●PAYPALクレジット決済●ジャパンネットバン', '', '', '', '', '', 0, '', '', '', '', 0, 0, 1, '2015-07-27 03:02:42', '2015-07-27 03:02:42');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `sites`
--
ALTER TABLE `sites`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `sites`
--
ALTER TABLE `sites`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=28;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
