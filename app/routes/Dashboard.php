<?php

Route::get('/', array(
    'before' => 'auth',
    'as' => 'index',
    'uses' => 'DashboardController@index',
));

Route::get('/testtpl', array(
    'before' => 'auth',
    'as' => 'testtpl',
    'uses' => 'DashboardController@testtpl',
));
