<?php

class root_ForexController extends BaseController {


    public function tradeStatuses()
    {
        $params = array(
            'page' => Input::get('page', 1),
            'order' => Input::get('order', 'open_time'),
            'sort' => Input::get('sort', 'desc'),
            'per_page' => 20,
        );
        $statuses = WebserviceModel::getInstance()->getConnections($params);
        $pag = Paginator::make($statuses, $statuses['connections']['count'], $params['per_page']);
        $data = array(
            'css' => array(),
            'js' => array(),
            'title' => 'Статусы',
            'statuses' => $statuses['connections'],
            'params' => $params,
            'paginator' => $pag->appends(array('order' => $params['order'], 'sort' => $params['sort']))->links(),
        );
        return View::make('root.main', $data)
            ->nest('body', 'root.forex.trade-statuses', $data);
    }

}
