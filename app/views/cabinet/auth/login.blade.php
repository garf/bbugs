<div class="form-signin">
    <div class="text-center">
        <img src="/template/common/img/logos/logo-sm.png" alt="Last Bugs">
    </div>
    <hr>
    <?php echo TplHelpers::systemMessagesFormatted(); ?>
    <div class="tab-content">
        <div id="login" class="tab-pane active">
            <form action="<@ URL::route('login') @>" method="post">
                <p class="text-muted text-center">
                    <@ trans('auth.enter_your') @>
                </p>
                <input type="text" placeholder="<@ trans('auth.email') @>" name="email" class="form-control top">
                <input type="password" placeholder="<@ trans('auth.password') @>" name="password" class="form-control bottom">
                <div class="checkbox">
                    <label>
                        <input type="checkbox"><@ trans('auth.remember') @>
                    </label>
                </div>
                <input class="btn btn-lg btn-primary btn-block" value="<@ trans('auth.enter') @>" type="submit" />
            </form>
        </div>
        <div id="forgot" class="tab-pane">
            <form action="<@ URL::route('recover') @>">
                <p class="text-muted text-center"><@ trans('auth.enter_email') @></p>
                <input type="email" placeholder="mail@domain.com" class="form-control">
                <br>
                <button class="btn btn-lg btn-danger btn-block" type="submit"><@ trans('auth.recover_button') @></button>
            </form>
        </div>
        <div id="signup" class="tab-pane">
            <form action="<@ URL::route('login') @>">
                <input type="text" placeholder="username" class="form-control top">
                <input type="email" placeholder="mail@domain.com" class="form-control middle">
                <input type="password" placeholder="password" class="form-control middle">
                <input type="password" placeholder="re-password" class="form-control bottom">
                <button class="btn btn-lg btn-success btn-block" type="submit">Register</button>
            </form>
        </div>
    </div>
    <hr>
    <div class="text-center">
        <ul class="list-inline">
            <li> <a class="text-muted" href="#login" data-toggle="tab"><@ trans('auth.login') @></a>  </li>
            <li> <a class="text-muted" href="#forgot" data-toggle="tab"><@ trans('auth.forgot') @></a>  </li>
            <li> <a class="text-muted" href="#signup" data-toggle="tab"><@ trans('auth.register') @></a>  </li>
        </ul>
        <ul class="list-inline">
            <li> <a href="<@ URL::route('set-language', array('en')) @>"><img src="/template/common/img/flags/gb.png" alt="" /></a>  </li>
            <li> <a href="<@ URL::route('set-language', array('ru')) @>"><img src="/template/common/img/flags/ru.png" alt="" /></a>  </li>
        </ul>
    </div>
</div>