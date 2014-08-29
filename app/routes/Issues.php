<?php

Route::get('/issues', array(
    'before' => 'auth',
    'as' => 'issues',
    'uses' => 'IssuesController@index',
));

Route::get('/issues/project/{project_id}', array(
    'before' => 'auth|project-user',
    'as' => 'issues-project',
    'uses' => 'IssuesController@project',
))->where(array('project_id' => '[0-9]+'));
