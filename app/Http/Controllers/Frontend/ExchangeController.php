<?php

namespace App\Http\Controllers\Frontend;

use DB;
use App\Http\Controllers\Controller;
use App\Http\Controllers\DatatablesX;
use Yajra\Datatables\Facades\Datatables;
use Tsssec\Editable\Editable;

/**
 * Class FrontendController
 * @package App\Http\Controllers
 */
class ExchangeController extends Controller
{
    /**
     * @return \Illuminate\View\View
     */
    public function index() {
        $user = auth()->user();
        $param = ['reward' => null, 'credit' => null];
        if( $user ){
            $param = ['reward' => $user->reward ?? null, 'credit' => $user->credit ?? null];
        }
        return view('frontend.goods.list', $param);
    }

    /**
     * @return \Illuminate\View\View
     */
    public function search() {
        return DatatablesX::queryBuilder( DB::table('goods'))
        ->whitelist(['id'])
        ->make(true);
    }
}
