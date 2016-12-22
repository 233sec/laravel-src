@extends ('backend.layouts.master')

@section ('title', trans('menus.backend.exchange.title').'|'.trans('menus.backend.exchange.type.list'))

@section('after-styles-end')
@stop

@section('page-header')
    <h1>
        {{ trans('menus.backend.exchange.title') }}
        <small>{{ trans('menus.backend.exchange.type.list') }}</small>
    </h1>
@endsection

@section('content')
    <div class="box box-success">
        <div class="box-header with-border">
            <h3 class="box-title">{{ trans('menus.backend.exchange.type.list') }}</h3>
        </div>

        <div class="box-body">
            <div class="table-responsive">
                <table id="table-list-type" class="table table-condensed table-hover">
                    <thead>
                        <tr>
                            <th class="col-md-1">ID</th>
                            <th class="col-md-2">类型名</th>
                            <th class="col-md-1">图标</th>
                            <th class="col-md-2">状态</th>
                            <th class="col-md-2">创建时间</th>
                            <th class="col-md-1">操作</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th><input type="text" class="form-control input-sm" style="width: 70px" placeholder="筛 ID"></th>
                            <th><input type="text" class="form-control input-sm" style="width: 90px" placeholder="筛 类型名"></th>
                            <th></th>
                            <th><select class="form-control input-sm" style="width: 60px;"><option value=""></option><option value="1">已启用</option><option value="0">已禁用</option></select></th>
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
                        <a href="{{ URL::route('admin.exchange.type.create') }}" class="btn btn-sm btn-success">添加类型</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop

@section('after-scripts-end')
    <script>
        $(function() {
            window.datable =$('#table-list-type').DataTable({
                pageLength: 100,
                processing: true,
                serverSide: true,
                ajax: {
                    url: '{{ route("admin.exchange.type.search") }}',
                    type: 'get',
                    data: {}
                },
                columns: [
                    {data: 'id', name: 'ac_goods_type.id'},
                    {data: 'goods_type', name: 'ac_goods_type.goods_type'},
                    {data: function(raw){return '<a href="'+raw.icon+'" target="_blank"><img style="max-width:20px; max-height:20px; width: auto; height: auto;" src="'+raw.icon+'"></a>';}, name: 'ac_goods_type.icon'},
                    {data: function(raw){
                        if(raw.status==1){
                            return '<span class="label label-success">已启用</span>';
                        }else if(raw.status==0){
                            return '<span class="label label-danger">已禁用</span>';
                        }
                    },name:'ac_goods_type.status'},
                    {data: 'created_at', name: 'ac_goods_type.created_at'},
                    {data: function(raw){
                        if(raw.status==1) {
                            return [
                                '<a href="javascript:void(0);" class="btn btn-default btn-xs btn-sort"><span class="fa fa-sort"></span></a>',
                                ' ',
                                '<a href="{{ URL::route("admin.exchange.type.detail", ["type_id"=>99999]) }}" class="btn btn-primary btn-xs">修改</a>'.replace(/99999/g, raw.id),
                                ' ',
                                '<a href="javascript:void(0);" onclick="window.set_type_status(0,\'99998\'); return false;" class="btn btn-danger btn-xs">禁用</a>'.replace(/99998/g, raw.id)
                            ].join('');
                        }else if(raw.status==0){
                            return [
                                '<a href="javascript:void(0);" class="btn btn-default btn-xs btn-sort"><span class="fa fa-sort"></span></a>',
                                ' ',
                                '<a href="{{ URL::route("admin.exchange.type.detail", ["type_id"=>99999]) }}" class="btn btn-primary btn-xs">修改</a>'.replace(/99999/g, raw.id),
                                ' ',
                                '<a href="javascript:void(0);" onclick="window.set_type_status(1,\'99998\'); return false;" class="btn btn-success btn-xs">启用</a>'.replace(/99998/g, raw.id)
                            ].join('');
                        }
                    }, name: 'action', orderable: false, searchable: false}
                ],
                order: [[0, "asc"]],
                searchDelay: 500,
                drawCallback: function(){
                    new Sortable($('#table-list-type tbody')[0], {
                        group: 'sort',
                        sort: true,
                        delay: 0,
                        disabled: false,
                        store: null,
                        animation: 150,
                        ghostClass: "sortable-ghost",
                        chosenClass: "sortable-chosen",
                        dragClass: "sortable-drag",
                        dataIdAttr: 'data-id',
                        forceFallback: false,
                        handle: ".btn-sort",
                        fallbackClass: "sortable-fallback",
                        fallbackOnBody: false,
                        fallbackTolerance: 0,

                        scroll: true,
                        scrollSensitivity: 30,
                        scrollSpeed: 10,

                        setData: function (dataTransfer, dragEl) {
                            dataTransfer.setData('Text', dragEl.textContent);
                        },
                        onEnd: function (evt) {
                            var _sort = [];
                            $('#table-list-type tbody tr').each(function() {
                                _sort.push($(this).find('td:first').text());
                            });
                            $.ajax({
                                url: '{{ URL::route("admin.exchange.type.sort") }}',
                                type: 'POST',
                                dataType: 'json',
                                data: {
                                    _sort: _sort,
                                    _token: $('meta[name="_token"]').attr('content')
                                },
                                success: function(json) {
                                    if (json.code !== 1000) {
                                        bootbox.alert(json.message);
                                    }
                                },
                                error:function() {
                                    bootbox.alert('网络出错');
                                }
                            });
                        },
                    });
                }
            });

            window.set_type_status = function(status, type_id){
                $.ajax({
                    url: '{{ URL::route("admin.exchange.type.detail", ["type_id"=>99999]) }}'.replace(/99999/g, type_id),
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
        });



    </script>
@stop
