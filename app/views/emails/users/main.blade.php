<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head profile="http://gmpg.org/xfn/11">
        <style>
            body {color: #000;font-family: "Trebuchet MS", Arial, sans-serif;font-size: 14px;font-weight: normal;}
        </style>
    </head>
    <body>
        <div class="box">
            <div>
                <?php echo $body; ?>
            </div>
            <br />
            ----<br />
            <@ trans('email.best_regards') @><br />
            <a href="<?php echo Config::get('app.url'); ?>"><?php echo Config::get('app.sitename'); ?></a>
        </div>
    </body>
</html>
