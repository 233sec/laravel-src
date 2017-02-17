@extends ('backend.layouts.master')

@section ('title', trans('menus.backend.exchange.title').'|'.trans('menus.backend.exchange.log'))

@section('after-styles-end')
@stop

@section('page-header')
    <h1>
        {{ trans('menus.backend.exchange.title') }}
        <small>{{ trans('menus.backend.exchange.log') }}</small>
    </h1>
@endsection

@section('content')
    <div class="box box-success">
        <div class="box-header with-border">
            <h3 class="box-title">{{ trans('menus.backend.exchange.log') }}</h3>
        </div>

        <div class="box-body">
            <div class="table-responsive">
                <table id="users-table" class="table table-condensed table-hover">
                    <thead>
                        <tr>
                            <th>订ID</th>
                            <th>品类</th>
                            <th>品名</th>
                            <th>用户</th>
                            <th>收电话</th>
                            <th>收人</th>
                            <th>收地址</th>
                            <th>公司|单号</th>
                            <th>安全币</th>
                            <th>状态</th>
                            <th>创时</th>
                            <th>操作</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th><input data-fullmatch="1" type="text" class="form-control input-sm" style="width: 40px" placeholder="筛 ID"></th>
                            <th><input type="text" class="form-control input-sm" style="width: 60px" placeholder="筛 商品类型"></th>
                            <th><input type="text" class="form-control input-sm" style="width: 60px" placeholder="筛 商品名字"></th>
                            <th><input data-fullmatch="1" type="text" class="form-control input-sm" style="width: 60px" placeholder="筛 用户"></th>
                            <th><input type="text" class="form-control input-sm" style="width: 60px" placeholder="筛 收件人电话"></th>
                            <th><input type="text" class="form-control input-sm" style="width: 60px" placeholder="筛 收件人"></th>
                            <th><input type="text" class="form-control input-sm" style="width: 90px" placeholder="筛 收货地址"></th>
                            <th><input type="text" class="form-control input-sm" style="width: 90px" placeholder="筛 单号"></th>
                            <th><input data-fullmatch="1" type="text" class="form-control input-sm" style="width: 90px" placeholder="筛 消耗积分"></th>
                            <th><select data-fullmatch="1" id="filter_exchanges_status" class="form-control input-sm" style="width: 55px" placeholder="筛 订单状态"></select></th>
                            <td><input type="text" class="form-control input-sm date-range" data-fullmatch="1" style="width: 70px;" placeholder=""></td>
                            <th></th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
@stop

