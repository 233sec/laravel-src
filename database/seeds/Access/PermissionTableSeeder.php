<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

/**
 * Class PermissionTableSeeder
 */
class PermissionTableSeeder extends Seeder
{
    public function run()
    {
        if (DB::connection()->getDriverName() == 'mysql') {
            DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        }

        if (DB::connection()->getDriverName() == 'mysql') {
            DB::table(config('access.permissions_table'))->truncate();
            DB::table(config('access.permission_role_table'))->truncate();
        } elseif (DB::connection()->getDriverName() == 'sqlite') {
            DB::statement('DELETE FROM ' . config('access.permissions_table'));
            DB::statement('DELETE FROM ' . config('access.permission_role_table'));
        } else {
            //For PostgreSQL or anything else
            DB::statement('TRUNCATE TABLE ' . config('access.permissions_table') . ' CASCADE');
            DB::statement('TRUNCATE TABLE ' . config('access.permission_role_table') . ' CASCADE');
        }

        /**
         * Don't need to assign any permissions to administrator because the all flag is set to true
         * in RoleTableSeeder.php
         */

        /**
         * Misc Access Permissions
         */
        $permission_model          = config('access.permission');
        $viewBackend               = new $permission_model;
        $viewBackend->name         = 'view-backend';
        $viewBackend->display_name = '登入后台';
        $viewBackend->sort         = 1;
        $viewBackend->created_at   = Carbon::now();
        $viewBackend->updated_at   = Carbon::now();
        $viewBackend->save();

        /**
         * Access Permissions
         */
        $permission_model          = config('access.permission');
        $manageUsers               = new $permission_model;
        $manageUsers->name         = 'manage-users';
        $manageUsers->display_name = '管理用户';
        $manageUsers->sort         = 2;
        $manageUsers->created_at   = Carbon::now();
        $manageUsers->updated_at   = Carbon::now();
        $manageUsers->save();

        $permission_model          = config('access.permission');
        $manageRoles               = new $permission_model;
        $manageRoles->name         = 'manage-roles';
        $manageRoles->display_name = '管理权限';
        $manageRoles->sort         = 3;
        $manageRoles->created_at   = Carbon::now();
        $manageRoles->updated_at   = Carbon::now();
        $manageRoles->save();

        $manageVuls                         = new $permission_model;
        $manageVuls->name                   = 'manage-vuls';
        $manageVuls->display_name           = '管理漏洞';
        $manageVuls->sort                   = 4;
        $manageVuls->created_at             = Carbon::now();
        $manageVuls->updated_at             = Carbon::now();
        $manageVuls->save();

        $manageGoods                        = new $permission_model;
        $manageGoods->name                  = 'manage-goods';
        $manageGoods->display_name          = '管理礼品';
        $manageGoods->sort                  = 5;
        $manageGoods->created_at            = Carbon::now();
        $manageGoods->updated_at            = Carbon::now();
        $manageGoods->save();

        $manageExchanges                    = new $permission_model;
        $manageExchanges->name              = 'manage-exchanges';
        $manageExchanges->display_name      = '管理兑换';
        $manageExchanges->sort              = 6;
        $manageExchanges->created_at        = Carbon::now();
        $manageExchanges->updated_at        = Carbon::now();
        $manageExchanges->save();

        $manageArticles                     = new $permission_model;
        $manageArticles->name               = 'manage-articles';
        $manageArticles->display_name       = '管理文章';
        $manageArticles->sort               = 7;
        $manageArticles->created_at         = Carbon::now();
        $manageArticles->updated_at         = Carbon::now();
        $manageArticles->save();

        if (DB::connection()->getDriverName() == 'mysql') {
            DB::statement('SET FOREIGN_KEY_CHECKS=1;');
        }
    }
}
