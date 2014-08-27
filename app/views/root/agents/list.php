<div>
    <?php echo $agents->links(); ?>
    <table class="table table-hover">
        <thead>
        <tr>
            <th>ID</th>
            <th>Спонсор</th>
            <th>Имя</th>
            <th>Email</th>
            <th>Balance</th>
            <th>Роль</th>
            <th>Опции</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($agents as $agent) { ?>
        <tr class="<?php echo (AgentsModel::getInstance()->inRole('agent', $agent->role)) ? (($agent->status == '1') ? 'success' : 'danger') : 'info'; ?>">
            <td><?php echo $agent->id; ?></td>
            <td>
                <?php if($agent->parent_id != 0) { ?>
                <a href="/root/agent-view/<?php echo $agent->parent_id; ?>" title="Посмотреть спонсора">
                    <i class="fa fa-arrow-circle-right"></i> <?php echo $agent->parent_id; ?>
                </a>
                <?php } else { ?>
                    <span class="text-muted">НЛ</span>
                <?php } ?>
            </td>
            <td><a href="/root/agent-view/<?php echo $agent->id; ?>"><?php echo $agent->last_name; ?> <?php echo $agent->first_name; ?> <?php echo $agent->middle_name; ?></a></td>
            <td><?php echo $agent->email; ?></td>
            <td><span class="<?php echo ((float)$agent->balance == 0) ? 'text-muted' : ''; ?>"><?php echo MiscModel::getInstance()->moneyFormat($agent->balance); ?></span></td>
            <td><?php echo $agent->role; ?></td>
            <td>
                <a href="/root/agent-view/<?php echo $agent->id; ?>" title="Посмотреть" class="btn btn-xs btn-info"><i class="fa fa-eye"></i></a>
                <a href="/root/login-agent/<?php echo $agent->id; ?>" title="Войти как этот агент" class="btn btn-xs btn-success"><i class="fa fa-download"></i></a>
            </td>
        </tr>
        <?php } ?>
        </tbody>
    </table>
    <?php echo $agents->links(); ?>
</div>