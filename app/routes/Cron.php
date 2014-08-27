<?php

Route::get('/cron', array(
    'uses' => 'CronController@work',
));

Route::get('/cron/test', array(
    'uses' => 'CronController@test',
));
