<br />
<div>
<table>
    <?php var_dump($results); ?>
    <?php foreach ($results as $res) { ?>
    <tr>
        <td><?= $res->title ?></td>
    </tr>
    <?php } ?>
</table>
</div>