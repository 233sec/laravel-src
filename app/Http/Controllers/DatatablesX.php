<?php
namespace App\Http\Controllers;

use \Yajra\Datatables\Facades\Datatables;

class DatatablesX extends Datatables{
    public static function queryBuilder($q){
        $ret = parent::queryBuilder($q);
        $columns = $ret->request->get('columns', []);
        foreach($columns as $column_item){
            $name  =$column_item['name']??'';
            $regex = $column_item['search']['regex']??false;
            $value = $column_item['search']['value']??'';
            if($name && $regex && $value){
                if(preg_match('/^\^(.*)\$$/', $value)){
                    $ret = $ret->filterColumn($name, function($query, $keyword) use($name, $value){
                        preg_match('/^\^(.*)\$$/', $value, $v);
                        $v = $v[1]??false;
                        if(is_numeric($v)) $v = (int) $v;
                        if($v) return $query->where([$name=>$v]);
                    });
                }
            }
        }

        return $ret;
    }
}
