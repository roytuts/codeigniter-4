-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               8.0.22 - MySQL Community Server - GPL
-- Server OS:                    Win64
-- HeidiSQL Version:             10.2.0.5599
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;


-- Dumping database structure for roytuts
CREATE DATABASE IF NOT EXISTS `roytuts` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `roytuts`;

-- Dumping structure for table roytuts.visitors
CREATE TABLE IF NOT EXISTS `visitors` (
  `visitor_id` int unsigned NOT NULL AUTO_INCREMENT,
  `no_of_visits` int unsigned NOT NULL,
  `ip_address` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `requested_url` tinytext COLLATE utf8mb4_unicode_ci NOT NULL,
  `referer_page` tinytext COLLATE utf8mb4_unicode_ci NOT NULL,
  `page_name` tinytext COLLATE utf8mb4_unicode_ci NOT NULL,
  `query_string` tinytext COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_agent` tinytext COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_unique` tinyint NOT NULL DEFAULT '0',
  `access_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`visitor_id`)
) ENGINE=InnoDB AUTO_INCREMENT=665 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table roytuts.visitors: ~31 rows (approximately)
/*!40000 ALTER TABLE `visitors` DISABLE KEYS */;
INSERT INTO `visitors` (`visitor_id`, `no_of_visits`, `ip_address`, `requested_url`, `referer_page`, `page_name`, `query_string`, `user_agent`, `is_unique`, `access_date`) VALUES
	(628, 1, '::1', '/blog/faqs', 'http://localhost/blog/blog/blogs', 'faqs/index', '', 'Mozilla/5.0 (Windows NT 6.1; rv:25.0) Gecko/20100101 Firefox/25.0', 0, '2020-08-09 04:36:39'),
	(629, 1, '::1', '/blog/faqs/interview_faqs', 'http://localhost/blog/blog/blogs', 'faqs/interview_faqs', '', 'Mozilla/5.0 (Windows NT 6.1; rv:25.0) Gecko/20100101 Firefox/25.0', 0, '2013-11-09 04:36:39'),
	(630, 1, '::1', '/blog/', 'http://localhost/blog/faqs/interview_faqs', 'home/index', '', 'Mozilla/5.0 (Windows NT 6.1; rv:25.0) Gecko/20100101 Firefox/25.0', 0, '2013-11-09 04:36:40'),
	(631, 1, '::1', '/blog/blog', 'http://localhost/blog/faqs/interview_faqs', 'blog/index', '', 'Mozilla/5.0 (Windows NT 6.1; rv:25.0) Gecko/20100101 Firefox/25.0', 0, '2013-11-09 04:36:40'),
	(632, 1, '::1', '/blog/blog/blogs', 'http://localhost/blog/faqs/interview_faqs', 'blog/blogs', '', 'Mozilla/5.0 (Windows NT 6.1; rv:25.0) Gecko/20100101 Firefox/25.0', 0, '2020-08-01 04:38:47'),
	(633, 1, '::1', '/blog/faqs', 'http://localhost/blog/blog/blogs', 'faqs/index', '', 'Mozilla/5.0 (Windows NT 6.1; rv:25.0) Gecko/20100101 Firefox/25.0', 0, '2020-08-01 04:38:47'),
	(634, 1, '::1', '/blog/faqs/interview_faqs', 'http://localhost/blog/blog/blogs', 'faqs/interview_faqs', '', 'Mozilla/5.0 (Windows NT 6.1; rv:25.0) Gecko/20100101 Firefox/25.0', 0, '2020-08-01 04:38:47'),
	(635, 1, '::1', '/blog/', 'http://localhost/blog/faqs/interview_faqs', 'home/index', '', 'Mozilla/5.0 (Windows NT 6.1; rv:25.0) Gecko/20100101 Firefox/25.0', 0, '2020-08-02 04:38:47'),
	(636, 1, '::1', '/blog/blog', 'http://localhost/blog/faqs/interview_faqs', 'blog/index', '', 'Mozilla/5.0 (Windows NT 6.1; rv:25.0) Gecko/20100101 Firefox/25.0', 0, '2020-08-02 04:38:47'),
	(637, 1, '::1', '/blog/blog/blogs', 'http://localhost/blog/faqs/interview_faqs', 'blog/blogs', '', 'Mozilla/5.0 (Windows NT 6.1; rv:25.0) Gecko/20100101 Firefox/25.0', 0, '2020-08-03 04:38:47'),
	(638, 1, '::1', '/blog/faqs', 'http://localhost/blog/blog/blogs', 'faqs/index', '', 'Mozilla/5.0 (Windows NT 6.1; rv:25.0) Gecko/20100101 Firefox/25.0', 0, '2020-08-04 04:38:47'),
	(639, 1, '::1', '/blog/faqs/interview_faqs', 'http://localhost/blog/blog/blogs', 'faqs/interview_faqs', '', 'Mozilla/5.0 (Windows NT 6.1; rv:25.0) Gecko/20100101 Firefox/25.0', 0, '2020-08-04 04:38:47'),
	(640, 1, '::1', '/blog/', 'http://localhost/blog/faqs/interview_faqs', 'home/index', '', 'Mozilla/5.0 (Windows NT 6.1; rv:25.0) Gecko/20100101 Firefox/25.0', 0, '2020-08-05 04:38:47'),
	(641, 1, '::1', '/blog/blog', 'http://localhost/blog/faqs/interview_faqs', 'blog/index', '', 'Mozilla/5.0 (Windows NT 6.1; rv:25.0) Gecko/20100101 Firefox/25.0', 0, '2020-08-05 04:38:47'),
	(642, 1, '::1', '/blog/blog/blogs', 'http://localhost/blog/faqs/interview_faqs', 'blog/blogs', '', 'Mozilla/5.0 (Windows NT 6.1; rv:25.0) Gecko/20100101 Firefox/25.0', 0, '2020-08-05 04:38:47'),
	(643, 1, '::1', '/blog/about', 'http://localhost/blog/blog/blogs', 'about/index', '', 'Mozilla/5.0 (Windows NT 6.1; rv:25.0) Gecko/20100101 Firefox/25.0', 0, '2020-08-03 04:38:47'),
	(644, 1, '::1', '/blog/contact', 'http://localhost/blog/about', 'contact/index', '', 'Mozilla/5.0 (Windows NT 6.1; rv:25.0) Gecko/20100101 Firefox/25.0', 0, '2020-08-03 04:38:47'),
	(645, 1, '::1', '/blog/', 'http://localhost/blog/contact', 'home/index', '', 'Mozilla/5.0 (Windows NT 6.1; rv:25.0) Gecko/20100101 Firefox/25.0', 0, '2020-08-03 04:38:47'),
	(646, 1, '::1', '/blog/blog', 'http://localhost/blog/contact', 'blog/index', '', 'Mozilla/5.0 (Windows NT 6.1; rv:25.0) Gecko/20100101 Firefox/25.0', 0, '2020-08-03 04:38:47'),
	(647, 1, '::1', '/blog/blog/blogs', 'http://localhost/blog/contact', 'blog/blogs', '', 'Mozilla/5.0 (Windows NT 6.1; rv:25.0) Gecko/20100101 Firefox/25.0', 0, '2020-08-05 04:38:47'),
	(648, 1, '::1', '/blog/', 'http://localhost/blog/blog/blogs', 'home/index', '', 'Mozilla/5.0 (Windows NT 6.1; rv:25.0) Gecko/20100101 Firefox/25.0', 0, '2020-08-05 04:38:47'),
	(649, 1, '::1', '/blog/blog', 'http://localhost/blog/blog/blogs', 'blog/index', '', 'Mozilla/5.0 (Windows NT 6.1; rv:25.0) Gecko/20100101 Firefox/25.0', 0, '2020-08-04 04:38:47'),
	(650, 1, '::1', '/blog/blog/blogs', 'http://localhost/blog/blog/blogs', 'blog/blogs', '', 'Mozilla/5.0 (Windows NT 6.1; rv:25.0) Gecko/20100101 Firefox/25.0', 0, '2020-08-04 04:38:47'),
	(651, 1, '::1', '/blog/faqs', 'http://localhost/blog/blog/blogs', 'faqs/index', '', 'Mozilla/5.0 (Windows NT 6.1; rv:25.0) Gecko/20100101 Firefox/25.0', 0, '2020-08-12 07:39:47'),
	(652, 1, '::1', '/blog/faqs/interview_faqs', 'http://localhost/blog/blog/blogs', 'faqs/interview_faqs', '', 'Mozilla/5.0 (Windows NT 6.1; rv:25.0) Gecko/20100101 Firefox/25.0', 0, '2020-08-12 03:39:47'),
	(653, 1, '::1', '/blog/faqs/interview_faqs/jsf', 'http://localhost/blog/faqs/interview_faqs', 'faqs/interview_faqs', 'jsf', 'Mozilla/5.0 (Windows NT 6.1; rv:25.0) Gecko/20100101 Firefox/25.0', 0, '2020-08-12 03:39:47'),
	(654, 1, '::1', '/blog/faqs/interview_faqs/struts2', 'http://localhost/blog/faqs/interview_faqs/jsf', 'faqs/interview_faqs', 'struts2', 'Mozilla/5.0 (Windows NT 6.1; rv:25.0) Gecko/20100101 Firefox/25.0', 0, '2020-08-12 02:39:47'),
	(655, 1, '::1', '/blog/faqs/interview_faqs/hibernate', 'http://localhost/blog/faqs/interview_faqs/struts2', 'faqs/interview_faqs', 'hibernate', 'Mozilla/5.0 (Windows NT 6.1; rv:25.0) Gecko/20100101 Firefox/25.0', 0, '2020-08-12 06:39:47'),
	(656, 1, '::1', '/blog/faqs/interview_faqs/ibatis', 'http://localhost/blog/faqs/interview_faqs/hibernate', 'faqs/interview_faqs', 'ibatis', 'Mozilla/5.0 (Windows NT 6.1; rv:25.0) Gecko/20100101 Firefox/25.0', 0, '2020-08-12 04:39:47'),
	(657, 1, '::1', '/blog/signin', 'http://localhost/blog/faqs/interview_faqs/ibatis', 'signin/index', '', 'Mozilla/5.0 (Windows NT 6.1; rv:25.0) Gecko/20100101 Firefox/25.0', 0, '2020-08-12 04:39:47'),
	(658, 1, '::1', '/blog/account', 'http://localhost/blog/signin', 'account/index', '', 'Mozilla/5.0 (Windows NT 6.1; rv:25.0) Gecko/20100101 Firefox/25.0', 0, '2013-11-09 04:39:53'),
	(659, 1, '::1', 'http://localhost:8080/', '', '\\App\\Controllers\\VisitorController/index', '', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/86.0.4240.75 Safari/537.36', 0, '2021-02-10 16:00:24'),
	(660, 1, '::1', 'http://localhost:8080/', '', '\\App\\Controllers\\VisitorController/index', '', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/88.0.4324.150 Safari/537.36 Edg/88.0.705.63', 0, '2021-02-10 16:06:37'),
	(661, 1, '0.0.0.0', 'http://localhost:8080', '', '\\CodeIgniter\\CLI\\CommandRunner/index', '', '', 0, '2021-02-10 16:08:27'),
	(662, 1, '0.0.0.0', 'http://localhost:8080', '', '\\CodeIgniter\\CLI\\CommandRunner/index', '', '', 0, '2021-02-10 16:10:11'),
	(663, 1, '0.0.0.0', 'http://localhost:8080', '', '\\CodeIgniter\\CLI\\CommandRunner/index', '', '', 0, '2021-02-10 16:11:26'),
	(664, 1, '0.0.0.0', 'http://localhost:8080', '', '\\CodeIgniter\\CLI\\CommandRunner/index', '', '', 0, '2021-02-10 16:12:57');
/*!40000 ALTER TABLE `visitors` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
