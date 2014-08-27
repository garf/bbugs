<h2>Партнерам</h2>
<div class="wrapper indent-bot">
    <div class="col-3">
        <div class="wrapper">
            <figure class="img-indent3"><img src="/template/site/img/page3-img6.png" alt="" /></figure>
            <div class="extra-wrap">
                <h6>Взаимовыгодное партнерство - одно из главных составляющих любого бизнеса.</h6>
                Только взаимовыгодное и честное сотрудничество с партнерами может привести к нашему общему успеху.
                Именно поэтому мы предлагаем достойное предложение в размере <?php echo Config::get('mlm.bonus_percent'); ?>% от стоимости продажи.
                <br />
                Мы прекрасно понимаем, что денежное вознаграждение - это не единственное требование наших партнеров.
                Ведение рекламных кампаний в таких социальных сетях как Вконтате, Фейсбук, Твиттер и другие,
                использование различные сервисы контекстной рекламы, продвижение через лэндинг пейджи и другие методы
                требуют отслеживание переходов клиентов для анализа эффективности той или иной рекламной кампании.
                Поэтому мы максимально постарались создать удобный сервис работы с потенциальными клиентами для наших партнеров.
            </div>
        </div>
    </div>
    <div class="col-4">
        <div class="wrapper">
            <figure class="img-indent2"><img src="/template/site/img/page4-img1.png" alt="" /></figure>
            <div class="extra-wrap">
                <h6>Расчет с нашими партнерами осуществляется два раза в неделю через QIWI-кошелек и Webmoney.</h6>
                Автоматизированная стратегия Saturn-FX действительно качественный продукт,
                который не стыдно рекомендовать даже родным и близким.
                <br />
                Этот продукт настолько легок и прост в
                использовании, что даже самые неуверенные пользователи смогут разобраться в настройке и запуске
                данного торгового робота.
                <br />
                И самое главное в нашем торговом роботе – это то что он гарантированно приносит прибыль!
                <br />
                По любым вопросам сотрудничества обращайтесь по форме обратной связи,
                либо пишите нам на наш e-mail - <nobr><a href="mailto:partners@saturn-fx.com">partners@saturn-fx.com</a></nobr>
            </div>
        </div>
    </div>
</div>

<div class="page-well" id="register-form">
    <div class="form-logo-right">
        <img src="/template/common/img/logos/logo-partner.png" alt="" />
    </div>
    <h3 style="margin-bottom: 50px;">Регистрация партнера</h3>
    <?php echo TplHelpers::systemMessagesFormattedNc(); ?>
    <?php if(!Session::has('done')) { ?>

    <div class="col-my">
        <form method="post" action="/partners" >
            <br />
            <br />
            <label>
                <span>Телефон</span>
                <input type="text" name="phone" value="<?php echo Input::old('phone', '+7'); ?>" style="width: 160px;" maxlength="12" />
            </label>
            <br />
            <br />
            <label>
                <span>E-mail</span>
                <input type="text" name="email" type="email" value="<?php echo Input::old('email', ''); ?>" />
            </label>
            <div style="text-align: right; width: 450px;">
                <span style="color: #999;font-size: 14px;text-align: right;">Укажите действующий e-mail. На него придет доступ в личный кабинет</span>
            </div>
            <br />
            <label>
                <span>Фамилия</span>
                <input type="text" name="last_name" value="<?php echo Input::old('last_name', ''); ?>" />
            </label>
            <br />
            <br />
            <label>
                <span>Имя</span>
                <input type="text" name="first_name" value="<?php echo Input::old('first_name', ''); ?>" />
            </label>
            <br />
            <br />
            <label>
                <span>Отчество</span>
                <input type="text" name="middle_name" value="<?php echo Input::old('middle_name', ''); ?>" />
            </label>
            <br />
            <?php if(!$x) { ?>
                <br />
                <label>
                    <span>Партнерский код</span>
                    <input type="text" name="parent" value="<?php echo Input::old('parent', ''); ?>" style="width: 100px;" />
                    <span style="color: #999;font-size: 14px;text-align: left;">(Если есть)</span>
                </label>
                <br />
            <?php } else { ?>
                <input type="hidden" name="parent" value="<?php echo Session::get('x', 0); ?>" />
            <?php } ?>
            <br />
            <br />
            <label><input type="checkbox" name="agree" value="1" /> Согласен с условиями использования</label>
            <br />
            <a href="/terms" style="text-indent: 113px;display:inline-block;">условия использования</a>
            <br />
            <hr />
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
        </form>
    </div>
    <?php } ?>
</div>