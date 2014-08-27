<div class="navbar-default navbar-static-side" role="navigation">
    <div class="sidebar-collapse">
        <ul class="nav" id="side-menu">
            <li class="sidebar-search">
                <div>Здравствуйте,<br />
                   {{{ Auth::root()->get()->name }}}
                </div>
            </li>
            <li>
                <a href="/root"><i class="fa fa-dashboard fa-fw"></i> Сводка</a>
            </li>
            <li>
                <a href="/root/agents"><i class="fa fa-group fa-fw"></i> Агенты</a>
            </li>
            <li>
                <a href="/root/transactions"><i class="fa fa-exchange fa-fw"></i> Транзакции</a>
            </li>
            <li>
                <a href="/root/orders"><i class="fa fa-legal fa-fw"></i> Покупки</a>
            </li>
            <li>
                <a href="/root/trade-statuses"><i class="fa fa-tasks fa-fw"></i> Статусы</a>
            </li>
        </ul>
    </div>
    <div class="well">
        <b>IP:</b> {{{ Request::getClientIp() }}}<br />
    </div>
</div>