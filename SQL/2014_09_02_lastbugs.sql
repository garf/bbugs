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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=39 ;

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
(17, 1, '', 1, 1, 1409445661),
(18, 2, 'd<em>asd</em> a<s>sd as</s>d', 1, 1, 1409620748),
(19, 2, 'd<em>asd</em> a<s>sd as</s>d', 1, 1, 1409620840),
(20, 2, '<h1>sfsdf</h1>\r<br /><h2>sdfsdf</h2>\r<br /><h3>dfgh, ,spl,</h3>', 1, 1, 1409620865),
(21, 2, 'Jgbhjs <pre><code>jshbdjfs</code></pre> jjsdfs', 1, 1, 1409620998),
(22, 2, 'Ntcnbyu', 0, 1, 1409621055),
(23, 2, '', 0, 1, 1409621060),
(24, 2, '<h1>Request Information</h1>\r<br />\r<br />The Request class provides many methods for examining the HTTP request for your application and extends the <em>Symfony\\Component\\HttpFoundation\\Request</em> class. Here are some of the highlights.\r<br /><h2>Retrieving The Request URI</h2>\r<br /><pre><code class<h3>"php">\r$uri </h3> Request::path();\r</code></pre>\r<br />\r<br /><h3>Retrieving The Request Method</h3>', 0, 1, 1409621586),
(25, 2, '<h1>Request Information</h1>\r<br />\r<br />The Request class provides many methods for examining the HTTP request for your application and extends the <em>Symfony\\Component\\HttpFoundation\\Request</em> class. Here are some of the highlights.\r<br /><h2>Retrieving The Request URI</h2>\r<br /><pre><code class<h3>"php">\r$uri </h3> Request::path();\r</code></pre>\r<br />\r<br /><h3>Retrieving The Request Method</h3>', 0, 1, 1409621597),
(26, 2, 's<pre><code class="php">dfgsdfgsd</code></pre>', 0, 1, 1409621659),
(27, 2, '<pre><code class<h3>"php">$uri </h3> Request::path();</code></pre>', 0, 1, 1409621706),
(28, 2, '<pre><code class="php">$uri = Request::path();</code></pre>', 0, 1, 1409621804),
(29, 2, '<pre><code class="php">$uri = Request::path();</code></pre>\r<br /><pre><code class="php">$uri = Request::path();</code></pre>', 0, 1, 1409621818),
(30, 2, 'sfsdf\r<br /><span style="text-decoration: underline;">sdfsdf</span>\r<br />dfgh, ,spl,', 0, 1, 1409623861),
(31, 2, 'sfsdf\r<br /><span style="text-decoration: underline;">sdfsdf</span>\r<br />dfgh, ,spl,', 0, 1, 1409623886),
(32, 1, '<pre><code> $c = 0.5; @\r@=php $c = 0.5; </code></pre>', 0, 1, 1409637653),
(33, 1, '<pre><code> $y = 5 + $t; </code></pre>\r<br /><pre><code class="php"> function x($y) {\r    echo &quot;Hello world!&quot;;\r} </code></pre>', 0, 1, 1409637737),
(34, 1, '<pre><code> \rsdf@ \rfsdf\r @\r </code></pre>', 0, 1, 1409637876),
(35, 1, '', 2, 1, 1409640022),
(36, 1, 'sdf<pre><code> \rfsdf\r </code></pre>', 0, 1, 1409641969),
(37, 5, '', 1, 1, 1409648949),
(38, 8, '<h1>14233_blalog</h1>', 0, 1, 1409649718);

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
  `salt` varchar(255) NOT NULL,
  `creator` int(255) unsigned NOT NULL,
  `uploaded` int(255) unsigned NOT NULL,
  `status` enum('1','0') NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=23 ;

