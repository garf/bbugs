<?php

Route::get('/', array(
    'before' => 'auth',
    'as' => 'cabinet',
    'uses' => 'DashboardController@index',
));
