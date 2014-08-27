<div class="row">
    <div class="col-md-4 col-md-offset-4">
        <div class="login-panel panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">Авторизация</h3>
            </div>
            <div class="panel-body">
                <form role="form" action="/login-root" method="post">
                    <fieldset>
                        <div class="form-group">
                            <input class="form-control" placeholder="E-mail" name="email" type="email" autofocus>
                        </div>
                        <div class="form-group">
                            <input class="form-control" placeholder="Пароль" name="password" type="password" value="">
                        </div>
                        <div class="checkbox">
                            <label>
                                <input name="remember" type="checkbox" value="Remember Me">Запомнить меня
                            </label>
                        </div>

                        <input type="submit" value="Войти" class="btn btn-lg btn-primary btn-block" />
                        <br />
                        <a href="/">На сайт</a>
                    </fieldset>
                </form>
            </div>
        </div>
    </div>
</div>