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

Route::filter('root', function()
{
	if (Auth::root()->guest()) return Redirect::to('/login-root');
});

Route::filter('auth', function()
{
	if (Auth::user()->guest()) return Redirect::to('/login');
});

Route::filter('auth.basic', function()
{
	return Auth::user()->basic();
});

/*
|--------------------------------------------------------------------------
| Role Filter
|--------------------------------------------------------------------------
|
*/


Route::filter('partner', function()
{
    if(!AgentsModel::getInstance()->inRole('partner', Auth::user()->get()->role)) {
        App::abort(404);
    }
});

Route::filter('agent', function()
{
    if(!AgentsModel::getInstance()->inRole('agent', Auth::user()->get()->role)) {
        App::abort(404);
    }
});

Route::filter('observer', function() {
    if(!RootsModel::getInstance()->inRole('admin', Auth::root()->get()->role)) {
        if(RootsModel::getInstance()->inRole('observer', Auth::root()->get()->role)) {
            MiscModel::getInstance()->setSystemMessage('Доступ запрещен', 'danger');
            return Redirect::to('/404');
        }
    }
});

Route::filter('news', function() {
    if(!RootsModel::getInstance()->inRole('admin', Auth::root()->get()->role)) {
        if(RootsModel::getInstance()->inRole('news', Auth::root()->get()->role)) {
            MiscModel::getInstance()->setSystemMessage('Доступ запрещен', 'danger');
            return Redirect::to('/404');
        }
    }
});

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
	if (Auth::user()->check()) return Redirect::to('/');
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
        MiscModel::getInstance()->setSystemMessage("Проверочный токен неверный! Введите данные еще раз!", "error");
        return Redirect::back()->withInput();
    }
});
