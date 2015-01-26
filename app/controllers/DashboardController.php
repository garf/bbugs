<?php

class DashboardController extends BaseController {


    public function index()
    {
        View::share('menu_item', 'index');
        $data = array(
            'css' => array(),
            'js' => array(),
            'title' => trans('dashboard.dashboard'),
            'history' => History::getInstance()->getByUser(Auth::user()->id),
        );

        return View::make('cabinet.main', $data)
            ->nest('body', 'cabinet.dashboard.index', $data);
    }

    public function testtpl()
    {
        View::share('menu_item', 'index');
        $data = array(
            'css' => array(),
            'js' => array(),
            'title' => trans('dashboard.dashboard'),
        );

        return View::make('cabinet.tpl', $data);
    }
}
