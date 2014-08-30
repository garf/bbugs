<div>

    <b><@ trans('email.hello', array('name' => $name)) @></b>

    <p>
        <@ trans('email.recover.your_password') @>: <b><?php echo $password; ?></b>
        <br />
        <br />
        <a href="<?php echo Config::get('app.cabinet'); ?>"><@ trans('email.recover.authorization') @></a>
    </p>
</div>