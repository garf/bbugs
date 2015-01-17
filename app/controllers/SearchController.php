<?php

class SearchController extends BaseController {

    public function searchCreateUrl()
    {
        $q = Input::get('q', null);
        return Redirect::to(URL::route('search', array('q' => $q)));
    }

    public function search($q=null)
    {
        View::share('menu_item', 'search');

        $params = array(
            'q' => $q,
            'statuses' => Input::get('statuses', Issues::getInstance()->statsMapper('not_done')),
            'assigned' => Input::get('assigned', 'me') == 'me' ? Auth::user()->id : null,
            'project' => Input::get('project', null),
        );

        $data = array(
            'css' => array(),
            'js' => array(),
            'title' => trans('search.search') . ' : '  . e($q),
            'results' => Issues::getInstance()->searchByQ($params),
        );

        return View::make('cabinet.main', $data)
            ->nest('body', 'cabinet.search.results', $data);
    }

}
