@extends('frontend.layouts.master')

@section('content')
    <div class="row">

        <div class="col-md-12">

            <div class="col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2">
                <div style="margin-top: 10vw;">

                    {{ Form::open(['route' => 'auth.register', 'class' => 'form-horizontal']) }}
                    <div class="form-group">
                        <div class="col-md-8 col-md-offset-2">
                            <h2 style="font-weight: normal;"><b>{{ trans('labels.frontend.auth.register_box_title') }}</b></h2>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-md-8 col-md-offset-2">
                            {{ Form::input('email', 'email', null, ['class' => 'form-control', 'placeholder' => trans('validation.attributes.frontend.email')]) }}
                        </div><!--col-md-6-->
                    </div><!--form-group-->

                    <div class="form-group">
                        <div class="col-md-8 col-md-offset-2">
                            {{ Form::input('name', 'name', null, ['class' => 'form-control', 'placeholder' => trans('validation.attributes.frontend.name')]) }}
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-md-8 col-md-offset-2">
                            {{ Form::input('password', 'password', null, ['class' => 'form-control', 'placeholder' => trans('validation.attributes.frontend.password')]) }}
                        </div><!--col-md-6-->
                    </div><!--form-group-->

                    <div class="form-group">
                        <div class="col-md-8 col-md-offset-2">
                            {{ Form::input('password', 'password_confirmation', null, ['class' => 'form-control', 'placeholder' => trans('validation.attributes.frontend.password_confirmation')]) }}
                        </div><!--col-md-6-->
                    </div><!--form-group-->

                    <div class="form-group">
                        <div class="col-md-8 col-md-offset-2">
                            {!! Form::captcha() !!}
                            {{ Form::hidden('captcha_status', 'true') }}
                        </div><!--col-md-6-->
                    </div><!--form-group-->

                    <div class="form-group">
                        <div class="col-md-8 col-md-offset-2">
                            {{ Form::submit(trans('labels.frontend.auth.register_button'), ['class' => 'btn btn-primary', 'style' => 'margin-right:15px']) }}
                            <a href="{{ URL::route('auth.login') }}">已有账号?</a>
                        </div><!--col-md-6-->
                    </div><!--form-group-->

                    <div class="row">
                        <div class="col-md-8 col-md-offset-2">
                            @include('includes.partials.messages')
                        </div>
                    </div>
                    {{ Form::close() }}

                </div><!-- panel body -->

            </div><!-- panel -->

        </div><!-- col-md-8 -->

    </div><!-- row -->
@endsection

@section('after-scripts-end')
    {!! Captcha::script() !!}
@stop
