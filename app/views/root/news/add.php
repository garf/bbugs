<div>
    <div class="well well-sm">
        <a href="/root/news" class="btn btn-warning">Список</a>
    </div>
    <form method="post" action="/root/news-save">
        <table class="table">
            <tr>
                <th>Заголовок</th>
                <td><input type="text" name="title" class="form-control" value="<?php echo Input::old('title'); ?>" /></td>
            </tr>
            <tr>
                <th>URI</th>
                <td><input type="text" name="url" class="form-control" style="width: 200px;" value="<?php echo Input::old('url'); ?>" /> <span class="text-muted">латинские буквы, цифры, знаки -_</span></td>
            </tr>
            <tr>
                <th>Кратко</th>
                <td><textarea name="short_content" class="form-control"><?php echo Input::old('short_content'); ?></textarea></td>
            </tr>
            <tr>
                <th>Содержимое</th>
                <td><textarea name="content" id="ckeditor_content"><?php echo Input::old('content'); ?></textarea></td>
            </tr>
            <tr>
                <th>Теги</th>
                <td><input type="text" name="tags" class="form-control" <?php echo Input::old('tags'); ?> /></td>
            </tr>
            <tr >
                <th>Добавлено</th>
                <td>
                    <div class='col-md-3'>
                        <input type="text" name="date" class="datetime form-control" data-date-format="YYYY-MM-DD HH:mm:ss" value="<?php echo Input::old('date', date('Y-m-d H:i:s')); ?>" style="width: 170px;" />
                    </div>
                </td>
            </tr>
            <tr>
                <th>Активно?</th>
                <td><input type="checkbox" name="status" value="1" <?php echo (Input::old('status', '0') == '1') ? 'checked="checked"' : ''; ?> /></td>
            </tr>
            <tr>
                <td colspan="2" class="text-right">
                    <input type="submit" value="Сохранить" class="btn btn-success btn-lg" />
                </td>
            </tr>
        </table>
    </form>
</div>
