<div>
    <br />
    <div class="col-md-1"></div>
    <div class="col-md-5">
        <div class="box">
            <header>
                <div class="icons">
                    <i class="fa fa-lock"></i>
                </div>
                <h5><?= trans('users.password_changing') ?></h5>
                <div class="toolbar">

                </div>
            </header>
            <div class="body" ng-controller="ChangePasswordController">
                <form action="<?= URL::route('settings-password-save') ?>" method="post" class="form-horizontal">
                    <div class="form-group">
                        <label for="oldPass" class="control-label col-lg-4"><?= trans('users.old_password') ?></label>
                        <div class="col-lg-8">
                            <input id="oldPass" ng-model="oldPassword" class="form-control" type="password" name="old_password">
                        </div>
                    </div>
                    <hr />
                    <div class="form-group">
                        <label for="newPass" class="control-label col-lg-4"><?= trans('users.new_password') ?></label>
                        <div class="col-lg-8">
                            <input id="newPass" class="form-control" ng-model="newPassword" type="password" name="password">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="confirmPass" class="control-label col-lg-4"><?= trans('users.repeat_password') ?></label>
                        <div class="col-lg-8">
                            <input id="confirmPass" class="form-control" ng-model="confirmPassword" type="password" name="password_confirmation">
                        </div>
                    </div>
                    <div class="alert alert-warning" ng-hide="isSimilar()"><?= trans('validation.custom.password.confirmed') ?></div>
                    <div class="alert alert-warning" ng-hide="isMin()"><?= trans('validation.custom.password.min') ?></div>
                    <div class="alert alert-warning" ng-hide="isOldpass()"><?= trans('validation.custom.old_password.required') ?></div>
                    <div class="text-right">
                        <input type="submit" value="<?= trans('users.change_password') ?>" class="btn btn-primary" />
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="col-md-5">
        <div class="box">
            <header>
                <div class="icons">
                    <i class="fa fa-user"></i>
                </div>
                <h5><?= trans('users.profile_settings') ?></h5>
                <div class="toolbar">

                </div><!-- /.toolbar -->
            </header>
            <div class="body">
                <form action="<?= URL::route('settings-profile-save') ?>" method="post" class="form-horizontal">
                    <div class="form-group">
                        <label for="profileName" class="control-label col-lg-4"><?= trans('users.name') ?></label>
                        <div class="col-lg-8">
                            <input id="profileName" class="form-control" type="text" name="name" value="<?= Auth::user()->name ?>" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="profilePhone" class="control-label col-lg-4"><?= trans('users.phone') ?></label>
                        <div class="col-lg-8">
                            <input id="profilePhone" class="form-control" type="text" name="phone" value="+<?= Auth::user()->phone ?>" />
                        </div>
                    </div>
                    <div class="text-right">
                        <input type="submit" value="<?= trans('users.update_profile') ?>" class="btn btn-primary disabled" />
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="col-md-1"></div>

</div>