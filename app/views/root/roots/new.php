<div class="well clearfix col-md-5">
    <form method="post" action="/root/save" >
        <table class="table">
            <tr>
                <th>Имя</th>
                <td><input type="text" name="name" value="" class="form-control" required="required" /></td>
            </tr>
            <tr>
                <th>E-mail</th>
                <td><input type="email" name="email" value="" class="form-control" required="required" /></td>
            </tr>
            <tr>
                <th>Роль</th>
                <td><input type="text" name="role" value="" class="form-control" required="required" /></td>
            </tr>
            <tr>
                <th>Активен?</th>
                <td><input type="checkbox" name="status" value="1" /></td>
            </tr>
            <tr>
                <td colspan="2"><hr /></td>
            </tr>
            <tr>
                <th>Новый пароль</th>
                <td><input type="text" name="password" class="form-control" required="required" style="width: 180px;" /></td>
            </tr>
            <tr>
                <td colspan="2" class="text-right">
                    <input type="submit" value="Сохранить" class="btn btn-lg btn-success" />
                </td>
            </tr>
        </table>
    </form>
</div>