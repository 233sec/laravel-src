@extends ('backend.layouts.master')

@section ('title', trans('menus.backend.vul.vuls.management') . '|' . trans('menus.backend.vul.vuls.list'))

@section('after-styles-end')
@stop

@section('page-header')
    <h1>
        {{ trans('menus.backend.vul.title') }}
        <small>{{ trans('menus.backend.vul.vuls.list') }}</small>
    </h1>
@endsection

@section('content')
    <div class="box box-success">
        <div class="box-header with-border">
            <h3 class="box-title">{{ trans('menus.backend.vul.vuls.list') }}</h3>
        </div>

        <div class="box-body">
            <div class="table-responsive">
                <table id="users-table" class="table table-condensed table-hover">
                    <thead>
                        <tr>
                            <th class="text-left">ID</th>
                            <th>标题</th>
                            <th class="text-center">分类</th>
                            <th>上报人</th>
                            <th class="text-center">程度</th>
                            <th class="text-right">奖励</th>
                            <th class="text-right">贡献度</th>
                            <th class="text-center">状态</th>
                            <th class="text-center">创建</th>
                            <th class="text-center">更新</th>
                            <th class="text-center" style="padding-right: 5px; width: 80px;">操作</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <td><input type="text" class="form-control input-sm" style="width: 40px;" placeholder="ID"></td>
                            <td><input type="text" class="form-control input-sm" style="width: 80px;" placeholder="TITLE"></td>
                            <td><select class="form-control input-sm" id="filter_category" style="width: 50px;"></select></td>
                            <td><input type="text" class="form-control input-sm" style="width: 60px;" placeholder="REPORTOR"></td>
                            <td><select class="form-control input-sm" id="filter_emergency" style="width: 50px;"></select></td>
                            <td><input type="text" class="form-control input-sm" style="width: 60px;" placeholder="REWARD"></td>
                            <td><input type="text" class="form-control input-sm" style="width: 60px;" placeholder="CREDIT"></td>
                            <td><select class="form-control input-sm" id="filter_status" style="width: 50px;"></select></td>
                            <td><input type="text" class="form-control input-sm" style="width: 60px;" placeholder="CREATED_AT"></td>
                            <td><input type="text" class="form-control input-sm" style="width: 60px;" placeholder="UPDATED_AT"></td>
                            <td></th>
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
                        <a href="{{ URL::route('admin.vul.create') }}" class="btn btn-sm btn-success">{{'提交'}}</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop

@section('after-scripts-end')
    <script>
        $(function() {
            window.vul_status_map = {!! json_encode(config('app.vul.status')) !!};
            window.vul_category_map = {!! json_encode(config('app.vul.category')) !!};
            window.vul_emergency_map = {!! json_encode(config('app.vul.emergency')) !!};

            for(i in window.vul_status_map){
                e = window.vul_status_map[i][0];
                $op = $('<option></option>');
                $op.text(e); $op.val(i);
                $('#filter_status').append($op);
            }

            for(i in window.vul_category_map){
                e = window.vul_category_map[i][0];
                $op = $('<option></option>');
                $op.text(e); $op.val(i);
                $('#filter_category').append($op);
            }

            for(i in window.vul_emergency_map){
                e = window.vul_emergency_map[i][0];
                $op = $('<option></option>');
                $op.text(e); $op.val(i);
                $('#filter_emergency').append($op);
            }

            $('#users-table').DataTable({
                pageLength: 100,
                processing: true,
                serverSide: true,
                autoWidth: false,
                ajax: {
                    url: '{{ route("admin.vul.search") }}',
                    type: 'get',
                    data: {status: 1, deleted_at: false}
                },
                columns: [
                    {data: function(raw){return '<label class="text-left" style="width:50px;">'+raw.id+'</label>'; }, name: 'vuls.id'},
                    {data: function(a){$a = $('<span><span>'); $a.attr('class','text-nowrap'); $a.width($(window).outerWidth() - 1080); $a.text(a.title); $a.attr('title', a.title); return $a.get(0).outerHTML;}, name: 'vuls.title', orderable: false},
                    {data: function(a){$span = $('<span></span>'); var category = ''; if('undefined' !== typeof window.vul_category_map[a.category]) category = window.vul_category_map[a.category][0]; $span.text(category); $span.attr('class', 'label label-warning'); return $span.get(0).outerHTML;}, name: 'vuls.category', class: 'text-center', orderable: false},
                    {data: function(a){$a = $('<a></a>'); $a.text(a.name); $a.attr('class', 'btn btn-xs btn-default'); $a.attr('target', '_blank'); $a.attr('href', '{{ URL::route("admin.access.user.login-as", ["user" => 99999])  }}'.replace(/99999/, a.user_id)); return $a.get(0).outerHTML;}, name: 'users.name', orderable: false},
                    {data: function(a){$span = $('<span></span>'); var emergency = '', emergency_class = 'label label-default'; if('undefined' !== typeof window.vul_emergency_map[a.emergency]) {emergency = window.vul_emergency_map[a.emergency][0]; emergency_class = window.vul_emergency_map[a.emergency][1];} $span.text(emergency); $span.attr('class', emergency_class); return $span.get(0).outerHTML;}, name: 'vuls.emergency', class: 'text-center', orderable: false},
                    {data: 'reward', name: 'vuls.reward', class: 'text-right'},
                    {data: 'credit', name: 'vuls.credit', class: 'text-right'},
                    {data: function(a){$span = $('<span></span>'); $span.text(window.vul_status_map[a.status][0]); $span.attr('class', window.vul_status_map[a.status][1]); return $span.get(0).outerHTML;}, name: 'vuls.status', class: 'text-center', orderable: false},
                    {data: function(a){$span = $('<span></span>'); $span.text(a.created_at.split(' ')[0]); $span.attr('class', 'label label-warning'); $span.attr('title', a.created_at); return $span.get(0).outerHTML;}, name: 'vuls.created_at', class: 'text-center'},
                    {data: function(a){$span = $('<span></span>'); $span.text(a.updated_at.split(' ')[0]); $span.attr('class', 'label label-warning'); $span.attr('title', a.updated_at); return $span.get(0).outerHTML;}, name: 'vuls.updated_at', class: 'text-center'},
                    {data: function(a){$a = $('<a></a>');$a.attr('class','btn btn-xs btn-primary');$a.html('<i class="glyphicon glyphicon-pencil"></i>');$a.attr('href','{{ URL::Route("admin.vul.edit", ["vul_id" => 99999]) }}'.replace(/99999/g, a.id)); $b = $('<a></a>');$b.attr('class','btn btn-xs btn-success');$b.html('<i class="glyphicon glyphicon-ok-sign"></i> 审');$b.attr('href','{{ URL::Route("admin.vul.detail", ["vul_id" => 99999]) }}'.replace(/99999/g, a.id)); return $a.get(0).outerHTML + ' ' + $b.get(0).outerHTML;}, name:'op', orderable:false, searchable: false, class: 'text-center'}
                ],
                order: [[0, "desc"]],
                searchDelay: 500,
                oLanguage: window._table_i18n
            });

        });
    </script>
@stop
