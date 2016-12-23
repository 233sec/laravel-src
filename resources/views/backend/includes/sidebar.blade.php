<aside class="main-sidebar">
    <section class="sidebar">
        <div class="user-panel">
            <div class="pull-left image">
                <img onclick="location.href='{{ URL::route('frontend.user.dashboard') }}';" src="//it68-file-alimmdn-com.alikunlun.com/FjcbrvYNWHGA354YawXt06hnl4yA" class="img-circle" alt="User Image" />
                </a>
            </div>
            <div class="pull-left info">
                <p onclick="location.href='{{ URL::route('frontend.user.dashboard') }}';">{{ access()->user()->name }}</p>
                <a><i class="fa fa-circle text-success"></i> {{ trans('strings.backend.general.status.online') }}</a>
            </div>
        </div>

        <ul class="sidebar-menu">
            <li class="header">{{ trans('menus.backend.sidebar.dashboard') }}</li>
            <li class="{{ Active::route('admin.dashboard') }}">
                <a href="{{ URL::route('admin.dashboard') }}"><i class="fa fa-home"></i> <span>{{ trans('menus.backend.sidebar.dashboard') }}</span></a>
            </li>
        </ul>

        @permission('manage-vuls')
        <ul class="sidebar-menu">
            <li class="header">{{ trans('menus.backend.vul.title') }}</li>
            <li class="{{ Active::routeParam('admin.vul', []) }}">
                <a href="{{ URL::route('admin.vul', []) }}"><i class="fa fa-check-circle"></i> <span>{{ trans('menus.backend.vul.vuls.list') }}</span></a>
            </li>
        </ul>
        @endauth

        @permission('manage-exchanges')
        <ul class="sidebar-menu">
            <li class="header">{{ trans('menus.backend.exchange.title') }}</li>
            <li class="{{ Active::route('admin.exchange.goods.list') }}">
                <a href="{{ URL::route('admin.exchange.goods.list') }}"><i class="fa fa-briefcase"></i> <span>{{ trans('menus.backend.exchange.goods.list') }}</span></a>
            </li>
            <li class="{{ Active::route('admin.exchange.exchange.log') }}">
                <a href="{{ URL::route('admin.exchange.exchange.log') }}"><i class="fa fa-briefcase"></i> <span>{{ trans('menus.backend.exchange.log') }}</span></a>
            </li>
        </ul>
        @endauth

        @permission('manage-articles')
        <ul class="sidebar-menu">
            <li class="header">{{ trans('menus.backend.article.title') }}</li>
            <li class="{{ Active::route('admin.article.list') }}">
                <a href="{{ URL::route('admin.article.list') }}"><i class="fa fa-briefcase"></i> <span>{{ trans('menus.backend.article.notices.list') }}</span></a>
            </li>
        </ul>
        @endauth

        @permission('manage-users')
        <ul class="sidebar-menu">
            <li class="header">{{ trans('menus.backend.log-viewer.main') }}</li>
            <li class="{{ Active::pattern('admin/log-viewer*') }} treeview">
                <a href="javascript:;">
                    <i class="fa fa-th"></i>
                    <span>{{ trans('menus.backend.log-viewer.main') }}</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu {{ Active::pattern('admin/log-viewer*', 'menu-open') }}" style="display: none; {{ Active::pattern('admin/log-viewer*', 'display: block;') }}">
                    <li class="{{ Active::pattern('admin/log-viewer') }}">
                        {{ link_to('admin/log-viewer', trans('menus.backend.log-viewer.dashboard')) }}
                    </li>
                    <li class="{{ Active::pattern('admin/log-viewer/logs') }}">
                        {{ link_to('admin/log-viewer/logs', trans('menus.backend.log-viewer.logs')) }}
                    </li>
                </ul>
            </li>
        </ul>
        @endauth

        <ul class="sidebar-menu">
            <li class="header">{{ trans('menus.backend.access.title') }}</li>
            @permission('manage-users')
            <li class="{{ Active::route('admin.access.user.index') }}">
                <a href="{{ URL::route('admin.access.user.index') }}"><i class="fa fa-users"></i> <span>{{ trans('menus.backend.access.users.management') }}</span></a>
            </li>
            @endauth
            @permission('manage-roles')
            <li class="{{ Active::route('admin.access.role.index') }}">
                <a href="{{ URL::route('admin.access.role.index') }}"><i class="fa fa-warning"></i> <span>{{ trans('menus.backend.access.roles.management') }}</span></a>
            </li>
            @endauth
            <li class="{{ Active::route('auth.password.change') }}">
                <a href="{{ URL::route('auth.password.change') }}"><i class="fa fa-unlock-alt"></i> <span>{{ trans('labels.frontend.user.passwords.change') }}</span></a>
            </li>
            <li class="{{ Active::route('auth.logout') }}">
                <a href="{{ URL::route('auth.logout') }}"><i class="fa fa-power-off"></i> <span>{{ trans('navs.general.logout') }}</span></a>
            </li>
        </ul>
    </section>
</aside>
