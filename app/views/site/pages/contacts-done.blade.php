<!-- header -->
<div class="bg">
    <div class="main">
        <header>
            <?php echo View::make('site.widgets.header'); ?>
            <?php echo View::make('site.widgets.menu'); ?>
        </header>
        <!-- content -->
        <section id="content">
            <div class="padding">
                <div class="wrapper margin-bot">
                    <div style="padding-right: 32px;">
                        <div class="indent">
                            <h2 class="p0"><?php echo $title; ?></h2>
                            <div class="alert alert-success">Ваше сообщение отправлено успешно!</div>
                        </div>
                    </div>
                </div>
                <?php echo View::make('site.widgets.three-blocks'); ?>
            </div>
        </section>
        <!-- footer -->
        <?php echo View::make('site.widgets.footer'); ?>
    </div>
</div>