<nav class="navbar navbar-default no-border">
    <div class="navbar-header">
        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#frontend-navbar-collapse">
            <span class="sr-only">{{ trans('labels.general.toggle_navigation') }}</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>

        {{ link_to_route('frontend.index', app_name(), [], ['class' => 'navbar-brand']) }}
    </div>

    <div class="collapse navbar-collapse" id="frontend-navbar-collapse">
        <ul class="nav navbar-nav">
            <li class="{{ Active::controller('App\Http\Controllers\Frontend\Frontend') }}"><a href="{{ URL::Route('frontend.index') }}">首页</a></li>
            <li class="{{ Active::controller('App\Http\Controllers\Frontend\Article') }}"><a href="{{ URL::Route('frontend.article') }}">公告</a></li>
            <li class="{{ Active::controller('App\Http\Controllers\Frontend\Exchange') }}"><a href="{{ URL::Route('frontend.exchange') }}">兑换中心</a></li>
            <li class="{{ Active::controller('App\Http\Controllers\Frontend\Hero') }}"><a href="{{ URL::Route('frontend.hero') }}">名人榜</a></li>
        </ul>

        <ul class="nav navbar-nav navbar-right">
            @if (access()->guest())
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                        未登陆 <span class="caret"></span>
                    </a>
                    <ul class="dropdown-menu no-border" role="menu">
                        <li><a href="{{ URL::Route('auth.login') }}">登陆</a></li>
                        <li><a href="{{ URL::Route('auth.register') }}">注册</a></li>
                    </ul>
                </li>
            @else
                <li class="dropdown {{ Active::controller('App\Http\Controllers\Frontend\User') }}">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                        {{ access()->user()->name }} <span class="caret"></span>
                    </a>
                    <ul class="dropdown-menu no-border" role="menu">
                        <li><a href="{{ URL::Route('frontend.user.vul.list') }}">我提交的漏洞</a></li>
                        <li><a href="{{ URL::Route('frontend.user.exchange.list') }}">我的订单</a></li>
                        <li><a href="{{ URL::Route('frontend.user.profile.edit') }}">个人资料</a></li>
                        <li><a href="{{ URL::Route('admin.dashboard') }}">后台</a></li>
                        <li class="divider"></li>
                        <li>{{ link_to_route('auth.logout', trans('navs.general.logout')) }}</li>
                    </ul>
                </li>
            @endif
        </ul>
    </div>
</nav>
