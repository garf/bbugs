<div class="row">
    <div class="col-md-4 col-md-offset-4">
        <div class="login-panel panel panel-default">
            <div class="panel-heading text-center">
                <img src="/template/common/img/logos/logo-sm.png" />
            </div>
            <div class="panel-body">
                <h3 class="panel-title text-center">{{{trans('auth.authorization')}}}</h3>
                <br />
                <form role="form" action="{{{URL::route('login')}}}" method="post">
                    <fieldset>
                        <div class="form-group">
                            <input class="form-control" placeholder="{{{trans('auth.email')}}}" name="email" type="email" autofocus>
                        </div>
                        <div class="form-group">
                            <input class="form-control" placeholder="{{{trans('auth.password')}}}" name="password" type="password" value="">
                        </div>
                        <div class="checkbox">
                            <label>
                                <input name="remember" type="checkbox" value="Remember Me">{{{trans('auth.remember')}}}
                            </label>
                        </div>

                        <input type="submit" value="{{{trans('auth.enter')}}}" class="btn btn-lg btn-primary btn-block" />
                        <br />
                        <div style="float: right;">
                            <a href="{{{URL::route('recover')}}}">{{{trans('auth.forget')}}}</a>
                            <br />
                        </div>
                    </fieldset>
                </form>
            </div>
        </div>
    </div>
</div>