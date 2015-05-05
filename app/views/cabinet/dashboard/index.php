<br />
<div>

    <div class="panel panel-default">
        <div class="panel-heading">
            <?= trans('history.title') ?>
        </div>
        <div class="panel-body">
            <?php if (count($history) != 0) { ?>
                <table class="table table-hover">
                    <thead>
                    <tr>
                        <th><?= trans('history.titles.changes') ?></th>
                        <th><?= trans('history.titles.project') ?></th>
                        <th><?= trans('history.titles.date') ?></th>
                        <th><?= trans('history.titles.assigned') ?></th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($history as $item) { ?>
                        <tr class="<?= ($item->to_id == Auth::user()->id) ? 'info' : '' ?>">
                            <td>
                                <?= trans(History::getInstance()->historyTypeText($item->act_type), array(
                                    'user_name' => $item->user_name,
                                    'issue_id' => $item->issue_id,
                                    'url' => URL::route('issue-view', array(
                                        'issue_id' => $item->issue_id,
                                        '#comment' . $item->comment_id,
                                    )),
                                )) ?>
                            </td>
                            <td><a href="<?= URL::route('issues-project', array('project_id' => $item->project_id)) ?>"><?= $item->project_title ?></a></td>
                            <td><?= date(trans('common.datetime_format'), $item->act_time) ?></td>
                            <td><?= ($item->to_id == Auth::user()->id) ? trans('history.issue_to_you') :  $item->assignee_name ?> </td>
                        </tr>
                    <?php } ?>
                    </tbody>
                </table>


            <?php } else { ?>
                <div class="alert alert-info"><?= trans('history.no_history') ?></div>
            <?php } ?>
        </div>
        <div class="panel-footer">
            <div class="text-right">
                <?= $history->links(); ?>
            </div>
        </div>
    </div>

</div>