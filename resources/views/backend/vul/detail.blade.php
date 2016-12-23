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
            {{ $vul_detail
                ->template([
                        'content' => ['wysiwyg'],
                        'status'=>[
                            'select',
                            config('app.vul.status_text')
                        ],
                        'emergency'=>[
                            'select',
                            config('app.vul.emergency_text')
                        ],
                        'category'=>[
                            'select',
                            config('app.vul.category_text')
                        ],
                        'created_at'=>['datetime'],
                        'lengend_1' => ['lengend'],
                    ])
                ->make() }}
        </div>
    </div>


    @if ('admin.vul.detail' == \Request::route()->getName())
    <div class="box box-danger">
        <div class="box-body">
            <form role="form" class="form-horizontal">
                <div class="form-group">
                    <label class="col-sm-2 control-label" for="input_deleted_at">操作</label>
                    <div class="col-sm-10">
                        <a href="{{ URL::Route('admin.vul.edit', ['vul_id' => $vul_id]) }}" class="btn btn-success btn-sm">通过</a>
                        <a href="{{ URL::Route('admin.vul.edit', ['vul_id' => $vul_id]) }}" class="btn btn-danger btn-sm">拒绝</a>
                        <a href="{{ URL::Route('admin.vul.edit', ['vul_id' => $vul_id]) }}" class="btn btn-warning btn-sm">修改</a>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <div class="box box-warning">
        <div class="box-body">
            {{ $comment_detail
                ->template([
                        'content' => ['wysiwyg']
                    ])
                ->make()
            }}
            <div class="form-horizontal">
                <div class="form-group">
                    <label class="col-md-2 control-label">留言</label>
                    <div class="col-md-10">
                        <table id="users-table" class="table table-bordered table-responsive" style="width: 100%">
                            <thead class="hide">
                                <tr>
                                    <th></th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endif
@endsection

@section('after-scripts-end')
    <script>
        $(function() {
            window._comment_datatable =
            $('#users-table').DataTable({
                pageLength: 10,
                processing: true,
                serverSide: true,
                bLengthChange: false,
                searching: false,
                info:false,
                ajax: {
                    url: '{{ URL::Route('admin.vul.comments', ['vul_id' => $vul_id]) }}',
                    type: 'get',
                    data: {status: 1, deleted_at: false}
                },
                columns: [
                    {
                      data: function(a){
                        $a = $('<a></a>');
                        $a.attr('class', 'btn btn-default btn-xs no-border');
                        $a.css('margin-right', '10px');
                        $a.attr('href', '{{ URL::Route("admin.access.user.login-as", ["user"=>99999]) }}'.replace(/99999/g, a.user_id));
                        $a.text(a.name);

                        $b = $('<small></small>');
                        $b.attr('class', 'text-muted');
                        $b.text('发表于: '+a.created_at);

                        $c = $('<div></div>');
                        $c.css('padding', '20px 0 0 45px');
                        $c.html(a.content);

                        $d = $('<div></div>');
                        if(a.role_id == 1) $d.addClass('bg-warning');
                        $d.addClass('col-md-12');
                        $d.css('padding', '10px');
                        $d.append($a);
                        $d.append($b);
                        $d.append($c);

                        return $d.get(0).outerHTML;
                      },
                      name: 'content', searchable: false, orderable: false}
                ],
                searchDelay: 500,
                oLanguage: window._table_i18n
            });

            $('form').on('submit', function(){
                setTimeout(function(){
                    window._comment_datatable.draw();
                }, 1500);
            });
        });

    </script>
@endsection
