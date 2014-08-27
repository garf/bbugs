<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="/favicon.png"/>
    <title><?php echo isset($title) ? $title . ' :: ' : ''; ?><?php echo Config::get('app.sitename'); ?></title>
    <link href="/template/common/css/bootstrap.min.css" rel="stylesheet">
    <link href="/template/common/font-awesome/css/font-awesome.css" rel="stylesheet">
    <link href="/template/common/css/sb-admin.css" rel="stylesheet">
    <link href="/template/common/css/plugins/dataTables/dataTables.bootstrap.css" rel="stylesheet">
    <?php if(isset($css)){echo TplHelpers::addCss($css);} ?>

    <!-- Core Scripts - Include with every page -->
    <script src="/template/common/js/jquery-1.10.2.js"></script>
    <script src="/template/common/js/bootstrap.min.js"></script>
    <script src="/template/common/js/plugins/metisMenu/jquery.metisMenu.js"></script>
    <script src="/template/common/js/plugins/dataTables/jquery.dataTables.js"></script>
    <script src="/template/common/js/plugins/dataTables/dataTables.bootstrap.js"></script>
    <?php if(isset($js)){echo TplHelpers::addJs($js);} ?>
    <!-- Page-Level Plugin Scripts - Blank -->

    <!-- SB Admin Scripts - Include with every page -->
    <script src="/template/common/js/sb-admin.js"></script>

    <!-- Page-Level Demo Scripts - Blank - Use for reference -->
</head>

<body>

<div id="wrapper">

<nav class="navbar navbar-default navbar-inverse navbar-fixed-top" role="navigation" style="margin-bottom: 0">
<div class="navbar-header">
    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".sidebar-collapse">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
    </button>
    <a class="navbar-brand" href="/root"><img src="/template/common/img/logos/logo_small_admin.png" alt="<?php echo Config::get('app.sitename'); ?>" /></a>
</div>
<!-- /.navbar-header -->
<?php echo View::make('root.widgets.navbar'); ?>
<?php echo View::make('root.widgets.left-menu'); ?>


</nav>

<div id="page-wrapper">
    <?php echo TplHelpers::systemMessagesFormatted(); ?>
    <div class="row">

        <div class="col-lg-12">
            <h1 class="page-header"><?php echo (isset($title)) ? $title : ''; ?></h1>
            <?php echo $body; ?>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
</div>
<!-- /#page-wrapper -->

</div>
<!-- /#wrapper -->


</body>

</html>
