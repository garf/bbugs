<?php

Route::get('/search/{q?}/{statuses?}/{assignee?}', array(
    'before' => 'auth',
    'as' => 'search',
    'uses' => 'SearchController@search',
));

Route::post('/search-create-url', array(
    'before' => 'auth',
    'as' => 'search-create-url',
    'uses' => 'SearchController@searchCreateUrl',
));