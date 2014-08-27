<div>
    <table class="table table-bordered">
        <tr>
            <td colspan="2">
                <h3>
                    <?php echo Auth::user()->get()->last_name; ?>
                    <?php echo Auth::user()->get()->first_name; ?>
                    <?php echo Auth::user()->get()->middle_name; ?>
                </h3>
            </td>
        </tr>
        <tr>
            <th class="col-md-2">E-mail</th>
            <td><?php echo Auth::user()->get()->email; ?></td>
        </tr>
        <tr>
            <th>Телефон</th>
            <td>+<?php echo Auth::user()->get()->phone; ?></td>
        </tr>
        <tr>
            <th>Дата регистрации</th>
            <td><?php echo date('d.m.Y H:i', Auth::user()->get()->reg_date); ?></td>
        </tr>
    </table>
</div>