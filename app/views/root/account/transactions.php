<div>
    <?php echo $transactions->links(); ?>
    <table class="table table-hover">
        <thead>
        <tr>
            <th style="width: 100px;">ID</th>
            <th>Агент</th>
            <th>Тип</th>
            <th style="width: 180px;">Дата</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($transactions as $trans) { ?>
            <tr class="<?php echo AccountModel::getInstance()->getTypes($trans->act_type)['class']; ?>">
                <td><?php echo MiscModel::getInstance()->publicId($trans->id); ?></td>
                <td>
                    <a href="/root/agent-view/<?php echo $trans->agent_id; ?>">
                        <?php echo $trans->agent_id; ?> :
                        <?php echo $trans->last_name; ?>
                        <?php echo $trans->first_name; ?>
                        <?php echo $trans->middle_name; ?>
                    </a>
                </td>
                <td><?php echo AccountModel::getInstance()->getTypes($trans->act_type)['text']; ?></td>
                <td><?php echo date('Y-m-d H:i:s', $trans->act_date); ?></td>
            </tr>
        <?php } ?>
        </tbody>
    </table>
    <?php echo $transactions->links(); ?>
</div>