@extends('frontend.layouts.master')

@section('content')
    <div class="row">

        <div class="col-md-8 col-md-offset-2">

                <div style="margin-top:10vw">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{ Form::open(['route' => 'auth.password.email', 'class' => 'form-horizontal']) }}
                    <div class="form-group">
                        <div class="col-md-6 col-md-offset-3"><h2 style="font-weight: normal;">{{ trans('labels.frontend.passwords.reset_password_box_title') }}</h2></div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-3 control-label"></label>
                        <div class="col-md-6">
                            {{ Form::input('email', 'email', null, ['class' => 'form-control', 'placeholder' => trans('validation.attributes.frontend.email')]) }}
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-3 control-label"></label>
                        <div class="col-md-6">
                            {!! Form::captcha() !!}
                            {{ Form::hidden('captcha_status', 'true') }}
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-md-6 col-md-offset-3">
                            {{ Form::submit(trans('labels.frontend.passwords.send_password_reset_link_button'), ['class' => 'btn btn-primary']) }}
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-6 col-md-offset-3">
                            @include('includes.partials.messages')
                        </div>
                    </div>

                    {{ Form::close() }}

                </div>

        </div>

    </div>

    <div class="row">
        <div class="col-md-8 col-md-offset-2">
        </div>
    </div>
@endsection


@section('after-scripts-end')
    {!! Captcha::script() !!}
@stop
