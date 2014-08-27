<div class="bg">
    <div class="main">
        <header>
            <?php echo View::make('site.widgets.header'); ?>
            <?php echo View::make('site.widgets.menu'); ?>
            <?php echo View::make('site.widgets.slider'); ?>
        </header>
        <!-- content -->
        <section id="content">
            <div class="padding">
                <?php echo View::make('site.widgets.three-blocks'); ?>
                <div class="wrapper">
                    <div class="col-3">
                        <div class="indent">
                            <h2>100% прибыльная стратегия!</h2>
                            <p class="color-4 p1">Изначально может показаться, что гарантированная прибыль на рынке Форекс – это утопия и лишь громкое заявление. Однако мы спешим Вас обрадовать, что гарантированная прибыль на рынке Форекс – это реальность!</p>
                            <div class="wrapper">
                                <figure class="img-indent3"><img src="/template/site/img/page1-img1.png" alt="" /></figure>
                                <div class="extra-wrap">
                                    <div class="indent2">Наша автоматизированная торговая стратегия без единого сомнения поможет Вам преумножить Ваш депозит. Наш торговый робот настолько уникален и продуман, что Вы сами убедитесь, насколько все гениально и просто.
                                        Каждая сделка, а точнее будет сказать сессия сделок, будет приносить Вам прибыль в размере от 2 до 5% от вашего депозита. Математика заработка настолько просчитана, что иного результата, кроме как прибыли, просто не возможен!
                                        <br />Не верите?<br />
                                        Купите нашу автоматизированную стратегию и убедитесь сами. А если Вы сможете убедить нас, что наша стратегия не работает, то мы с радостью вернем Вам потраченные Вами деньги на покупку нашего торгового советника. </div>

                                </div>
                                <br />
                                <div style="text-align: right;">
                                    <a href="/about" class="button-2">Узнать о продукте</a>
                                </div>
                            </div>
<!--                            <a class="button-2" href="#">Read More</a>-->
                        </div>
                    </div>
                    <?php echo View::make('site.widgets.right-block'); ?>
                </div>
            </div>
        </section>
        <!-- footer -->
        <?php echo View::make('site.widgets.footer'); ?>
    </div>
</div>
<!--<script type="text/javascript">Cufon.now();</script>-->
<script type="text/javascript">
    $(function () {
        $('.slider')._TMS({
            prevBu: '.prev',
            nextBu: '.next',
            playBu: '.play',
            duration: 800,
            easing: 'easeOutQuad',
            preset: 'simpleFade',
            pagination: false,
            slideshow: 3000,
            numStatus: false,
            pauseOnHover: true,
            banners: true,
            waitBannerAnimation: false,
            bannerShow: function (banner) {
                banner.hide().fadeIn(500)
            },
            bannerHide: function (banner) {
                banner.show().fadeOut(500)
            }
        });
    })
</script>