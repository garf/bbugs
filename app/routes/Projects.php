<?php

Route::get('/projects', array(
    'before' => 'auth',
    'as' => 'projects',
    'uses' => 'ProjectsController@index',
));

Route::post('/projects/create', array(
    'before' => 'auth',
    'as' => 'create-project',
    'uses' => 'ProjectsController@create',
));

Route::get('/projects/info/{project_id}', array(
    'before' => 'auth|project-user',
    'as' => 'project-info',
    'uses' => 'ProjectsController@info',
))->where(array('project_id' => '[0-9]+'));

Route::get('/projects/edit/{project_id}', array(
    'before' => 'auth|project-user',
    'as' => 'edit-project',
    'uses' => 'ProjectsController@edit',
))->where(array('project_id' => '[0-9]+'));

Route::post('/projects/save/{project_id}', array(
    'before' => 'auth|project-user',
    'as' => 'save-project',
    'uses' => 'ProjectsController@save',
))->where(array('project_id' => '[0-9]+'));

Route::get('/projects/delete/{project_id}', array(
    'before' => 'auth|project-user',
    'as' => 'project-delete',
    'uses' => 'ProjectsController@delete',
))->where(array('project_id' => '[0-9]+'));

Route::get('/projects/view/{project_id}', array(
    'before' => 'auth|project-user',
    'as' => 'project-view',
    'uses' => 'ProjectsController@view',
))->where(array('project_id' => '[0-9]+'));

Route::get('/projects/{project_id}/add-user', array(
    'before' => 'auth|project-user',
    'as' => 'add-to-project',
    'uses' => 'ProjectsController@addUser',
))->where(array('project_id' => '[0-9]+'));

Route::get('/projects/{project_id}/users-list', array(
    'before' => 'auth|project-user',
    'as' => 'project-users',
    'uses' => 'ProjectsController@projectUsersList',
))->where(array('project_id' => '[0-9]+'));

Route::post('/projects/add-user', array(
    'before' => 'auth',
    'as' => 'project-add-user',
    'uses' => 'ProjectsController@projectAddUser',
));

Route::post('/projects/remove-user', array(
    'before' => 'auth',
    'as' => 'project-remove-user',
    'uses' => 'ProjectsController@projectRemoveUser',
));
