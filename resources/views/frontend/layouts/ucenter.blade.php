@extends('frontend.layouts.page')

@section('wrap')
    <div class="row">
        <div class="col-md-3 col-sm-4">
            <div class="panel panel-default">
                <div class="panel-heading"><i class="fa fa-fw fa-flag"></i> 操作</div>
                <ul class="list-group">
                    <a class="list-group-item {{ Active::controller('App\Http\Controllers\Frontend\User\Vul') }}" href="{{ URL::Route('frontend.user.vul.list') }}"><i class="fa fa-fw fa-times-circle"></i> 我的漏洞</a>
                    <a class="list-group-item {{ Active::controller('App\Http\Controllers\Frontend\User\Exchange') }}" href="{{ URL::Route('frontend.user.exchange.list') }}"><i class="fa fa-fw fa-list"></i> 我的订单</a>
                    <a class="list-group-item {{ Active::controller('App\Http\Controllers\Frontend\User\Dashboard') }}" href="{{ URL::Route('frontend.user.dashboard') }}"><i class="fa fa-fw fa-info-circle"></i> 个人资料</a>
                </ul>
            </div>
        </div>
        <div class="col-md-9 col-sm-8">
            @yield('panel')
        </div>
    </div>
@endsection
