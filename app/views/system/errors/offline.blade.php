<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Offline : <?php echo Config::get('app.sitename'); ?></title>
    <meta name="msapplication-TileColor" content="#5bc0de" />
    <link rel="stylesheet" href="/template/common/css/bootstrap.min.css">
    <link rel="stylesheet" href="/template/common/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="/template/common/css/metis/main.min.css">
</head>
<body class="error">
<div class="container">
    <div class="col-lg-8 col-lg-offset-2 text-center">
        <div class="logo">
            <h1><@ trans('errors.offline_header') @></h1>
        </div>
        <p class="lead text-muted"><@ trans('errors.we_offline') @></p>
        <div class="clearfix"></div>
        <br>
        <div class="col-lg-6  col-lg-offset-3">
            <div class="btn-group btn-group-justified">
                <a href="<@ URL::route('index') @>" class="btn btn-primary"><i class="fa fa-recycle"></i> <@ trans('errors.check') @></a>
            </div>
        </div>
    </div>
</div>
</body>
</html>
