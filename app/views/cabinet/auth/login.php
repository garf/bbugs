<!doctype html>
<html class="no-js" >
<head>
    <meta charset="UTF-8">
    <title><?= e($title) ?> : <?= Config::get('app.sitename') ?></title>
    <link rel="shortcut icon" href="/favicon.png">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="/template/common/css/bootstrap.min.css">
    <link rel="stylesheet" href="/template/common/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="/template/common/css/metis/main.min.css">
    <link rel="stylesheet" href="/template/cabinet/css/common.css">

    <?php if(isset($css)){echo TplHelpers::addCss($css);} ?>
</head>
<body class="<?= (isset($body_class) ? $body_class : '') ?>" ng-app>

<div class="form-signin">
    <div class="text-center">
        <img src="/template/common/img/logos/logo-sm.png" alt="Last Bugs">
    </div>
    <hr>
    <?= TplHelpers::systemMessagesFormatted(); ?>
    <div class="tab-content">
        <div id="login" class="tab-pane active">
            <form action="<?= URL::route('login') ?>" method="post" id="loginForm">
                <input type="hidden" name="_token" value="<?= $token ?>" />
                <p class="text-muted text-center">
                    <?= trans('auth.enter_your') ?>
                </p>
                <input type="text" maxlength="200" placeholder="<?= trans('auth.email') ?>" value="<?= Input::old('email') ?>" name="email" class="form-control top">
                <input type="password" placeholder="<?= trans('auth.password') ?>" name="password" class="form-control bottom">
                <div class="checkbox">
                    <label>
                        <input type="checkbox"><?= trans('auth.remember') ?>
                    </label>
                </div>
                <input class="btn btn-lg btn-primary btn-block" value="<?= trans('auth.enter') ?>" type="submit" />
            </form>
        </div>
        <div id="recover" class="tab-pane">
            <form action="<?= URL::route('recover') ?>" method="post"  id="recoverForm">
                <input type="hidden" name="_token" value="<?= $token ?>" />
                <p class="text-muted text-center"><?= trans('auth.enter_email') ?></p>
                <input type="email" name="email" maxlength="200" placeholder="mail@domain.com" class="form-control">
                <br>
                <input type="submit" class="btn btn-lg btn-danger btn-block" value="<?= trans('auth.recover_button') ?>" />
            </form>
        </div>
        <div id="signup" class="tab-pane">
            <form action="<?= URL::route('signup-post') ?>" method="post" id="signupForm">
                <input type="hidden" name="_token" value="<?= $token ?>" />
                <p class="text-muted text-center">
                    <?= trans('auth.registration_greeting') ?>
                    <br />
                    <?= trans('auth.registration_text') ?>
                </p>
                <input type="text" name="name" maxlength="25" value="<?= Input::old('name') ?>" placeholder="<?= trans('auth.your_name') ?>" class="form-control top">
                <input type="email" maxlength="200" name="email" value="<?= Input::old('email') ?>" placeholder="<?= trans('auth.email') ?>" class="form-control middle">
                <input type="email" maxlength="200" name="email_confirmation" value="<?= Input::old('email_confirmation') ?>" placeholder="<?= trans('auth.email_confirm') ?>" class="form-control bottom">
                <button class="btn btn-lg btn-success btn-block signup" type="submit"><?= trans('auth.signup') ?></button>
            </form>
        </div>
    </div>
    <hr>
    <div class="text-center">
        <ul class="list-inline">
            <li> <a class="text-muted" href="#login" data-toggle="tab"><?= trans('auth.login') ?></a>  </li>
            <li> <a class="text-muted" href="#recover" data-toggle="tab"><?= trans('auth.forgot') ?></a>  </li>
            <li> <a class="text-muted" href="#signup" data-toggle="tab"><?= trans('auth.register') ?></a>  </li>
        </ul>
        <ul class="list-inline">
            <li> <a href="<?= URL::route('set-language', array('en')) ?>"><img src="/template/common/img/flags/gb.png" alt="" /></a>  </li>
            <li> <a href="<?= URL::route('set-language', array('ru')) ?>"><img src="/template/common/img/flags/ru.png" alt="" /></a>  </li>
        </ul>
    </div>
</div>
<br />
<div class="text-center">
    <img src="https://www.positivessl.com/images-new/PositiveSSL_tl_trans.png" alt="Positive SSL on a transparent background" title="Positive SSL on a transparent background" border="0" />
</div>
<script src="/template/common/js/jquery-1.11.0.js"></script>
<script src="/template/common/js/bootstrap.min.js"></script>
<?php if(isset($js)){echo TplHelpers::addJs($js);} ?>
</body>
</html>