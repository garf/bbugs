<br />
<div>
    <form action="<?= URL::route('search-create-url') ?>" method="post">
        <div class="input-group">
            <span class="input-group-addon" id="sizing-addon1"><?= trans('search.string') ?>:</span>
            <input type="text" class="form-control" name="q" id="qInput" value="<?= e($params['q']) ?>" />
            <span class="input-group-btn">
                <input type="submit" class="btn btn-info" value="<?= trans('search.search') ?>" />
            </span>
        </div>
        <br />
        <label for="assignedInput"><?= trans('search.assigned_to_me') ?></label>
        <input type="checkbox" name="assigned" value="me" id="assignedInput" <?= ($assignedMe ? 'checked="checked"' : '') ?>  />
    </form>
</div>
<br />
<?php if (count($issues)) { ?>
    <div>
    <table class="table table-hover">
        <thead>
        <tr>
            <th>ID</th>
            <th><?= trans('issues.issue_title') ?></th>
            <th><?= trans('issues.project') ?></th>
            <th><?= trans('issues.issue_type') ?></th>
            <th><?= trans('issues.issue_priority') ?></th>
            <th><?= trans('issues.issue_status') ?></th>
            <th><?= trans('issues.assigned') ?></th>
            <th><?= trans('issues.updated') ?></th>
        </tr>
        </thead>
        <?php foreach ($issues as $issue) { ?>
        <tbody>
        <tr class="<?= ($issue->status == 'new') ? 'info' : ''; ?> <?= ($issue->priority == '1') ? 'danger' : ''; ?>">
            <td>#<?= $issue->id ?></td>
            <td>
                <a href="<?= URL::route('issue-view', array('issue_id' => $issue->id)) ?>">
                    <?= preg_replace('#' . $params['q'] . '#ius', '<span class="search-highlight">' . $params['q'] . '</span>', $issue->title) ?>
                </a>
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
            <td><?= $issue->uname ?></td>
            <td><?= date(trans('common.datetime_format'), $issue->updated) ?></td>
        </tr>
        </tbody>
        <?php } ?>
    </table>
    </div>
<?php } else { ?>
    <?php if (!empty($params['q'])) { ?>
        <div class="alert alert-info">Nothing found</div>
    <?php } ?>
<?php } ?>