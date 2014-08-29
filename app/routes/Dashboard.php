<?php

Route::get('/', array(
    'before' => 'auth',
    'as' => 'index',
    'uses' => 'DashboardController@index',
));
