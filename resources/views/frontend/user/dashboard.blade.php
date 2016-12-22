@extends('frontend.layouts.ucenter')

@section('panel')
    <div class="panel panel-default">
        <div class="panel-body">
                <h3 class="box-title">个人资料</h3>
            <div class="">
                <div class="form-group">
                    <div class="clearfix"></div>
                </div>
                <div class="row">

                    <div class="col-md-12">
                        <div class="tab-content">
                            <div role="tabpanel" class="tab-pane active" id="profile">
                                <table class="table table-striped table-hover">
                                    <tr>
                                        <th>{{ trans('labels.frontend.user.profile.name') }}</th>
                                        <td>{{ $user->name }}</td>
                                    </tr>
                                    <tr>
                                        <th>{{ trans('labels.frontend.user.profile.email') }}</th>
                                        <td>{{ $user->email }}</td>
                                    </tr>
                                    <tr>
                                        <th>{{ trans('labels.frontend.user.profile.created_at') }}</th>
                                        <td>{{ $user->created_at }} ({{ $user->created_at->diffForHumans() }})</td>
                                    </tr>
                                    <tr>
                                        <th>{{ trans('labels.frontend.user.profile.last_updated') }}</th>
                                        <td>{{ $user->updated_at }} ({{ $user->updated_at->diffForHumans() }})</td>
                                    </tr>
                                    <tr>
                                        <th>{{ trans('labels.general.actions') }}</th>
                                        <td>
                                            {{ link_to_route('frontend.user.profile.edit', trans('labels.frontend.user.profile.edit_information'), [], ['class' => 'btn btn-primary no-border']) }}

                                            @if ($user->canChangePassword())
                                                {{ link_to_route('auth.password.change', trans('navs.frontend.user.change_password'), [], ['class' => 'btn btn-warning no-border']) }}
                                            @endif
                                        </td>
                                    </tr>
                                </table>
                            </div><!--tab panel profile-->

                        </div><!--tab content-->

                    </div><!--tab panel-->

                </div>
            </div>
        </div>
@endsection
