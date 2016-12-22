@extends('frontend.layouts.page')

@section('wrap')
    <div class="panel panel-default">
        <div class="panel-body">
            <h3>名人榜</h3>
            <table id="users-table" class="table table-condensed table table-hover">
                <thead>
                    <tr>
                        <th style="width: 49%;" class="text-right">名字</th>
                        <th style="width: 2%;"></th>
                        <th style="width: 49%;">贡献</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td colspan="4" class="text-center">加载中...</td>
                    </tr>
                </tbody>
            </table>
            <div class="row">
                <div class="col-sm-6 col-sm-offset-3">
                    <div class="row">
                        <div class="col-md-4 col-md-offset-3">
                            <select class="form-control">
                                <option value="" selected>ALL</option>
                                <option value="2016" selected>2016</option>
                                <option value="2017" selected>2017</option>
                            </select>
                        </div>
                        <div class="col-md-2">
                            <select class="form-control">
                                <option value="" selected>ALL</option>
                                <option value="01">01</option>
                                <option value="02">02</option>
                                <option value="03">03</option>
                                <option value="04">04</option>
                                <option value="05">05</option>
                                <option value="06">06</option>
                                <option value="07">07</option>
                                <option value="08">08</option>
                                <option value="09">09</option>
                                <option value="11">11</option>
                                <option value="12">12</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('after-scripts-end')
    <script>
        $('#users-table').DataTable({
            pageLength: 5000,
            processing: true,
            serverSide: true,
            info: false,
            searching: false,
            bLengthChange: false,
            bPaginate: false,
            autoWidth: false,
            ajax: {
                url: '{{ route("frontend.hero.search") }}',
                type: 'get',
                data: {!! json_encode($_GET) !!}
            },
            columns: [
                {class: 'text-right', data: 'name', name: 'name', render: $.fn.dataTable.render.text(), orderable: false, searchable: false},
                {class: 'text-center', data: function(){return '';}, name: 'id', orderable: false, searchable: false},
                {class: 'text-left', data: 'credit', name: 'credit', orderable: false, searchable: false}
            ],
            order: [[0, "desc"]],
            searchDelay: 500,
            oLanguage: window._table_i18n
        });

    </script>
@endsection
