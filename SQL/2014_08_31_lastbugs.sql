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
  `files_count` int(20) NOT NULL DEFAULT '0',
  `creator` int(255) unsigned NOT NULL,
  `created` int(255) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=18 ;

INSERT INTO `lb_comments` (`id`, `issue_id`, `comment`, `files_count`, `creator`, `created`) VALUES
(1, 2, 'Не понял. опишите подробнее пожалуйста.\r\nВообще желательно на английском. Я не очень в русском секу.', 0, 2, 140247563),
(2, 2, 'Но я же не виноват, что ты не знаешь. Сам виноват.\r\nРешай давай проблему!', 0, 4, 140376837),
(5, 2, '<pre><code class="php">\r\n&lt;?php \r\n\r\n    for ($i=0; $i &lt; 10; $i++) {\r\n\r\n        echo Foo::bar($i);\r\n\r\n    }\r\n\r\n?&gt;\r\n</code></pre>', 0, 1, 1409437985),
(6, 2, 'А вот мой пример.\r\nТут перенос.\r\n\r\nТут 2 переноса.\r\n<pre><code class="php">&lt;?php\r\ninterface Product{\r\n    public function GetName();\r\n}\r\n \r\nclass ConcreteProductA implements Product{\r\n    public function GetName() { return &quot;ProductA&quot;; }\r\n} \r\n \r\nclass ConcreteProductB implements Product{\r\n    public function GetName() { return &quot;ProductB&quot;; }\r\n}\r\n \r\ninterface Creator{\r\n    public function FactoryMethod();\r\n} \r\n \r\nclass ConcreteCreatorA implements Creator{\r\n    public function FactoryMethod() { return new ConcreteProductA(); }\r\n}\r\n \r\nclass ConcreteCreatorB implements Creator{\r\n    public function FactoryMethod() { return new ConcreteProductB(); }\r\n}\r\n \r\n// An array of creators\r\n$creators = array( new ConcreteCreatorA(), new ConcreteCreatorB() );\r\n// Iterate over creators and create products\r\nfor($i = 0; $i &lt; count($creators); $i++){\r\n    $products[] = $creators[$i]-&gt;FactoryMethod();\r\n}\r\n \r\nheader(&quot;content-type:text/plain&quot;);\r\necho var_export($products);\r\n \r\n?&gt;\r\n</code></pre>', 0, 1, 1409438101),
(7, 2, 'Хочу \r<br />протестить\r<br />\r<br />Это\r<br /><pre><code>\r{\r	&quot;name&quot;: &quot;laravel/laravel&quot;,\r	&quot;description&quot;: &quot;The Laravel Framework.&quot;,\r	&quot;keywords&quot;: [&quot;framework&quot;, &quot;laravel&quot;],\r	&quot;license&quot;: &quot;MIT&quot;,\r	&quot;require&quot;: {\r		&quot;laravel/framework&quot;: &quot;4.2.<strong>&quot;,\r        &quot;barryvdh/laravel-debugbar&quot;: &quot;1.</strong>&quot;,\r        &quot;mews/captcha&quot;: &quot;dev-master&quot;,\r        &quot;torann/geoip&quot;: &quot;dev-master&quot;,\r        &quot;thomaswelton/laravel-gravatar&quot;: &quot;0.1.x&quot;\r    },\r	&quot;autoload&quot;: {\r		&quot;classmap&quot;: [\r			&quot;app/commands&quot;,\r			&quot;app/controllers&quot;,\r			&quot;app/models&quot;,\r			&quot;app/database/migrations&quot;,\r			&quot;app/database/seeds&quot;,\r			&quot;app/tests/TestCase.php&quot;\r		]\r	},\r	&quot;scripts&quot;: {\r		&quot;post-install-cmd&quot;: [\r			&quot;php artisan clear-compiled&quot;,\r			&quot;php artisan optimize&quot;\r\r		],\r		&quot;post-update-cmd&quot;: [\r			&quot;php artisan clear-compiled&quot;,\r			&quot;php artisan optimize&quot;,\r            &quot;php artisan debugbar:publish&quot;\r		],\r		&quot;post-create-project-cmd&quot;: [\r			&quot;php artisan key:generate&quot;\r		]\r	},\r	&quot;config&quot;: {\r		&quot;preferred-install&quot;: &quot;dist&quot;\r	},\r	&quot;minimum-stability&quot;: &quot;stable&quot;\r}\r</code></pre>\r<br />Это JSON\r<br />Прямо из моей IDE', 0, 1, 1409438842),
(8, 2, '<pre><code class="json">\r{\r    &quot;name&quot;: &quot;laravel/laravel&quot;,\r    &quot;description&quot;: &quot;The Laravel Framework.&quot;,\r    &quot;keywords&quot;: [&quot;framework&quot;, &quot;laravel&quot;],\r    &quot;license&quot;: &quot;MIT&quot;,\r    &quot;require&quot;: {\r        &quot;laravel/framework&quot;: &quot;4.2.<strong>&quot;,\r        &quot;barryvdh/laravel-debugbar&quot;: &quot;1.</strong>&quot;,\r        &quot;mews/captcha&quot;: &quot;dev-master&quot;,\r        &quot;torann/geoip&quot;: &quot;dev-master&quot;,\r        &quot;thomaswelton/laravel-gravatar&quot;: &quot;0.1.x&quot;\r    },\r    &quot;autoload&quot;: {\r        &quot;classmap&quot;: [\r            &quot;app/commands&quot;,\r            &quot;app/controllers&quot;,\r            &quot;app/models&quot;,\r            &quot;app/database/migrations&quot;,\r            &quot;app/database/seeds&quot;,\r            &quot;app/tests/TestCase.php&quot;\r        ]\r    },\r    &quot;scripts&quot;: {\r        &quot;post-install-cmd&quot;: [\r            &quot;php artisan clear-compiled&quot;,\r            &quot;php artisan optimize&quot;\r    \r        ],\r        &quot;post-update-cmd&quot;: [\r            &quot;php artisan clear-compiled&quot;,\r            &quot;php artisan optimize&quot;,\r            &quot;php artisan debugbar:publish&quot;\r        ],\r        &quot;post-create-project-cmd&quot;: [\r            &quot;php artisan key:generate&quot;\r        ]\r    },\r    &quot;config&quot;: {\r        &quot;preferred-install&quot;: &quot;dist&quot;\r    },\r    &quot;minimum-stability&quot;: &quot;stable&quot;\r}\r\r</code></pre>', 0, 1, 1409438923),
(9, 2, 'Вот типа того', 0, 1, 1409439082),
(10, 2, '&lt;script&gt;alert(&#039;HACK!&#039;);&lt;/script&gt;', 0, 1, 1409439120),
(16, 1, '', 3, 1, 1409445623),
(17, 1, '', 1, 1, 1409445661);

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
(14, 1, 3, 'Zyluxxx', 1, 1, 0, 'Pidr', 1409415491);

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=16 ;

