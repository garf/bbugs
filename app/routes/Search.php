<?php

Route::get('/search', array(
    'before' => 'auth',
    'as' => 'search-index',
    'uses' => 'SearchController@index',
));
Route::post('/search', array(
    'before' => 'auth',
    'as' => 'search-do',
    'uses' => 'SearchController@search',
));