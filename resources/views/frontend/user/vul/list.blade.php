@extends('frontend.layouts.ucenter')

@section('panel')
    <div class="panel panel-default">
        <div class="panel-body">
            <h3>我提交的漏洞</h3>
            <table id="users-table" class="table table-condensed table table-hover">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>名字</th>
                        <th style="width: 80px">类型</th>
                        <th style="width: 80px">危害</th>
                        <th style="width: 60px">奖励</th>
                        <th style="width: 60px">贡献</th>
                        <th style="width: 60px">状态</th>
                        <th style="width: 160px">提交时间</th>
                        <th style="width: 60px"></th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td colspan="8" class="text-center">加载中...</td>
                    </tr>
                </tbody>
            </table>
            <table class="table no-border">
                <tfoot>
                    <tr>
                        <td colspan="8" class="bg-white"><a href="{{ URL::Route('frontend.user.vul.create') }}" class="btn btn-success no-border">提交漏洞</a></td>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
@endsection

@section('after-scripts-end')
    <script>
        window.vul_status_map = {!! json_encode(config('app.vul.status')) !!};
        window.vul_category_map = {!! json_encode(config('app.vul.category')) !!};

        window._table_i18n = {
            "sLengthMenu":"显示 _MENU_ 条记录",
            "sZeroRecords":"没有检索到数据",
            "sInfo":"当前数据为 _START_ - _END_ 条数据；总共有 _TOTAL_ 条记录",
            "sInfoEmpty":"没有数据",
            "sProcessing":"正在加载数据......",
            "sSearch":"查询",
            "sInfoFiltered": "(过滤自 _MAX_ 条记录)",
            "oPaginate":{
                "sFirst":"首页",
                "sPrevious":"前页",
                "sNext":"后页",
                "sLast":"尾页"
            }
        };

        $('#users-table').DataTable({
            pageLength: 10,
            processing: true,
            serverSide: true,
            info: false,
            searching: false,
            bLengthChange: false,
            autoWidth: false,
            ajax: {
                url: '{{ route("frontend.user.vul.search") }}',
                type: 'get',
                data: {}
            },
            columns: [
                {data: 'id', name: 'id', render: $.fn.dataTable.render.text(), orderable: false, searchable: false},
                {data: function(a){$a = $('<span><span>'); $a.attr('class','text-nowrap'); $a.css({'max-width':'140px', 'width':'10vw'}); $a.text(a.title); return $a.get(0).outerHTML;}, name: 'vuls.title', orderable: false, searchable: false},
                {data: function(a){$span = $('<span></span>');var category=''; if('undefined' !== typeof window.vul_category_map[a.category])category=window.vul_category_map[a.category][0]; $span.text(category); $span.attr('class', 'label label-warning'); return $span.get(0).outerHTML;}, name: 'vuls.category', class: 'text-center', orderable: false, searchable: false},
                {data: 'emergency', name: 'emergency', orderable: false, searchable: false},
                {data: 'reward', name: 'reward', orderable: false, searchable: false},
                {data: 'credit', name: 'credit', orderable: false, searchable: false},
                {data: function(a){$span = $('<span></span>'); $span.text(window.vul_status_map[a.status][0]); $span.attr('class', window.vul_status_map[a.status][1]); return $span.get(0).outerHTML;}, name: 'status', class: 'text-center', orderable: false, searchable: false},
                {data: 'created_at', name: 'created_at', class: 'text-center', orderable: false, searchable: false},
                {data: function(a){$a = $('<a></a>'); $a.text('查看'); $a.attr('class', 'btn btn-default btn-xs'); $a.attr('href', '{{ URL::Route("frontend.user.vul.detail", ["vul_id"=>99999]) }}'.replace(/99999/g, a.id)); return $a.get(0).outerHTML;}, class: 'text-right', orderable: false, searchable: false}
            ],
            searchDelay: 500,
            oLanguage: window._table_i18n
        });

    </script>
@endsection
