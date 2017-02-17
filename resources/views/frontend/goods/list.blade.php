@extends('frontend.layouts.page')

@section('wrap')
    <div class="panel panel-default">
        <div class="panel-body">
            <h3>兑换中心</h3>
            <table id="users-table" class="table table-condensed table table-hover">
                <thead class="hide">
                    <tr>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>加载中...</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
    <div id="tpl-goods" class="hide">
        <div class="media">
            <a class="media-left">
                <img data-error-src="data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0iVVRGLTgiIHN0YW5kYWxvbmU9InllcyI/PjxzdmcgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIiB3aWR0aD0iNjQiIGhlaWdodD0iNjQiIHZpZXdCb3g9IjAgMCA2NCA2NCIgcHJlc2VydmVBc3BlY3RSYXRpbz0ibm9uZSI+PGRlZnMvPjxyZWN0IHdpZHRoPSI2NCIgaGVpZ2h0PSI2NCIgZmlsbD0iI0VFRUVFRSIvPjxnPjx0ZXh0IHg9IjEzLjQ2ODc1IiB5PSIzMiIgc3R5bGU9ImZpbGw6I0FBQUFBQTtmb250LXdlaWdodDpib2xkO2ZvbnQtZmFtaWx5OkFyaWFsLCBIZWx2ZXRpY2EsIE9wZW4gU2Fucywgc2Fucy1zZXJpZiwgbW9ub3NwYWNlO2ZvbnQtc2l6ZToxMHB0O2RvbWluYW50LWJhc2VsaW5lOmNlbnRyYWwiPjY0eDY0PC90ZXh0PjwvZz48L3N2Zz4=" data-holder-rendered="true" style="width: 64px; height: 64px;" onerror="$(this).attr('src', $(this).attr('data-error-src'));">
            </a>
            <div class="media-body">
                <p><b class="media-heading goods-title">商品11</b></p>
                <p class="goods-misc">
                    <span class="label label-success"><span class="goods-coin"></span>安全币</span>
                    <span class="label label-warning"><span class="goods-stock"></span>可兑</span>
                    <a href="javascript:void(0);" onclick="window.exchange(this);return false;" class="btn btn-primary btn-xs pull-right">兑换</a>
                </p>
            </div>
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
                url: '{{ route("frontend.exchange.search") }}',
                type: 'get',
                data: {}
            },
            columns: [
                {
                    data: function(a){
                        $div = $($('#tpl-goods').html());
                        $div.find('.goods-title').text(a.title);
                        $div.find('.goods-coin').text(a.coin);
                        $div.find('.goods-stock').text(a.stock);
                        $div.find('.media-left img').attr('src', a.goods_img + '?x-oss-process=image/resize,m_fill,h_128,w_128');
                        $div.find('.btn').attr('data-goods-id', a.id);
                        $div.find('.btn').attr('data-goods-title', a.title);
                        $div.find('.btn').attr('data-goods-coin', a.coin);
                        $div.find('.btn').attr('data-goods-type', a.type);
                        if(a.stock < 1)$div.find('.btn').addClass('disabled');
                        return $div.get(0).outerHTML;
                    }, name: 'action', orderable: false, searchable: false}
            ],
            order: [[0, "desc"]],
            searchDelay: 500,
            oLanguage: window._table_i18n
        });

        window.reward_balance = {{ $reward ?? 'null' }};

        window.exchange = function(a){
            if(window.reward_balance == null){
                return location.href = '{{ URL::route("auth.login") }}';
            }
            var dialog = bootbox.dialog({
                backdrop: true,
                onEscape: true,
                message: [
                    '<form role="form" onsubmit="window.do_exchange_log_delivery(this);return false;" action="{{URL::route('frontend.user.exchange.create')}}" method="POST" class="form-horizontal">',
                    '    <div class="form-group">',
                    '        <label class="col-sm-2 control-label"><p></p></label>',
                    '        <div class="col-xs-10 col-sm-10 col-md-10 col-lg-10">',
                    '            <h2>兑换</h2>',
                    '        </div>',
                    '    </div>',
                    '    <div class="form-group">',
                    '        <label class="col-sm-3 control-label" for="input_uuid">商品</label>',
                    '        <div class="col-sm-8">',
                    '            <span id="input_title"></span>',
                    '            <input type="hidden" id="input_goods_id" name="update[goods_id]" value="">',
                    '            <input type="hidden" id="input_hidden_title" name="update[title]" value="">',
                    '        </div>',
                    '    </div>',
                    '    <div class="form-group">',
                    '        <label class="col-sm-3 control-label" for="input_left">支付</label>',
                    '        <div class="col-sm-8">',
                    '            <span id="input_balance"></span> - ',
                    '            <span id="input_coin" class="text-danger"></span> = ',
                    '            <span id="input_remain"></span> (安全币)',
                    '            <input type="hidden" id="input_hidden_coin" name="update[coin]" value="">',
                    '        </div>',
                    '    </div>',
                    '    <div class="form-group receive">',
                    '        <label class="col-sm-3 control-label" for="input_title">姓名</label>',
                    '        <div class="col-sm-8">',
                    '            <input type="text" id="input_receive_name" name="update[receive_name]" class="form-control">',
                    '        </div>',
                    '    </div>',
                    '    <div class="form-group receive">',
                    '        <label class="col-sm-3 control-label" for="input_title">手机</label>',
                    '        <div class="col-sm-8">',
                    '            <input type="text" id="input_receive_phone" name="update[receive_phone]" class="form-control">',
                    '        </div>',
                    '    </div>',
                    '    <div class="form-group receive">',
                    '        <label class="col-sm-3 control-label" for="input_title">地址</label>',
                    '        <div class="col-sm-8">',
                    '            <input type="text" id="input_receive_address" name="update[receive_address]" class="form-control">',
                    '        </div>',
                    '    </div>',
                    '    <div class="form-group">',
                    '        <div class="col-sm-11 text-right">',
                    '            <input type="hidden" name="update[status]" value="1">',
                    '            <button data-bb-handler="cancel" type="button" class="btn btn-default" data-dismiss="modal">取消</button>',
                    '            <input id="btn-exchange" type="submit" class="btn btn-primary" value="兑换">',
                    '        </div>',
                    '    </div>',
                    '</form>'
                        ].join('')
            });
            dialog.init(function(){
                $('#input_goods_id').val($(a).attr('data-goods-id'));
                $('#input_title').text($(a).attr('data-goods-title'));
                $('#input_coin').text($(a).attr('data-goods-coin'));
                $('#input_remain').text((Number(window.reward_balance) - Number($(a).attr('data-goods-coin'))).toFixed(2));
                $('#input_hidden_title').val($(a).attr('data-goods-title'));
                $('#input_hidden_coin').val($(a).attr('data-goods-coin'));
                $('#input_balance').text(window.reward_balance.toFixed(2));
                $('#input_receive_address').val($(a).attr('data-receive-address'));
                $('#input_receive_address').val($(a).attr('data-receive-address'));
                $('#input_receive_name').val($(a).attr('data-receive-name'));
                $('#input_receive_phone').val($(a).attr('data-receive-phone'));

                var price = parseInt($(a).attr('data-goods-coin')) * 10000;
                var balance = window.reward_balance * 10000;
                if( balance - price < 0 ) {
                    $('#btn-exchange').val('余额不足').prop('disabled', true);
                    dialog.find('.receive').remove();
                }
            });
        };

        window.do_exchange_log_delivery = function(a){
            $.ajax({
                url: $(a).attr('action'),
                type: $(a).attr('method'),
                data: $(a).serialize(),
                dataType: 'json',
                success: function(json){
                    if(0 !== json.head.statusCode)return bootbox.alert('Fail: '+json.head.note);
                    return bootbox.alert('成功');
                },
                error: function(){
                    return bootbox.alert('网络错误');
                }
            });
            return false;
        };
    </script>
@endsection
