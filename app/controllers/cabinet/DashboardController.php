<?php

class cabinet_DashboardController extends BaseController {


    public function index()
    {
        $data = array(
            'css' => array(),
            'js' => array(),
            'title' => trans('dashboard.dashboard'),
        );
        return View::make('cabinet.main', $data)
            ->nest('body', 'cabinet.dashboard.index', $data);
    }
}
