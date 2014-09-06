<br />
<?php if (count($issues) != 0) { ?>
    <div>
        <table class="table table-hover" id="dataTable">
            <tr>
                <th>ID</th>
                <th><?= trans('issues.issue_title') ?></th>
                <th><?= trans('issues.project') ?></th>
                <th><?= trans('issues.issue_status') ?></th>
                <th><?= trans('issues.issue_priority') ?></th>
                <th><?= trans('issues.issue_type') ?></th>
                <th><?= trans('issues.updated') ?></th>
            </tr>
            <?php foreach ($issues as $issue) { ?>
                <tr class="<?= ($issue->status == 'new') ? 'info' : ''; ?> <?= ($issue->priority == '1') ? 'danger' : ''; ?>">
                    <td>#<?= $issue->id ?></td>
                    <td>
                        <a href="<?= URL::route('issue-view', array('issue_id' => $issue->id)) ?>"><?= $issue->title ?></a>
                    </td>
                    <td><a href="<?= URL::route('issues-project', array($issue->project_id)) ?>"><?= $issue->ptitle ?></a></td>
                    <td><?= trans('issues.status.' . $issue->status . '.title') ?></td>
                    <td class="<?= trans('issues.priority.' . $issue->priority . '.class') ?>"><?= trans('issues.priority.' . $issue->priority . '.title') ?></td>
                    <td><?= trans('issues.type.' . $issue->issue_type . '.title') ?></td>
                    <td><?= date(trans('common.datetime_format'), $issue->updated) ?></td>
                </tr>
            <?php } ?>
        </table>
    </div>
<?php } else { ?>
    <div class="alert alert-info"><?= trans('issues.no_issues_assigned') ?></div>
<?php } ?>