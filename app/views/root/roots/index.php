<div>
    <div class="well well-sm">
        <a href="/root/root-create" class="btn btn-success">Добавить</a>
    </div>
    <table class="table">
        <thead>
        <tr>
            <th>ID</th>
            <th>Имя</th>
            <th>E-mail</th>
            <th>Роль</th>
            <th>Посл. Вход</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach($roots as $root) { ?>
            <tr>
                <td><?php echo $root->id; ?></td>
                <td><a href="/root/root-edit/<?php echo $root->id; ?>"><?php echo $root->name; ?></a></td>
                <td><?php echo $root->email; ?></td>
                <td><?php echo $root->role; ?></td>
                <td><?php echo date('d.m.Y H:i', $root->entered_at); ?></td>
            </tr>
        <?php } ?>
        </tbody>
    </table>
</div>