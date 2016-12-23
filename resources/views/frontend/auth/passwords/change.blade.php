@extends('backend.layouts.master')

@section('content')
        <div class="box box-success">
            <div class="box-header with-border">
                <h3 class="box-title">{{ trans('labels.frontend.user.passwords.change') }}</h3>
            </div>

            <div class="box-body">
                <div class="form-group">
                    <div class="clearfix"></div>
                </div>
                <div class="row">
                    <div class="col-md-10 col-md-offset-1">
                        {{ Form::open(['route' => ['auth.password.change'], 'class' => 'form-horizontal']) }}
                        <div class="form-group">
                            {{ Form::label('old_password', trans('validation.attributes.frontend.old_password'), ['class' => 'col-md-2 control-label']) }}
                            <div class="col-md-10">
                                {{ Form::input('password', 'old_password', null, ['class' => 'form-control input-sm', 'placeholder' => trans('validation.attributes.frontend.old_password')]) }}
                            </div>
                        </div>
                        <div class="form-group">
                            {{ Form::label('password', trans('validation.attributes.frontend.new_password'), ['class' => 'col-md-2 control-label']) }}
                            <div class="col-md-10">
                                {{ Form::input('password', 'password', null, ['class' => 'form-control input-sm', 'placeholder' => trans('validation.attributes.frontend.new_password')]) }}
                            </div>
                        </div>
                        <div class="form-group">
                            {{ Form::label('password_confirmation', trans('validation.attributes.frontend.new_password_confirmation'), ['class' => 'col-md-2 control-label']) }}
                            <div class="col-md-10">
                                {{ Form::input('password', 'password_confirmation', null, ['class' => 'form-control input-sm', 'placeholder' => trans('validation.attributes.frontend.new_password_confirmation')]) }}
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-10 col-md-offset-2">
                                {{ Form::submit(trans('labels.general.buttons.update'), ['class' => 'btn btn-primary no-border btn-sm']) }}
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                @include('includes.partials.messages')
                            </div><!--col-md-6-->
                        </div><!--form-group-->
                        {{ Form::close() }}
                    </div>
                </div>
            </div>
        </div>
@endsection