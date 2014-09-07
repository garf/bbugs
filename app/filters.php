<?php

/*
|--------------------------------------------------------------------------
| Application & Route Filters
|--------------------------------------------------------------------------
|
| Below you will find the "before" and "after" events for the application
| which may be used to do any work before or after a request into your
| application. Here you may also register your custom route filters.
|
*/

App::before(function($request)
{
	//
});


App::after(function($request, $response)
{
	//
});



Route::filter('json', function()
{
    App::after(function($request, $response)
    {
        $response->headers->set('Content-Type', 'application/json');
    });
});

Route::filter('xml', function()
{
    App::after(function($request, $response)
    {
        $response->headers->set('Content-Type', 'text/xml');
    });
});

/*
|--------------------------------------------------------------------------
| Authentication Filters
|--------------------------------------------------------------------------
|
| The following filters are used to verify that the user of the current
| session is logged into this application. The "basic" filter easily
| integrates HTTP Basic authentication for quick, simple checking.
|
*/

Route::filter('auth', function()
{
	if (Auth::guest()) return Redirect::to('/login');
});

Route::filter('project-user', function($route)
{
    $id = $route->getParameter('project_id');
    if($id != '0' && !Projects::getInstance()->isUserProject(Auth::user()->id, $id)) {
        Misc::getInstance()->setSystemMessage(trans('projects.no_access'), 'danger');
        return Redirect::to(URL::route('index'));
    }
});

Route::filter('issue-user', function($route)
{
    $id = $route->getParameter('issue_id');
    if(!Issues::getInstance()->isUserIssue(Auth::user()->id, $id)) {
        Misc::getInstance()->setSystemMessage(trans('projects.no_access'), 'danger');
        return Redirect::to(URL::route('index'));
    }
});

Route::filter('auth.basic', function()
{
	return Auth::basic();
});

/*
|--------------------------------------------------------------------------
| Role Filter
|--------------------------------------------------------------------------
|
*/

/*
|--------------------------------------------------------------------------
| Guest Filter
|--------------------------------------------------------------------------
|
| The "guest" filter is the counterpart of the authentication filters as
| it simply checks that the current user is not logged in. A redirect
| response will be issued if they are, which you may freely change.
|
*/

Route::filter('guest', function()
{
	if (Auth::check()) return Redirect::to('/');
});

/*
|--------------------------------------------------------------------------
| CSRF Protection Filter
|--------------------------------------------------------------------------
|
| The CSRF filter is responsible for protecting your application against
| cross-site request forgery attacks. If this special token in a user
| session does not match the one given in this request, we'll bail.
|
*/

Route::filter('csrf', function()
{
    if (Session::token() != Input::get('_token'))
    {
        Misc::getInstance()->setSystemMessage(trans('errors.token_wrong'), "danger");
        return Redirect::back()->withInput();
    }
});
