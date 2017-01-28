@extends('frontend.layouts.ucenter')

@section('panel')
    <div class="panel panel-default">
        <div class="panel-body">
            <h3>漏洞详情</h3>
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

    @if ('frontend.user.vul.detail' == \Request::route()->getName())
    <div class="panel panel-default">
        <div class="panel-body">
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
    <script src="http://gosspublic.alicdn.com/aliyun-oss-sdk-4.4.4.min.js"></script>
    @if (!isset($comment_detail))
    <script>
        $(function() {
            $(window).on('load', function(){
                window.on_submit_okay = function(a){
                    location.href = '{{ URL::route("frontend.user.vul.list") }}';
                };
            });
        });
    </script>

    @else
    <script>
        $(function() {
            window._comment_datatable = $('#users-table').DataTable({
                pageLength: 500,
                processing: false,
                serverSide: true,
                bLengthChange: false,
                bPaginate: false,
                searching: false,
                info: false,
                ajax: {
                    url: '{{ URL::Route('frontend.user.vul.comments', ['vul_id' => $vul_id]) }}',
                    type: 'get'
                },
                columns: [
                    {
                      data: function(a){
                        $a = $('<a></a>');
                        $a.attr('class', 'btn btn-default btn-xs no-border');
                        $a.css('margin-right', '10px');
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
    @endif
@endsection