INSERT INTO `lb_files` (`id`, `issue_id`, `comment_id`, `filename`, `file_title`, `file_size`, `salt`, `creator`, `uploaded`, `status`) VALUES
(16, 1, 35, 'd598aebace96cd0cae8542ec7faf96c0.jpg', 'ava.jpg', '98.4130859375', 'eab3ef5b5c', 1, 1409640022, '1'),
(17, 1, 35, 'e8cc4c3a0f18bad528fdeee13c7d3666.doc', '30.doc', '20', '', 1, 1409640022, '1'),
(18, 5, 37, 'd3856a91d8267ced58e4d0775a941c08.jpg', '1.jpg', '40.6845703125', 'e26bb51b45', 1, 1409648949, '1'),
(19, 7, NULL, 'f9a7c90da3006dde67232f12a13d9281.zip', 'DT_Insta_24.zip', '66.0390625', '42d70f40ca', 1, 1409649340, '1'),
(20, 7, NULL, '67f2c1a94a5b89f2963b57bba7ffa953.csv', 'fetchcsv.csv', '6.43359375', '231b8fb499', 1, 1409649340, '1'),
(21, 8, NULL, '068fb4a34d4881c4c78bd071796d8422.jpg', 'ava.jpg', '98.4130859375', '407a665efb', 1, 1409649397, '1'),
(22, 8, NULL, '68ad9cbbcb98543b63cdd27fba7b5692.jpg', '552800.jpg', '83.802734375', 'dbb98ed987', 1, 1409649397, '1');

