<?php

namespace App\Http\Controllers\Frontend;

use DB;
use App\Http\Controllers\Controller;
use Yajra\Datatables\Facades\Datatables;
use Tsssec\Editable\Editable;

/**
 * Class FrontendController
 * @package App\Http\Controllers
 */
class ArticleController extends Controller
{
    /**
     * @return \Illuminate\View\View
     */
    public function index() {
        return view('frontend.article.list');
    }

    /**
     * @return \Illuminate\View\View
     */
    public function search() {
        return Datatables::queryBuilder(
            DB::table('articles')
            ->select(['id', 'title', 'cover_img', 'created_at'])
        )
        ->whitelist(['id'])
        ->make(true);
    }

    /**
     * @return \Illuminate\View\View
     */
    public function detail($article_id) {
        $article_detail = new Editable();
        $a = $article_detail->options([
            'primary_key' => 'id',
            'i18n' => [
                'title'         => '标题',
                'content'       => '内容',
            ],
            'edit' => false
        ])->queryBuilder(
            DB::table('articles')
            ->select(['title','content'])
            ->where(['id' => $article_id])
        )->ready();

        return view('frontend.article.detail', ['article_detail' => $article_detail]);
    }
}
