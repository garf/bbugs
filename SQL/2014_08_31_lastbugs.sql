SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;


DROP TABLE IF EXISTS `lb_comments`;
CREATE TABLE `lb_comments` (
  `id` int(255) unsigned NOT NULL AUTO_INCREMENT,
  `issue_id` int(255) unsigned DEFAULT NULL,
  `comment` text NOT NULL,
  `creator` int(255) unsigned NOT NULL,
  `created` int(255) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

INSERT INTO `lb_comments` (`id`, `issue_id`, `comment`, `creator`, `created`) VALUES
(1, 2, 'Не понял. опишите подробнее пожалуйста.\r\nВообще желательно на английском. Я не очень в русском секу.', 2, 140247563),
(2, 2, 'Но я же не виноват, что ты не знаешь. Сам виноват.\r\nРешай давай проблему!', 4, 140376837);

DROP TABLE IF EXISTS `lb_contacts`;
CREATE TABLE `lb_contacts` (
  `id` int(255) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(255) NOT NULL,
  `contact_id` int(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `is_email` tinyint(1) DEFAULT '0',
  `is_phone` tinyint(1) DEFAULT '0',
  `is_skype` tinyint(1) NOT NULL DEFAULT '0',
  `notes` varchar(255) NOT NULL,
  `created` int(255) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=15 ;

INSERT INTO `lb_contacts` (`id`, `user_id`, `contact_id`, `title`, `is_email`, `is_phone`, `is_skype`, `notes`, `created`) VALUES
(9, 1, 5, 'Руслан Double Trend', 1, 1, 1, 'Ненадежный. Может подвести в любой момент.', 1409264729),
(12, 1, 4, 'Макс FIX LLC.', 1, 1, 1, 'Крутой программер. Надо нанять.', 1409265155),
(13, 1, 2, 'Серега Канада', 1, 1, 0, 'Свой чувак. Но таки еврей.', 1409356320),
(14, 1, 3, 'Zyluxxx GoonZ', 1, 1, 0, 'Pidr', 1409415491);

DROP TABLE IF EXISTS `lb_files`;
CREATE TABLE `lb_files` (
  `id` int(255) unsigned NOT NULL AUTO_INCREMENT,
  `issue_id` int(255) unsigned NOT NULL,
  `comment_id` int(255) unsigned DEFAULT NULL,
  `filename` varchar(255) NOT NULL,
  `file_title` varchar(255) NOT NULL,
  `file_size` varchar(100) NOT NULL,
  `creator` int(255) unsigned NOT NULL,
  `uploaded` int(255) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

INSERT INTO `lb_files` (`id`, `issue_id`, `comment_id`, `filename`, `file_title`, `file_size`, `creator`, `uploaded`) VALUES
(1, 2, 2, 'sdhbakjsbhdasdf.jpg', 'my_best_man.jpg', '243.2', 4, 234523453),
(2, 2, NULL, 'Hgfsybwiqbhiefw.tar.gz', 'PhpMyAdmin.tar.gz', '2655.7', 1, 2432352);

DROP TABLE IF EXISTS `lb_issues`;
CREATE TABLE `lb_issues` (
  `id` int(255) unsigned NOT NULL AUTO_INCREMENT,
  `project_id` int(255) unsigned NOT NULL,
  `title` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `status` enum('new','opened','in_work','need_feedback','closed','not_actual') NOT NULL DEFAULT 'new',
  `issue_type` enum('task','bug','research') NOT NULL DEFAULT 'task',
  `priority` int(4) NOT NULL DEFAULT '3',
  `creator` int(255) NOT NULL,
  `assigned` int(255) unsigned NOT NULL,
  `created` int(255) NOT NULL,
  `updated` int(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

INSERT INTO `lb_issues` (`id`, `project_id`, `title`, `content`, `status`, `issue_type`, `priority`, `creator`, `assigned`, `created`, `updated`) VALUES
(1, 1, 'Нелимитированный ввод логин', 'Можно ввести большое количество символов в поле логина <br />\r\nВоспроизведение ошибки: Скопировать большой текст, вставить в поле регистрации.', 'in_work', 'task', 2, 1, 1, 1043241234, 1053241234),
(2, 1, 'Можно ввести SQL-иньекцию', 'Не экранирован ввод коментариев. Легко ввести SQL-иньекцию, или XSS-код.\r\nИсправить!', 'new', 'bug', 1, 2, 1, 24123422, 42312344);

DROP TABLE IF EXISTS `lb_projects`;
CREATE TABLE `lb_projects` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `parent_id` int(255) NOT NULL,
  `creator` int(255) unsigned NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `created` int(255) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

INSERT INTO `lb_projects` (`id`, `parent_id`, `creator`, `title`, `description`, `created`) VALUES
(1, 0, 1, 'Double Trend', 'Forex Exper Advisor developemtn and sales.', 0),
(2, 0, 3, 'LastBugs.com', 'Разработка и поддержка проекта Last Bugs Be very careful when echoing content that is supplied by users of your application. Always use the triple curly brace syntax to escape any HTML entities in the content. Sometimes you may wish to echo a variable, but you aren''t sure if the variable has been set. Basically, you want to do thi @yield directive. You may pass the default value as the second argument:', 0);

DROP TABLE IF EXISTS `lb_project_user`;
CREATE TABLE `lb_project_user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `project_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `role` enum('teamlead','developer','observer') NOT NULL DEFAULT 'observer',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

INSERT INTO `lb_project_user` (`id`, `project_id`, `user_id`, `role`) VALUES
(1, 1, 1, 'teamlead'),
(2, 2, 1, 'developer');

DROP TABLE IF EXISTS `lb_settings`;
CREATE TABLE `lb_settings` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `value` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

DROP TABLE IF EXISTS `lb_users`;
CREATE TABLE `lb_users` (
  `id` int(255) unsigned NOT NULL AUTO_INCREMENT,
  `role` varchar(255) NOT NULL DEFAULT 'agent',
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(50) DEFAULT NULL,
  `skype` varchar(200) DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `recover_time` int(255) NOT NULL,
  `remember_token` varchar(120) DEFAULT NULL,
  `reg_date` int(255) NOT NULL,
  `last_access` int(255) NOT NULL,
  `last_ip` varchar(80) DEFAULT NULL,
  `updated_at` date NOT NULL,
  `status` enum('1','0','2') NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=10 ;

INSERT INTO `lb_users` (`id`, `role`, `name`, `email`, `phone`, `skype`, `password`, `recover_time`, `remember_token`, `reg_date`, `last_access`, `last_ip`, `updated_at`, `status`) VALUES
(1, 'teamlead', 'Динар Гарипов', 'garipov.dinar@gmail.com', '79196390302', NULL, '$2y$10$klh/EJog7rozEwRdK8er8up7Pbq69vM7jjFt8uAk9tN3zZgydB.Fi', 0, 'yg2vgfA4Eave45vazSag5LJFw34gubUX6oDNsqbehHmp7wgYtrTmedHgVNkH', 1403700187, 1409428419, '127.0.0.1', '2014-08-30', '1'),
(2, 'teamlead', 'Сергей Биндер', 't88855@gmail.com', '79153032106', NULL, '$2y$10$LwcOSKpFkoWMEwsKsABHwOy2ao7qCM5mY9npt66rUaBOeR0mHisSq', 0, '3wixIGK7i2CEPyFpBZ7ORZdNBfrKW49eEDUv6VWp1C2OBHtsqx8f11HF6vWZ', 1402700187, 1409172056, '127.0.0.1', '2014-08-28', '1'),
(3, 'teamlead', 'Zyluxxx GoonZ', 'ragament@gmail.com', '14158764498', 'syluxx', '$2y$10$FlGbPfIbR.b5vo0S1E8ECecRERofVCnxncaxj2MnynIqwmafiybZS', 0, '3wixIGK7i2CEPyFpBZ7ORZdNBfrKW49eEDUv6VWp1C2OBHtsqx8f11HF6vWZ', 1405700187, 1409172056, '127.0.0.1', '2014-08-28', '1'),
(4, 'teamlead', 'Максим Зималиев', 'zimaliev@gmail.com', '79043225496', NULL, '$2y$10$klh/EJog7rozEwRdK8er8up7Pbq69vM7jjFt8uAk9tN3zZgydB.Fi', 10, '3wixIGK7i2CEPyFpBZ7ORZdNBfrKW49eEDUv6VWp1C2OBHtsqx8f11HF6vWZ', 1403700187, 1404172056, '117.200.37.11', '2014-08-28', '1'),
(5, 'teamlead', 'Руслан Хуснутдинов', 'rus-clon@yandex.ru', NULL, 'rus-clon', '$2y$10$1jcpGr9RcFF3fTjDV3PubejMfEr1ncGk4qdK9If2B4TETEG0UHKUa', 0, '3wixIGK7i2CEPyFpBZ7ORZdNBfrKW49eEDUv6VWp1C2OBHtsqx8f11HF6vWZ', 1403600187, 1404172056, '37.110.17.149', '2014-08-28', '1'),
(9, 'agent', 'Николай Хворостов', 'nikhvorostov@gmail.com', NULL, NULL, '$2y$10$N9WIEisrfHgxjcZgajQV9ev7JaQs91GVzpws1vvjGNcx0m4X3vgj.', 0, 'Sv39v0ivPvmXDouZmms0muqElFf7EDDasRi9wai8xSvlGyS3U70JPWRpLRqL', 1409429183, 1409429233, '127.0.0.1', '2014-08-31', '1');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
