<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="/favicon.png"/>
    <title><?php echo isset($title) ? $title . ' :: ' : ''; ?><?php echo Config::get('app.sitename'); ?></title>

    <!-- Core CSS - Include with every page -->
    <link href="/template/common/css/bootstrap.min.css" rel="stylesheet">
    <link href="/template/common/font-awesome/css/font-awesome.css" rel="stylesheet">

    <!-- SB Admin CSS - Include with every page -->
    <link href="/template/common/css/sb-admin.css" rel="stylesheet">


    <!-- Core Scripts - Include with every page -->
    <script src="/template/common/js/jquery-1.10.2.js"></script>
    <script src="/template/common/js/bootstrap.min.js"></script>
    <script src="/template/common/js/plugins/metisMenu/jquery.metisMenu.js"></script>

    <!-- SB Admin Scripts - Include with every page -->
    <script src="/template/common/js/sb-admin.js"></script>


</head>

<body>
<?php echo TplHelpers::systemMessagesFormatted(); ?>
<div class="container">
    <?php echo $body; ?>
</div>

</body>

</html>
