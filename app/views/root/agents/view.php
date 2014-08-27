<div class="clearfix">
    <div class="col-md-6">
        <div class="panel panel-info">
            <div class="panel-heading">
                Данные клиента
            </div>
            <div class="panel-body">
                <table class="table table-bordered table-hover">
                    <tr>
                        <th>Роли</th>
                        <td>
                            <?php $userRoles = explode('|', $agent->role); ?>
                            <?php foreach($userRoles as $role) { ?>
                                <?php echo AgentsModel::getInstance()->getRole($role, array('title' => ''))['title']; ?><br />
                            <?php } ?>
                        </td>
                    </tr>
                    <tr>
                        <th>E-mail</th>
                        <td><?php echo $agent->email; ?></td>
                    </tr>
                    <tr>
                        <th>Телефон</th>
                        <td>+<?php echo $agent->phone; ?></td>
                    </tr>
                    <tr>
                        <th>Спонсор</th>
                        <td><?php echo $sponsor->id; ?> : <?php echo $sponsor->last_name; ?> <?php echo $sponsor->first_name; ?> <?php echo $sponsor->middle_name; ?></td>
                    </tr>
                    <tr class="info">
                        <th>Баланс</th>
                        <td><?php echo MiscModel::getInstance()->moneyFormat($agent->balance); ?></td>
                    </tr>
                    <tr>
                        <th>Регистрация</th>
                        <td><?php echo date('d.m.Y H:i', $agent->reg_date); ?></td>
                    </tr>
                    <tr>
                        <th>Последний вход</th>
                        <td><?php echo date('d.m.Y H:i', $agent->last_login); ?></td>
                    </tr>
                    <tr>
                        <th>Последний IP</th>
                        <td><?php echo $agent->last_ip; ?></td>
                    </tr>
                    <tr>
                        <th>Referral</th>
                        <td><?php echo $agent->x_referal; ?></td>
                    </tr>
                    <tr>
                        <th>Register Url</th>
                        <td><?php echo $agent->x_url; ?></td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
    <?php if (!$pair['error']) { ?>
        <div class="col-md-6">
            <div class="panel panel-danger">
                <div class="panel-heading">
                    Данные Счета
                </div>
                <div class="panel-body">
                    <table class="table table-bordered table-hover">
                        <tr>
                            <th>Счет 1 (InstaForex)</th>
                            <td><?php echo $pair['pair']['account1']; ?></td>
                        </tr>
                        <tr>
                            <th>Счет 2 (TradeFort)</th>
                            <td><?php echo $pair['pair']['account2']; ?></td>
                        </tr>
                        <tr>
                            <th>Тип открытия</th>
                            <td><?php echo ($pair['pair']['open_type'] == 'fast') ? 'Быстрый' : 'Нормальный'; ?></td>
                        </tr>
                        <tr>
                            <th>Активный</th>
                            <td><?php echo ($pair['pair']['status'] == '1') ? 'Да' : 'Нет'; ?></td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    <?php } ?>
    <div class="col-md-6">
        <div class="panel panel-warning">
            <div class="panel-heading">
                Данные спонсора
            </div>
            <div class="panel-body">
                <?php if ($sponsor->id != 0) { ?>
                <table class="table table-bordered table-hover">
                    <tr>
                        <th>Имя</th>
                        <td><?php echo $sponsor->id; ?> : <?php echo $sponsor->last_name; ?> <?php echo $sponsor->first_name; ?> <?php echo $sponsor->middle_name; ?></td>
                    </tr>
                    <tr>
                        <th>Роли</th>
                        <td>
                            <?php $userRoles = explode('|', $sponsor->role); ?>
                            <?php foreach($userRoles as $role) { ?>
                                <?php echo AgentsModel::getInstance()->getRole($role, array('title' => ''))['title']; ?><br />
                            <?php } ?>
                        </td>
                    </tr>
                    <tr>
                        <th>E-mail</th>
                        <td><?php echo $sponsor->email; ?></td>
                    </tr>
                    <tr>
                        <th>Телефон</th>
                        <td>+<?php echo $sponsor->phone; ?></td>
                    </tr>
                    <tr class="info">
                        <th>Баланс</th>
                        <td><?php echo MiscModel::getInstance()->moneyFormat($sponsor->balance); ?></td>
                    </tr>
                    <tr>
                        <th>Регистрация</th>
                        <td><?php echo date('d.m.Y H:i', $sponsor->reg_date); ?></td>
                    </tr>
                    <tr>
                        <th>Последний вход</th>
                        <td><?php echo date('d.m.Y H:i', $sponsor->last_login); ?></td>
                    </tr>
                    <tr>
                        <th>Последний IP</th>
                        <td><?php echo $sponsor->last_ip; ?></td>
                    </tr>
                    <tr>
                        <th>Referral</th>
                        <td><?php echo $sponsor->x_referal; ?></td>
                    </tr>
                    <tr>
                        <th>Register Url</th>
                        <td><?php echo $sponsor->x_url; ?></td>
                    </tr>
                    <tr>
                        <td colspan="2" class="text-right">
                            <a href="/root/agent-view/<?php echo $sponsor->id ?>" class="btn btn-info">Перейти</a>
                        </td>
                    </tr>
                </table>
                <?php } else { ?>
                    <div class="text-center">
                        <h2>Нулевая Линия</h2>
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>
</div>