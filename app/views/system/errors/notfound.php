<html>
<head>
    <title><?php echo Config::get('app.sitename'); ?> :: 404</title>
    <link href="/template/common/css/bootstrap.min.css" rel="stylesheet" />
    <script src="/template/common/js/bootstrap.min.js" type="text/javascript" ></script>
</head>
<body>
    <div style="padding: 10px;" class="text-center">
        <img src="/template/common/img/logos/logo.png" alt="" />
    </div>
    <div class="well well-lg text-center">
        <?php echo TplHelpers::systemMessagesFormatted(); ?>
        <h1>404! Страница не найдена.</h1>
        <a href="<?php echo URL::previous(); ?>" class="btn btn-info">Назад</a>
    </div>

</body>
</html>
