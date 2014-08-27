<div>

    <b>Здравствуйте, <?php echo $name; ?>!</b>

    <p>
        Благодарим вас за регистрацию в проекте <?php echo Config::get('app.url'); ?>.
    </p>
    <p>
        Ваши учетные данные для доступа в личный кабинет.
        <br />
        <br />
        E-mail: <b><?php echo $email; ?></b>
        <br />
        Пароль: <b><?php echo $password; ?></b>
        <br />
        <br />
        Вам присвоен партнерский код: <b><?php echo $agent_id; ?></b>
        <br />
        Ваша партнерская ссылка:  <b><?php echo $reflink; ?></b>
        <br />
        <br />
        <a href="<?php echo Config::get('app.cabinet'); ?>">Войти в личный кабинет</a>
    </p>
</div>