@section('after-scripts-end')
    <script>
        $(function() {
            window.exchanges_log_status_map_text = { '-1': '已拒绝', '0': '处理中', '1': '已发货', '': '全部' };
            window.exchanges_log_status_map_class = { '-1': 'label label-danger', '0': 'label label-primary', '1': 'label label-success', '': 'label label-default' };

            for( i in window.exchanges_log_status_map_text ){
                $option = $('<option></option>');
                $option.val(i);
                $option.text(window.exchanges_log_status_map_text[i]);
                $('#filter_exchanges_status').append($option);
            }

            window.exchange_table =
            $('#users-table').DataTable({
                processing: true,
                serverSide: true,
                pageLength: 100,
                autoWidth: false,
                ajax: {
                    url: '{{ route("admin.exchange.exchange.search") }}',
                    type: 'get',
                    data: {}
                },
                columns: [
                    {data: function(a){return '<label class="text-left" style="width:50px;">'+a.id+'</label>'; }, name:'exchanges.id'},
                    {data: function(a){return {'1': '实物', '2': '虚拟'}[a.type];}, name: 'exchanges.type', class: 'text-center', orderable: false, searchable: true},
                    {data: function(a){$a = $('<a class="btn btn-default btn-xs no-border"></a>'); $a.attr('href', '{{ URL::route("admin.exchange.goods.detail", ["goods_id" => 99999])  }}'.replace(/99999/g, a.goods_id)); $a.text(a.title); return $a.get(0).outerHTML;}, name: 'exchanges.title', class: 'text-center', orderable: false, searchable: true},
                    {data: function(a){$a = $('<a class="btn btn-default btn-xs no-border"></a>'); $a.attr('href', '{{ URL::route("admin.access.user.login-as", ["user" => 99999])  }}'.replace(/99999/g, a.user_id)); $a.text(a.user_name); return $a.get(0).outerHTML;}, name: 'users.name', orderable: false, searchable: true},
                    {data: 'receive_phone', name: 'exchanges.receive_phone', render: $.fn.dataTable.render.text(), orderable: false, searchable: true},
                    {data: 'receive_name', name: 'exchanges.receive_name', render: $.fn.dataTable.render.text(), orderable: false, searchable: true},
                    {data: 'receive_address', name: 'exchanges.receive_address', render: $.fn.dataTable.render.text(), orderable: false, searchable: true},
                    {data: function(a){return a.status>0?(a.express_vendor+'|'+a.express_sn):'';}, name: 'exchanges.express_sn', render: $.fn.dataTable.render.text(), orderable: false, searchable: true},
                    {data: 'coin', name: 'exchanges.coin'},
                    {data: function(a){$a = $('<a></a>'); $a.attr('class', window.exchanges_log_status_map_class[a.status]); $a.text(window.exchanges_log_status_map_text[a.status]); return $a.get(0).outerHTML;}, name: 'exchanges.status', class: 'text-center', orderable: false, searchable: true},
                    {data: function(a){$a = $('<span></span>'); $a.attr('title', a.created_at); $a.text(a.created_at.split(' ')[0]); return $a.get(0).outerHTML;}, name: 'exchanges.created_at', class: 'text-right'},
                    {data: function(a){
                        if(a.status == 0){
                            $a = $('<a></a>');
                            $a.addClass('btn btn-primary btn-xs no-border');
                            $a.attr('onclick', 'window.exchanges_log_delivery(this);return !1;');
                            $a.text('发货');
                            $a.attr('data-id', a.id);
                            $a.attr('data-coin', a.coin);
                            $a.attr('data-title', a.title);
                            $a.attr('data-goods-id', a.goods_id);
                            $a.attr('data-receive-address', a.receive_address);
                            $a.attr('data-receive-name', a.receive_name);
                            $a.attr('data-receive-phone', a.receive_phone);
                            return $a.get(0).outerHTML;
                        }
                        return '';
                    }, name: 'action', orderable: false, searchable: false}
                ],
                order: [[0, "asc"]],
                searchDelay: 300,
                oLanguage: window._table_i18n
            });

            window.do_exchange_log_delivery = function(a){
                $.ajax({
                    url: $(a).attr('action').replace(/99999/g, $('#input_id').val()),
                    type: $(a).attr('method'),
                    data: $(a).serialize(),
                    dataType: 'json',
                    success: function(json){
                        if(0 !== json.head.statusCode) return bootbox.alert(json.head.note);
                        window.exchange_table.draw();
                    },
                    error: function(){
                        bootbox.alert('失败: 网络错误');
                    }
                });
                return !1;
            };

            window.exchanges_log_delivery = function(a){
                var dialog = bootbox.dialog({
                    backdrop: true,
                    onEscape: true,
                    message: [
                        '<form role="form" onsubmit="window.do_exchange_log_delivery(this);return false;" action="{{ URL::Route('admin.exchange.exchange.detail', ['exchange_id'=>99999]) }}" method="POST" class="form-horizontal">',
                        '    <div class="form-group">',
                        '        <label class="col-sm-2 control-label"><p></p></label>',
                        '        <div class="col-xs-10 col-sm-10 col-md-10 col-lg-10">',
                        '            <h2>发货</h2>',
                        '        </div>',
                        '    </div>',
                        '    <div class="form-group">',
                        '        <label class="col-sm-3 control-label" for="input_id">ID</label>',
                        '        <div class="col-sm-8">',
                        '            <input type="text" name="update[id]" id="input_id" class="form-control" readonly="readonly">',
                        '        </div>',
                        '    </div>',
                        '    <div class="form-group">',
                        '        <label class="col-sm-3 control-label" for="input_category">快递公司</label>',
                        '        <div class="col-sm-8">',
                        '            <select rows="8" type="text" name="update[express_vendor]" id="input_express_vendor" class="form-control">',
                        '                <option value="">---PLEASE CHOOSE---</option>',
                        '                <option value="sf">顺丰</option>',
                        '                <option value="sto">申通</option>',
                        '                <option value="yto">圆通</option>',
                        '                <option value="yunda">韵达</option>',
                        '                <option value="bestex">百世汇通</option>',
                        '                <option value="zto">中通</option>',
                        '                <option value="gto">国通</option>',
                        '                <option value="ems">EMS</option>',
                        '            </select>',
                        '        </div>',
                        '    </div>',
                        '    <div class="form-group">',
                        '        <label class="col-sm-3 control-label" for="input_emergency">单号</label>',
                        '        <div class="col-sm-8">',
                        '            <input type="text" name="update[express_sn]" id="input_express_sn" class="form-control" value="">',
                        '        </div>',
                        '    </div>',
                        '    <div class="form-group">',
                        '        <label class="col-sm-3 control-label" for="input_uuid">商品</label>',
                        '        <div class="col-sm-8">',
                        '            <input type="text" id="input_title" class="form-control" readonly="readonly">',
                        '        </div>',
                        '    </div>',
                        '    <div class="form-group">',
                        '        <label class="col-sm-3 control-label" for="input_title">价格</label>',
                        '        <div class="col-sm-8">',
                        '            <input type="text" id="input_coin" class="form-control" readonly="readonly">',
                        '        </div>',
                        '    </div>',
                        '    <div class="form-group">',
                        '        <label class="col-sm-3 control-label" for="input_title">收货人</label>',
                        '        <div class="col-sm-8">',
                        '            <input type="text" id="input_receive_name" class="form-control" readonly="readonly">',
                        '        </div>',
                        '    </div>',
                        '    <div class="form-group">',
                        '        <label class="col-sm-3 control-label" for="input_title">收货手机</label>',
                        '        <div class="col-sm-8">',
                        '            <input type="text" id="input_receive_phone" class="form-control" readonly="readonly">',
                        '        </div>',
                        '    </div>',
                        '    <div class="form-group">',
                        '        <label class="col-sm-3 control-label" for="input_title">收货地址</label>',
                        '        <div class="col-sm-8">',
                        '            <input type="text" id="input_receive_address" class="form-control" readonly="readonly">',
                        '        </div>',
                        '    </div>',
                        '    <div class="form-group">',
                        '        <div class="col-sm-11 text-right">',
                        '            <input type="hidden" name="update[status]" value="1">',
                        '            <button data-bb-handler="cancel" type="button" class="btn btn-default" data-dismiss="modal">取消</button>',
                        '            <input type="submit" class="btn btn-primary" value="发货">',
                        '        </div>',
                        '    </div>',
                        '</form>'
                    ].join('')
                });
                dialog.init(function(){
                    $('#input_id').val($(a).attr('data-id'));
                    $('#input_title').val($(a).attr('data-title'));
                    //$(a).attr('data-goods-id'));
                    $('#input_coin').val($(a).attr('data-coin'));
                    $('#input_receive_address').val($(a).attr('data-receive-address'));
                    $('#input_receive_name').val($(a).attr('data-receive-name'));
                    $('#input_receive_phone').val($(a).attr('data-receive-phone'));
                    setTimeout(function(){$('#input_express_vendor').focus();}, 800);
                });
            };
        });
    </script>
@stop
