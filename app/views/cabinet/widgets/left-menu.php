<ul id="menu" class="bg-blue dker">
    <?php foreach ($items as $item) { ?>
        <li class="<?= ($item['menu_item'] == $menu_item) ? 'active' : '' ?>">
            <a href="<?= $item['url'] ?>">
                <i class="fa <?= $item['icon'] ?>"></i><span class="link-title">&nbsp;<?= trans($item['lang_key']) ?> <span class="label label-danger"><?= $item['counter'] ?></span></span>

            </a>
        </li>
    <?php } ?>
</ul>