<br />
<div>

    <?php if (count($history) != 0) { ?>
        <table class="table table-hover">
            <thead>
            <tr>
                <th colspan="4"><?= trans('history.title') ?></th>
            </tr>
            <tr>
                <th>Изменения</th>
                <th>Проект</th>
                <th>Дата</th>
                <th>Назначено</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($history as $item) { ?>
                <tr class="<?= ($item->to_id == Auth::user()->id) ? 'info' : '' ?>">
                    <td>
                        <?= trans(History::getInstance()->historyTypeText($item->act_type), array(
                            'user_name' => $item->user_name,
                            'issue_id' => $item->issue_id,
                            'url' => URL::route('issue-view', array('issue_id' => $item->issue_id)),
                        )) ?>
                    </td>
                    <td><?= $item->project_title ?></td>
                    <td><?= date(trans('common.datetime_format'), $item->act_time) ?></td>
                    <td><?= ($item->to_id == Auth::user()->id) ? trans('history.issue_to_you') :  $item->assignee_name ?> </td>
                </tr>
            <?php } ?>
            </tbody>
        </table>
        <div class="text-right">
            <?= $history->links(); ?>
        </div>

    <?php } else { ?>
        <div class="alert alert-info"><?= trans('history.no_history') ?></div>
    <?php } ?>
</div>