INSERT INTO `lb_files` (`id`, `issue_id`, `comment_id`, `filename`, `file_title`, `file_size`, `creator`, `uploaded`) VALUES
(1, 2, 2, 'sdhbakjsbhdasdf.jpg', 'my_best_man.jpg', '243.2', 4, 234523453),
(2, 2, NULL, 'Hgfsybwiqbhiefw.tar.gz', 'PhpMyAdmin.tar.gz', '2655.7', 1, 2432352),
(3, 1, 12, '68beb31081d7c14d93f64978f367f9c7.jpg', 'ava.jpg', '98.4130859375', 1, 1409443176),
(4, 1, 12, 'fc3fce8fb100cab5f1f015e77a30aef4.doc', '30%.doc', '20', 1, 1409443176),
(5, 1, 12, 'd3ee51f967f50db19d04703e2575eed0.zip', 'DT_Insta_24.zip', '66.0390625', 1, 1409443176),
(6, 1, 13, '0684d4c3a3b5c1bbef5dac8c9f17b7f1.doc', '30%.doc', '20', 1, 1409444838),
(7, 1, 13, '8549cad5413bdda99f51ab40dd809835.mq4', 'DoubleTrend.mq4', '80.87109375', 1, 1409444838),
(8, 1, 13, '0da94664e759586b99a4c066ae8c657e.zip', 'DT_Insta_24.zip', '66.0390625', 1, 1409444838),
(9, 1, 14, 'fd3c506f31fa508b65c597a2e5d209e7.jpg', '552800.jpg', '83.802734375', 1, 1409444890),
(10, 1, 14, 'eca83fba01af15a6d5a0d323f76443cc.mq4', 'DoubleTrend.mq4', '80.87109375', 1, 1409444890),
(11, 1, 15, 'ca9b04478f9ac373df1e8b81546bf9fc.jpg', '552800.jpg', '83.802734375', 1, 1409445249),
(12, 1, 16, '3af47699ba95daaa4f39543f8dbdd36d.jpg', '1.jpg', '40.6845703125', 1, 1409445623),
(13, 1, 16, 'ea183255fad9d49a43df7c29b444196c.jpg', 'ava.jpg', '98.4130859375', 1, 1409445623),
(14, 1, 16, 'fa12ecea3013b9efa8ed5b38dfb282f4.jpg', 'Doobacco_16-600x600.jpg', '39.93359375', 1, 1409445623),
(15, 1, 17, '367ab84a59527f9b4f6cfb7425f0c5b7.doc', '30%.doc', '20', 1, 1409445661);

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
(1, 1, 'Нелимитированный ввод логин', 'Можно ввести большое количество символов в поле логина <br />\r\nВоспроизведение ошибки: Скопировать большой текст, вставить в поле регистрации.', 'in_work', 'task', 2, 1, 1, 1043241234, 1409445661),
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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

