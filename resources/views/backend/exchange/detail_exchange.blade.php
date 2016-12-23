@extends ('backend.layouts.master')

@section ('title', trans('menus.backend.exchange.title').'|'.trans('menus.backend.exchange.goods.create'))

@section('after-styles-end')
@stop

@section('page-header')
    <h1>
        {{ trans('menus.backend.exchange.title') }}
        <small>{{ trans('menus.backend.exchange.goods.create') }}</small>
    </h1>
@endsection

@section('content')
    <div class="box box-success">
        <div class="box-header with-border">
            <h3 class="box-title">{{ trans('menus.backend.exchange.goods.create') }}</h3>
        </div>

        <div class="box-body">
            <div class="form-group">
                <label class="col-sm-1 control-label"></label>
                <div class="col-sm-10">
                    <h2>兑换修改</h2>
                </div>
            </div>

            {{ $Editable
                ->template([
                    'id' => ['text'],
                    'title' => ['text'],
                    'goods_id' => ['text'],
                    'users_id' => ['text'],
                    'type' => ['text'],
                    'cost' => ['text'],
                    'coin' => ['text'],
                    'receive_address' => ['text'],
                    'receive_phone' => ['text'],
                    'receive_name' => ['text'],
                    'express_vendor' => ['text'],
                    'express_sn' => ['text'],
                    'status'=>[
                        'select',
                        [
                            '0'=> '已禁用',
                            '1'=> '不显示',
                            '2'=> '显示'
                        ]
                    ],
                    'created_at' => ['datetime_timestamp']
                ])
                ->make() }}
        </div>
    </div>
@stop

@section('after-scripts-end')
    <script>
    </script>
@stop
