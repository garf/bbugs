<!DOCTYPE html>
<html lang="en">
<head>
    <title><?php echo isset($title) ? strip_tags($title) . ' :: ' : ''; ?><?php echo Config::get('app.sitename'); ?></title>
    <meta charset="utf-8">
    <link rel="shortcut icon" href="/favicon.png"/>
    <link rel="stylesheet" href="/template/site/css/reset.css" type="text/css" media="screen">
    <link rel="stylesheet" href="/template/site/css/style.css" type="text/css" media="screen">
    <link rel="stylesheet" href="/template/site/css/layout.css" type="text/css" media="screen">
    <?php if(isset($css)){echo TplHelpers::addCss($css);} ?>
    <script type="text/javascript" src="/template/site/js/jquery-1.6.min.js"></script>
    <script type="text/javascript" src="/template/site/js/tms-0.3.js"></script>
    <script type="text/javascript" src="/template/site/js/tms_presets.js"></script>
    <script type="text/javascript" src="/template/site/js/jquery.easing.1.3.js"></script>
    <script src="/template/site/js/FF-cash.js" type="text/javascript"></script>
    <?php if(isset($js)){echo TplHelpers::addJs($js);} ?>
    <!--[if lt IE 9]>
    <script type="text/javascript" src="/template/site/js/html5.js"></script>
    <link rel="stylesheet" href="/template/site/css/ie.css" type="text/css" media="screen">
    <![endif]-->
</head>
<body id="page3">
@include('widgets.counters')
<!-- header -->
<div class="bg">
    <div class="main">
        <header>
            @include('site.widgets.header')
            @include('site.widgets.menu')
        </header>
        <!-- content -->
        <section id="content">
            <div class="padding">
                <div class="indent">
                    <div class="wrapper indent-bot">
                        <?php echo $body; ?>
                    </div>
                </div>
                @include('site.widgets.three-blocks')
            </div>
        </section>
        <!-- footer -->
        @include('site.widgets.footer')
    </div>
</div>
</html>