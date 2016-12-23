@extends ('backend.layouts.master')

@section ('title', trans('menus.backend.exchange.title').'|'.trans('menus.backend.exchange.goods.list'))

@section('after-styles-end')
@stop

@section('page-header')
    <h1>
        {{ trans('menus.backend.exchange.title') }}
        <small>{{ trans('menus.backend.exchange.goods.list') }}</small>
    </h1>
@endsection

@section('content')
    <div class="box box-success">
        <div class="box-header with-border">
            <h3 class="box-title">{{ trans('menus.backend.exchange.goods.list') }}</h3>
        </div>

        <div class="box-body">
            <div class="table-responsive">
                <table id="users-table" class="table table-condensed table-hover">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>商品名称</th>
                            <th>创建时间</th>
                            <th>商品类型</th>
                            <th>商品类型NEW</th>
                            <th>可vip折扣</th>
                            <th>商品唯一标识</th>
                            <th>金额</th>
                            <th>时长(天)</th>
                            <th>兑换积分</th>
                            <th>SVIP兑换积分折扣</th>
                            <th>单个用户最大兑换次数</th>
                            <th>奖品个数</th>
                            <th>库存</th>
                            <th>操作人</th>
                            <th>商品状态</th>
                            <th>操作</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th><input type="text" class="form-control input-sm" style="width: 40px" placeholder="筛 ID"></th>
                            <th><input type="text" class="form-control input-sm" style="width: 40px" placeholder="筛 商品名称"></th>
                            <th><input type="text" class="form-control input-sm" style="width: 40px" placeholder="筛 创建时间"></th>
                            <th><input type="text" class="form-control input-sm" style="width: 40px" placeholder="筛 商品类型"></th>
                            <th><input type="text" class="form-control input-sm" style="width: 40px" placeholder="筛 商品类型NEW"></th>
                            <th><input type="text" class="form-control input-sm" style="width: 40px" placeholder="筛 可vip折扣"></th>
                            <th><input type="text" class="form-control input-sm" style="width: 40px" placeholder="筛 商品唯一标识"></th>
                            <th><input type="text" class="form-control input-sm" style="width: 40px" placeholder="筛 金额"></th>
                            <th><input type="text" class="form-control input-sm" style="width: 40px" placeholder="筛 时长"></th>
                            <th><input type="text" class="form-control input-sm" style="width: 40px" placeholder="筛 兑换积分"></th>
                            <th><input type="text" class="form-control input-sm" style="width: 40px" placeholder="筛 SVIP兑换积分折扣"></th>
                            <th><input type="text" class="form-control input-sm" style="width: 40px" placeholder="筛 单个用户最大兑换次数"></th>
                            <th><input type="text" class="form-control input-sm" style="width: 40px" placeholder="筛 奖品个数"></th>
                            <th><input type="text" class="form-control input-sm" style="width: 40px" placeholder="筛 库存"></th>
                            <th><input type="text" class="form-control input-sm" style="width: 40px" placeholder="筛 操作人"></th>
                            <th><input type="text" class="form-control input-sm" style="width: 40px" placeholder="筛 商品状态"></th>
                            <th></th>
                        </tr>
                    </tfoot>
                </table>
            </div>
            <div class="row">
                <div class="form-group">
                    <div class="clearfix"></div>
                </div>
                <div class="form-group">
                    <div class="col-md-12">
                        <a href="{{ URL::route('admin.activity_create') }}" class="btn btn-sm btn-success">添加抽奖商品</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop

@section('after-scripts-end')
    <script>
        $(function() {
            $('#users-table').DataTable({
                pageLength: 100,
                processing: true,
                serverSide: true,
                ajax: {
                    url: '{{ route("admin.exchange.lotteries.search") }}',
                    type: 'get',
                    data: {}
                },
                columns: [
                    {data: 'id', name: 'ac_coupons_config.id'},
                    {data: 'title', name: 'ac_coupons_config.title'},
                    {data: 'value', name: 'ac_coupons_config.value'},
                    {data: 'bind_count', name: 'ac_coupons_config.bind_count', orderable: false, searchable: false},
                    {data: function(raw){
                        return [
                            '<a href="{{ URL::route("admin.activity.edit", ["activity_id"=>99999]) }}" class="btn btn-danger btn-xs">禁用</a>'.replace(/99999/g, raw.id),
                            ' ',
                            '<a href="{{ URL::route("admin.activity.edit", ["activity_id"=>99999]) }}" class="btn btn-primary btn-xs">修改</a>'.replace(/99999/g, raw.id),
                        ].join('');
                    }, name: 'action', orderable: false, searchable: false}
                ],
                order: [[0, "asc"]],
                searchDelay: 500
            });

        });
    </script>
@stop