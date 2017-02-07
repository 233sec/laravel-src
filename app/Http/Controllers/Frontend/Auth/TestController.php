<?php

namespace App\Http\Controllers\Frontend\Auth;
use DB;
use App\Http\Controllers\Controller;
use App\Http\Controllers\DatatablesX;

class TestController extends Controller
{
    public function __construct() {
    }

    public function test() {
        return view('frontend.test');
    }

    public function search() {
        return DatatablesX::queryBuilder( DB::table('test'))->make(true);
    }
}
