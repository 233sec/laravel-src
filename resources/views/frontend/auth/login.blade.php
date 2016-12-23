@extends('frontend.layouts.master')

@section('content')
    <div class="row">
        <div class="col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2">
            <div style="margin-top: 10vw;">
                {{ Form::open(['route' => 'auth.login', 'class' => 'form-horizontal']) }}
                <div class="form-group">
                    <div class="col-md-8 col-md-offset-2">
                        <h2 style="font-weight: normal;"><b>Login</b></h2>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-md-8 col-md-offset-2">
                        {{ Form::input('email', 'email', null, ['class' => 'form-control', 'placeholder' => trans('validation.attributes.frontend.email'), 'tabindex'=>1]) }}
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-md-8 col-md-offset-2">
                        {{ Form::input('password', 'password', null, ['class' => 'form-control', 'placeholder' => trans('validation.attributes.frontend.password'), 'tabindex'=>2]) }}
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-md-8 col-md-offset-2">
                        {!! Form::captcha() !!}
                        {{ Form::hidden('captcha_status', 'true') }}
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-md-8 col-md-offset-2">
                        <div class="checkbox">
                            <label style="-webkit-user-select: none; user-select: none;">
                                {{ Form::checkbox('remember') }} {{ trans('labels.frontend.auth.remember_me') }}
                            </label>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-md-8 col-md-offset-2">
                        {{ Form::submit(trans('labels.frontend.auth.login_button'), ['class' => 'btn btn-primary', 'style' => 'margin-right:15px']) }}
                        {{ link_to(URL::route('auth.register'), '注册') }} &nbsp;
                        {{ link_to(URL::route('auth.password.reset'), trans('labels.frontend.passwords.forgot_password')) }}
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-8 col-md-offset-2">
                        @include('includes.partials.messages')
                    </div>
                </div>
                {{ Form::close() }}
            </div>
        </div>
    </div>

@endsection

@section('after-scripts-end')
    {!! Captcha::script() !!}
@stop
