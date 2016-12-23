@extends ('backend.layouts.master')

@section ('title', trans('menus.backend.article.title').'|'.trans('menus.backend.article.articles.list'))

@section('after-styles-end')
@stop

@section('page-header')
    <h1>
        {{ trans('menus.backend.article.title') }}
        <small>{{ trans('menus.backend.article.articles.list') }}</small>
    </h1>
@endsection

@section('content')
    <div class="box box-success">
        <div class="box-header with-border">
            <h3 class="box-title">{{ trans('menus.backend.article.articles.list') }}</h3>
        </div>

        <div class="box-body">
            <div class="table-responsive">
                <table id="users-table" class="table table-condensed table-hover">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>标题</th>
                            <th>封面</th>
                            <th>URL自定义</th>
                            <th>标签</th>
                            <th>状态</th>
                            <th>创建于</th>
                            <th style="width: 100px;" class="text-center">操作</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th><input type="text" class="form-control input-sm" style="width: 40px" placeholder="筛 ID"></th>
                            <th><input type="text" class="form-control input-sm" style="width: 100px" placeholder="筛 标题"></th>
                            <th></th>
                            <th><input type="text" class="form-control input-sm" style="width: 100px" placeholder="筛 URL自定义"></th>
                            <th><input type="text" class="form-control input-sm" style="width: 100px" placeholder="筛 标签"></th>
                            <th><select id="filter_status" class="form-control input-sm" style="width: 60px" placeholder="筛 状态"></select></th>
                            <th><input type="text" class="form-control input-sm" style="width: 100px" placeholder="筛 创建于"></th>
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
                        <a href="{{ URL::route('admin.article.create') }}" class="btn btn-sm btn-success">{{'写公告'}}</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop

@section('after-scripts-end')
    <script>
        $(function() {
            window.article_status_mapping = {
                '0': '草稿',
                '1': '已发布',
                '2': '已置顶'
            };
            window.article_status_class = {
                '0': 'label label-danger',
                '1': 'label label-success',
                '2': 'label label-warning'
            };

            window.datable = $('#users-table').DataTable({
                pageLength: 100,
                processing: true,
                serverSide: true,
                autoWidth: false,
                ajax: {
                    url: '{{ route("admin.article.search") }}',
                    type: 'get',
                    data: {}
                },
                columns: [
                    {data: function(a){return '<label class="text-left" style="width:50px;">'+a.id+'</label>'; }, name: 'id'},
                    {data: 'title', name: 'title', render: $.fn.dataTable.render.text(), orderable: false},
                    {data: function(raw){return '<a href="'+raw.cover_img+'" target="_blank"><img style="max-width:20px; max-height:20px; width: auto; height: auto;" src="'+raw.cover_img+'"></a>';}, name: 'cover_img', orderable: false},
                    {data: 'slug', name: 'slug', render: $.fn.dataTable.render.text(), orderable: false},
                    {data: 'tags', name: 'tags', render: $.fn.dataTable.render.text(), orderable: false},
                    {data: function(raw){return '<span class="'+window.article_status_class[raw.status]+'">'+window.article_status_mapping[raw.status]+'</span>';}, name: 'status', class: 'text-center', orderable: false},
                    {data: 'created_at', name: 'created_at'},
                    {data: function(raw){
                        return [
                            (raw.status != 0)?('<a href="javascript:void(0);" onclick="window.set_article_status(0, 99999, 99998);return false;" class="btn btn-danger btn-xs">草</a>'.replace(/99999/g, raw.id)+' ').replace(/99998/g, raw.type):'',
                            (raw.status != 1)?('<a href="javascript:void(0);" onclick="window.set_article_status(1, 99999, 99998);return false;" class="btn btn-success btn-xs">发</a>'.replace(/99999/g, raw.id)+' ').replace(/99998/g, raw.type):'',
                            (raw.status != 2)?('<a href="javascript:void(0);" onclick="window.set_article_status(2, 99999, 99998);return false;" class="btn btn-warning btn-xs">顶</a>'.replace(/99999/g, raw.id)+' ').replace(/99998/g, raw.type):'',
                            '<a href="{{ URL::route("admin.article.detail", ["article_id"=>99999,"type"=>99998]) }}" class="btn btn-primary btn-xs">修改</a>'.replace(/99999/g, raw.id).replace(/99998/g, raw.type),
                        ].join('');
                    }, name: 'action', class: 'text-center', orderable: false, searchable: false}
                ],
                order: [[0, "desc"]],
                searchDelay: 500,
                oLanguage: window._table_i18n
            });

            window.set_article_status = function(status, article_id, article_type){
                $.ajax({
                    url: '{{ URL::route("admin.article.detail", ["article_id"=>99999,"type"=>99998]) }}'.replace(/99999/g, article_id).replace(/99998/g, article_type),
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
            for(i in window.article_status_mapping){
                $('#filter_status').append('<option value="'+i+'">'+window.article_status_mapping[i]+'</option>');
            }
        });
    </script>
@stop
