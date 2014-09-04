<?php

Route::get('/feedback', array(
    'before' => 'auth',
    'as' => 'feedback',
    'uses' => 'ComController@feedback',
));

Route::post('/feedback', array(
    'before' => 'auth',
    'as' => 'feedback-post',
    'uses' => 'ComController@feedbackPost',
));