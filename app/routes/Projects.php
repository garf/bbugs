<?php

Route::get('/projects', array(
    'before' => 'auth',
    'as' => 'projects',
    'uses' => 'ProjectsController@index',
));

Route::post('/project-create', array(
    'before' => 'auth',
    'as' => 'create-project',
    'uses' => 'ProjectsController@create',
));

Route::get('/projects/delete/{id}', array(
    'before' => 'auth',
    'as' => 'project-delete',
    'uses' => 'ProjectsController@delete',
))->where(array('id' => '[0-9]+'));

Route::get('/projects/view/{id}', array(
    'before' => 'auth',
    'as' => 'project-view',
    'uses' => 'ProjectsController@view',
))->where(array('id' => '[0-9]+'));

Route::get('/projects/{project_id}/add-user', array(
    'before' => 'auth',
    'as' => 'add-to-project',
    'uses' => 'ProjectsController@addUser',
))->where(array('project_id' => '[0-9]+'));
