<div>
    <?php echo $orders->links(); ?>
    <table class="table table-hover">
        <thead>
        <tr>
            <th style="width: 100px;">ID</th>
            <th>Агент</th>
            <th>Сумма</th>
            <th>Тип</th>
            <th style="width: 180px;">Дата</th>
            <th style="width: 150px;">Оплачено</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($orders as $order) { ?>
            <tr class="<?php echo ShopModel::getInstance()->getTypes($order->status)['class']; ?>">
                <td><?php echo MiscModel::getInstance()->publicId($order->id); ?></td>
                <td>
                    <a href="/root/agent-view/<?php echo $order->agent_id; ?>">
                        <?php echo $order->agent_id; ?> :
                        <?php echo $order->last_name; ?>
                        <?php echo $order->first_name; ?>
                        <?php echo $order->middle_name; ?>
                    </a>
                </td>
                <td><?php echo MiscModel::getInstance()->moneyFormat($order->amount); ?></td>
                <td><?php echo ucfirst($order->service); ?></td>
                <td><?php echo date('Y-m-d H:i:s', $order->act_date); ?></td>
                <td><?php echo ShopModel::getInstance()->getTypes($order->status)['text']; ?></td>
            </tr>
        <?php } ?>
        </tbody>
    </table>
    <?php echo $orders->links(); ?>
</div>