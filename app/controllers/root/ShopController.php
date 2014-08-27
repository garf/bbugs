<?php

class root_ShopController extends BaseController {


    public function orders()
    {
        $data = array(
            'css' => array(),
            'js' => array(),
            'title' => 'Покупки',
            'orders' => ShopModel::getInstance()->getOrders(array('paged' => true)),
        );
        return View::make('root.main', $data)
            ->nest('body', 'root.shop.orders', $data);
    }

}
