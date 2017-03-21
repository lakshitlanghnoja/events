-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Aug 22, 2014 at 11:30 AM
-- Server version: 5.6.17
-- PHP Version: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `cidemo`
--

-- --------------------------------------------------------

--
-- Table structure for table `activity_log`
--

CREATE TABLE IF NOT EXISTS `activity_log` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL DEFAULT '0',
  `session_id` varchar(100) NOT NULL,
  `url` varchar(255) NOT NULL,
  `ip_address` varchar(50) NOT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `ci_sessions`
--

CREATE TABLE IF NOT EXISTS `ci_sessions` (
  `session_id` char(40) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL COMMENT 'session id',
  `ip_address` varchar(45) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL COMMENT 'ip address',
  `user_agent` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL COMMENT 'user agent - Browser',
  `last_activity` int(10) unsigned NOT NULL COMMENT 'last activity',
  `user_data` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL COMMENT 'user''s session data',
  `previous_id` varchar(40) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'previous session id',
  `last_rotate` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `last_write` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL COMMENT 'last write',
  UNIQUE KEY `session_id` (`session_id`),
  KEY `last_activity` (`last_activity`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `ci_sessions`
--

INSERT INTO `ci_sessions` (`session_id`, `ip_address`, `user_agent`, `last_activity`, `user_data`, `previous_id`, `last_rotate`, `last_write`) VALUES
('4966c23c746f585924da2388dafa8307', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:30.0) Gecko', 1408698840, 'a:5:{s:9:"user_data";s:0:"";s:5:"admin";a:21:{s:15:"record_per_page";i:5;s:12:"site_lang_id";s:1:"1";s:14:"site_lang_name";s:7:"english";s:14:"site_lang_code";s:2:"en";s:14:"site_direction";s:3:"ltr";s:7:"user_id";s:1:"1";s:7:"role_id";s:1:"1";s:5:"email";s:22:"pankit.shah@sparsh.com";s:9:"firstname";s:12:"Pankit Super";s:8:"lastname";s:4:"Shah";s:9:"logged_in";b:1;s:11:"permissions";a:53:{i:0;s:17:"admin.users.login";i:1;s:17:"admin.users.index";i:2;s:22:"admin.users.action.add";i:3;s:23:"admin.users.action.edit";i:4;s:23:"admin.permissions.index";i:5;s:28:"admin.permissions.action.add";i:6;s:18:"admin.users.delete";i:7;s:29:"admin.permissions.action.edit";i:8;s:24:"admin.permissions.delete";i:9;s:17:"admin.roles.index";i:10;s:22:"admin.roles.action.add";i:11;s:23:"admin.roles.action.edit";i:12;s:25:"admin.roles.action.delete";i:13;s:29:"admin.roles.permission_matrix";i:14;s:16:"admin.urls.index";i:15;s:21:"admin.urls.action.add";i:16;s:22:"admin.urls.action.edit";i:17;s:17:"admin.urls.delete";i:18;s:22:"front.contact_us.index";i:19;s:15:"admin.cms.index";i:20;s:20:"admin.cms.ajax_index";i:21;s:16:"admin.cms.action";i:22;s:21:"admin.cms.ajax_action";i:23;s:16:"admin.menu.index";i:24;s:21:"admin.menu.action.add";i:25;s:22:"admin.menu.action.edit";i:26;s:17:"admin.menu.delete";i:27;s:21:"admin.languages.index";i:28;s:26:"admin.languages.action.add";i:29;s:27:"admin.languages.action.edit";i:30;s:20:"admin.settings.index";i:31;s:25:"admin.settings.action.add";i:32;s:26:"admin.settings.action.edit";i:33;s:21:"admin.settings.delete";i:34;s:16:"admin.users.save";i:35;s:16:"admin.cms.delete";i:36;s:27:"front.users.change_password";i:37;s:22:"admin.permissions.save";i:38;s:15:"admin.urls.save";i:39;s:36:"admin.roles.update_matrix_permission";i:40;s:15:"admin.menu.save";i:41;s:20:"admin.languages.save";i:42;s:22:"admin.languages.delete";i:43;s:21:"admin.users.view_data";i:44;s:34:"admin.roles.update_user_permission";i:45;s:23:"admin.menu.get_menulist";i:46;s:23:"admin.menu.get_subpages";i:47;s:34:"admin.roles.user_permission_matrix";i:48;s:18:"admin.users.action";i:49;s:14:"admin.cms.view";i:50;s:35:"admin.modulebuilder.generate_module";i:51;s:16:"admin.roles.save";i:52;s:19:"admin.settings.save";}s:10:"super_user";s:1:"1";s:18:"permissions_offset";s:0:"";s:23:"permissions_page_number";s:0:"";s:23:"permissions_search_term";s:0:"";s:19:"permissions_sort_by";s:6:"status";s:22:"permissions_sort_order";s:4:"desc";s:16:"user_search_term";s:0:"";s:12:"user_sort_by";s:0:"";s:15:"user_sort_order";s:0:"";}s:4:"word";s:6:"IDVFVL";s:5:"image";s:19:"1408697610.5655.jpg";s:5:"front";a:5:{s:12:"site_lang_id";s:1:"1";s:14:"site_lang_name";s:7:"english";s:14:"site_lang_code";s:2:"en";s:14:"site_direction";s:3:"ltr";s:15:"record_per_page";s:1:"5";}}', NULL, '', '');

-- --------------------------------------------------------

--
-- Table structure for table `cms`
--

CREATE TABLE IF NOT EXISTS `cms` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cms_id` int(11) NOT NULL COMMENT 'cms id for frontend representation',
  `lang_id` int(11) NOT NULL DEFAULT '1' COMMENT 'Foreign Key of id from language table',
  `title` varchar(100) CHARACTER SET utf8 NOT NULL,
  `slug_url` varchar(50) CHARACTER SET utf8 NOT NULL,
  `description` text COLLATE utf8_bin NOT NULL,
  `meta_fields` text COLLATE utf8_bin NOT NULL COMMENT 'Json Encoded Array',
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT 'Status Active/Inactive',
  `created` datetime NOT NULL,
  `created_by` int(11) NOT NULL,
  `modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modified_by` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `lang_id` (`lang_id`),
  KEY `cms_id` (`cms_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=3 ;

--
-- Dumping data for table `cms`
--

INSERT INTO `cms` (`id`, `cms_id`, `lang_id`, `title`, `slug_url`, `description`, `meta_fields`, `status`, `created`, `created_by`, `modified`, `modified_by`) VALUES
(1, 1, 1, 'home', 'home', '<p>Home page Home page</p>\r\n\r\n<p>Home page Home pageHome page Home pageHome page Home page</p>\r\n\r\n<p>Home page Home page</p>\r\n\r\n<p>Home page Home pageHome page Home pageHome page Home pageHome page Home page</p>', '', 1, '2013-09-03 13:13:58', 0, '2014-08-22 03:20:21', 1),
(2, 2, 1, 'shopping', 'shopping', '<p>shopping shopping shopping shopping shopping shoppingshopping shopping shoppingshopping shopping shoppingshopping shopping shoppingshopping shopping shoppingshopping shopping shoppingshopping shopping shoppingshopping shopping shoppingshopping shopping shoppingshopping shopping shoppingshopping shopping shopping</p>\r\n\r\n<p>shopping shopping shopping</p>\r\n\r\n<p>shopping shopping shoppingshopping shopping shoppingshopping shopping shoppingshopping shopping shoppingshopping shopping shoppingshopping shopping shopping</p>', '', 1, '2014-08-22 09:38:06', 1, '2014-08-22 07:38:06', 0);

-- --------------------------------------------------------

--
-- Table structure for table `cms_meta`
--

CREATE TABLE IF NOT EXISTS `cms_meta` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cms_id` int(11) NOT NULL,
  `lang_id` int(11) NOT NULL,
  `meta_title` varchar(255) NOT NULL,
  `meta_keywords` varchar(255) NOT NULL,
  `meta_description` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `cms_meta`
--

INSERT INTO `cms_meta` (`id`, `cms_id`, `lang_id`, `meta_title`, `meta_keywords`, `meta_description`) VALUES
(1, 1, 1, 'Home', 'home', 'Home Home'),
(2, 68, 1, 'shopping', 'shopping', 'shopping'),
(3, 2, 1, 'Shopping', 'Shopping', 'shopping');

-- --------------------------------------------------------

--
-- Table structure for table `contact_us`
--

CREATE TABLE IF NOT EXISTS `contact_us` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) CHARACTER SET utf8 NOT NULL,
  `email` varchar(100) CHARACTER SET utf8 NOT NULL,
  `subject` varchar(100) CHARACTER SET utf8 NOT NULL,
  `message` text CHARACTER SET utf8 NOT NULL,
  `ip_address` varchar(500) CHARACTER SET utf8 NOT NULL,
  `timestamp` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `email_template`
--

CREATE TABLE IF NOT EXISTS `email_template` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `template_id` int(11) NOT NULL,
  `lang_id` int(11) NOT NULL,
  `template_name` varchar(100) NOT NULL,
  `template_subject` varchar(100) NOT NULL,
  `template_body` text NOT NULL,
  `status` tinyint(1) NOT NULL,
  `created` datetime NOT NULL,
  `created_by` int(11) NOT NULL,
  `modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `modified_by` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `email_template`
--

INSERT INTO `email_template` (`id`, `template_id`, `lang_id`, `template_name`, `template_subject`, `template_body`, `status`, `created`, `created_by`, `modified`, `modified_by`) VALUES
(1, 1, 1, 'forgot_password_email_template', 'Forgot Password Mail', '<table border="0" cellpadding="0" cellspacing="2">\r\n <tbody>\r\n  <tr>\r\n   <td colspan="2"><strong>Dear [name]</strong></td>\r\n  </tr>\r\n  <tr>\r\n   <td colspan="2">We have reset you password. Please try to login with below details.</td>\r\n  </tr>\r\n  <tr>\r\n   <td>Username :[USERNAME]</td>\r\n  </tr>\r\n  <tr>\r\n   <td>New Password :[PASSWORD]</td>\r\n  </tr>\r\n  <tr>\r\n   <td colspan="2">&copy; Copyright 2013 [SITE_NAME] All rights reserved.</td>\r\n  </tr>\r\n </tbody>\r\n</table>', 0, '2014-08-22 10:26:42', 1, '2014-08-22 05:02:00', 1);

-- --------------------------------------------------------

--
-- Table structure for table `languages`
--

CREATE TABLE IF NOT EXISTS `languages` (
  `id` int(3) NOT NULL AUTO_INCREMENT COMMENT 'Primary Key',
  `language_code` varchar(100) CHARACTER SET utf8 NOT NULL COMMENT 'Language Code',
  `language_name` varchar(100) COLLATE utf8_bin NOT NULL COMMENT 'Language Name',
  `direction` enum('ltr','rtl') COLLATE utf8_bin NOT NULL DEFAULT 'ltr' COMMENT 'Direction for view (left to right - ltr or right to left - rtl)',
  `default` tinyint(1) NOT NULL DEFAULT '0' COMMENT 'Is Default Language',
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT 'Status Active/Inactive',
  PRIMARY KEY (`id`),
  KEY `language_code` (`language_code`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Lanugage Table' AUTO_INCREMENT=11 ;

--
-- Dumping data for table `languages`
--

INSERT INTO `languages` (`id`, `language_code`, `language_name`, `direction`, `default`, `status`) VALUES
(1, 'en', 'English', 'ltr', 1, 1),
(2, 'es', 'Spanish', 'ltr', 0, 1),
(10, 'ar', 'Arabic', 'rtl', 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `menu_navigation`
--

CREATE TABLE IF NOT EXISTS `menu_navigation` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `menu_name` varchar(50) COLLATE utf8_bin NOT NULL,
  `title` varchar(50) COLLATE utf8_bin NOT NULL,
  `link` varchar(255) COLLATE utf8_bin NOT NULL,
  `parent_id` int(11) NOT NULL DEFAULT '0',
  `lang_id` int(11) NOT NULL DEFAULT '1',
  `status` tinyint(1) NOT NULL DEFAULT '0' COMMENT '0=Inactive,1=Active, -1= Deleted',
  PRIMARY KEY (`id`),
  KEY `lang_id` (`lang_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=296 ;

--
-- Dumping data for table `menu_navigation`
--

INSERT INTO `menu_navigation` (`id`, `menu_name`, `title`, `link`, `parent_id`, `lang_id`, `status`) VALUES
(1, 'admin_menu', 'Home', 'admin/users', 0, 1, 1),
(17, 'front_menu', 'Home', 'home', 0, 1, 1),
(28, 'admin_menu', 'Home-sp', '/', 0, 2, 1),
(29, 'admin_menu', 'Menu-sp', 'admin/menu', 0, 2, 1),
(33, 'admin_menu', 'Permissions-sp', 'admin/permissions', 0, 2, 0),
(41, 'admin_menu', 'URL Management', 'admin/urls', 0, 2, 0),
(42, 'admin_menu', 'Roles', 'admin/roles', 0, 2, 0),
(43, 'admin_menu', 'CMS Management', 'admin/cms', 0, 2, 1),
(54, 'admin_menu', 'Home', 'admin/users', 0, 3, 1),
(55, 'admin_menu', 'Menu', 'admin/menu/index', 0, 3, 1),
(59, 'admin_menu', 'Permissions', 'admin/permissions', 0, 3, 0),
(67, 'admin_menu', 'URL Management', 'admin/urls', 0, 3, 0),
(70, 'front_menu', 'Home', '/', 0, 3, 1),
(93, 'admin_menu', 'Roles', 'admin/roles', 0, 3, 0),
(94, 'admin_menu', 'Settings', 'admin/settings', 0, 3, 1),
(95, 'admin_menu', 'Languages', 'admin/languages', 94, 3, 1),
(105, 'admin_menu', 'Translate', 'admin/translate', 94, 3, 1),
(106, 'admin_menu', 'Menu', 'admin/menu', 0, 1, 1),
(114, 'front_menu', 'Contact Us', 'contact_us/index', 0, 1, 1),
(123, 'admin_menu', 'Permissions', 'admin/permissions', 0, 1, 0),
(124, 'admin_menu', 'URL', 'admin/urls', 0, 1, 0),
(125, 'admin_menu', 'Roles', 'admin/roles', 0, 1, 0),
(126, 'admin_menu', 'CMS', 'admin/cms', 0, 1, 1),
(130, 'admin_menu', 'Permission Matrix', 'admin/roles/permission_matrix', 125, 1, 0),
(140, 'admin_menu', 'Permission Matrix', 'admin/roles/permission_matrix', 42, 2, 0),
(141, 'admin_menu', 'Settings', 'admin/settings', 0, 2, 1),
(142, 'admin_menu', 'Languages', 'admin/languages', 141, 2, 1),
(143, 'admin_menu', 'Translate', 'admin/translate', 141, 2, 1),
(144, 'front_menu', 'Contact Us sp', 'contact_us/index', 0, 2, 1),
(146, 'front_menu', 'Login-sp', 'users', 0, 2, 1),
(148, 'front_menu', 'Contact Us ar', 'contact_us/index', 0, 3, 1),
(150, 'front_menu', 'Login-ar', 'users', 0, 3, 1),
(151, 'admin_menu', 'Permission Matrix', 'admin/roles/permission_matrix', 93, 3, 0),
(160, 'admin_menu', 'Settings', 'admin/settings', 0, 1, 1),
(161, 'admin_menu', 'Language', 'admin/languages', 160, 1, 1),
(162, 'admin_menu', 'Translate', 'admin/translate', 160, 1, 1),
(164, 'admin_menu', ' منزل', 'admin/users', 0, 10, 1),
(230, 'admin_menu', 'Email Template', 'admin/email_template', 0, 1, 1),
(271, 'front_menu', 'Edit Profile', 'users/profile', 0, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE IF NOT EXISTS `permissions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `permission_label` varchar(255) COLLATE utf8_bin NOT NULL,
  `permission_title` varchar(255) COLLATE utf8_bin NOT NULL,
  `parent_id` int(11) NOT NULL DEFAULT '0',
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '"-1= Deleted, 0=Inactive,1=Active"',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=317 ;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`id`, `permission_label`, `permission_title`, `parent_id`, `status`) VALUES
(1, 'Admin.Users.Login', 'Login', 0, 1),
(2, 'Admin.Users.Index', 'User Listing', 0, 1),
(3, 'Admin.Users.Action.Add', 'User Add', 2, 1),
(4, 'Admin.Users.Action.Edit', 'User Edit', 2, 1),
(5, 'Admin.Permissions.Index', 'Permission Listing', 0, 1),
(6, 'Admin.Permissions.Action.Add', 'Permission Add', 5, 1),
(7, 'Admin.Users.Delete', 'User Delete', 2, 1),
(9, 'Admin.Permissions.Action.Edit', 'Permission Edit', 5, 1),
(10, 'Admin.Permissions.Delete', 'Permission Delete', 5, 1),
(11, 'Admin.Roles.Index', 'Role Listing', 0, 1),
(12, 'Admin.Roles.Action.Add', 'Role Add', 11, 1),
(13, 'Admin.Roles.Action.Edit', 'Role Edit', 11, 1),
(14, 'Admin.Roles.Action.Delete', 'Role Delete', 11, 1),
(15, 'Admin.Roles.Permission_matrix', 'Role Permission Matrix', 11, 1),
(17, 'Admin.Urls.Index', 'URL Listing', 0, 1),
(18, 'Admin.Urls.Action.Add', 'URL Add', 17, 1),
(19, 'Admin.Urls.Action.Edit', 'URL Edit', 17, 1),
(20, 'Admin.Urls.Delete', 'URL Delete', 17, 1),
(21, 'Front.Contact_us.Index', 'Contact Us', 0, 1),
(22, 'Admin.Cms.Index', 'CMS Listing', 0, 1),
(23, 'Admin.Cms.Ajax_Index', 'CMS Listing - Ajax', 22, 1),
(24, 'Admin.Cms.Action', 'Cms add/edit page', 22, 1),
(25, 'Admin.Cms.Ajax_Action', 'Cms add/edit ajax page', 22, 1),
(26, 'Admin.Menu.Index', 'Menu', 0, 1),
(27, 'Admin.Menu.Action.Add', 'Menu Add', 26, 1),
(28, 'Admin.Menu.Action.Edit', 'Menu Edit', 26, 1),
(29, 'Admin.Menu.Delete', 'Menu Delete', 26, 1),
(30, 'Admin.Languages.Index', 'Languages', 0, 1),
(31, 'Admin.Languages.Action.Add', 'Languages Add', 30, 1),
(32, 'Admin.Languages.Action.Edit', 'Languages Edit', 30, 1),
(33, 'Admin.Settings.Index', 'Settings', 0, 1),
(34, 'Admin.Settings.Action.Add', 'Settings Add', 33, 1),
(35, 'Admin.Settings.Action.Edit', 'Settings Edit', 33, 1),
(36, 'Admin.Settings.Delete', 'Settings Delete', 33, 1),
(37, 'Admin.Users.Save', 'User Save', 2, 1),
(41, 'Admin.Cms.Delete', 'CMS delete', 22, 1),
(42, 'Front.Users.Change_password', 'Users Change Password', 0, 1),
(43, 'Admin.Permissions.save', 'Permission save', 5, 1),
(44, 'Admin.Urls.Save', 'Url save', 17, 1),
(45, 'Admin.Roles.update_matrix_permission', 'Update Permission matrix', 11, 1),
(46, 'Admin.Menu.Save', 'Menu Save', 26, 1),
(47, 'Admin.Languages.Save', 'Language Save', 30, 1),
(48, 'Admin.Languages.Delete', 'Language Delete', 30, 1),
(54, 'Admin.Users.View_Data', 'View user profile', 17, 1),
(134, 'Admin.Roles.Update_user_permission', 'Update User Permission', 11, 1),
(259, 'Admin.Menu.Get_menulist', 'Menu Get Menulist', 26, 1),
(260, 'Admin.menu.get_subpages', 'Admin Menu Get_subpages', 26, 1),
(262, 'Admin.Roles.User_permission_matrix', 'User Permission Matrix', 11, 1),
(263, 'Admin.Users.Action', 'Admin User Action', 4, 1),
(303, 'Admin.cms.view', 'CMS View', 22, 1),
(312, 'Admin.Modulebuilder.Generate_Module', 'Module builder', 0, 1),
(315, 'Admin.Roles.Save', 'Role Save', 11, 1),
(316, 'Admin.Settings.Save', 'Settings Save', 33, 1);

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE IF NOT EXISTS `roles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `role_name` varchar(100) CHARACTER SET utf8 NOT NULL,
  `role_description` text CHARACTER SET utf8 NOT NULL,
  `default` tinyint(1) NOT NULL DEFAULT '0',
  `status` tinyint(1) NOT NULL COMMENT '"-1= Deleted, 0=Inactive,1=Active"',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=4 ;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `role_name`, `role_description`, `default`, `status`) VALUES
(1, 'Administrator', 'This is role of administrator', 0, 1),
(2, 'User', 'This is role user', 0, 1),
(3, 'Visitor', 'This is role of visitor', 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `role_permission`
--

CREATE TABLE IF NOT EXISTS `role_permission` (
  `role_id` int(11) NOT NULL,
  `permission_id` int(11) NOT NULL,
  PRIMARY KEY (`role_id`,`permission_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `role_permission`
--

INSERT INTO `role_permission` (`role_id`, `permission_id`) VALUES
(1, 1),
(1, 2),
(1, 3),
(1, 4),
(1, 5),
(1, 6),
(1, 7),
(1, 9),
(1, 10),
(1, 11),
(1, 12),
(1, 13),
(1, 14),
(1, 15),
(1, 17),
(1, 18),
(1, 19),
(1, 20),
(1, 21),
(1, 22),
(1, 23),
(1, 24),
(1, 25),
(1, 26),
(1, 27),
(1, 28),
(1, 29),
(1, 30),
(1, 31),
(1, 32),
(1, 33),
(1, 34),
(1, 35),
(1, 36),
(1, 37),
(1, 41),
(1, 42),
(1, 43),
(1, 44),
(1, 45),
(1, 46),
(1, 47),
(1, 48),
(1, 54),
(1, 134),
(1, 259),
(1, 260),
(1, 262),
(1, 263),
(1, 303),
(1, 312),
(1, 315),
(1, 316);

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE IF NOT EXISTS `settings` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `setting_label` varchar(255) COLLATE utf8_bin NOT NULL,
  `setting_title` varchar(255) COLLATE utf8_bin NOT NULL,
  `setting_value` varchar(255) COLLATE utf8_bin NOT NULL,
  `comment` varchar(255) COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=33 ;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `setting_label`, `setting_title`, `setting_value`, `comment`) VALUES
(8, 'RECORD_PER_PAGE', 'Recored per page for pagination', '5', 'Recored per page for pagination'),
(9, 'CAPTCHA_SETTING', 'captcha setting', '1', 'settings for captcha'),
(10, 'CONTACT_US_EMAIL', 'contact us email', 'vipul.bhoraniyas555@etatvasoft.com', 'contact us email id'),
(11, 'SITE_FROM_EMAIL', 'site from email', 'info@cidemo.in', 'from email address'),
(12, 'SMTP_HOST', 'smtp host', 'smtp.gmail.com', 'smtp host setting'),
(13, 'SMTP_PORT', 'smtp port', '465', 'set smtp port'),
(14, 'SMTP_PASSWORD', 'smtp password', '36Tatva_2010_#@$89', 'set smtp password'),
(15, 'SMTP_USERNAME', 'smtp username', 'tatva36@gmail.com', 'set smtp username'),
(16, 'DEFAULT_CMS_PAGE', 'Default CMS Page', 'cms3', 'Default CMS Page'),
(17, 'VALIDATION_ERROR_POSITION', 'ValidationErrorPosition', 'centerRight', 'jquery validation engine prompt position'),
(18, 'EXCLUDE_KEYS_FILTEROUTPUT', 'Exclude Keys in Filter Output', 'captcha,content,description,search_term', 'Exclude Keys in Data Variable assignment in Theme''s View function to render as it is'),
(19, 'ACTIVITY_LOG', 'Activity log', '1', 'Enable activity log. 1 for enable and 0 for disable'),
(21, 'SITE_NAME', 'Site Name', 'CIDemo', 'site name'),
(27, 'TEST_FOR_SETTING', 'Test For Setting', 'this is testing', 'teestin mecasfddf'),
(28, 'CURRENCY_CODE', 'Currency Code', 'USD', 'Default currency code for all products'),
(29, 'PAYPAL_TEST_MODE', 'Paypal Test Mode', 'true', 'Paypal mode if sandbox then it will go to testing site if you left blank then it will go to the live paypal site'),
(30, 'PAYPAL_API_USERNAME', 'Paypal Api User Name', 'avinash_api1.harmistechnology.com', ''),
(31, 'PAYPAL_API_PASSWORD', 'Paypal Api Password', ' 1370340116 ', ''),
(32, 'PAYPAL_API_SIGNATURE', 'Paypal Api Signature', ' A2SWcQAS0uppuSsEeK2HVEognWrWA8ewm2jWM40td6VN2BLc1Kihd3MU', '');

-- --------------------------------------------------------

--
-- Table structure for table `url_management`
--

CREATE TABLE IF NOT EXISTS `url_management` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `slug_url` varchar(50) COLLATE utf8_bin NOT NULL,
  `language_id` int(11) NOT NULL,
  `module_name` varchar(50) COLLATE utf8_bin NOT NULL,
  `related_id` int(11) NOT NULL DEFAULT '0',
  `core_url` varchar(255) COLLATE utf8_bin NOT NULL,
  `order` int(11) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '0' COMMENT '0=Inactive, 1=Active',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=53 ;

--
-- Dumping data for table `url_management`
--

INSERT INTO `url_management` (`id`, `slug_url`, `language_id`, `module_name`, `related_id`, `core_url`, `order`, `status`) VALUES
(1, 'cms3-es', 2, 'cms', 1, 'index/cms3-es', 0, 1),
(2, 'about-us', 1, 'cms', 2, 'index/about-us', 0, 1),
(3, 'cms3', 1, 'cms', 1, 'index/cms3', 0, 1),
(4, 'cms-ar', 10, 'cms', 1, 'index/cms-ar', 0, 1),
(6, 'testcms', 1, 'cms', 21, 'index/testcms', 9, 1),
(8, 'test123', 1, 'cms', 12, 'index/test123', 0, 1),
(9, 'vb-test-title', 1, 'cms', 43, 'index/vb-test-title', 0, 1),
(10, 'testing-purpose', 1, 'cms', 45, 'index/testing-purpose', 0, 1),
(11, 't', 1, 'cms', 46, 'index/t', 0, 1),
(12, 'tes12222', 1, 'cms', 47, 'index/tes12222', 0, 1),
(13, 'testi111', 1, 'cms', 48, 'index/testi111', 0, 1),
(14, 'testing-purpose-spanish', 2, 'cms', 49, 'index/testing-purpose-spanish', 0, 1),
(15, 'cms', 1, 'cms', 8, 'index/cms', 0, 1),
(16, 'testssaaa', 1, 'cms', 27, 'index/testssaaa', 0, 1),
(17, 'asdfasdfsd', 2, 'cms', 50, 'index/asdfasdfsd', 0, 1),
(18, 'about-fnch', 11, 'cms', 2, 'index/about-fnch', 0, 1),
(19, 'about-us1', 2, 'cms', 2, 'index/about-us1', 0, 1),
(22, 'special-page', 1, 'cms', 53, 'index/special-page', 0, 1),
(23, 'en/test', 0, 'cms', 54, 'index/test', 0, 1),
(24, 'fghghfg', 18, 'cms', 55, 'index/fghghfg', 0, 1),
(25, 'fghfghfhfghgfh', 18, 'cms', 56, 'index/fghfghfhfghgfh', 0, 1),
(26, 'portfolio', 1, 'cms', 57, 'index/portfolio', 0, 1),
(27, 'portfoliosp', 2, 'cms', 57, 'index/portfoliosp', 0, 1),
(28, 'fdfdfdfdffdfdfdf', 1, 'cms', 13, 'index/fdfdfdfdffdfdfdf', 0, 1),
(29, 'mehul-m', 1, 'cms', 34, 'index/mehul-m', 0, 1),
(30, 'test', 1, 'cms', 54, 'index/test', 0, 1),
(31, 'test-article-en', 1, 'cms', 37, 'index/test-article-en', 0, 1),
(33, 'vipul', 0, 'contact_us', 0, 'index', 1, 1),
(34, 'its-my-page', 1, 'cms', 18, 'index/its-my-page', 0, 1),
(35, 'testcmsbyme', 1, 'cms', 58, 'index/testcmsbyme', 0, 0),
(36, 'privacy-policy-sp', 2, 'cms', 3, 'index/privacy-policy-sp', 0, 1),
(39, 'tester', 0, 'contact_us', 0, 'contact_us/index', 999, 1),
(40, 'asddddasasqwwqq', 1, 'cms', 59, 'index/asddddasasqwwqq', 0, 1),
(41, 'dfgtt', 1, 'cms', 60, 'index/dfgtt', 0, 1),
(42, 'dfgggggggggg', 1, 'cms', 61, 'index/dfgggggggggg', 0, 1),
(43, 'ghjghghjghj', 1, 'cms', 62, 'index/ghjghghjghj', 0, 1),
(44, 'sdfsdfds', 1, 'cms', 63, 'index/sdfsdfds', 0, 1),
(45, 'ewrewsdf', 1, 'cms', 64, 'index/ewrewsdf', 0, 1),
(46, 'asdasdasd', 1, 'cms', 65, 'index/asdasdasd', 0, 1),
(47, 'asddsddd', 1, 'cms', 27, 'index/asddsddd', 0, 1),
(48, 'contact', 0, 'contact_us', 0, 'index', 1, 1),
(49, 'test2', 1, 'cms', 67, 'index/test2', 0, 0),
(51, 'home', 1, 'cms', 1, 'index/home', 0, 1),
(52, 'shopping', 1, 'cms', 2, 'index/shopping', 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `role_id` int(3) NOT NULL DEFAULT '0',
  `firstname` varchar(100) CHARACTER SET utf8 NOT NULL,
  `lastname` varchar(100) CHARACTER SET utf8 NOT NULL,
  `email` varchar(255) COLLATE utf8_bin NOT NULL COMMENT 'Unique',
  `password` varchar(50) COLLATE utf8_bin NOT NULL COMMENT 'Sha1 with Custom encryption key',
  `last_login` datetime DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '"-1= Deleted, 0=Inactive,1=Active, 2=Suspended,3=Restricted"',
  `created` datetime NOT NULL,
  `modified` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=203 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `role_id`, `firstname`, `lastname`, `email`, `password`, `last_login`, `status`, `created`, `modified`) VALUES
(1, 1, 'Pankit Super', 'Shah', 'pankit.shah@sparsh.com', '3d4f2bf07dc1be38b20cd6e46949a1071f9d0e3d', '2014-08-22 13:52:54', 1, '2013-08-22 18:56:52', '2013-08-22 13:26:52'),
(196, 1, 'Ankit', 'Patel', 'ankit.patel@tatvasoft.com', 'a87ad6c22c7f21d17a4b0345114840f4a6987a26', NULL, 1, '2014-08-21 19:36:45', '2014-08-21 14:06:45'),
(197, 1, 'Rakesh', 'Advani', 'rakesh.advani@gmail.com', '0b88270569462c1cc1992c7d32f5a4d6b579d78c', NULL, 1, '2014-08-21 19:44:17', '2014-08-21 14:14:17'),
(198, 2, 'Ronak', 'luhar', 'ronak@gmail.com', '212ea19a0df157ac623c72c7e63cde51a92b480b', NULL, 1, '2014-08-22 14:08:58', '2014-08-22 08:38:58'),
(199, 2, 'amit', 'patel', 'amit@gmail.com', 'c8babb64262c6076e821e1ea0afc7d306ede96cb', NULL, 1, '2014-08-22 14:10:14', '2014-08-22 08:40:14'),
(200, 0, 'krutik', 'patel', 'krutik@gmail.com', '4baa3a2f8c81d0f7a4928a40586c7e34756a677b', '2014-08-22 14:31:30', 1, '2014-08-22 14:30:43', '2014-08-22 09:00:43'),
(201, 2, 'suketu', 'Hingu', 'suketu.hingu@gmail.com', 'b8ce286d609f72d6164fc3d44684af1cc5a3df1c', NULL, 1, '2014-08-22 14:35:58', '2014-08-22 09:05:58'),
(202, 2, 'nidhish', 'patadia', 'nidhish@gmail.com', '4c77c15338231e2dfbe168ac1421d6b62cca2dd1', NULL, 1, '2014-08-22 14:44:59', '2014-08-22 09:14:59');

-- --------------------------------------------------------

--
-- Table structure for table `user_permission`
--

CREATE TABLE IF NOT EXISTS `user_permission` (
  `user_id` int(11) NOT NULL,
  `permission_id` int(11) NOT NULL,
  PRIMARY KEY (`user_id`,`permission_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
