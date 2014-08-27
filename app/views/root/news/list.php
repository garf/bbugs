<div>
    <div class="well well-sm">
        <a href="/root/news-add" class="btn btn-success">Добавить</a>
        <a href="/root/news-tags" class="btn btn-primary">Тэги</a>
    </div>
    <?php if($news->getTotal() > 0) { ?>
        <?php echo $news->links(); ?>
        <table class="table table-hover">
            <thead>
            <tr>
                <th style="width: 100px;">ID</th>
                <th>Заголовок</th>
                <th style="width: 180px;">Дата размещения</th>
                <th style="width: 120px;">Опции</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($news as $new) { ?>
            <tr class="<?php echo ($new->status == '1') ? 'success' : 'danger'; ?>">
                <td><?php echo $new->id; ?></td>
                <td>
                    <a href="/root/news-edit/<?php echo $new->id; ?>">
                        <?php echo $new->title; ?>
                    </a>
                </td>
                <td><?php echo date('d.m.Y H:i', $new->act_date); ?></td>
                <td>
                    <a href="/root/news-edit/<?php echo $new->id; ?>" class="btn btn-xs btn-success"><i class="fa fa-pencil"></i></a>
                    <a href="/root/news-activation/<?php echo $new->id; ?>" class="btn btn-xs btn-warning"><i class="fa fa-check-square"></i></a>
                    <a href="/root/news-del/<?php echo $new->id; ?>" class="btn btn-xs btn-danger" onclick="return confirm('Удалить новость?');"><i class="fa fa-times"></i></a>
                </td>
            </tr>
            <?php } ?>
            </tbody>
        </table>
        <?php echo $news->links(); ?>
    <?php } else { ?>
        <div class="alert alert-info">Нет новостей</div>
    <?php } ?>
</div>