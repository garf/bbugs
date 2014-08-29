<?php

Route::get('/projects', array(
    'before' => 'auth',
    'as' => 'projects',
    'uses' => 'ProjectsController@index',
));

Route::get('/projects/view/{id}', array(
    'before' => 'auth',
    'as' => 'project-view',
    'uses' => 'ProjectsController@view',
))->where(array('id' => '[0-9]+'));
