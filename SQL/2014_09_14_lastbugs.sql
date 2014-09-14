SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;


DROP TABLE IF EXISTS `lb_assigned_roles`;
CREATE TABLE `lb_assigned_roles` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned NOT NULL,
  `role_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `assigned_roles_user_id_foreign` (`user_id`),
  KEY `assigned_roles_role_id_foreign` (`role_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

DROP TABLE IF EXISTS `lb_comments`;
CREATE TABLE `lb_comments` (
  `id` int(255) unsigned NOT NULL AUTO_INCREMENT,
  `issue_id` int(255) unsigned DEFAULT NULL,
  `comment` text NOT NULL,
  `files_count` int(20) NOT NULL DEFAULT '0',
  `creator` int(255) unsigned NOT NULL,
  `created` int(255) unsigned NOT NULL,
  `updated_at` date NOT NULL,
  `status` enum('1','0') NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=46 ;

INSERT INTO `lb_comments` (`id`, `issue_id`, `comment`, `files_count`, `creator`, `created`, `updated_at`, `status`) VALUES
(1, 2, 'Не понял. опишите подробнее пожалуйста.\r\nВообще желательно на английском. Я не очень в русском секу.', 0, 2, 140247563, '0000-00-00', '1'),
(2, 2, 'Но я же не виноват, что ты не знаешь. Сам виноват.\r\nРешай давай проблему!', 0, 4, 140376837, '0000-00-00', '1'),
(5, 2, '<pre><code class="php">\r\n&lt;?php \r\n\r\n    for ($i=0; $i &lt; 10; $i++) {\r\n\r\n        echo Foo::bar($i);\r\n\r\n    }\r\n\r\n?&gt;\r\n</code></pre>', 0, 1, 1409437985, '0000-00-00', '1'),
(6, 2, 'А вот мой пример.\r\nТут перенос.\r\n\r\nТут 2 переноса.\r\n<pre><code class="php">&lt;?php\r\ninterface Product{\r\n    public function GetName();\r\n}\r\n \r\nclass ConcreteProductA implements Product{\r\n    public function GetName() { return &quot;ProductA&quot;; }\r\n} \r\n \r\nclass ConcreteProductB implements Product{\r\n    public function GetName() { return &quot;ProductB&quot;; }\r\n}\r\n \r\ninterface Creator{\r\n    public function FactoryMethod();\r\n} \r\n \r\nclass ConcreteCreatorA implements Creator{\r\n    public function FactoryMethod() { return new ConcreteProductA(); }\r\n}\r\n \r\nclass ConcreteCreatorB implements Creator{\r\n    public function FactoryMethod() { return new ConcreteProductB(); }\r\n}\r\n \r\n// An array of creators\r\n$creators = array( new ConcreteCreatorA(), new ConcreteCreatorB() );\r\n// Iterate over creators and create products\r\nfor($i = 0; $i &lt; count($creators); $i++){\r\n    $products[] = $creators[$i]-&gt;FactoryMethod();\r\n}\r\n \r\nheader(&quot;content-type:text/plain&quot;);\r\necho var_export($products);\r\n \r\n?&gt;\r\n</code></pre>', 0, 1, 1409438101, '0000-00-00', '1'),
(7, 2, 'Хочу \r<br />протестить\r<br />\r<br />Это\r<br /><pre><code>\r{\r	&quot;name&quot;: &quot;laravel/laravel&quot;,\r	&quot;description&quot;: &quot;The Laravel Framework.&quot;,\r	&quot;keywords&quot;: [&quot;framework&quot;, &quot;laravel&quot;],\r	&quot;license&quot;: &quot;MIT&quot;,\r	&quot;require&quot;: {\r		&quot;laravel/framework&quot;: &quot;4.2.<strong>&quot;,\r        &quot;barryvdh/laravel-debugbar&quot;: &quot;1.</strong>&quot;,\r        &quot;mews/captcha&quot;: &quot;dev-master&quot;,\r        &quot;torann/geoip&quot;: &quot;dev-master&quot;,\r        &quot;thomaswelton/laravel-gravatar&quot;: &quot;0.1.x&quot;\r    },\r	&quot;autoload&quot;: {\r		&quot;classmap&quot;: [\r			&quot;app/commands&quot;,\r			&quot;app/controllers&quot;,\r			&quot;app/models&quot;,\r			&quot;app/database/migrations&quot;,\r			&quot;app/database/seeds&quot;,\r			&quot;app/tests/TestCase.php&quot;\r		]\r	},\r	&quot;scripts&quot;: {\r		&quot;post-install-cmd&quot;: [\r			&quot;php artisan clear-compiled&quot;,\r			&quot;php artisan optimize&quot;\r\r		],\r		&quot;post-update-cmd&quot;: [\r			&quot;php artisan clear-compiled&quot;,\r			&quot;php artisan optimize&quot;,\r            &quot;php artisan debugbar:publish&quot;\r		],\r		&quot;post-create-project-cmd&quot;: [\r			&quot;php artisan key:generate&quot;\r		]\r	},\r	&quot;config&quot;: {\r		&quot;preferred-install&quot;: &quot;dist&quot;\r	},\r	&quot;minimum-stability&quot;: &quot;stable&quot;\r}\r</code></pre>\r<br />Это JSON\r<br />Прямо из моей IDE', 0, 1, 1409438842, '2014-09-07', '0'),
(8, 2, '<pre><code class="json">\r{\r    &quot;name&quot;: &quot;laravel/laravel&quot;,\r    &quot;description&quot;: &quot;The Laravel Framework.&quot;,\r    &quot;keywords&quot;: [&quot;framework&quot;, &quot;laravel&quot;],\r    &quot;license&quot;: &quot;MIT&quot;,\r    &quot;require&quot;: {\r        &quot;laravel/framework&quot;: &quot;4.2.<strong>&quot;,\r        &quot;barryvdh/laravel-debugbar&quot;: &quot;1.</strong>&quot;,\r        &quot;mews/captcha&quot;: &quot;dev-master&quot;,\r        &quot;torann/geoip&quot;: &quot;dev-master&quot;,\r        &quot;thomaswelton/laravel-gravatar&quot;: &quot;0.1.x&quot;\r    },\r    &quot;autoload&quot;: {\r        &quot;classmap&quot;: [\r            &quot;app/commands&quot;,\r            &quot;app/controllers&quot;,\r            &quot;app/models&quot;,\r            &quot;app/database/migrations&quot;,\r            &quot;app/database/seeds&quot;,\r            &quot;app/tests/TestCase.php&quot;\r        ]\r    },\r    &quot;scripts&quot;: {\r        &quot;post-install-cmd&quot;: [\r            &quot;php artisan clear-compiled&quot;,\r            &quot;php artisan optimize&quot;\r    \r        ],\r        &quot;post-update-cmd&quot;: [\r            &quot;php artisan clear-compiled&quot;,\r            &quot;php artisan optimize&quot;,\r            &quot;php artisan debugbar:publish&quot;\r        ],\r        &quot;post-create-project-cmd&quot;: [\r            &quot;php artisan key:generate&quot;\r        ]\r    },\r    &quot;config&quot;: {\r        &quot;preferred-install&quot;: &quot;dist&quot;\r    },\r    &quot;minimum-stability&quot;: &quot;stable&quot;\r}\r\r</code></pre>', 0, 1, 1409438923, '0000-00-00', '1'),
(9, 2, 'Вот типа того', 0, 1, 1409439082, '2014-09-07', '0'),
(10, 2, '&lt;script&gt;alert(&#039;HACK!&#039;);&lt;/script&gt;', 0, 1, 1409439120, '2014-09-07', '0'),
(18, 2, 'd<em>asd</em> a<s>sd as</s>d', 1, 1, 1409620748, '2014-09-07', '0'),
(19, 2, 'd<em>asd</em> a<s>sd as</s>d', 1, 1, 1409620840, '2014-09-07', '0'),
(20, 2, '<h1>sfsdf</h1>\r<br /><h2>sdfsdf</h2>\r<br /><h3>dfgh, ,spl,</h3>', 1, 1, 1409620865, '2014-09-07', '0'),
(21, 2, 'Jgbhjs <pre><code>jshbdjfs</code></pre> jjsdfs', 1, 1, 1409620998, '2014-09-07', '0'),
(22, 2, 'Ntcnbyu', 0, 1, 1409621055, '2014-09-07', '0'),
(23, 2, '', 0, 1, 1409621060, '2014-09-07', '0'),
(24, 2, '<h1>Request Information</h1>\r<br />\r<br />The Request class provides many methods for examining the HTTP request for your application and extends the <em>Symfony\\Component\\HttpFoundation\\Request</em> class. Here are some of the highlights.\r<br /><h2>Retrieving The Request URI</h2>\r<br /><pre><code class<h3>"php">\r$uri </h3> Request::path();\r</code></pre>\r<br />\r<br /><h3>Retrieving The Request Method</h3>', 0, 1, 1409621586, '0000-00-00', '1'),
(25, 2, '<h1>Request Information</h1>\r<br />\r<br />The Request class provides many methods for examining the HTTP request for your application and extends the <em>Symfony\\Component\\HttpFoundation\\Request</em> class. Here are some of the highlights.\r<br /><h2>Retrieving The Request URI</h2>\r<br /><pre><code class<h3>"php">\r$uri </h3> Request::path();\r</code></pre>\r<br />\r<br /><h3>Retrieving The Request Method</h3>', 0, 1, 1409621597, '2014-09-07', '0'),
(26, 2, 's<pre><code class="php">dfgsdfgsd</code></pre>', 0, 1, 1409621659, '2014-09-07', '0'),
(27, 2, '<pre><code class<h3>"php">$uri </h3> Request::path();</code></pre>', 0, 1, 1409621706, '2014-09-07', '0'),
(28, 2, '<pre><code class="php">$uri = Request::path();</code></pre>', 0, 1, 1409621804, '0000-00-00', '1'),
(29, 2, '<pre><code class="php">$uri = Request::path();</code></pre>\r<br /><pre><code class="php">$uri = Request::path();</code></pre>', 0, 1, 1409621818, '0000-00-00', '1'),
(30, 2, 'sfsdf\r<br /><span style="text-decoration: underline;">sdfsdf</span>\r<br />dfgh, ,spl,', 0, 1, 1409623861, '2014-09-07', '0'),
(31, 2, 'sfsdf\r<br /><span style="text-decoration: underline;">sdfsdf</span>\r<br />dfgh, ,spl,', 0, 1, 1409623886, '2014-09-07', '0'),
(33, 1, '<pre><code> $y = 5 + $t; </code></pre>\r<br /><pre><code class="php"> function x($y) {\r    echo &quot;Hello world!&quot;;\r} </code></pre>', 0, 1, 1409637737, '2014-09-07', '0'),
(34, 1, '<pre><code> \rsdf@ \rfsdf\r @\r </code></pre>', 0, 1, 1409637876, '0000-00-00', '1'),
(35, 1, '', 2, 1, 1409640022, '2014-09-07', '0'),
(36, 1, 'sdf<pre><code> \rfsdf\r </code></pre>', 0, 1, 1409641969, '0000-00-00', '1'),
(37, 5, '', 1, 1, 1409648949, '0000-00-00', '1'),
(38, 8, '<h1>14233_blalog</h1>', 0, 1, 1409649718, '0000-00-00', '1'),
(39, 9, '', 3, 1, 1410040433, '0000-00-00', '1'),
(40, 9, '', 3, 1, 1410040935, '0000-00-00', '1'),
(41, 9, '', 3, 1, 1410041167, '0000-00-00', '1'),
(42, 9, '', 3, 1, 1410041221, '0000-00-00', '1'),
(43, 9, '', 1, 1, 1410041278, '0000-00-00', '1'),
(44, 2, '', 1, 1, 1410049023, '0000-00-00', '1'),
(45, 2, '', 1, 1, 1410049054, '0000-00-00', '1');

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
  PRIMARY KEY (`id`),
  KEY `_user_id` (`user_id`),
  KEY `_contact_id` (`contact_id`),
  KEY `_user_id_contact_id` (`user_id`,`contact_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=16 ;

INSERT INTO `lb_contacts` (`id`, `user_id`, `contact_id`, `title`, `is_email`, `is_phone`, `is_skype`, `notes`, `created`) VALUES
(9, 1, 5, 'Руслан Double Trend', 1, 1, 1, 'Ненадежный. Может подвести в любой момент.', 1409264729),
(12, 1, 4, 'Макс FIX LLC.', 1, 1, 1, 'Крутой программер. Надо нанять.', 1409265155),
(13, 1, 2, 'Серега Канада', 1, 1, 0, 'Свой чувак. Но таки еврей.', 1409356320),
(14, 1, 3, 'Zyluxxx', 1, 1, 0, 'Pidr', 1409415491),
(15, 10, 1, 'Динар Гарипов', 1, 1, 0, 'Это и есть я', 1409859575);

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
  `updated_at` date NOT NULL,
  `status` enum('1','0') NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=28 ;

INSERT INTO `lb_files` (`id`, `issue_id`, `comment_id`, `filename`, `file_title`, `file_size`, `salt`, `creator`, `uploaded`, `updated_at`, `status`) VALUES
(16, 1, 35, 'd598aebace96cd0cae8542ec7faf96c0.jpg', 'ava.jpg', '98.4130859375', 'eab3ef5b5c', 1, 1409640022, '0000-00-00', '1'),
(17, 1, 35, 'e8cc4c3a0f18bad528fdeee13c7d3666.doc', '30.doc', '20', '', 1, 1409640022, '0000-00-00', '1'),
(18, 5, 37, 'd3856a91d8267ced58e4d0775a941c08.jpg', '1.jpg', '40.6845703125', 'e26bb51b45', 1, 1409648949, '0000-00-00', '1'),
(19, 7, NULL, 'f9a7c90da3006dde67232f12a13d9281.zip', 'DT_Insta_24.zip', '66.0390625', '42d70f40ca', 1, 1409649340, '0000-00-00', '1'),
(20, 7, NULL, '67f2c1a94a5b89f2963b57bba7ffa953.csv', 'fetchcsv.csv', '6.43359375', '231b8fb499', 1, 1409649340, '0000-00-00', '1'),
(21, 8, NULL, '068fb4a34d4881c4c78bd071796d8422.jpg', 'ava.jpg', '98.4130859375', '407a665efb', 1, 1409649397, '2014-09-07', '0'),
(22, 8, NULL, '68ad9cbbcb98543b63cdd27fba7b5692.jpg', '552800.jpg', '83.802734375', 'dbb98ed987', 1, 1409649397, '0000-00-00', '1'),
(23, 9, 39, '7f64acbb50725fc619d8bd9b6f5defcd.jpg', '1.jpg', '40.6845703125', 'ed762dfa6a3de639', 1, 1410040433, '0000-00-00', '1'),
(24, 9, 39, '487dbb83dfe7de61ecf261fc86952314.mq4', 'DoubleTrend.mq4', '80.87109375', '6a475d512588219f', 1, 1410040433, '0000-00-00', '1'),
(25, 9, 40, '7da3880f3db7c2f57fdc9e2692c3db88.png', 'snapshot2.png', '1774.125', 'ae0a019cf00c0cef', 1, 1410040935, '0000-00-00', '1'),
(26, 9, 41, 'd37515262bee3ccb7a41627de10d6aa4.png', 'snapshot2.png', '1774.125', 'c7166c3f107df15a', 1, 1410041167, '0000-00-00', '1'),
(27, 9, 42, 'e70db4d1d9227883e527c3541a4cf4a3.png', 'snapshot2.png', '1774.125', '3eb29a79480b373c', 1, 1410041221, '0000-00-00', '1');

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
  `hours_spent` decimal(12,2) NOT NULL DEFAULT '0.00',
  `creator` int(255) NOT NULL,
  `assigned` int(255) unsigned DEFAULT NULL,
  `created` int(255) NOT NULL,
  `updated` int(255) NOT NULL,
  `updated_at` date NOT NULL,
  PRIMARY KEY (`id`),
  KEY `_assigned` (`assigned`),
  KEY `_status` (`status`),
  KEY `_project_id` (`project_id`),
  KEY `_assigned_status` (`assigned`,`status`),
  KEY `_status_project_id` (`status`,`project_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=12 ;

INSERT INTO `lb_issues` (`id`, `project_id`, `title`, `content`, `status`, `issue_type`, `priority`, `hours_spent`, `creator`, `assigned`, `created`, `updated`, `updated_at`) VALUES
(1, 1, 'Нелимитированный ввод логин', 'Можно ввести большое количество символов в поле логина <br />\r\nВоспроизведение ошибки: Скопировать большой текст, вставить в поле регистрации.', 'in_work', 'task', 2, 0.20, 1, 1, 1043241234, 1409445661, '2014-09-06'),
(2, 1, 'Можно ввести SQL-иньекцию', 'Не экранирован ввод коментариев. Легко ввести SQL-иньекцию, или XSS-код.\r\nИсправить!', 'in_work', 'bug', 4, 2.00, 2, 9, 24123422, 1409622394, '2014-09-07'),
(3, 7, 'Not My Issue', 'Content of not mine issue', 'in_work', 'research', 3, 0.00, 3, 3, 234523453, 1447483647, '0000-00-00'),
(4, 1, 'Проверочная задача', 'Текст проверочной задачи\r<br /><strong>Жирный шрифт</strong>\r<br /><h2>Большой шрифт</h2>\r<br />Немного кода JS\r<br /><pre><code> function NewIssueController($scope) {\r\r    $scope.lines = [];\r\r    $scope.addFile = function() {\r        $scope.lines.push($scope.lines.length+1);\r\r    };\r\r    $scope.removeFile = function(index) {\r        $scope.lines.splice(index, 1);\r    };\r\r    $scope.isMaxMessage = function() {\r        var max = $(&#039;#maxFiles&#039;).val();\r        return $scope.lines.length &gt;= (max - 1);\r    }\r}\r$(document).ready(function(){\r    $(&quot;#contentTextarea&quot;).markupy();\r}); </code></pre>', 'opened', 'task', 5, 1.20, 1, 0, 1409648453, 1409648453, '2014-09-06'),
(5, 8, 'Something Wrong With Files uploading', 'Please Check', 'opened', 'task', 2, 0.00, 1, 1, 1409648713, 1409648713, '0000-00-00'),
(6, 1, 'My best Song Ever', 'My files uploaded successfuly! :)', 'closed', 'task', 4, 1.00, 1, 1, 1409649318, 1409649318, '2014-09-02'),
(7, 8, 'My best Song Ever', 'My files uploaded successfuly! :)', 'need_feedback', 'task', 4, 0.00, 1, 1, 1409649340, 1409649340, '0000-00-00'),
(8, 1, 'Status testing', '<h1>Blabla</h1>', 'opened', 'research', 1, 3.15, 1, 1, 1409649397, 1409649397, '2014-09-07'),
(9, 9, 'Тест', 'проеврка', 'opened', 'task', 4, 3.00, 10, 1, 1409860431, 1409860431, '2014-09-07'),
(10, 9, 'Проверка на обсервера', 'Проверь-ка на обсервера', 'new', 'task', 4, 0.00, 10, 0, 1410042749, 1410042749, '0000-00-00'),
(11, 1, 'Test deparse2', '<span style="text-decoration: underline;">Hello</span> buenos\r<br />\r<br /><strong>noxhes </strong>\r<br /><s>my</s> <h1>dear</h1>\r<br /><h2>h2</h2> <h3>h3</h3>\r<br /><pre><code>  \r{some: code }\r  </code></pre>\r<br />\r<br /><pre><code class="php">  \r$some = phpcode($foo);\r  </code></pre>', 'need_feedback', 'bug', 3, 0.00, 1, 1, 1410091777, 1410091777, '2014-09-07');

DROP TABLE IF EXISTS `lb_migrations`;
CREATE TABLE `lb_migrations` (
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `lb_migrations` (`migration`, `batch`) VALUES
('2014_09_14_144113_entrust_setup_tables', 1);

DROP TABLE IF EXISTS `lb_permissions`;
CREATE TABLE `lb_permissions` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `display_name` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  UNIQUE KEY `permissions_name_unique` (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

DROP TABLE IF EXISTS `lb_permission_role`;
CREATE TABLE `lb_permission_role` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `permission_id` int(10) unsigned NOT NULL,
  `role_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `permission_role_permission_id_foreign` (`permission_id`),
  KEY `permission_role_role_id_foreign` (`role_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

DROP TABLE IF EXISTS `lb_projects`;
CREATE TABLE `lb_projects` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `parent_id` int(255) NOT NULL DEFAULT '0',
  `creator` int(255) unsigned NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `budget` decimal(12,2) NOT NULL DEFAULT '0.00',
  `created` int(255) unsigned NOT NULL,
  `updated_at` date NOT NULL,
  `status` enum('1','0') NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=11 ;

INSERT INTO `lb_projects` (`id`, `parent_id`, `creator`, `title`, `description`, `budget`, `created`, `updated_at`, `status`) VALUES
(1, 0, 1, 'Double Trend2', 'Where is desription???\r\nNext line', 800.00, 0, '2014-09-07', '1'),
(2, 0, 3, 'LastBugs.com', 'Разработка и поддержка проекта Last Bugs Be very careful when echoing content that is supplied by users of your application. Always use the triple curly brace syntax to escape any HTML entities in the content. Sometimes you may wish to echo a variable, but you aren''t sure if the variable has been set. Basically, you want to do thi @yield directive. You may pass the default value as the second argument:', 0.00, 0, '0000-00-00', '1'),
(7, 0, 3, 'Not my project', 'FOFOFOFOOOO', 0.00, 1409635614, '0000-00-00', '1'),
(8, 0, 1, 'New test Project', 'Place issues Here please', 1500.00, 1409637947, '2014-09-07', '1'),
(9, 0, 10, 'Raziel&#039;s project', 'Just to test some features,', 0.00, 1409859555, '0000-00-00', '1'),
(10, 0, 1, 'Test CSRF', 'Edit test', 2000.00, 1410088696, '2014-09-07', '1');

DROP TABLE IF EXISTS `lb_project_user`;
CREATE TABLE `lb_project_user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `project_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `role` enum('teamlead','developer','observer') NOT NULL DEFAULT 'observer',
  `hour_cost` decimal(12,2) NOT NULL DEFAULT '0.00',
  PRIMARY KEY (`id`),
  KEY `_project_id_user_id` (`project_id`,`user_id`),
  KEY `_project_id` (`project_id`),
  KEY `_user_id` (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=24 ;

INSERT INTO `lb_project_user` (`id`, `project_id`, `user_id`, `role`, `hour_cost`) VALUES
(1, 1, 1, 'teamlead', 70.00),
(2, 2, 3, 'teamlead', 0.00),
(4, 1, 9, 'developer', 20.00),
(5, 3, 1, 'teamlead', 0.00),
(6, 4, 1, 'teamlead', 0.00),
(7, 2, 1, 'teamlead', 0.00),
(8, 6, 1, 'teamlead', 0.00),
(9, 7, 3, 'teamlead', 0.00),
(10, 8, 1, 'teamlead', 0.00),
(11, 1, 3, 'developer', 37.00),
(15, 8, 3, 'developer', 0.00),
(16, 8, 4, 'developer', 0.00),
(17, 9, 10, 'teamlead', 0.00),
(19, 1, 4, 'observer', 0.00),
(21, 1, 5, 'observer', 0.00),
(22, 9, 1, 'observer', 0.00),
(23, 10, 1, 'teamlead', 0.00);

DROP TABLE IF EXISTS `lb_roles`;
CREATE TABLE `lb_roles` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  UNIQUE KEY `roles_name_unique` (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

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
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
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
  PRIMARY KEY (`id`),
  KEY `_status` (`status`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=11 ;

INSERT INTO `lb_users` (`id`, `name`, `email`, `phone`, `skype`, `password`, `recover_time`, `remember_token`, `reg_date`, `last_access`, `last_ip`, `updated_at`, `status`) VALUES
(0, 'nobody', 'noone@nowhere.cru', '+0', 'a', '1525324532452345', 0, NULL, 0, 0, NULL, '0000-00-00', '2'),
(1, 'Динар Гарипов', 'garipov.dinar@gmail.com', '79196390302', NULL, '$2y$10$jMrqefnSNw1fC/nJNBAlLedaiUoxf1UoVuBF.oC095Z6pB.b1/aHe', 1409798141, 'rtkGLqhXKijruERcyfT8MucUDj7ErNckf0mwCHToaq8hrEibXXt7z4Wo1O2h', 1403700187, 1410684845, '127.0.0.1', '2014-09-14', '1'),
(2, 'Сергей Биндер', 't88855@gmail.com', '79153032106', NULL, '$2y$10$LwcOSKpFkoWMEwsKsABHwOy2ao7qCM5mY9npt66rUaBOeR0mHisSq', 0, '3wixIGK7i2CEPyFpBZ7ORZdNBfrKW49eEDUv6VWp1C2OBHtsqx8f11HF6vWZ', 1402700187, 1409172056, '127.0.0.1', '2014-08-28', '1'),
(3, 'Zyluxxx GoonZ', 'ragament@gmail.com', '14158764498', 'syluxx', '$2y$10$FlGbPfIbR.b5vo0S1E8ECecRERofVCnxncaxj2MnynIqwmafiybZS', 0, '3wixIGK7i2CEPyFpBZ7ORZdNBfrKW49eEDUv6VWp1C2OBHtsqx8f11HF6vWZ', 1405700187, 1409172056, '127.0.0.1', '2014-08-28', '1'),
(4, 'Максим Зималиев', 'zimaliev@gmail.com', '79043225496', NULL, '$2y$10$klh/EJog7rozEwRdK8er8up7Pbq69vM7jjFt8uAk9tN3zZgydB.Fi', 10, '3wixIGK7i2CEPyFpBZ7ORZdNBfrKW49eEDUv6VWp1C2OBHtsqx8f11HF6vWZ', 1403700187, 1404172056, '117.200.37.11', '2014-08-28', '1'),
(5, 'Руслан Хуснутдинов', 'rus-clon@yandex.ru', NULL, 'rus-clon', '$2y$10$1jcpGr9RcFF3fTjDV3PubejMfEr1ncGk4qdK9If2B4TETEG0UHKUa', 0, '3wixIGK7i2CEPyFpBZ7ORZdNBfrKW49eEDUv6VWp1C2OBHtsqx8f11HF6vWZ', 1403600187, 1404172056, '37.110.17.149', '2014-08-28', '1'),
(9, 'Николай Хворостов', 'nikhvorostov@gmail.com', NULL, NULL, '$2y$10$N9WIEisrfHgxjcZgajQV9ev7JaQs91GVzpws1vvjGNcx0m4X3vgj.', 0, 'Sv39v0ivPvmXDouZmms0muqElFf7EDDasRi9wai8xSvlGyS3U70JPWRpLRqL', 1409429183, 1409429233, '127.0.0.1', '2014-08-31', '1'),
(10, 'Raziel', 'info@nosgoth.ru', NULL, NULL, '$2y$10$K1bmBIH.2tVxN5ZIQ.PCeugY3Hq8m09fqJpYCyePXjxOjjz0Ds6lm', 1409859470, 'h4HLhpaQiuR7vWFLhzFXnZdA52piq2vLMZaiv1Q0OFDnHbzQz0Bh5FXDTLJL', 1409859439, 1410042703, '127.0.0.1', '2014-09-07', '1');


ALTER TABLE `lb_assigned_roles`
  ADD CONSTRAINT `assigned_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `lb_roles` (`id`),
  ADD CONSTRAINT `assigned_roles_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `lb_users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

ALTER TABLE `lb_permission_role`
  ADD CONSTRAINT `permission_role_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `lb_roles` (`id`),
  ADD CONSTRAINT `permission_role_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `lb_permissions` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
