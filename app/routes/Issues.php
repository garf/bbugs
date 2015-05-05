<?php

Route::get('/issues/{stats?}', array(
    'before' => 'auth',
    'as' => 'issues',
    'uses' => 'IssuesController@index',
))->where(array('stats' => '[_a-z0-9]+'));

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

Route::post('/issues/save/{issue_id}', array(
    'before' => 'auth|csrf|issue-user',
    'as' => 'issue-save',
    'uses' => 'IssuesController@save',
))->where(array('issue_id' => '[0-9]+'));

Route::get('/issues/create/{project_id}', array(
    'before' => 'auth|project-user',
    'as' => 'issue-new',
    'uses' => 'IssuesController@newIssue',
))->where(array('project_id' => '[0-9]+'));

Route::get('/issues/edit/{issue_id}', array(
    'before' => 'auth|issue-user',
    'as' => 'issue-edit',
    'uses' => 'IssuesController@edit',
))->where(array('issue_id' => '[0-9]+'));

Route::get('/issues/delete-comment/{comment_id}', array(
    'before' => 'auth',
    'as' => 'delete-comment',
    'uses' => 'IssuesController@deleteComment',
))->where(array('comment_id' => '[0-9]+'));

Route::post('/issues/add/{project_id}', array(
    'before' => 'auth|csrf|project-user',
    'as' => 'issue-add',
    'uses' => 'IssuesController@addIssue',
))->where(array('project_id' => '[0-9]+'));

Route::post('/issues/update/{issue_id}', array(
    'before' => 'auth|csrf|issue-user',
    'as' => 'update-issue',
    'uses' => 'IssuesController@updateIssue',
))->where(array('issue_id' => '[0-9]+'));
