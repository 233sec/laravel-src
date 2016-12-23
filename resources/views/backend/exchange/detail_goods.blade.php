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
                    <h2>商品修改/增加</h2>
                </div>
            </div>

            {{ $goods_detail
                ->template([
                    'id' => ['text'],
                    'title' => ['text'],
                    'goods_img' => ['file'],
                    'type' => [
                        'select',
                        [
                            '1'=> '实物',
                            '2'=> '虚拟'
                        ]
                    ],
                    'cost' => ['text'],
                    'coin' => ['text'],
                    'stock' => ['text'],
                    'stock_sum' => ['text'],
                    'created_at' => ['datetime']
                ])
                ->make() }}
        </div>
    </div>
@stop

@section('after-scripts-end')
    <script>
    </script>
@stop
