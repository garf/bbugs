<html>
<head>
    <title><?php echo Config::get('app.sitename'); ?> :: 500</title>
    <link href="/template/common/css/bootstrap.min.css" rel="stylesheet" />
    <script src="/template/common/js/bootstrap.min.js" type="text/javascript" ></script>
</head>
<body>
<div style="padding: 10px;" class="text-center">
    <img src="/template/common/img/logos/logo.png" alt="" />
</div>
<div class="well well-lg text-center">
    <?php echo TplHelpers::systemMessagesFormatted(); ?>
    <h1>500. Ошибка сервера!</h1>
    <a href="<?php echo URL::previous(); ?>" class="btn btn-info">Назад</a>
    <a href="<?php echo Config::get('app.url'); ?>/contacts" class="btn btn-primary">Связаться с нами</a>
</div>

</body>
</html>
