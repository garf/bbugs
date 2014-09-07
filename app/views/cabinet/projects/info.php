<br />
<div>
    <?php
        $budget_spent = 0;
    ?>
    <div class="col-md-6">
        <div class="box">
            <header>
                <div class="icons">
                    <i class="fa fa-users"></i>
                </div>
                <h5><?= trans('projects.info_users') ?></h5>
                <div class="toolbar">
                    <a href="#usersBox" data-toggle="collapse" class="btn btn-sm btn-default minimize-box">
                        <i class="fa fa-angle-up"></i>
                    </a>
                </div>
            </header>
            <div class="body in" id="usersBox">
                <div class="">
                    <table class="table table-hover">
                        <tbody>
                        <?php foreach($contacts as $contact) { ?>
                            <?php
                            $hours = 0;
                            $user_spent = 0;
                            ?>

                            <tr>
                                <th colspan="2"><?= $contact->name ?></th>
                            </tr>
                            <tr>
                                <td><?= trans('projects.role') ?></td>
                                <td><?= trans('users.roles.' . $contact->role) ?></td>
                            </tr>
                            <?php if ($contact->role != 'observer') { ?>
                                <tr>
                                    <td><?= trans('projects.issues_opened') ?></td>
                                    <td class="text-danger">
                                        <?php
                                        $opcount = 0;
                                        foreach($opened as $op) {
                                            if($op->assigned == $contact->id) {
                                                $opcount++;
                                                $hours += $op->hours_spent;
                                                $user_spent += ($op->hours_spent * $contact->hour_cost);
                                                $budget_spent += ($op->hours_spent * $contact->hour_cost);
                                            }
                                        }
                                        ?>
                                        <?= $opcount ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td><?= trans('projects.issues_closed') ?></td>
                                    <td class="text-success">
                                        <?php
                                        $clcount = 0;
                                        foreach($closed as $cl) {
                                            if($cl->assigned == $contact->id) {
                                                $clcount++;
                                                $hours += $cl->hours_spent;
                                                $user_spent += ($cl->hours_spent * $contact->hour_cost);
                                                $budget_spent += ($cl->hours_spent * $contact->hour_cost);
                                            }
                                        }
                                        ?>
                                        <?= $clcount ?>
                                    </td>
                                </tr>
                                    <tr>
                                        <td><?= trans('projects.hour_cost') ?></td>
                                        <td>
                                            <div id="showHours<?= $contact->id ?>">
                                                <strong><?= Misc::getInstance()->moneyFormat($contact->hour_cost) ?></strong>
                                                <?php if ($is_teamlead) { ?>
                                                    <a href="javascript:void(0);" onclick="$('#editHours<?= $contact->id ?>').show();$('#showHours<?= $contact->id ?>').hide();">Изменить</a>
                                                <?php } ?>
                                            </div>
                                            <div style="display:none;" id="editHours<?= $contact->id ?>">
                                                <form method="post" action="<?= URL::route('set-hour-cost', array('project_id' => $project->id, 'user_id' => $contact->id)) ?>">
                                                    <div class="clearfix">
                                                        <div class="input-group input-group-sm">
                                                            <span class="input-group-addon">$</span>
                                                            <input type="text" name="hour_cost" class="form-control" value="<?= round($contact->hour_cost, 2) ?>" placeholder="30.00" />
                                                            <span class="input-group-btn">
                                                                <a href="javascript:void(0);" class="btn btn-default" onclick="$('#editHours<?= $contact->id ?>').hide();$('#showHours<?= $contact->id ?>').show();"><?= trans('projects.cancel') ?></a>
                                                            </span>
                                                            <span class="input-group-btn">
                                                                <input class="btn btn-success" type="submit" value="<?= trans('projects.set') ?>" />
                                                            </span>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                <tr>
                                    <td><?= trans('projects.involvement') ?></td>
                                    <td>
                                        <?php
                                            $inv_percent = ($all_count != 0) ? ($opcount + $clcount) * 100 / $all_count : 0;
                                        ?>
                                        <?= $inv_percent ?>%
                                        <span class="text-muted">
                                            ( <?= $hours ?> hours
                                            <?php if ($contact->hour_cost != 0) { ?>
                                                - <?= Misc::getInstance()->moneyFormat($user_spent) ?>
                                            <?php } ?>)
                                        </span>
                                    </td>
                                </tr>
                            <?php } ?>
                            <tr class="info">
                                <td colspan="2"></td>
                            </tr>
                        <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>


    <div class="col-md-6">
        <div class="box">
            <header>
                <div class="icons">
                    <i class="fa fa-crosshairs"></i>
                </div>
                <h5><?= trans('projects.info_compl_stats') ?></h5>
                <div class="toolbar">
                    <a href="#projectProgressBox" data-toggle="collapse" class="btn btn-sm btn-default minimize-box">
                        <i class="fa fa-angle-up"></i>
                    </a>
                </div>
            </header>
            <div class="body in" id="projectProgressBox">
                <div class="well">
                    <strong><?= trans('projects.project_progress') ?></strong>
                    <br />
                    <div class="clearfix" style="margin-top: 10px;">
                        <div  style="float: left;"><strong><?= $closed_count ?> <span class="text-success">(<?= $closed_percent ?>%)</span></strong> <?= trans('projects.complete') ?></div>
                        <div  style="float: right;"><strong><?= $opened_count ?> <span class="text-danger">(<?= $opened_percent ?>%)</span> </strong><?= trans('projects.incomplete') ?></div>
                    </div>
                    <div class="progress">
                        <div class="progress-bar progress-bar-success" style="width: <?= $closed_percent ?>%;"></div>
                        <div class="progress-bar progress-bar-danger" style="width: <?= $opened_percent ?>%"></div>
                    </div>

                </div>
                <?php if ($project->budget != 0) { ?>
                    <div style="margin-top: 20px;" class="well">
                        <strong><?= trans('projects.budget_spent') ?></strong> <span class="text-muted"><?= Misc::getInstance()->moneyFormat($project->budget) ?></span>
                        <?php
                            $budget_left = $project->budget - $budget_spent;
                            $budget_spent_percent = ($project->budget != 0) ? $budget_spent * 100 / $project->budget : 0;
                            $budget_left_percent = 100 - $budget_spent_percent;
                        ?>
                        <br />
                        <div class="clearfix" style="margin-top: 10px;">
                            <div style="float: left;">
                                <strong><?= Misc::getInstance()->moneyFormat($budget_spent) ?> <strong class="text-danger">(<?= round($budget_spent_percent, 2) ?>%)</strong></strong> <?= trans('projects.spent') ?>
                            </div>
                            <div  style="float: right;">
                                <strong><?= Misc::getInstance()->moneyFormat($budget_left) ?> <strong class="text-success">(<?= round($budget_left_percent, 2) ?>%)</strong></strong> <?= trans('projects.left') ?>
                            </div>
                        </div>

                        <div class="progress">
                            <div class="progress-bar progress-bar-danger" style="width: <?= round($budget_spent_percent) ?>%;"></div>
                            <div class="progress-bar progress-bar-success" style="width: <?= round($budget_left_percent) ?>%"></div>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>


</div>