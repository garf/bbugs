<?php

Route::get('/login', array(
    'as' => 'login',
    'uses' => 'AuthController@login',
));

Route::post('/login', array(
    'as' => 'login',
    'before' => 'csrf',
    'uses' => 'AuthController@loginPost',
));

Route::post('/recover', array(
    'as' => 'recover',
    'before' => 'csrf',
    'uses' => 'AuthController@recoverPost',
));

Route::post('/signup', array(
    'as' => 'signup-post',
    'before' => 'csrf',
    'uses' => 'AuthController@registerPost',
));

Route::any('/logout', array(
    'as' => 'logout',
    'uses' => 'AuthController@logout',
));
