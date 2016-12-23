<?php

namespace App\Http\Controllers\Backend;

use DB;
use Response;
use App\Http\Controllers\Controller;
use Yajra\Datatables\Facades\Datatables;
use Tsssec\Editable\Editable;

/**
 * Class ArticleController
 * @package App\Http\Controllers\Backend
 */
class ArticleController extends Controller
{
    /**
     * @return \Illuminate\View\View
     */
    public function index()
    {
        return view('backend.article.list');
    }

    /**
     * @return \Illuminate\View\View
     */
    public function search()
    {
        return Datatables::queryBuilder( DB::table('articles'))
        ->make(true);
    }

    /**
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $article_detail = new Editable();
        $article_detail->options([
            'primary_key' => 'id',
            'i18n' => [
                'lengend_1'     => '文章/公告添加',
                'id'            => 'ID',
                'title'         => '标题',
                'cover_img'     => '封面图',
                'content'       => '内容',
                'slug'          => 'URL友好化',
                'tags'          => '标签',
                'type'          => '类型',
                'created_at'    => '创建时间',
                'status'        => '状态'
            ],
            //'columns_protected' => ['type']
        ])->insertTo(
            DB::table('articles')
        )->ready();
        return view('backend.article.detail', ['article_detail' => $article_detail]);
    }

    /**
     * @return \Illuminate\View\View
     */
    public function detail($article_id)
    {
        $article_detail = new Editable();

        return
        $article_detail->options([
            'primary_key' => 'id',
            'i18n' => [
                'lengend_1'     => '文章/公告編輯',
                'id'            => 'ID',
                'title'         => '标题',
                'cover_img'     => '封面图',
                'content'       => '内容',
                'slug'          => 'URL友好化',
                'tags'          => '标签',
                'type'          => '类型',
                'created_at'    => '创建时间',
                'status'        => '状态',
            ]
        ])->queryBuilder(
            DB::table('articles')
            ->select(['id','title','cover_img','content','slug','tags','type','created_at','status'])
            ->where(['id' => $article_id])
        )->ready(function($article_detail){
            return view('backend.article.detail', ['article_detail' => $article_detail]);
        });
    }
}
