<?php

Route::get('/cabinet', array(
    'before' => 'auth',
    'as' => 'cabinet',
    'uses' => 'cabinet_DashboardController@index',
));
