<div class="navbar-default sidebar" role="navigation">
    <div class="sidebar-nav navbar-collapse">
        <ul class="nav" id="side-menu">
            <li class="sidebar-search">
                <div class="input-group custom-search-form">
                    <input type="text" class="form-control" placeholder="{{{trans('menu.search_ph')}}}" />
                    <span class="input-group-btn">
                        <button class="btn btn-default" type="button">
                            <i class="fa fa-search"></i>
                        </button>
                    </span>
                </div>
            </li>
            <li>
                <a class="active" href="{{{URL::route('cabinet')}}}"><i class="fa fa-dashboard fa-fw"></i> {{{trans('menu.dashboard')}}}</a>
            </li>
        </ul>
    </div>
</div>