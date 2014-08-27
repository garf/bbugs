<?php

Route::get('/projects', array(
    'before' => 'auth',
    'as' => 'projects',
    'uses' => 'ProjectsController@index',
));
