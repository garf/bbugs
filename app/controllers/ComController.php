<?php

class ComController extends BaseController {


    public function feedback()
    {
        View::share('menu_item', 'feedback');
        $data = array(
            'css' => array(),
            'js' => array(),
            'title' => trans('com.feedback'),
        );

        return View::make('cabinet.main', $data)
            ->nest('body', 'cabinet.dashboard.index', $data);
    }


    public function feedbackPost()
    {

    }

}
