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
                    <div class="col-3">
                        <div class="indent">
                            <h2 class="p0"><?php echo $title; ?></h2>
                            <form id="contact-form" action="/contacts" method="post">
                                <fieldset>
                                    <?php echo TplHelpers::systemMessagesFormattedNc(); ?>
                                    <label><span class="text-form">Имя:</span>
                                        <input name="name" type="text" value="<?php echo Input::old('name'); ?>" />
                                    </label>
                                    <label><span class="text-form">Email:</span>
                                        <input name="email" type="text" value="<?php echo Input::old('email'); ?>" />
                                    </label>
                                    <div class="wrapper">
                                        <div class="text-form">Сообщение:</div>
                                        <textarea name="message"><?php echo Input::old('message'); ?></textarea>
                                    </div>
                                    <div class="buttons">
                                        <img src="<?php echo Captcha::img(); ?>" alt="Captcha image" />
                                        <div style="float: right;margin-left: 20px;">
                                            <span>Введите проверочный код:</span>
                                            <br />
                                            <input type="text" name="captcha" style="width: 120px;float: right;" autocomplete="off" />

                                        </div>
                                        <div style="clear:both;"></div>
                                        <br />
                                        <input type="submit" class="button-2" value="Отправить" />
                                    </div>
                                </fieldset>
                            </form>
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="block-news">
                            <h3 class="color-4 indent-bot2">Контакты</h3>
                            <p class="text-1">
                                Вы всегда можете связаться с нами с помощью Email,
                                либо использовав форму обратной связи на этой странице.
                            </p>
                            <br />
                            <dl class="contact p3">
                                <dd><span>E-mail:</span><a href="mailto:info@saturn-fx.com">info@saturn-fx.com</a></dd>
                                <dd><span>Тех. поддержка:</span><a href="mailto:support@saturn-fx.com">support@saturn-fx.com</a></dd>
                                <dd><span>Партнерам:</span><a href="mailto:partners@saturn-fx.com">partners@saturn-fx.com</a></dd>
                            </dl>
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