<?php

class root_DashboardController extends BaseController {


    public function index()
    {
        $data = array(
            'css' => array(),
            'js' => array(),
            'title' => 'Сводка',
        );
        return View::make('root.main', $data)
            ->nest('body', 'root.dashboard.index', $data);
    }
}
