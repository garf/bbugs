<?php

class common_CronController extends BaseController {


    public function test()
    {
        $params = array(
            'name' => 'Тест Тестович',
            'email' => 't88855@gmail.com',
            'password' => 'Hggdtybw3672',
        );
        EmailModel::getInstance()->registration($params);
    }

    public function work()
    {
        if(!$this->checkToken()) {
            return 'OK';
        }
        $orders = ShopModel::getInstance()->getOrdersByStatus(array('not_paid'));
        foreach($orders as $order) {
            $expiry = $order->act_date + Config::get('merchant.qiwi.expiry');
            if($expiry < time()) {
                ShopModel::getInstance()->setOrderStatus($order->id, 'overdue');
                continue;
            }
            if($order->service == 'qiwi') {
                $status = MerchantModel::getInstance()->checkQiwiStatus($order->id, 'not_paid');
                if($status == 'paid') {
                    ShopModel::getInstance()->setOrderStatus($order->id, 'paid');
                    $password = MiscModel::getInstance()->generatePassword(8, 'alphanumeric');
                    AgentsModel::getInstance()->setAgentPassword($order->agent_id, $password);
                    AgentsModel::getInstance()->setAgentStatus($order->agent_id, '1');
                    $params = array(
                        'name' => $order->first_name . ' ' . $order->middle_name,
                        'email' => $order->email,
                        'password' => $password,
                    );
                    EmailModel::getInstance()->registration($params);
                } elseif ($status == 'rejected' || $status == 'unpaid') {
                    ShopModel::getInstance()->setOrderStatus($order->id, 'failed');
                } elseif ($status == 'expired') {
                    ShopModel::getInstance()->setOrderStatus($order->id, 'overdue');
                }
                sleep(1);
            }
        }
    }


    private function checkToken()
    {
        if(Input::get('token', '') == Config::get('cron.token')) {
            return true;
        } else {
            return false;
        }
    }
}
