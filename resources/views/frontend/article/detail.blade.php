@extends('frontend.layouts.page')

@section('wrap')
    <div class="panel panel-default">
        <div class="panel-body">
            <h3>公告</h3>
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
@endsection

@section('after-scripts-end')
@endsection
