<div>
    <h4>Зарегистрирован новый агент</h4>
    <br />
    Имя: (<?php echo $agent_id; ?>) <b><?php echo $full_name; ?></b>
    <br />
    Телефон: <b><?php echo $phone; ?></b>
    <br />
    E-mail: <a href="mailto:<?php echo $email; ?>"><?php echo $email; ?></a>
    <br />
    <br />
    Спонсор: (<?php echo $parent_id; ?>) <?php echo $parent_name; ?>
    <br />
    <?php echo (isset($role)) ? 'Зарегистрирован как ' . $role : ''; ?>
    <br />
    <br />
</div>