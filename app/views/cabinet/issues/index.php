<br />
<link rel="stylesheet" href="/template/common/js/metis/datatables/3/dataTables.bootstrap.css" />
<div class="well well-sm">
    <?php if (count($aprojects) > 0) { ?>
        <div class="btn-group">
            <button type="button" class="btn btn-danger dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                <?= trans('issues.new_issue') ?> <span class="caret"></span>
            </button>
            <ul class="dropdown-menu" role="menu">
                <?php foreach ($aprojects as $aproject) { ?>
                    <li><a href="<?= URL::route('issue-new', array('project_id' => $aproject->id)); ?>"><?= $aproject->title ?></a></li>
                <?php } ?>
            </ul>
        </div>
    <?php } ?>
    <a href="<?= URL::route('projects') ?>" class="btn btn-success"><?= trans('menu.projects') ?></a>
</div>
<strong><?= trans('issues.filter') ?>:</strong>
<div class="btn-group">
    <a href="<?= URL::route('issues', array('stat' => 'not_done')) ?>"
       class="btn btn-xs btn-info">
        <?= trans('issues.all_opened') ?>
    </a>
    <button type="button" class="btn btn-xs btn-info dropdown-toggle" data-toggle="dropdown">
        <span class="caret"></span>
        <span class="sr-only"></span>
    </button>
    <ul class="dropdown-menu" role="menu">
        <li>
            <a href="<?= URL::route('issues', array('stat' => 'new')) ?>">
                <?= trans('issues.status.news.title') ?>
            </a>
        </li>
        <li>
            <a href="<?= URL::route('issues', array('stat' => 'opened')) ?>">
                <?= trans('issues.status.openeds.title') ?>
            </a>
        </li>
        <li>
            <a href="<?= URL::route('issues', array('stat' => 'in_work')) ?>">
                <?= trans('issues.status.in_works.title') ?>
            </a>
        </li>
        <li>
            <a href="<?= URL::route('issues', array('stat' => 'need_feedback')) ?>">
                <?= trans('issues.status.need_feedbacks.title') ?>
            </a>
        </li>
        <li>
            <a href="<?= URL::route('issues', array('stat' => 'realized')) ?>">
                <?= trans('issues.status.realizeds.title') ?>
            </a>
        </li>
        <li>
            <a href="<?= URL::route('issues', array('stat' => 'rework')) ?>">
                <?= trans('issues.status.reworks.title') ?>
            </a>
        </li>
    </ul>
</div>
<div class="btn-group">
    <a href="<?= URL::route('issues', array('stat' => 'done')) ?>"
       class="btn btn-default btn-xs">
        <?= trans('issues.all_closed') ?>
    </a>
    <button type="button" class="btn btn-default btn-xs dropdown-toggle" data-toggle="dropdown">
        <span class="caret"></span>
        <span class="sr-only"></span>
    </button>
    <ul class="dropdown-menu" role="menu">
        <li>
            <a href="<?= URL::route('issues', array('stat' => 'closed')) ?>">
                <?= trans('issues.status.closed.title') ?>
            </a>
        </li>
        <li>
            <a href="<?= URL::route('issues', array('stat' => 'not_actual')) ?>">
                <?= trans('issues.status.not_actual.title') ?>
            </a>
        </li>
    </ul>
</div>
<br />
<br />

<br />
<?php if (count($issues) != 0) { ?>
    <div>
        <table class="table table-hover" id="dataTable">
            <thead>
            <tr>
                <th>ID</th>
                <th><?= trans('issues.issue_title') ?></th>
                <th><?= trans('issues.project') ?></th>
                <th><?= trans('issues.issue_type') ?></th>
                <th><?= trans('issues.issue_priority') ?></th>
                <th><?= trans('issues.issue_status') ?></th>
                <th><?= trans('issues.updated') ?></th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($issues as $issue) { ?>
                <tr class="<?= ($issue->status == 'new') ? 'info' : ''; ?> <?= ($issue->priority == '1') ? 'danger' : ''; ?>">
                    <td>#<?= $issue->id ?></td>
                    <td>
                        <a href="<?= URL::route('issue-view', array('issue_id' => $issue->id)) ?>"><?= $issue->title ?></a>
                    </td>
                    <td>
                        <div class="btn-group">
                            <a href="<?= URL::route('issues-project', array($issue->project_id)) ?>" class="btn btn-default btn-xs"><?= $issue->ptitle ?></a>
                            <button type="button" class="btn btn-default btn-xs dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                                <span class="caret"></span>
                                <span class="sr-only">More params</span>
                            </button>
                            <ul class="dropdown-menu" role="menu">

                                <?php if (!Projects::getInstance()->isProjectObserver(Auth::user()->id, $issue->pid)) { ?>
                                    <li><a href="<?= URL::route('issue-new', array('project_id' => $issue->pid)); ?>"><?= trans('issues.new_issue') ?></a></li>
                                    <li class="divider"></li>
                                <?php } ?>
                                <li>
                                    <a href="<?= URL::route('project-info', array('project_id' => $issue->pid)) ?>">
                                        <?= trans('projects.view_info') ?>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </td>
                    <td><i class="<?= trans('issues.type.' . $issue->issue_type . '.bs_icon_class') ?>"></i> <?= trans('issues.type.' . $issue->issue_type . '.title') ?></td>
                    <td class="<?= trans('issues.priority.' . $issue->priority . '.class') ?>"><?= trans('issues.priority.' . $issue->priority . '.title') ?></td>
                    <td><?= trans('issues.status.' . $issue->status . '.title') ?></td>
                    <td><?= date(trans('common.datetime_format'), $issue->updated) ?></td>
                </tr>
            <?php } ?>
            </tbody>
        </table>
    </div>
<?php } else { ?>
    <div class="alert alert-info"><?= trans('issues.no_issues_assigned') ?></div>
<?php } ?>