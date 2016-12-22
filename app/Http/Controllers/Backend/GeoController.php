<?php

namespace App\Http\Controllers\Backend;

use DB;
use Response;
use App\Http\Controllers\Controller;
use Yajra\Datatables\Facades\Datatables;

/**
 * Class BorrowerController
 * @package App\Http\Controllers\Backend
 */
class GeoController extends Controller
{
    public function listProvince() {
        $province_list = DB::connection('mysql_geo')->table('province')->get();
        return Response::json([
            'head' => ['statusCode' => 0, 'note' => 'OK'],
            'body' => ['provinces' => $province_list]
        ])->header('Cache-Control', 'max-age=300')->header('Expires', gmdate('D, d M Y H:i:s', time()+300));
    }
    public function listCity($province_id) {
        $city_list = DB::connection('mysql_geo')->table('city')->where([
            'fatherID' => $province_id
        ])->get();
        return Response::json([
            'head' => ['statusCode' => 0, 'note' => 'OK'],
            'body' => ['citys' => $city_list]
        ])->header('Cache-Control', 'max-age=300')->header('Expires', gmdate('D, d M Y H:i:s', time()+300));
    }
    public function listArea($province_id, $father_id) {
        $area_list = DB::connection('mysql_geo')->table('area')->where([
            'fatherID' => $father_id
        ])->get();
        return Response::json([
            'head' => ['statusCode' => 0, 'note' => 'OK'],
            'body' => ['areas' => $area_list]
        ])->header('Cache-Control', 'max-age=300')->header('Expires', gmdate('D, d M Y H:i:s', time()+300));
    }

}