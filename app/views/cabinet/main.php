<!DOCTYPE html>
<html class="no-js">
<head>
    <meta charset="UTF-8">
    <title><?= e($title) ?> : <?= Config::get('app.sitename') ?></title>
    <link rel="shortcut icon" href="/favicon.png">

    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="/template/common/css/bootstrap.min.css">
    <link rel="stylesheet" href="/template/common/js/metis/jasny-bootstrap/css/jasny-bootstrap.min.css">
    <link rel="stylesheet" href="/template/common/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="/template/common/css/metis/main.min.css">
    <link rel="stylesheet" href="/template/common/css/highlight/sunburst.css">
    <link rel="stylesheet" href="/template/cabinet/css/common.css">
    <?php if(isset($css)){echo TplHelpers::addCss($css);} ?>
    <!--[if lt IE 9]>
    <script src="/template/common/js/metis/html5shiv/html5shiv.js"></script>
    <script src="/template/common/js/metis/respond/respond.min.js"></script>
    <![endif]-->
    <script src="/template/common/js/metis/modernizr/modernizr.min.js"></script>
    <script src="/template/common/js/highlight.pack.js"></script>
    <script src="/template/common/js/jquery-1.11.0.js"></script>
    <script src="/template/common/js/bootstrap.min.js"></script>
    <script src="/template/common/js/angular.min.js"></script>

</head>
<body class="<?= (isset($body_class) ? $body_class : '') ?> bgimage <?= TplHelpers::getBgClass(); ?>" ng-app>
<div class=" dk bgimage <?= TplHelpers::getBgClass(); ?>" id="wrap">
<div id="top">

    <?= View::make('cabinet.widgets.navbar') ?>
    <header class="head">
        <div class="search-bar">
            <form class="main-search" action="<?= URL::route('search-create-url') ?>" method="post" id="mainSearch">
                <div class="input-group">
                    <input type="text" class="form-control" placeholder="<?= trans('menu.search_ph') ?>" name="q">
                <span class="input-group-btn">
                    <button class="btn btn-primary btn-sm text-muted" type="button" onclick="$('#mainSearch').submit();">
                        <i class="fa fa-search"></i>
                    </button>
                </span>
                </div>
            </form>
        </div>
        <div class="main-bar">
            <h3><i class="fa fa-th-large"></i>&nbsp; <?= e($title) ?></h3>
        </div>
    </header>
</div>
<div id="left">

<?= View::make('cabinet.widgets.user-info') ?>
<?= View::make('cabinet.widgets.left-menu') ?>
</div>
<div id="content" data-canvas="body">
    <div class="outer">
        <?= TplHelpers::systemMessagesFormatted() ?>
        <div class="inner bg-light lter"  style="min-height: 500px;">
            <?= $body ?>
        </div>
    </div>
</div>

</div>
<footer class="Footer bg-dark dker">
    <p>2014 &copy; Last Bugs</p>
</footer>

<!--<script src="/template/common/js/metis/jasny-bootstrap/js/jasny-bootstrap.min.js"></script>-->
<!--<script src="/template/common/js/metis/jquery-ui-touch-punch/jquery.ui.touch-punch.min.js"></script>-->
<script src="/template/common/js/metis/autosize/jquery.autosize.min.js"></script>
<script src="/template/common/js/metis/core.js"></script>
<?php if(isset($js)){echo TplHelpers::addJs($js);} ?>
<script>
    hljs.initHighlightingOnLoad();
</script>
</body>
</html>
