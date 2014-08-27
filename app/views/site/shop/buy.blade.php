<div>
    <h2>Покупка робота</h2>
    <form method="post" action="/buy" >
        <fieldset>
            <div class="buy-well">
                <div class="buy-form">
                    <div class="alert alert-info">
                        После прохождения оплаты в течение 10 минут на ваш e-mail придет доступ в ваш личный кабинет,
                        где вы сможете завершить регистрацию и скачать робота и инструкцию по стратегии и работе с этим роботом.
                        <br />
                        Убедитесь, что ввели e-mail верно, иначе мы не сможем прислать вам доступ в ваш кабинет.
                        <br />
                        Если письмо так и не пришло, проверьте папку "Спам" и <a href="/contacts">свяжитесь с администрацией</a>.
                    </div>
                    <?php if(count($merchants) != 1) { ?>
                    <br />
                    <br />
                    <label>
                        <span>Способ оплаты</span>
                        <select name="service">
                            <?php foreach($merchants as $m) { ?>
                                <option value="<?php echo $m['service']; ?>" <?php echo (Input::old('service', 'robox') == $m['service']) ? 'selected="selected"' : ''; ?>><?php echo $m['title']; ?></option>
                            <?php } ?>
                        </select>
                    </label>
                    <?php } else { ?>
                        <input type="hidden" name="service" value="<?php echo current($merchants)['service']; ?>" />
                    <?php } ?>
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
                        <span style="color: #999;font-size: 14px;text-align: right;">Укажите действующий e-mail. На него придет доступ в личный кабинет.</span>
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
                    <label><input type="checkbox" name="agree" value="1" /> Согласен с условиями продажи</label>
                    <br />
                    <a href="/terms" style="text-indent: 113px;display:inline-block;">условия продажи</a>
                    <br />
                    <br />
                    <?php echo TplHelpers::systemMessagesFormattedNc(); ?>
                    <br /><br />
                    <input type="submit" value="Перейти к оплате" class="button-2" onclick="yaCounter25498940.reachGoal('ORDER_MADE');return true;" />
                    <br /><br />
                </div>
                <div class="pretty-price">
                    Робот Saturn-FX<br />
                    <span class="rub rub-big"><?php echo $price; ?></span>
                    <br />
                    <div style="text-align: center;">
                        <?php foreach($merchants as $m) { ?>
                            <img src="<?php echo $m['logo']; ?>" style="height: 60px; margin: 10px;" alt="<?php echo $m['title']; ?>" />
                            <br />
                        <?php } ?>
                    </div>
                </div>
                <div class="clearfix"></div>
            </div>
        </fieldset>
    </form>
</div>
