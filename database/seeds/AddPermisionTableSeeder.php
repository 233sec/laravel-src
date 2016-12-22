<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

// composer require laracasts/testdummy
use Laracasts\TestDummy\Factory as TestDummy;

class AddPermisionTableSeeder extends Seeder
{
    public function run()
    {
        $permission_model                   = config('access.permission');

        $manageVuls                        = new $permission_model;
        $manageVuls->name                  = 'manage-vuls';
        $manageVuls->display_name          = '管理漏洞';
        $manageVuls->sort                  = 1;
        $manageVuls->created_at            = Carbon::now();
        $manageVuls->updated_at            = Carbon::now();
        $manageVuls->save();

        $manageGoods                        = new $permission_model;
        $manageGoods->name                  = 'manage-goods';
        $manageGoods->display_name          = '管理礼品';
        $manageGoods->sort                  = 2;
        $manageGoods->created_at            = Carbon::now();
        $manageGoods->updated_at            = Carbon::now();
        $manageGoods->save();

        $manageExchanges                    = new $permission_model;
        $manageExchanges->name              = 'manage-exchanges';
        $manageExchanges->display_name      = '管理兑换';
        $manageExchanges->sort              = 3;
        $manageExchanges->created_at        = Carbon::now();
        $manageExchanges->updated_at        = Carbon::now();
        $manageExchanges->save();

        $manageArticles                     = new $permission_model;
        $manageArticles->name               = 'manage-articles';
        $manageArticles->display_name       = '管理文章';
        $manageArticles->sort               = 4;
        $manageArticles->created_at         = Carbon::now();
        $manageArticles->updated_at         = Carbon::now();
        $manageArticles->save();
    }
}
