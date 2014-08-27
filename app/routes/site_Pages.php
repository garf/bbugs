<?php

Route::get('/', array(
    'as' => 'index',
    'uses' => 'site_PagesController@index',
));