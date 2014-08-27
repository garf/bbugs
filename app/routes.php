<?php

/*
 * Site Controllers
*/

include_once(app_path() . '/routes/site_Pages.php');

/*
 * Cabinet Controllers
*/

include_once(app_path() . '/routes/cabinet_Users.php');
include_once(app_path() . '/routes/cabinet_Auth.php');
include_once(app_path() . '/routes/cabinet_Dashboard.php');

/*
 * Common Controllers
*/

include_once(app_path() . '/routes/common_Cron.php');
include_once(app_path() . '/routes/common_Errors.php');
include_once(app_path() . '/routes/common_Files.php');

/*
 * Root Controllers
*/
