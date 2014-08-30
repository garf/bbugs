<!doctype html>
<html class="no-js" >
<head>
    <meta charset="UTF-8">
    <title><@@ $title @@> : <@ Config::get('app.sitename') @></title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="/template/common/css/bootstrap.min.css">
    <link rel="stylesheet" href="/template/common/js/metis/jasny-bootstrap/css/jasny-bootstrap.min.css">
    <link rel="stylesheet" href="/template/common/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="/template/common/css/metis/main.min.css">
    <link rel="stylesheet" href="/template/cabinet/css/common.css">

    <?php if(isset($css)){echo TplHelpers::addCss($css);} ?>

    <!--[if lt IE 9]>
    <script src="/template/common/js/metis/html5shiv/html5shiv.js"></script>
    <script src="/template/common/js/metis/respond/respond.min.js"></script>
    <![endif]-->

    <script src="/template/common/js/metis/modernizr/modernizr.min.js"></script>
    <script src="/template/common/js/jquery-1.11.0.js"></script>
    <script src="/template/common/js/angular.min.js"></script>
    <script src="/template/common/js/bootstrap.min.js"></script>
    <script src="/template/common/js/metis/jasny-bootstrap/js/jasny-bootstrap.min.js"></script>
    <script src="/template/common/js/metis/jquery-ui-touch-punch/jquery.ui.touch-punch.min.js"></script>
    <script src="/template/common/js/metis/core.min.js"></script>
    <script src="/template/common/js/metis/app.min.js"></script>

    <?php if(isset($js)){echo TplHelpers::addJs($js);} ?>

</head>
<body class="<@ (isset($body_class) ? $body_class : '') @>" ng-app>
    <@ $body @>
</body>
</html>