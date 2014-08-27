<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head profile="http://gmpg.org/xfn/11">
        <style>
            body {background: #000000;color: #111;font-family: "Trebuchet MS", Arial, sans-serif;font-size: 14px;font-weight: normal;}
            a {color: #0081d7;}
            .logo {margin: 20px;}
            .box {border: 1px solid #000;border-radius: 4px;padding: 20px;margin: 20px;background: #fff;box-shadow: 3px 3px 3px #000;}
            p {margin-left: 0;padding-left: 0;}
        </style>
    </head>
    <body>
        <div>
            <img src="<?php echo $message->embed('template/common/img/logos/logo_shadow.png'); ?>" class="logo" />
            <!--        <img src="--><?php //echo Config::get('app.url'); ?><!--/template/common/img/logos/logo_medium.png" />-->
        </div>
        <div class="box">
            <div>
                <?php echo $body; ?>
            </div>
            <br />
            ----<br />
            С уважением,<br />
            <a href="<?php echo Config::get('app.url'); ?>"><?php echo Config::get('app.sitename'); ?></a>
        </div>
    </body>
</html>
