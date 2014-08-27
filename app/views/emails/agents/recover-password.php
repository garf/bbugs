<div>

    <b>Здравствуйте, <?php echo $name; ?>!</b>

    <p>
        Ваш новый пароль для входа в личный кабинет: <b><?php echo $password; ?></b>
        <br />
        <br />
        <a href="<?php echo Config::get('app.cabinet'); ?>">Войти в личный кабинет</a>
    </p>
</div>