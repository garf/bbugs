<?php

Route::get('/cron', array(
    'uses' => 'common_CronController@work',
));

Route::get('/cron/test', array(
    'uses' => 'common_CronController@test',
));
