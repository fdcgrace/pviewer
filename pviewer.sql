-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Sep 22, 2015 at 11:54 AM
-- Server version: 5.6.17
-- PHP Version: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `pviewer`
--

-- --------------------------------------------------------

--
-- Table structure for table `bug_infos`
--

CREATE TABLE IF NOT EXISTS `bug_infos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `issue_id` varchar(3) NOT NULL,
  `bug_description` varchar(250) NOT NULL,
  `bug_steps` varchar(200) NOT NULL,
  `bug_status` varchar(200) NOT NULL,
  `status_after` varchar(200) NOT NULL,
  `who_found` varchar(200) NOT NULL,
  `bug_reason` varchar(200) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=29 ;

-- --------------------------------------------------------

--
-- Table structure for table `issue_specs`
--

CREATE TABLE IF NOT EXISTS `issue_specs` (
  `id` int(11) NOT NULL,
  `issue_id` varchar(3) NOT NULL,
  `specs_id` varchar(3) NOT NULL,
  `file` varchar(100) NOT NULL,
  `type` varchar(100) NOT NULL,
  `content` mediumblob NOT NULL,
  `type2` varchar(30) NOT NULL,
  `size` int(11) NOT NULL,
  `date_modified` date NOT NULL,
  `date_released` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `issue_specs`
--

INSERT INTO `issue_specs` (`id`, `issue_id`, `specs_id`, `file`, `type`, `content`, `type2`, `size`, `date_modified`, `date_released`) VALUES
(0, '47', '1', '', 'link', '', '', 0, '0000-00-00', '0000-00-00');

-- --------------------------------------------------------

--
-- Table structure for table `members`
--

CREATE TABLE IF NOT EXISTS `members` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `member` varchar(25) NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  `team_id` int(11) DEFAULT '0',
  `del_flg` int(11) DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=45 ;

--
-- Dumping data for table `members`
--

INSERT INTO `members` (`id`, `member`, `created`, `modified`, `team_id`, `del_flg`) VALUES
(26, 'Fredo', '2015-09-22 10:08:10', '2015-09-22 10:08:10', 48, 1),
(27, 'Kat', '2015-09-22 10:08:24', '2015-09-22 10:08:24', 48, 1),
(28, 'Burt', '2015-09-22 10:08:32', '2015-09-22 10:08:32', 48, 1),
(29, 'Frank', '2015-09-22 10:08:37', '2015-09-22 10:08:37', 48, 1),
(30, 'Lester', '2015-09-22 10:08:44', '2015-09-22 10:08:44', 48, 1),
(31, 'Karen', '2015-09-22 10:08:52', '2015-09-22 10:08:52', 48, 1),
(32, 'Kat', '2015-09-22 10:09:02', '2015-09-22 10:09:02', 48, 1),
(33, 'Alvin', '2015-09-22 10:09:42', '2015-09-22 10:09:42', 51, 1),
(34, 'Ross', '2015-09-22 10:10:03', '2015-09-22 10:10:03', 51, 1),
(35, 'Jacob', '2015-09-22 10:10:12', '2015-09-22 10:10:12', 51, 1),
(36, 'DongDong', '2015-09-22 10:10:20', '2015-09-22 10:10:20', 51, 1),
(37, 'Roy', '2015-09-22 10:10:28', '2015-09-22 10:10:28', 51, 1),
(38, 'Grace', '2015-09-22 10:10:38', '2015-09-22 10:10:38', 50, 1),
(39, 'Sharon', '2015-09-22 10:10:44', '2015-09-22 10:10:44', 50, 1),
(40, 'Jeff', '2015-09-22 10:18:29', '2015-09-22 10:18:29', 49, 1),
(41, 'Rich', '2015-09-22 10:18:34', '2015-09-22 10:18:34', 48, 1),
(42, 'Yongbo', '2015-09-22 10:18:40', '2015-09-22 10:18:40', 51, 1),
(43, 'Evan', '2015-09-22 10:18:45', '2015-09-22 10:18:45', 50, 1),
(44, 'Neil', '2015-09-22 10:18:50', '2015-09-22 10:18:50', 52, 1);

-- --------------------------------------------------------

--
-- Table structure for table `pdetails`
--

CREATE TABLE IF NOT EXISTS `pdetails` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `project_id` int(11) NOT NULL,
  `deadline` date NOT NULL,
  `issue_no` varchar(25) NOT NULL,
  `sub_task` varchar(5000) NOT NULL,
  `task_description` varchar(5000) NOT NULL,
  `member` varchar(25) NOT NULL DEFAULT '0',
  `issue_link` varchar(250) NOT NULL,
  `status` int(11) NOT NULL COMMENT '//0 - inactive 1 - inprogress 2 - pending 3 - for confirmation 4 - for testing 5 - released 6 - closed',
  `created` date NOT NULL,
  `modified` datetime NOT NULL,
  `comment` varchar(250) NOT NULL DEFAULT 'this is a comment',
  `del_flg` int(11) DEFAULT '1',
  `team_id` int(11) DEFAULT NULL,
  `start_date` date NOT NULL,
  `priority` varchar(25) DEFAULT NULL,
  `progress` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=787 ;

--
-- Dumping data for table `pdetails`
--

INSERT INTO `pdetails` (`id`, `project_id`, `deadline`, `issue_no`, `sub_task`, `task_description`, `member`, `issue_link`, `status`, `created`, `modified`, `comment`, `del_flg`, `team_id`, `start_date`, `priority`, `progress`) VALUES
(752, 10, '0000-00-00', 'NC-206', '', 'Would like to display the Page title same with each menu @ Admin Screen', '26', 'https://love.backlog.jp/view/NC-206', 1, '2015-09-22', '2015-09-22 10:11:46', 'this is a comment', 1, NULL, '0000-00-00', NULL, NULL),
(753, 10, '0000-00-00', 'NC-526', '', 'New Schedule table', '0', '', 3, '2015-09-22', '2015-09-22 10:13:13', 'this is a comment', 1, NULL, '0000-00-00', NULL, NULL),
(754, 10, '0000-00-00', 'NC-603', '', 'Modification of withdrawal questionnaire @ management screen', '27', 'http://redmine.vjsol.jp/issues/7877', 8, '2015-09-22', '2015-09-22 10:15:43', 'this is a comment', 1, NULL, '0000-00-00', NULL, NULL),
(755, 10, '0000-00-00', 'NC-462', '', 'Modification for Student Management', '26', '', 2, '2015-09-22', '2015-09-22 10:17:20', 'this is a comment', 1, NULL, '0000-00-00', NULL, NULL),
(756, 10, '0000-00-00', 'NC-319', 'Modification for Teacher Management', '', '28', '', 4, '2015-09-22', '2015-09-22 10:17:57', 'this is a comment', 1, NULL, '0000-00-00', NULL, NULL),
(757, 10, '0000-00-00', 'NC-566', '', 'Counseling introduction development side ticket', '0', 'https://love.backlog.jp/view/NC-566?q=NC-566', 10, '2015-09-22', '2015-09-22 10:19:49', 'this is a comment', 1, NULL, '0000-00-00', NULL, NULL),
(758, 10, '0000-00-00', 'NC-641', '', '(Lester, Karen & Alvin) make a vagrant for native camp', '', '', 9, '2015-09-22', '2015-09-22 10:22:57', 'this is a comment', 1, NULL, '0000-00-00', NULL, NULL),
(759, 10, '0000-00-00', 'NC-647', 'Make message board for Student', '', '41', '', 2, '2015-09-22', '2015-09-22 10:23:43', 'this is a comment', 1, NULL, '0000-00-00', NULL, NULL),
(760, 10, '0000-00-00', 'NC-642 (Normal)', '', 'The lecturer introduction page, and add the "support of Rei-chan comment"', '31', '', 9, '2015-09-22', '2015-09-22 10:24:35', 'this is a comment', 1, NULL, '0000-00-00', NULL, NULL),
(761, 10, '0000-00-00', 'NC-664', '', 'Of NOT STANDBY limit @ lecturer screen', '29', '', 4, '2015-09-22', '2015-09-22 10:25:21', 'this is a comment', 1, NULL, '0000-00-00', NULL, NULL),
(762, 10, '0000-00-00', 'NC-566', '', '(Jeff & Kat) BREAK number of limit @ lecturer screen', '40', 'https://love.backlog.jp/view/NC-659?q=659', 2, '2015-09-22', '2015-09-22 10:33:13', 'this is a comment', 1, NULL, '0000-00-00', '2', NULL),
(763, 10, '0000-00-00', 'NC-672', '', 'Modification of online status', '26', '', 4, '2015-09-22', '2015-09-22 10:36:09', 'this is a comment', 1, NULL, '0000-00-00', '2', NULL),
(764, 10, '0000-00-00', 'NC-668', '', 'Optimization of Lessons Statistics ', '27', 'https://love.backlog.jp/view/NC-668?q=NC-668', 8, '2015-09-22', '2015-09-22 10:28:33', 'this is a comment', 1, NULL, '0000-00-00', NULL, NULL),
(765, 10, '0000-00-00', 'NC-679', '', 'Additional forced settlement flag @ student details', '30', '', 2, '2015-09-22', '2015-09-22 10:29:17', 'this is a comment', 1, NULL, '0000-00-00', NULL, NULL),
(766, 10, '0000-00-00', 'NC-566', '', 'Add version config for CSS & JS', '29', 'https://love.backlog.jp/view/NC-666?q=NC-666', 2, '2015-09-22', '2015-09-22 10:33:25', 'this is a comment', 1, NULL, '0000-00-00', '2', NULL),
(767, 10, '0000-00-00', 'NC-566', '', 'Create time restoration Feature in admin screen', '30', '', 9, '2015-09-22', '2015-09-22 10:32:59', 'this is a comment', 1, NULL, '0000-00-00', '2', NULL),
(768, 10, '2015-09-23', 'NC-672', '', 'Display JPN oe ENG text book name on Memo', '26', '', 9, '2015-09-22', '2015-09-22 11:47:43', 'this is a comment', 1, NULL, '0000-00-00', '3', NULL),
(769, 10, '2015-09-30', 'NC-672', '', 'fix slow query in admin teacher ranking page', '41', '', 8, '2015-09-22', '2015-09-22 11:48:56', 'this is a comment', 1, NULL, '0000-00-00', '3', NULL),
(770, 10, '0000-00-00', 'NC-671', '', 'Questionnaire item change after lessons', '26', 'https://love.backlog.jp/view/NC-671', 5, '2015-09-22', '2015-09-22 10:35:59', 'this is a comment', 1, NULL, '0000-00-00', NULL, NULL),
(771, 10, '0000-00-00', 'NC-672', '', 'Credit company "Zeus" introduction', '31', 'https://love.backlog.jp/view/NC-480', 2, '2015-09-22', '2015-09-22 10:36:59', 'this is a comment', 1, NULL, '0000-00-00', '2', NULL),
(772, 10, '0000-00-00', 'NC-677', '', 'Add "other" gender', '28', '', 1, '2015-09-22', '2015-09-22 10:37:52', 'this is a comment', 1, NULL, '0000-00-00', NULL, NULL),
(773, 10, '0000-00-00', 'NC-678', '', 'In Teacher Attendance History Optimize and filter 1 month to csv download', '28', '', 4, '2015-09-22', '2015-09-22 10:38:43', 'this is a comment', 1, NULL, '0000-00-00', NULL, NULL),
(774, 10, '0000-00-00', 'NC-679', '', 'Additional forced settlement flag @ student details', '30', '', 2, '2015-09-22', '2015-09-22 10:39:07', 'this is a comment', 1, NULL, '0000-00-00', NULL, NULL),
(775, 10, '0000-00-00', 'NC-680', '', 'transrate', '42', '', 2, '2015-09-22', '2015-09-22 10:41:07', 'this is a comment', 1, NULL, '0000-00-00', NULL, NULL),
(776, 10, '0000-00-00', 'NC-683', '', 'Because the message management is heavy improvement', '26', '', 2, '2015-09-22', '2015-09-22 10:43:02', 'this is a comment', 1, NULL, '0000-00-00', NULL, NULL),
(777, 10, '0000-00-00', 'NC-682', '', 'Lessons start before modal change', '0', '', 0, '2015-09-22', '2015-09-22 10:43:23', 'this is a comment', 1, NULL, '0000-00-00', NULL, NULL),
(779, 11, '0000-00-00', 'NC-API Bugs', '', '', '0', 'https://docs.google.com/spreadsheets/d/1yHk4jNp-Wh5G3fIBM_qoMUDWdT7vicKiJ7iMN6t2uRs/edit#gid=0', 0, '2015-09-22', '2015-09-22 11:01:57', 'this is a comment', 1, NULL, '0000-00-00', NULL, NULL),
(780, 12, '0000-00-00', 'MC-19', 'https://love.backlog.jp/view/MC-19', 'Flow and sql queries', '42', 'https://love.backlog.jp/view/MC-19', 2, '2015-09-22', '2015-09-22 11:04:02', 'this is a comment', 1, NULL, '0000-00-00', NULL, NULL),
(781, 12, '0000-00-00', 'Google Tag Manager', '', 'Not working needs to check', '42', '', 1, '2015-09-22', '2015-09-22 11:04:28', 'this is a comment', 1, NULL, '0000-00-00', NULL, NULL),
(782, 13, '0000-00-00', 'GGPE Schedule', '', '', '0', 'https://docs.google.com/spreadsheets/d/1nZVeFB_iIZwdUwX1DQXhtzTE4PgVbzt91FBoJYAA4JY/edit#gid=1519488662', 2, '2015-09-22', '2015-09-22 11:06:51', 'this is a comment', 1, NULL, '0000-00-00', NULL, NULL),
(783, 14, '0000-00-00', '7880', '', 'http://redmine.vjsol.jp/issues/7880', '38', 'http://redmine.vjsol.jp/issues/7880', 2, '2015-09-22', '2015-09-22 11:08:09', 'this is a comment', 1, NULL, '0000-00-00', NULL, NULL),
(784, 14, '0000-00-00', '7881', '', 'http://redmine.vjsol.jp/issues/7881', '43', 'http://redmine.vjsol.jp/issues/7881', 9, '2015-09-22', '2015-09-22 11:08:31', 'this is a comment', 1, NULL, '0000-00-00', NULL, NULL),
(785, 14, '0000-00-00', '7882', '', '', '43', 'http://redmine.vjsol.jp/issues/7882', 10, '2015-09-22', '2015-09-22 11:08:52', 'this is a comment', 1, NULL, '0000-00-00', NULL, NULL),
(786, 14, '0000-00-00', '7882', '', 'Questionnaire', '0', 'https://docs.google.com/spreadsheets/d/1nlf1pGfJHi2yqewxSeg7rfDPop6LJ68c2RKOdCymE4M/edit#gid=0', 0, '2015-09-22', '2015-09-22 11:10:50', 'this is a comment', 1, NULL, '0000-00-00', NULL, 100);

-- --------------------------------------------------------

--
-- Table structure for table `projects`
--

CREATE TABLE IF NOT EXISTS `projects` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `p_name` varchar(25) NOT NULL,
  `link` varchar(500) NOT NULL,
  `team_id` int(11) NOT NULL,
  `no_of_task` int(11) NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  `del_flg` int(11) DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=15 ;

--
-- Dumping data for table `projects`
--

INSERT INTO `projects` (`id`, `p_name`, `link`, `team_id`, `no_of_task`, `created`, `modified`, `del_flg`) VALUES
(10, 'Native Camp', 'http://english.fdc-inc.com/', 48, 0, '2015-09-22 10:07:36', '2015-09-22 10:07:36', 1),
(11, 'NC-API', 'https://docs.google.com/spreadsheets/d/1yHk4jNp-Wh5G3fIBM_qoMUDWdT7vicKiJ7iMN6t2uRs/edit#gid=0', 51, 0, '2015-09-22 11:01:22', '2015-09-22 11:01:22', 1),
(12, 'Macherie', 'http://macherie.tv', 51, 0, '2015-09-22 11:03:09', '2015-09-22 11:03:09', 1),
(13, 'AS for GGPE', 'http://accounting.fdc-inc.com', 51, 0, '2015-09-22 11:06:11', '2015-09-22 11:06:11', 1),
(14, 'L-charge/Appli', 'http://l-charge.fdc-inc.com/index_smt_ca.php?s=42112&u=xxx', 50, 0, '2015-09-22 11:07:36', '2015-09-22 11:07:36', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tblcolors`
--

