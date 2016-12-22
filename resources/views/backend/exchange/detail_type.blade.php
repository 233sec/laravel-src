@extends ('backend.layouts.master')

@section ('title', trans('menus.backend.exchange.title').'|'.trans('menus.backend.exchange.type.create'))

@section('after-styles-end')
@stop

@section('page-header')
    <h1>
        {{ trans('menus.backend.exchange.title') }}
        <small>{{ trans('menus.backend.exchange.type.create') }}</small>
    </h1>
@endsection

@section('content')
    <div class="box box-success">
        <div class="box-header with-border">
            <h3 class="box-title">{{ trans('menus.backend.exchange.type.create') }}</h3>
        </div>

        <div class="box-body">
            <div class="form-group">
                <label class="col-sm-1 control-label"></label>
                <div class="col-sm-10">
                    <h2>类型修改/增加</h2>
                </div>
            </div>

            {{ $Editable
                ->template([
                        'icon' => ['file'],
                        'status'=>[
                            'select',
                            [
                                '0'=>'未启用',
                                '1'=>'已启用'
                            ]
                        ],
                        'created_at'=>['datetime_timestamp']
                    ])
                ->make() }}
        </div>
    </div>
@stop

@section('after-scripts-end')
    <script>
    </script>
@stop