<?php

class SearchController extends BaseController {

    public function searchCreateUrl()
    {
        $q = Input::get('q', null);
        return Redirect::to(URL::route('search', array('q' => urlencode($q))));
    }

    public function search($q=null)
    {
        View::share('menu_item', 'search');
        $params = array(
            'q' => $q,
            'statuses' => Input::get('statuses', Issues::getInstance()->statsMapper('all')),
            'assigned' => Input::get('assigned', null) == 'me' ? Auth::user()->id : null,
            'project' => Input::get('project', null),
        );

        $issues = (!empty($q)) ? Issues::getInstance()->searchByQ($params) : array();

        $data = array(
            'params' => $params,
            'css' => array(),
            'js' => array(),
            'title' => trans('search.search') . ' : '  . e($q),
            'assignedMe' => Input::get('assigned', null) == 'me',
            'issues' => $issues,
        );

        return View::make('cabinet.main', $data)
            ->nest('body', 'cabinet.search.results', $data);
    }

}
