@extends('frontend.layouts.page')

@section('wrap')
    <div class="panel panel-default">
        <div class="panel-body">
            <h3>公告</h3>
            <table id="users-table" class="table table-condensed table table-hover">
                <thead>
                    <tr>
                        <th>标题</th>
                        <th style="width: 160px">创建于</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td colspan="2" class="text-center">加载中...</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
@endsection

@section('after-scripts-end')
    <script>
        $('#users-table').DataTable({
            pageLength: 10,
            processing: true,
            serverSide: true,
            info: false,
            searching: false,
            bLengthChange: false,
            autoWidth: false,
            ajax: {
                url: '{{ route("frontend.article.search") }}',
                type: 'get',
                data: {}
            },
            columns: [
                {data: function(a){$a = $('<a></a>'); $a.attr('href', '{{ URL::Route("frontend.article.detail", ["article_id"=>99999]) }}'.replace(/99999/g, a.id)); $a.text(a.title); return $a.get(0).outerHTML;}, name: 'title', searchable: false, orderable: false},
                {data: 'created_at', name: 'created_at', sortable: false, class: 'text-right'}
            ],
            order: [[0, "desc"]],
            searchDelay: 500,
            oLanguage: window._table_i18n
        });

    </script>
@endsection
