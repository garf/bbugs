<br />
<div>
<table>
    <div class="alert alert-info"><?= trans('common.in_dev') ?></div>
    <?php //var_dump($results); ?>
    <?php foreach ($results as $res) { ?>
    <tr>
        <td><?= $res->title ?></td>
    </tr>
    <?php } ?>
</table>
</div>