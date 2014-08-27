<div class="well clearfix col-md-5">
    <form method="post" action="/root/save/<?php echo $root->id; ?>" >
        <table class="table">
            <tr>
                <th>Имя</th>
                <td><input type="text" name="name" value="<?php echo $root->name; ?>" class="form-control" /></td>
            </tr>
            <tr>
                <th>E-mail</th>
                <td><input type="text" name="email" value="<?php echo $root->email; ?>" class="form-control" /></td>
            </tr>
            <tr>
                <th>Роль</th>
                <td><input type="text" name="role" value="<?php echo $root->role; ?>" class="form-control" /></td>
            </tr>
            <tr>
                <th>Активен?</th>
                <td><input type="checkbox" name="status" value="1" <?php echo ($root->status == 1) ? 'checked="checked"' : ''; ?> /></td>
            </tr>
            <tr>
                <td colspan="2"><hr /></td>
            </tr>
            <tr>
                <th>Новый пароль</th>
                <td><input type="text" name="password" class="form-control" style="width: 180px;" /></td>
            </tr>
            <tr>
                <td colspan="2" class="text-right">
                    <input type="submit" value="Сохранить" class="btn btn-lg btn-success" />
                </td>
            </tr>
        </table>
    </form>
</div>