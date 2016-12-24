@extends ('backend.layouts.master')

@section ('title', trans('menus.backend.article.title').'|'.trans('menus.backend.article.articles.create'))

@section('after-styles-end')
@stop

@section('page-header')
    <h1>
        {{ trans('menus.backend.article.title') }}
        <small>{{ trans('menus.backend.article.articles.create') }}</small>
    </h1>
@endsection

@section('content')
    <div class="box box-success">
        <div class="box-header with-border">
            <h3 class="box-title">{{ trans('menus.backend.article.articles.create') }}</h3>
        </div>

        <div class="box-body">

            {{ $article_detail
                ->template([
                        'cover_img' => ['file'],
                        'content' => ['wysiwyg'],
                        'tags' => ['tags'],
                        'status'=>[
                            'select',
                            [
                                '0'=>'未发布',
                                '1'=>'已发布',
                                '2'=>'已置顶'
                            ]
                        ],
                        'type'=>[
                            'select',
                            [
                                '1'=>'公告',
                                '2'=>'文章'
                            ]
                        ],
                        'created_at'=>['datetime'],
                        'lengend_1' => ['lengend'],
                    ])
                ->make() }}
        </div>
    </div>
@stop

@section('after-scripts-end')
    <script>
        $('form button[type="submit"]').on('click',function (a) {
            $('.wysiwyg').each(function () {
                var $ta = $(this); $ta.text(CKEDITOR.instances[$ta.attr('id')].getData());
            });
        });
    </script>
@stop
