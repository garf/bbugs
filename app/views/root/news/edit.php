<div>
    <div class="well well-sm">
        <a href="/root/news" class="btn btn-warning">Список</a>
    </div>
    <form method="post" action="/root/news-save/<?php echo $new->id; ?>">
        <table class="table">
            <tr>
                <th>Заголовок</th>
                <td><input type="text" name="title" value="<?php echo $new->title; ?>" class="form-control" /></td>
            </tr>
            <tr>
                <th>URI</th>
                <td>
                    <a href="<?php echo Config::get('app.url'); ?>/news/<?php echo $new->url; ?>" target="_blank">
                        <?php echo Config::get('app.url'); ?>/news/<span style="color: #cc0000;"><?php echo $new->url; ?></span>
                    </a>
                </td>
            </tr>
            <tr>
                <th>Кратко</th>
                <td><textarea name="short_content" class="form-control"><?php echo $new->short_content; ?></textarea></td>
            </tr>
            <tr>
                <th>Содержимое</th>
                <td><textarea name="content" id="ckeditor_content"><?php echo $new->content; ?></textarea></td>
            </tr>
            <tr>
                <th>Теги</th>
                <td><input type="text" name="tags" value="<?php
                    $tagsList = array();
                    foreach($tags as $tag) {
                        $tagsList[] = $tag->name;
                    }
                    echo implode(', ', $tagsList);
                    ?>" class="form-control" /></td>
            </tr>
            <tr >
                <th>Добавлено</th>
                <td>
                    <div class='col-md-3'>
                        <input type="text" name="date" class="datetime form-control" data-date-format="YYYY-MM-DD HH:mm:ss" value="<?php echo date('Y-m-d H:i:s', $new->act_date); ?>" style="width: 170px;" />
                    </div>
                </td>
            </tr>
            <tr class="<?php echo ($new->status == '1') ? 'success' : 'danger'; ?>">
                <th>Активно?</th>
                <td><input type="checkbox" name="status" value="1" <?php echo ($new->status == '1') ? 'checked="checked"' : ''; ?> /></td>
            </tr>
            <tr>
                <td colspan="2" class="text-right">
                    <input type="submit" value="Сохранить" class="btn btn-success btn-lg" />
                </td>
            </tr>
        </table>
    </form>
</div>
