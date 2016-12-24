<!doctype html>
<html class="no-js" lang="">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="_token" content="{{ csrf_token() }}" />

        <title>@yield('title', app_name())</title>

        <meta name="description" content="@yield('meta_description', 'Default Description')">
        <meta name="author" content="@yield('meta_author', 'Anthony Rappa')">
        @yield('meta')

        @yield('before-styles-end')

        {{ Html::style(Cdn::asset('css/backend/app.css')) }}
        {{ Html::style(Cdn::asset('css/backend/plugin/datatables/dataTables.bootstrap.min.css')) }}
        {{ Html::style(Cdn::asset('js/vendor/bootstrap-datetimepicker/css/bootstrap-datetimepicker.min.css')) }}
        {{ Html::style(Cdn::asset('js/vendor/select2/select2.min.css')) }}
        {{ Html::style(Cdn::asset('js/vendor/select2/select2-bootstrap.min.css')) }}
        {{ Html::style(Cdn::asset('js/vendor/bootstrap-tagsinput/bootstrap-tagsinput.css')) }}
        {{ Html::style(Cdn::asset('js/vendor/bootstrap-tagsinput/bootstrap-tagsinput-typeahead.css')) }}

        @yield('after-styles-end')

        <!--[if lt IE 9]>
        {{ HTML::script('https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js') }}
        {{ HTML::script('https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js') }}
        <![endif]-->
    </head>
    <body class="skin-{{ config('backend.theme') }} {{ config('backend.layout') }} sidebar-mini">
        <script type="text/javascript">
            try{
                document.body.className+=' '+document.cookie.match(/bodyClass=([^;]+)/)[1];
            }catch(e){}
        </script>
        @include('includes.partials.logged-in-as')

        <div class="wrapper">
            @include('backend.includes.header')
            @include('backend.includes.sidebar')

            <div class="content-wrapper">
                <section class="content-header">
                    @yield('page-header')

                    {{-- Change to Breadcrumbs::render() if you want it to error to remind you to create the breadcrumbs for the given route --}}
                    {!! Breadcrumbs::renderIfExists() !!}
                </section>

                <section class="content">
                    @include('includes.partials.messages')
                    @yield('content')
                </section>
            </div>

            @include('backend.includes.footer')
        </div>

        {{ Html::script(Cdn::asset('js/vendor/jquery/jquery-2.1.4.min.js')) }}
        {{ Html::script(Cdn::asset('js/vendor/bootstrap/bootstrap.min.js')) }}
        {{ Html::script(Cdn::asset('js/backend/plugin/datatables/jquery.dataTables.min.js')) }}
        {{ Html::script(Cdn::asset('js/backend/plugin/datatables/dataTables.bootstrap.min.js')) }}
        {{ HTML::script(Cdn::asset('js/backend/app.js')) }}
        {{ Html::script(Cdn::asset('js/vendor/bootbox/bootbox.min.js')) }}
        {{ Html::script(Cdn::asset('js/vendor/moment/moment-with-locales.min.js')) }}
        {{ Html::script(Cdn::asset('js/vendor/bootstrap-datetimepicker/js/bootstrap-datetimepicker.min.js')) }}
        {{ Html::script(Cdn::asset('ckeditor/ckeditor.js')) }}
        {{ Html::script(Cdn::asset('js/vendor/select2/select2.min.js')) }}
        {{ Html::script(Cdn::asset('js/vendor/bootstrap-tagsinput/bootstrap-tagsinput.min.js')) }}
        {{ Html::script(Cdn::asset('js/vendor/parsley/parsley.min.js')) }}
        {{ Html::script(Cdn::asset('js/vendor/sortable/Sortable.min.js')) }}
        {{ Html::script(Cdn::asset('js/vendor/ajaxfileuploader/ajaxfileuploader.min.js')) }}
        <script type="text/javascript">
            $(".sidebar-toggle").on("click",function(){setTimeout(function(){$("body").hasClass("sidebar-collapse")?document.cookie="bodyClass=sidebar-collapse; path=/;":document.cookie="bodyClass=sidebar-uncollapse; path=/;"},500)});

            $.ajaxSetup({
                beforeSend: function(xhr, set){
                    if('string' === typeof set.data) set.data = set.data+'&_token='+$('meta[name="_token"]').attr('content');
                    else set.data = $.extend(set.data, {_token: $('meta[name="_token"]').attr('content')});
                }
            });

            $.fn.upload_init = function(){
                $.getJSON('{{ URL::route("common.file.upload.async") }}', function (json) {
                    if(json.head.statusCode !== 0) return bootbox.alert('OSS 签名失败. 文件可能无法上传');
                    window.file_upload_callback = function(j){return '//'+json.body.host+'/'+j.body.url+'image';};
                    window.file_upload_url = json.body.host;
                    window.file_upload_param = {
                        OSSAccessKeyId: json.body.accessid,
                        policy: json.body.policy,
                        Signature: json.body.signature,
                        key: json.body.dir + 'image',
                        success_action_redirect: json.body.callback
                    };
                    $('.ajax-file').uploader({
                        url: '//'+window.file_upload_url,
                        data: window.file_upload_param,
                        secureuri: true,
                        filedName: 'file',
                        dataType: 'json',
                        minSize: 1,
                        maxSize: 10*1024*1024,
                        allowExt: {jpg: 1, png: 1, gif: 1, jpeg: 1, bmp: 1, rar: 1, zip: 1, '7z': 1, webp: 1, pdf: 1},
                        beforeUpload: function(file, nonce, dom){
                            $('#'+$(dom).attr('data-save-to')).val('上传中');
                        },
                        success: function(json, nonce, dom){
                            $('#'+$(dom).attr('data-save-to')).val(window.file_upload_callback(json));
                        },
                        error: function(file, nonce, msg, dom){
                            $('#'+$(dom).attr('data-save-to')).val('上传失敗');
                        }
                    });

                    CKEDITOR.on('dialogDefinition', function (ev) {
                            var dialogName = ev.data.name;
                            var dialogDefinition = ev.data.definition;
                            var dialog = ev.data.definition.dialog;

                            if (dialogName == 'image') {
                            dialog.on('show', function () {
                                    this.selectPage('Upload');
                                    this.hidePage('info');

                                    for (var i in dialogDefinition.contents) {
                                    var contents = dialogDefinition.contents[i];
                                    if (contents.id == "Upload") {
                                    window._rf = setInterval(function() {
                                            if($('iframe.cke_dialog_ui_input_file').length){
                                                clearInterval(window._rf);
                                                if($('.wysiwyg_file_img').length == 0){
                                                    $dom = $('<input/>');
                                                    $dom.attr('type', 'file');
                                                    $dom.addClass('wysiwyg_file_img');
                                                    $dom.uploader({
                                                        url: '//'+window.file_upload_url,
                                                        data: window.file_upload_param,
                                                        secureuri: true,
                                                        filedName: 'file',
                                                        dataType: 'json',
                                                        minSize: 1,
                                                        maxSize: 10*1024*1024,
                                                        allowExt: {jpg: 1, png: 1, gif: 1, jpeg: 1, bmp: 1, rar: 1, zip: 1, '7z': 1, webp: 1, pdf: 1},
                                                        beforeUpload: function(file, nonce, dom){
                                                        },
                                                        success: function(json, nonce, dom){
                                                            url = window.file_upload_callback(json);
                                                            CKEDITOR.dialog.getCurrent().getContentElement("info", "txtUrl").setValue(url);
                                                            jQuery(".cke_dialog_ui_button_ok span").click();
                                                        },
                                                        error: function(file, nonce, msg, dom){
                                                        }
                                                    });
                                                    $dom.css({
                                                        background: '#666',
                                                        width: '100%',
                                                        height: '120px',
                                                        display: 'block',
                                                        'text-indent': '99999px'
                                                    });

                                                    $('iframe.cke_dialog_ui_input_file').after($dom);
                                                    $('iframe.cke_dialog_ui_input_file,.cke_dialog_ui_fileButton,.cke_dialog_ui_labeled_label').hide();
                                                }
                                            }
                                            }, 50);
                                    }
                                    }
                            });
                            dialogDefinition.minHeight = 150;
                            }
                    });

                });
            };

            window.wysiwyg_param = {
            };
            window.wysiwyg_init = function(dom){
                $(dom).each(function(index, el) {
                    CKEDITOR.replace($(this)[0], window.wysiwyg_param);
                });
                $('form button').on('click', function(){
                    for(id in CKEDITOR.instances){
                        $('#'+id).val(CKEDITOR.instances[id].getData());
                    }
                });
            };
            window.datetime_init = function(dom){
                $(dom).each(function(index, el) {
                    $(this).datetimepicker({
                        locale:'zh-cn',
                        sideBySide: true,
                        format: 'YYYY/MM/DD HH:mm:ss',
                    });
                });
            };
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

            $.extend( true, $.fn.dataTable.defaults, {
                sPaginationType: "full_numbers",
                oLanguage: window._table_i18n,
                bStateSave: true,
                initComplete: function () {
                    var id = $(this[0]).attr('id');
                    var data = JSON.parse( localStorage['DataTables_'+id+'_'+location.pathname] );
                    var columns = this.api().settings().init().columns;
                    this.api().columns().every( function (index) {
                        var column = this;
                        $('input,select', this.footer() ).val( data.columns[index].search.search );
                        $('input,select', this.footer() ).on('keyup change', function () {
                            if ($(this).val() == column.search()) return;
                            column.search($(this).val(), false, false, true).draw();
                        } );
                    } );
                }
            } );

            bootbox.setDefaults({  backdrop: true, escape: true});
            $('input[type="file"]').uploader({
                url: '{{ URL::route('common.file.upload') }}',
                data: {_token: $('input[name="_token"]').val()},
                secureuri: true,
                filedName: 'file',
                dataType: 'json',
                minSize: 1,
                maxSize: 10*1024*1024,
                allowExt: {jpg: 1, png: 1, gif: 1, jpeg: 1, bmp: 1, rar: 1, zip: 1, '7z': 1, webp: 1, pdf: 1},
                beforeUpload: function(file, nonce, dom){
                    $(dom).parent().parent().find('#'+$(dom).attr('data-save-to')).val('上传中');
                },
                success: function(json, nonce, dom){
                    $(dom).parent().parent().find('#'+$(dom).attr('data-save-to')).val(json.data.url);
                },
                error: function(file, nonce, msg, dom){
                    $(dom).parent().parent().find('#'+$(dom).attr('data-save-to')).val('上传失敗');
                }
            });
            $('body').on('DOMNodeInserted', 'table', function(){
                $('table').not('.table, .cke_reset_all table').addClass('table').addClass('table-bordered').removeAttr('cellpadding').removeAttr('border').removeAttr('cellspacing');
                $('p img').not('.img-responsive').addClass('img-responsive');
            });
        </script>


        @yield('before-scripts-end')
        @yield('after-scripts-end')
    </body>
</html>
