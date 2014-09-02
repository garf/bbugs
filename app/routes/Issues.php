<?php

Route::get('/issues', array(
    'before' => 'auth',
    'as' => 'issues',
    'uses' => 'IssuesController@index',
));

Route::get('/project/{project_id}/issues/{stats?}', array(
    'before' => 'auth|project-user',
    'as' => 'issues-project',
    'uses' => 'IssuesController@project',
))->where(array('project_id' => '[0-9]+', 'stats' => '[_a-z0-9]+'));

Route::get('/issues/view/{issue_id}', array(
    'before' => 'auth|issue-user',
    'as' => 'issue-view',
    'uses' => 'IssuesController@view',
))->where(array('issue_id' => '[0-9]+'));

Route::get('/issues/new/{project_id}', array(
    'before' => 'auth|project-user',
    'as' => 'issue-new',
    'uses' => 'IssuesController@newIssue',
))->where(array('project_id' => '[0-9]+'));

Route::get('/issues/add/{project_id}', array(
    'before' => 'auth|project-user',
    'as' => 'issue-add',
    'uses' => 'IssuesController@addIssue',
))->where(array('project_id' => '[0-9]+'));

Route::post('/issues/add-comment/{issue_id}', array(
    'before' => 'auth|issue-user',
    'as' => 'add-comment',
    'uses' => 'IssuesController@addComment',
))->where(array('issue_id' => '[0-9]+'));
