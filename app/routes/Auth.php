<?php

Route::get('/recover', array(
    'as' => 'recover',
    'uses' => 'AuthController@recover',
));

Route::post('/recover', array(
    'as' => 'recover',
    'uses' => 'AuthController@recoverPost',
));

Route::get('/login', array(
    'as' => 'login',
    'uses' => 'AuthController@login',
));

Route::post('/login', array(
    'as' => 'login',
    'uses' => 'AuthController@loginPost',
));

Route::any('/logout', array(
    'as' => 'logout',
    'uses' => 'AuthController@logout',
));
