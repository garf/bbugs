<?php

class SearchController extends BaseController {


    public function index()
    {
        View::share('menu_item', 'search');
        $data = array(
            'css' => array(),
            'js' => array(),
            'title' => trans('search.search'),
        );

        return View::make('cabinet.main', $data)
            ->nest('body', 'cabinet.search.index', $data);
    }

    public function search()
    {
        View::share('menu_item', 'search');
        $data = array(
            'css' => array(),
            'js' => array(),
            'title' => trans('search.search'),
        );

        return View::make('cabinet.main', $data)
            ->nest('body', 'cabinet.search.index', $data);
    }

}
