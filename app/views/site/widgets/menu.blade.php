<div class="row-2">
    <nav>
        <ul class="menu">
            <li><a class="<?php echo (!isset($menu_section)) ? 'active' : ''; ?>" href="/">Главная</a></li>
            <li><a class="<?php echo (isset($menu_section) && $menu_section == 'news') ? 'active' : ''; ?>" href="/news">Новости</a></li>
            <li><a class="<?php echo (isset($menu_section) && $menu_section == 'buy') ? 'active' : ''; ?>" href="/buy">Купить</a></li>
            <li><a class="<?php echo (isset($menu_section) && $menu_section == 'partners') ? 'active' : ''; ?>" href="/partners">Партнерам</a></li>
            <li class="last-item"><a class="<?php echo (isset($menu_section) && $menu_section == 'contacts') ? 'active' : ''; ?>" href="/contacts">Контакты</a></li>
        </ul>
    </nav>
</div>