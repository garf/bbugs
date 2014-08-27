<?php

Route::get('/recover', array(
    'as' => 'recover',
    'uses' => 'cabinet_AuthController@recover',
));

Route::post('/recover', array(
    'as' => 'recover',
    'uses' => 'cabinet_AuthController@recoverPost',
));

Route::get('/login', array(
    'as' => 'login',
    'uses' => 'cabinet_AuthController@login',
));

Route::post('/login', array(
    'as' => 'login',
    'uses' => 'cabinet_AuthController@loginPost',
));

Route::any('/logout', array(
    'as' => 'logout',
    'uses' => 'cabinet_AuthController@logout',
));
