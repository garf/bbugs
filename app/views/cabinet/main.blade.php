<!DOCTYPE html>
<html class="no-js">
<head>
    <meta charset="UTF-8">
    <title>{{{Config::get('app.sitename')}}} : {{{$title}}}</title>

    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="/template/common/css/bootstrap.min.css">
    <link rel="stylesheet" href="/template/common/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="/template/common/css/metis/main.min.css">

    <?php if(isset($css)){echo TplHelpers::addCss($css);} ?>
    <!--[if lt IE 9]>
    <script src="/template/common/js/metis/html5shiv/html5shiv.js"></script>
    <script src="/template/common/js/metis/respond/respond.min.js"></script>
    <![endif]-->
    <script src="/template/common/js/metis/modernizr/modernizr.min.js"></script>
    <script src="/template/common/js/jquery-1.11.0.js"></script>
    <script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/jquery-ui.min.js"></script>
    <script src="/template/common/js/bootstrap.min.js"></script>
    <script src="/template/common/js/metis/core.js"></script>

    <?php if(isset($js)){echo TplHelpers::addJs($js);} ?>


</head>
<body class="<?php echo (isset($body_class) ? $body_class : ''); ?> menu-affix">
<div class="bg-dark dk" id="wrap">
<div id="top">

    {{View::make('cabinet.widgets.navbar')}}
    <header class="head">
        <div class="search-bar">
            <form class="main-search" action="">
                <div class="input-group">
                    <input type="text" class="form-control" placeholder="{{{trans('menu.search_ph')}}}">
                <span class="input-group-btn">
            <button class="btn btn-primary btn-sm text-muted" type="button">
                <i class="fa fa-search"></i>
            </button>
        </span>
                </div>
            </form>
        </div>
        <div class="main-bar">
            <h3><i class="fa fa-th-large"></i>&nbsp; {{{$title}}}</h3>
        </div>
    </header>
</div>
<div id="left">

{{View::make('cabinet.widgets.user-info')}}
{{View::make('cabinet.widgets.left-menu')}}
</div>
<div id="content">
    <div class="outer">
        <?php echo TplHelpers::systemMessagesFormatted(); ?>
        <div class="inner bg-light lter"  style="min-height: 500px;">
            {{$body}}
        </div>
    </div>
</div>

</div>
<footer class="Footer bg-dark dker">
    <p>2014 &copy; Last Bugs</p>
</footer>


</body>
</html>
