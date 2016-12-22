@extends('frontend.layouts.ucenter')

@section('panel')
        <div class="panel panel-default">
            <div class="panel-body">
                <h3>个人资料</h3>
                <div class="form-group">
                    <div class="clearfix"></div>
                </div>
                {{ Form::model($user, ['route' => 'frontend.user.profile.update', 'class' => 'form-horizontal', 'method' => 'PATCH']) }}

                <div class="form-group">
                    {{ Form::label('name', trans('validation.attributes.frontend.name'), ['class' => 'col-md-2 control-label']) }}
                    <div class="col-md-10">
                        {{ Form::input('text', 'name', null, ['class' => 'form-control', 'placeholder' => trans('validation.attributes.frontend.name')]) }}
                    </div>
                </div>

                @if ($user->canChangeEmail())
                    <div class="form-group">
                        {{ Form::label('email', trans('validation.attributes.frontend.email'), ['class' => 'col-md-2 control-label']) }}
                        <div class="col-md-10">
                            {{ Form::input('email', 'email', null, ['class' => 'form-control', 'placeholder' => trans('validation.attributes.frontend.email')]) }}
                        </div>
                    </div>
                @endif

                <div class="form-group">
                    <div class="col-md-10 col-md-offset-2">
                        {{ Form::submit(trans('labels.general.buttons.save'), ['class' => 'btn btn-success btn-sm']) }}
                    </div>
                </div>

                {{ Form::close() }}
            </div>
        </div>
    @endsection
