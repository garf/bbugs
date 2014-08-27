<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Garfild">
    <link rel="shortcut icon" href="/favicon.png">

    <title>{{{Config::get('app.sitename')}}} : {{{$title}}}</title>
    <!-- Bootstrap Core CSS -->
    <link href="/template/common/css/bootstrap.min.css" rel="stylesheet">
    <!-- MetisMenu CSS -->
    <link href="/template/common/css/plugins/metisMenu/metisMenu.min.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="/template/common/css/sb-admin-2.css" rel="stylesheet">
    <!-- Custom Fonts -->
    <link href="/template/common/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <?php if(isset($css)){echo TplHelpers::addCss($css);} ?>

    <?php if(isset($js)){echo TplHelpers::addJs($js);} ?>

    <!-- jQuery Version 1.11.0 -->
    <script src="/template/common/js/jquery-1.11.0.js"></script>
    <!-- Bootstrap Core JavaScript -->
    <script src="/template/common/js/bootstrap.min.js"></script>
    <!-- Metis Menu Plugin JavaScript -->
    <script src="/template/common/js/plugins/metisMenu/metisMenu.min.js"></script>
    <!-- Custom Theme JavaScript -->
    <script src="/template/common/js/sb-admin-2.js"></script>
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>

<body>
<?php echo TplHelpers::systemMessagesFormatted(); ?>
<div class="wrapper">
    <?php echo $body; ?>
</div>

</body>

</html>