INSERT INTO `lb_project_user` (`id`, `project_id`, `user_id`, `role`) VALUES
(1, 1, 1, 'teamlead'),
(2, 2, 1, 'developer'),
(3, 1, 3, 'developer'),
(4, 1, 9, 'developer');

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
(1, 'teamlead', 'Динар Гарипов', 'garipov.dinar@gmail.com', '79196390302', NULL, '$2y$10$klh/EJog7rozEwRdK8er8up7Pbq69vM7jjFt8uAk9tN3zZgydB.Fi', 0, 'yg2vgfA4Eave45vazSag5LJFw34gubUX6oDNsqbehHmp7wgYtrTmedHgVNkH', 1403700187, 1409435028, '127.0.0.1', '2014-08-31', '1'),
(2, 'teamlead', 'Сергей Биндер', 't88855@gmail.com', '79153032106', NULL, '$2y$10$LwcOSKpFkoWMEwsKsABHwOy2ao7qCM5mY9npt66rUaBOeR0mHisSq', 0, '3wixIGK7i2CEPyFpBZ7ORZdNBfrKW49eEDUv6VWp1C2OBHtsqx8f11HF6vWZ', 1402700187, 1409172056, '127.0.0.1', '2014-08-28', '1'),
(3, 'teamlead', 'Zyluxxx GoonZ', 'ragament@gmail.com', '14158764498', 'syluxx', '$2y$10$FlGbPfIbR.b5vo0S1E8ECecRERofVCnxncaxj2MnynIqwmafiybZS', 0, '3wixIGK7i2CEPyFpBZ7ORZdNBfrKW49eEDUv6VWp1C2OBHtsqx8f11HF6vWZ', 1405700187, 1409172056, '127.0.0.1', '2014-08-28', '1'),
(4, 'teamlead', 'Максим Зималиев', 'zimaliev@gmail.com', '79043225496', NULL, '$2y$10$klh/EJog7rozEwRdK8er8up7Pbq69vM7jjFt8uAk9tN3zZgydB.Fi', 10, '3wixIGK7i2CEPyFpBZ7ORZdNBfrKW49eEDUv6VWp1C2OBHtsqx8f11HF6vWZ', 1403700187, 1404172056, '117.200.37.11', '2014-08-28', '1'),
(5, 'teamlead', 'Руслан Хуснутдинов', 'rus-clon@yandex.ru', NULL, 'rus-clon', '$2y$10$1jcpGr9RcFF3fTjDV3PubejMfEr1ncGk4qdK9If2B4TETEG0UHKUa', 0, '3wixIGK7i2CEPyFpBZ7ORZdNBfrKW49eEDUv6VWp1C2OBHtsqx8f11HF6vWZ', 1403600187, 1404172056, '37.110.17.149', '2014-08-28', '1'),
(9, 'agent', 'Николай Хворостов', 'nikhvorostov@gmail.com', NULL, NULL, '$2y$10$N9WIEisrfHgxjcZgajQV9ev7JaQs91GVzpws1vvjGNcx0m4X3vgj.', 0, 'Sv39v0ivPvmXDouZmms0muqElFf7EDDasRi9wai8xSvlGyS3U70JPWRpLRqL', 1409429183, 1409429233, '127.0.0.1', '2014-08-31', '1');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
