@extends('frontend.layouts.ucenter')

@section('panel')
    <div class="panel panel-default">
        <div class="panel-body">
            <h3>我的兑换</h3>
            <table id="users-table" class="table table-condensed table table-hover">
                <thead class="hide">
                    <tr>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td colspan="1" class="text-center">加载中...</td>
                    </tr>
                </tbody>
            </table>
            <table class="table no-border">
                <tfoot>
                    <tr>
                        <td colspan="8" class="bg-white"><a href="{{ URL::Route('frontend.exchange') }}" class="btn btn-success no-border">去兑换</a></td>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
@endsection

@section('after-scripts-end')
    <script>
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
        window._exchange_status_map_text = {
            '-1': '已拒绝',
            '0': '审核中',
            '1': '已发货',
            '2': '完成'
        };
        window._exchange_status_map_class = {
            '-1': 'label label-danger',
            '0': 'label label-warning',
            '1': 'label label-success',
            '2': 'label label-default'
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
                url: '{{ route("frontend.user.exchange.search") }}',
                type: 'get',
                data: {}
            },
            columns: [
                {
                    data: function(a){
                      $a = $('<a></a>');
                      $a.text('查看');
                      $a.attr('class', 'btn btn-default btn-xs');

                      $b = $('<div class="media"></div>');
                      $c = $('<a class="media-left"></a>');
                      $d = $('<img src="data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0iVVRGLTgiIHN0YW5kYWxvbmU9InllcyI/PjxzdmcgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIiB3aWR0aD0iNjQiIGhlaWdodD0iNjQiIHZpZXdCb3g9IjAgMCA2NCA2NCIgcHJlc2VydmVBc3BlY3RSYXRpbz0ibm9uZSI+PGRlZnMvPjxyZWN0IHdpZHRoPSI2NCIgaGVpZ2h0PSI2NCIgZmlsbD0iI0VFRUVFRSIvPjxnPjx0ZXh0IHg9IjEzLjQ2ODc1IiB5PSIzMiIgc3R5bGU9ImZpbGw6I0FBQUFBQTtmb250LXdlaWdodDpib2xkO2ZvbnQtZmFtaWx5OkFyaWFsLCBIZWx2ZXRpY2EsIE9wZW4gU2Fucywgc2Fucy1zZXJpZiwgbW9ub3NwYWNlO2ZvbnQtc2l6ZToxMHB0O2RvbWluYW50LWJhc2VsaW5lOmNlbnRyYWwiPjY0eDY0PC90ZXh0PjwvZz48L3N2Zz4=" data-holder-rendered="true" style="width: 64px; height: 64px;">');

                      $e = $('<div class="media-body"></div>');
                      $f = $('<p class="media-heading text-muted"></p>');
                      $y = $('<span></span>');
                      $g = $('<span></span>');
                      $h = $('<span></span>');
                      $i = $('<div></div>');
                      $x = $('<div></div>');
                      $w = $('<div></div>');
                      $u = $('<div></div>');
                      $v = $('<div></div>');

                      $c.css({'padding-right': '18px'});
                      if(a.goods_img)$d.attr('src', a.goods_img);
                      $x.text(a.created_at);
                      $f.text(a.goods_name);
                      $g.text(a.receive_name);
                      $h.text(a.receive_phone);
                      $i.text(a.receive_address);
                      $w.text(a.express_vendor);
                      $v.text(a.express_sn);
                      $u.text(a.coin+'安全币');
                      $y.text(window._exchange_status_map_text[a.status]);
                      $y.attr('class', window._exchange_status_map_class[a.status]);
                      $g.attr('class', 'label label-default');
                      $h.attr('class', 'label label-default');
                      $i.attr('class', 'label label-default');
                      $x.attr('class', 'label label-primary');
                      $w.attr('class', 'label label-primary');
                      $u.attr('class', 'label label-primary');
                      $v.attr('class', 'label label-primary');
                      $c.append($d);
                      $e.append($f);
                      $e.append($x);
                      $e.append('&nbsp;');
                      $e.append($u);
                      $e.append('<p></p>');
                      $e.append($g);
                      $e.append('&nbsp;');
                      $e.append($h);
                      $e.append('&nbsp;');
                      $e.append($i);
                      $e.append('&nbsp;');
                      $e.append($w);
                      $e.append('&nbsp;');
                      $e.append($v);
                      $e.append('&nbsp;');
                      $e.append($y);
                      $b.append($c);
                      $b.append($e);
                      $b.css({'padding': '15px'});
                      return $b.get(0).outerHTML;
                    },
                    name: 'exchanges.id'
                }
            ],
            order: [[0, "desc"]],
            searchDelay: 500,
            oLanguage: window._table_i18n
        });
    </script>
@endsection
