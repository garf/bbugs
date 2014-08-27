<?php

class root_AccountController extends BaseController {


    public function transactions()
    {
        $data = array(
            'css' => array(),
            'js' => array(),
            'title' => 'Транзакции',
            'transactions' => AccountModel::getInstance()->getTransactions(array('paged' => true)),
        );
        return View::make('root.main', $data)
            ->nest('body', 'root.account.transactions', $data);
    }

}
