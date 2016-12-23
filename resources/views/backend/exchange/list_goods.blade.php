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
                            <th>名称</th>
                            <th>类型</th>
                            <th>成本</th>
                            <th>兑换价</th>
                            <th>库存</th>
                            <th>历史库存</th>
                            <th>创建时</th>
                            <th class="text-center" style="padding-right: 5px;">操作</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th><input type="text" class="form-control input-sm" style="width: 40px" placeholder="筛 ID"></th>
                            <th><input type="text" class="form-control input-sm" style="width: 100px" placeholder="筛 名称"></th>
                            <th><input type="text" class="form-control input-sm" style="width: 40px" placeholder="筛 类型"></th>
                            <th><input type="text" class="form-control input-sm" style="width: 40px" placeholder="筛 成本"></th>
                            <th><input type="text" class="form-control input-sm" style="width: 40px" placeholder="筛 兑换价"></th>
                            <th><input type="text" class="form-control input-sm" style="width: 40px" placeholder="筛 库存"></th>
                            <th><input type="text" class="form-control input-sm" style="width: 40px" placeholder="筛 历史库存"></th>
                            <th></th>
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
                        <a href="{{ URL::route('admin.exchange.goods.create') }}" class="btn btn-sm btn-success">添加兑换商品</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop

@section('after-scripts-end')
    <script>
        $(function() {
            window.exchange_goods_status_mapping = {
                '0': '已禁用',
                '1': '不显示',
                '2': '显示'
            };
            window.exchange_goods_status_class = {
                '0': 'label label-danger',
                '1': 'label label-warning',
                '2': 'label label-success'
            };

            window.datable = $('#users-table').DataTable({
                pageLength: 100,
                processing: true,
                serverSide: true,
                autoWidth: false,
                ajax: {
                    url: '{{ route("admin.exchange.goods.search") }}',
                    type: 'get',
                    data: {}
                },
                columns: [
                    {data: function(raw){return '<label class="text-left" style="width:50px;">'+raw.id+'</label>'; }, name: 'id'},
                    {data: 'title', name: 'title', render: $.fn.dataTable.render.text(), orderable: false, searchable: false},
                    {data: 'type', name: 'type', orderable: false, searchable: false},
                    {data: 'cost', name: 'cost'},
                    {data: 'coin', name: 'coin'},
                    {data: 'stock', name: 'stock'},
                    {data: 'stock_sum', name: 'stock_sum'},
                    {data: 'created_at', name: 'created_at'},
                    {data: function(raw){ return ['<a href="{{ URL::route("admin.exchange.goods.detail", ["goods_id"=>99999]) }}" class="btn btn-primary btn-xs"><i class="glyphicon glyphicon-pencil"></i></a>'.replace(/99999/g, raw.id), ].join(''); }, name: 'action', orderable: false, searchable: false, class: 'text-center'}
                ],
                order: [[0, "asc"]],
                searchDelay: 500,
                oLanguage: window._table_i18n
            });

            window.set_goods_status = function(status, goods_id){
                $.ajax({
                    url: '{{ URL::route("admin.exchange.goods.detail", ["goods_id"=>99999]) }}'.replace(/99999/, goods_id),
                    type: 'POST',
                    dataType: 'json',
                    data: {
                        _token: $('meta[name="_token"]').attr('content'),
                        update:{status: status }
                    },
                    success: function(json) {
                        if (json.head.statusCode !== 0) return bootbox.alert('失败:'+json.head.note);
                        return window.datable.draw();
                    },
                    error:function() {
                        return bootbox.alert('出错了');
                    }
                });
            };

            $('#filter_status').append('<option value="">全部</option>');
            for(i in window.exchange_goods_status_mapping){
                $('#filter_status').append('<option value="'+i+'">'+window.exchange_goods_status_mapping[i]+'</option>');
            }
        });
    </script>
@stop
