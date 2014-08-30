<!doctype html>
<html class="no-js" >
<head>
    <meta charset="UTF-8">
    <title><@@ $title @@> : <@ Config::get('app.sitename') @></title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="/template/common/css/bootstrap.min.css">
    <link rel="stylesheet" href="/template/common/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="/template/common/css/metis/main.min.css">
    <link rel="stylesheet" href="/template/cabinet/css/common.css">

    <?php if(isset($css)){echo TplHelpers::addCss($css);} ?>
</head>
<body class="<@ (isset($body_class) ? $body_class : '') @>" ng-app>
    <@ $body @>
    <script src="/template/common/js/jquery-1.11.0.js"></script>
    <script src="/template/common/js/bootstrap.min.js"></script>

    <?php if(isset($js)){echo TplHelpers::addJs($js);} ?>
    <script type="text/javascript">
        (function($) {
            $(document).ready(function() {
                $('.list-inline li > a').click(function() {
                    var activeForm = $(this).attr('href') + ' > form';
                    //console.log(activeForm);
                    $(activeForm).addClass('animated fadeIn');
                    //set timer to 1 seconds, after that, unload the animate animation
                    setTimeout(function() {
                        $(activeForm).removeClass('animated fadeIn');
                    }, 1000);
                });
            });
        })(jQuery);
    </script>
</body>
</html>