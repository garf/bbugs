<ul id="menu" class="bg-blue dker">
    <li class="nav-header">{{{trans('menu.menu')}}}</li>
    <li class="nav-divider"></li>
    <li class="">
        <a href="{{{URL::route('cabinet')}}}">
            <i class="fa fa-dashboard"></i><span class="link-title">&nbsp;{{{trans('menu.dashboard')}}}</span>
        </a>
    </li>
    <li class="">
        <a href="{{{URL::route('projects')}}}">
            <i class="fa fa-briefcase"></i><span class="link-title">&nbsp;{{{trans('menu.projects')}}}</span>
        </a>
    </li>
    <li class="">
        <a href="">
            <i class="fa fa-tasks"></i><span class="link-title">&nbsp;{{{trans('menu.issues')}}}</span>
        </a>
    </li>
    <li class="active">
        <a href="{{{URL::route('contacts')}}}">
            <i class="fa fa-book"></i><span class="link-title">&nbsp;{{{trans('menu.contacts')}}}</span>
        </a>
    </li>
</ul>