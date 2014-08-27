<div class="row">
    <div class="col-md-4 col-md-offset-4">
        <div class="login-panel panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">{{{trans('auth.recover')}}}</h3>
            </div>
            <div class="panel-body">

                <?php if (!Session::has('done')) { ?>
                <form role="form" action="{{{URL::route('recover')}}}" method="post">
                    <fieldset>
                        <div class="well well-sm">
                            {{{trans('auth.enter_email')}}}
                        </div>
                        <div class="form-group">
                            <input class="form-control" placeholder="{{{trans('auth.email')}}}" name="email" type="email" autofocus>
                        </div>
                        <input type="submit" value="{{{trans('auth.recover_button')}}}" class="btn btn-lg btn-warning btn-block" />
                        <br />
                        <a href="{{{URL::route('login')}}}">{{{trans('auth.authorization')}}}</a>
                    </fieldset>
                </form>
                <?php } else { ?>
                    <div class="alert alert-success">{{{trans('auth.new_password_sent')}}}</div>
                    <br />
                    <a href="{{{URL::route('login')}}}">{{{trans('auth.authorization')}}}</a>
                    </fieldset>
                <?php } ?>
            </div>
        </div>
    </div>
</div>