DROP TABLE IF EXISTS `lb_history`;
CREATE TABLE `lb_history` (
  `id` int(255) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(255) unsigned NOT NULL,
  `project_id` int(255) unsigned NOT NULL,
  `issue_id` int(255) unsigned NOT NULL,
  `act_type` enum('new_issue','new_file','new_comment','issue_change') NOT NULL,
  `act_time` int(255) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

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
  `updated_at` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=9 ;

INSERT INTO `lb_issues` (`id`, `project_id`, `title`, `content`, `status`, `issue_type`, `priority`, `creator`, `assigned`, `created`, `updated`, `updated_at`) VALUES
(1, 1, 'Нелимитированный ввод логин', 'Можно ввести большое количество символов в поле логина <br />\r\nВоспроизведение ошибки: Скопировать большой текст, вставить в поле регистрации.', 'in_work', 'task', 2, 1, 1, 1043241234, 1409445661, '0000-00-00'),
(2, 1, 'Можно ввести SQL-иньекцию', 'Не экранирован ввод коментариев. Легко ввести SQL-иньекцию, или XSS-код.\r\nИсправить!', 'in_work', 'bug', 4, 2, 9, 24123422, 1409622394, '2014-09-02'),
(3, 7, 'Not My Issue', 'Content of not mine issue', 'in_work', 'research', 3, 3, 3, 234523453, 1447483647, '0000-00-00'),
(4, 1, 'Проверочная задача', 'Текст проверочной задачи\r<br /><strong>Жирный шрифт</strong>\r<br /><h2>Большой шрифт</h2>\r<br />Немного кода JS\r<br /><pre><code> function NewIssueController($scope) {\r\r    $scope.lines = [];\r\r    $scope.addFile = function() {\r        $scope.lines.push($scope.lines.length+1);\r\r    };\r\r    $scope.removeFile = function(index) {\r        $scope.lines.splice(index, 1);\r    };\r\r    $scope.isMaxMessage = function() {\r        var max = $(&#039;#maxFiles&#039;).val();\r        return $scope.lines.length &gt;= (max - 1);\r    }\r}\r$(document).ready(function(){\r    $(&quot;#contentTextarea&quot;).markupy();\r}); </code></pre>', 'opened', 'task', 5, 1, 1, 1409648453, 1409648453, '2014-09-02'),
(5, 8, 'Something Wrong With Files uploading', 'Please Check', 'opened', 'task', 2, 1, 1, 1409648713, 1409648713, '0000-00-00'),
(6, 8, 'My best Song Ever', 'My files uploaded successfuly! :)', 'closed', 'task', 4, 1, 1, 1409649318, 1409649318, '2014-09-02'),
(7, 8, 'My best Song Ever', 'My files uploaded successfuly! :)', 'need_feedback', 'task', 4, 1, 1, 1409649340, 1409649340, '0000-00-00'),
(8, 8, 'Status testing', '<h1>Blabla</h1>', 'opened', 'research', 1, 1, 1, 1409649397, 1409649397, '2014-09-02');

DROP TABLE IF EXISTS `lb_projects`;
CREATE TABLE `lb_projects` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `parent_id` int(255) NOT NULL DEFAULT '0',
  `creator` int(255) unsigned NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `created` int(255) unsigned NOT NULL,
  `updated_at` date NOT NULL,
  `status` enum('1','0') NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=9 ;

INSERT INTO `lb_projects` (`id`, `parent_id`, `creator`, `title`, `description`, `created`, `updated_at`, `status`) VALUES
(1, 0, 1, 'Double Trend', 'Forex Exper Advisor developemtn and sales.', 0, '0000-00-00', '1'),
(2, 0, 3, 'LastBugs.com', 'Разработка и поддержка проекта Last Bugs Be very careful when echoing content that is supplied by users of your application. Always use the triple curly brace syntax to escape any HTML entities in the content. Sometimes you may wish to echo a variable, but you aren''t sure if the variable has been set. Basically, you want to do thi @yield directive. You may pass the default value as the second argument:', 0, '0000-00-00', '1'),
(7, 0, 3, 'Not my project', 'FOFOFOFOOOO', 1409635614, '0000-00-00', '1'),
(8, 0, 1, 'New test Project', 'Place issues Here please', 1409637947, '0000-00-00', '1');

DROP TABLE IF EXISTS `lb_project_user`;
CREATE TABLE `lb_project_user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `project_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `role` enum('teamlead','developer','observer') NOT NULL DEFAULT 'observer',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=12 ;

INSERT INTO `lb_project_user` (`id`, `project_id`, `user_id`, `role`) VALUES
(1, 1, 1, 'teamlead'),
(2, 2, 1, 'developer'),
(3, 1, 3, 'developer'),
(4, 1, 9, 'developer'),
(5, 3, 1, 'teamlead'),
(6, 4, 1, 'teamlead'),
(7, 5, 1, 'teamlead'),
(8, 6, 1, 'teamlead'),
(9, 7, 3, 'teamlead'),
(10, 8, 1, 'teamlead'),
(11, 1, 3, 'developer');

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
(1, 'teamlead', 'Динар Гарипов', 'garipov.dinar@gmail.com', '79196390302', NULL, '$2y$10$R5GJnRm.dY/mszPUEkYJFu.8axVmKtfyfpDdQO846HXhJ3tbGRnoK', 1409618516, '6UgLeH3MLl3MCLFx8uHjfon3dTaeOj2rybIZSyU9Q5AQGtOcVhJKQp7Sbkoy', 1403700187, 1409616616, '127.0.0.1', '2014-09-02', '1'),
(2, 'teamlead', 'Сергей Биндер', 't88855@gmail.com', '79153032106', NULL, '$2y$10$LwcOSKpFkoWMEwsKsABHwOy2ao7qCM5mY9npt66rUaBOeR0mHisSq', 0, '3wixIGK7i2CEPyFpBZ7ORZdNBfrKW49eEDUv6VWp1C2OBHtsqx8f11HF6vWZ', 1402700187, 1409172056, '127.0.0.1', '2014-08-28', '1'),
(3, 'teamlead', 'Zyluxxx GoonZ', 'ragament@gmail.com', '14158764498', 'syluxx', '$2y$10$FlGbPfIbR.b5vo0S1E8ECecRERofVCnxncaxj2MnynIqwmafiybZS', 0, '3wixIGK7i2CEPyFpBZ7ORZdNBfrKW49eEDUv6VWp1C2OBHtsqx8f11HF6vWZ', 1405700187, 1409172056, '127.0.0.1', '2014-08-28', '1'),
(4, 'teamlead', 'Максим Зималиев', 'zimaliev@gmail.com', '79043225496', NULL, '$2y$10$klh/EJog7rozEwRdK8er8up7Pbq69vM7jjFt8uAk9tN3zZgydB.Fi', 10, '3wixIGK7i2CEPyFpBZ7ORZdNBfrKW49eEDUv6VWp1C2OBHtsqx8f11HF6vWZ', 1403700187, 1404172056, '117.200.37.11', '2014-08-28', '1'),
(5, 'teamlead', 'Руслан Хуснутдинов', 'rus-clon@yandex.ru', NULL, 'rus-clon', '$2y$10$1jcpGr9RcFF3fTjDV3PubejMfEr1ncGk4qdK9If2B4TETEG0UHKUa', 0, '3wixIGK7i2CEPyFpBZ7ORZdNBfrKW49eEDUv6VWp1C2OBHtsqx8f11HF6vWZ', 1403600187, 1404172056, '37.110.17.149', '2014-08-28', '1'),
(9, 'agent', 'Николай Хворостов', 'nikhvorostov@gmail.com', NULL, NULL, '$2y$10$N9WIEisrfHgxjcZgajQV9ev7JaQs91GVzpws1vvjGNcx0m4X3vgj.', 0, 'Sv39v0ivPvmXDouZmms0muqElFf7EDDasRi9wai8xSvlGyS3U70JPWRpLRqL', 1409429183, 1409429233, '127.0.0.1', '2014-08-31', '1');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
