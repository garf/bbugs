<ul id="menu" class="bg-blue dker">
    <li class="nav-header"><@ trans('menu.menu') @></li>
    <li class="nav-divider"></li>
    @foreach ($items as $item)
        <li class="<@ ($item['menu_item'] == $menu_item) ? 'active' : '' @>">
            <a href="<@ $item['url'] @>">
                <i class="fa <@ $item['icon'] @>"></i><span class="link-title">&nbsp;<@ trans($item['lang_key']) @></span>
            </a>
        </li>
    @endforeach
</ul>