CREATE TABLE IF NOT EXISTS `tblcolors` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `status_id` int(11) NOT NULL,
  `color` varchar(50) NOT NULL,
  `status` varchar(25) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=12 ;

--
-- Dumping data for table `tblcolors`
--

INSERT INTO `tblcolors` (`id`, `status_id`, `color`, `status`) VALUES
(1, 0, '#000000', 'Not Assigned'),
(2, 1, '#a8a6a3', 'Pending'),
(3, 3, '#FF944D', 'For Confirmation'),
(4, 4, '#e7c4f2', 'For Testing'),
(5, 5, '#bfebbc', 'On Test'),
(6, 6, '#d99b55', 'Waiting For Feedback'),
(7, 2, '#48b0fa', 'In Progress'),
(8, 7, '#bebddb', 'Waiting For Fixed'),
(9, 8, '#7ef578', 'Released'),
(10, 9, '#1f6311', 'For Released'),
(11, 10, '#fff200', 'QA Tokyo');

-- --------------------------------------------------------

--
-- Table structure for table `teams`
--

CREATE TABLE IF NOT EXISTS `teams` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `team` varchar(25) NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  `del_flg` int(11) DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=53 ;

--
-- Dumping data for table `teams`
--

INSERT INTO `teams` (`id`, `team`, `created`, `modified`, `del_flg`) VALUES
(48, 'Rich', '2015-09-22 10:06:55', '2015-09-22 10:06:55', 1),
(49, 'Jeff', '2015-09-22 10:07:02', '2015-09-22 10:07:02', 1),
(50, 'Evan', '2015-09-22 10:07:06', '2015-09-22 10:07:06', 1),
(51, 'Yongbo', '2015-09-22 10:07:15', '2015-09-22 10:07:15', 1),
(52, 'Neil', '2015-09-22 10:07:19', '2015-09-22 10:07:19', 1);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user` varchar(25) NOT NULL,
  `password` varchar(25) NOT NULL,
  `created_date` datetime NOT NULL,
  `modified_date` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
