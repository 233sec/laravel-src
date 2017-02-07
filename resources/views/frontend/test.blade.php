<table border="1">
    <thead>
        <tr> <!-- TABLE ROW -->
            <th>ID</th> <!-- TABLE HEADER -->
            <th>NAME</th> <!-- TABLE HEADER -->
            <th>VALUE</th> <!-- TABLE HEADER -->
        </tr>
    </thead>
    <tbody>

    </tbody>
    <tfoot>
        <tr> <!-- TABLE ROW -->
            <th>ID</th> <!-- TABLE HEADER -->
            <th>NAME</th> <!-- TABLE HEADER -->
            <th>VALUE</th> <!-- TABLE HEADER -->
        </tr>
    </tfoot>
</table>
{{ Html::script(Cdn::asset('js/vendor/jquery/jquery-2.1.4.min.js')) }}
{{ Html::script(Cdn::asset('js/backend/plugin/datatables/jquery.dataTables.min.js')) }}
{{ Html::script(Cdn::asset('js/backend/plugin/datatables/dataTables.bootstrap.min.js')) }}
<script>
$('table').DataTable({
    pageLength: 5,
    processing: true,
    serverSide: true,
    autoWidth: false,
    ajax: '{{ URL::route("auth.test.search") }}',
    columns: [
    {data: 'id', name: 'id'},
    {data: 'name', name: 'name'},
    {data: 'value', name: 'value'}
    ],
    order: [[0, "asc"]],
    searchDelay: 500,
});
</script>
