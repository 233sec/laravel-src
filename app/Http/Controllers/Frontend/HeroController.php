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
class HeroController extends Controller
{
    /**
     * @return \Illuminate\View\View
     */
    public function index() {
        return view('frontend.hero.list');
    }

    /**
     * @return \Illuminate\View\View
     */
    public function search() {
        $query = DB::table('vuls')->select([
            DB::raw('SUM(vuls.credit) AS credit'),
            'users.name'
        ])
        ->join('users', 'users.id', '=', 'vuls.user_id', 'left');

        $m = $_GET['m'] ?? false;
        if ($m) $query = $query->whereBetween('vuls.created_at', [ date('Y-m-d H:i:s', strtotime($_GET['m'].'-01')), date('Y-m-d H:i:s', strtotime($_GET['m'].'-01 +1 month'))]);

        $query = $query->where('vuls.credit', '>', 0)->groupBy('vuls.user_id')->orderBy('vuls.credit', 'DESC');
        return DatatablesX::queryBuilder($query)
        ->whitelist([])
        ->make(true);
    }
}
