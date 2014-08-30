<nav class="navbar navbar-inverse navbar-static-top">
    <div class="container-fluid">

        <header class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a href="<@ URL::route('index') @>" class="navbar-brand">
                <img src="/template/common/img/logos/logo-sm.png" alt="">
            </a>
        </header>
        <div class="topnav">
            <div class="btn-group">
                <a data-placement="bottom" data-original-title="Show / Hide Left" data-toggle="tooltip" class="btn btn-primary btn-sm toggle-left" id="menu-toggle">
                    <i class="fa fa-bars"></i>
                </a>
                <a href="<@ URL::route('logout') @>"
                   data-toggle="tooltip"
                   data-original-title="<@ trans('navbar.logout') @>"
                   data-placement="bottom" class="btn btn-metis-1 btn-sm">
                    <i class="fa fa-power-off"></i>
                </a>
            </div>
        </div>
        <div class="collapse navbar-collapse navbar-ex1-collapse">

            <!-- .nav -->
            <ul class="nav navbar-nav">
                <li class="">
                    <a href="<@ URL::route('index') @>"><@trans('menu.dashboard')@></a>
                </li>
                <li class='dropdown '>
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <@ trans('menu.language') @>
                        <b class="caret"></b>
                    </a>
                    <ul class="dropdown-menu">
                        <li>

                            <a href="<@ URL::route('set-language', array('en')) @>"><img src="/template/common/img/flags/gb.png" alt="" /> English</a>
                        </li>
                        <li>

                            <a href="<@ URL::route('set-language', array('ru')) @>"><img src="/template/common/img/flags/ru.png" alt="" /> Русский</a>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</nav>