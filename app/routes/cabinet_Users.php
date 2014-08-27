<?php

Route::get('/cabinet/profile', array(
    'before' => 'auth',
    'as' => 'profile',
    'uses' => 'cabinet_AgentsController@profile',
));

Route::get('/cabinet/settings', array(
    'before' => 'auth',
    'as' => 'settings',
    'uses' => 'cabinet_AgentsController@settings',
));
