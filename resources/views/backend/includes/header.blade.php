<header class="main-header">
    <a href="{{ URL::route('admin.dashboard') }}" class="logo">
      <span class="logo-mini"><b>L</b>S</span>
      <span class="logo-lg"><b>LARAVEL</b><span>SRC</span></span>
    </a>
    <nav class="navbar navbar-static-top" role="navigation">
        <a href="javascript:;" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">{{ trans('labels.general.toggle_navigation') }}</span>
        </a>

        <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">

                <li class="dropdown user user-menu">
                    <a class="dropdown-toggle" data-toggle="dropdown">
                        <img src="/img/avatar.png" class="user-image" alt="User Avatar"/>
                        <span class="hidden-xs">{{ access()->user()->name }}</span>
                    </a>

                    <ul class="dropdown-menu">
                        <li class="user-header">
                            <img onclick="location.href='{{ URL::route('frontend.user.dashboard') }}';" src="/img/avatar.png" class="img-circle" style="width: 90px; height: 90px; border: 0" />
                            <p>
                                {{ access()->user()->name }} - {{ implode(", ", access()->user()->roles->lists('name')->toArray()) }}
                                <small>{{ trans('strings.backend.general.member_since') }} {{ access()->user()->created_at->format("m/d/Y") }}</small>
                            </p>
                        </li>

                        <li class="user-footer">
                            <div class="pull-left">
                                {{ link_to_route('auth.password.change', trans('navs.frontend.user.change_password'), [], ['class' => 'btn btn-sm btn-default btn-flat']) }}
                            </div>
                            <div class="pull-right">
                                {{ link_to_route('auth.logout', trans('navs.general.logout'), [], ['class' => 'btn btn-sm btn-danger btn-flat']) }}
                            </div>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </nav>
</header>
