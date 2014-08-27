<?php

class root_AgentsController extends BaseController {


    public function index()
    {
        $data = array(
            'css' => array(),
            'js' => array(),
            'title' => 'Агенты',
            'agents' => AgentsModel::getInstance()->getAgents(array('paged' => true)),
        );
        return View::make('root.main', $data)
            ->nest('body', 'root.agents.list', $data);
    }

    public function view($id)
    {
        $agent = AgentsModel::getInstance()->getAgentById($id);
        $sponsor = AgentsModel::getInstance()->getAgentById($agent->parent_id);
        $data = array(
            'css' => array(),
            'js' => array(),
            'title' => $agent->id . ' : ' . $agent->last_name . ' ' . $agent->first_name . ' ' . $agent->middle_name,
            'agent' => $agent,
            'sponsor' => $sponsor,
            'pair' => WebserviceModel::getInstance()->getPairByEmail($agent->email),
        );
        return View::make('root.main', $data)
            ->nest('body', 'root.agents.view', $data);
    }
}
