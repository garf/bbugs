<div class="media user-media bg-dark dker">
    <div class="user-media-toggleHover">
        <span class="fa fa-user"></span>
    </div>
    <div class="user-wrapper bg-dark">
        <a class="user-link" >
            <img class="media-object img-thumbnail user-img" alt="Gravatar" src="{{ Gravatar::src(Auth::user()->email, 64) }}">
            <span class="label label-danger user-label">16</span>
        </a>
        <div class="media-body">
            <h5 class="media-heading">{{{Auth::user()->name}}}</h5>
            <ul class="list-unstyled user-info">
                <li> <a href="#">{{{trans('users.roles.' . Auth::user()->role)}}}</a>  </li>
                <li>{{{trans('user-info.last_access')}}} :
                    <br>
                    <small>
                        <i class="fa fa-calendar"></i>&nbsp;{{{date('Y.m.d', Auth::user()->last_access)}}}</small>
                </li>
            </ul>
        </div>
    </div>
</div>