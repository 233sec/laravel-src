<?php

namespace App\Http\Controllers\Backend;
use DB;
use Response;
use Illuminate\Support\Facades\Redirect;
use Yajra\Datatables\Facades\Datatables;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
class InstitutionManageController extends Controller
{
    /**
     * 添加机构页面
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function addInstitution(Request $req){
        if($req->isMethod('post')){
            /**机构信息入库**/
            $data = [];
            /**必填字段**/
            //*机构名称
            $data['agency_name'] =$req->jgmc;
            //*注册资本
            $data['registered_capital'] = $req->zczb;
            //*实缴资本
            $data['confirmed_capital'] = $req->sjzb;
            //*注册地址
            $data['registered_address'] = $req->zcdz;
            //*注册时间
            $data['registration_time'] = $req->zcsj;
            //*法定代表人
            $data['legal_person'] = $req->fddbr;
            //*三证合一
            $data['company_document'] = $req->szhy;
            //*经营范围
            $data['business_filed'] = $req->jyfw;
            //*联系方式
            $data['contact'] = $req->lxfs;
            //*服务费扣除规则
            $data['service_fee_type'] = $req->fwfdkgz;
            //*是否接受兜底
            $data['service_fee'] = $req->fwfdkgz_num;
            $data['guarantee'] = $req->jsdd;
            //*注册协议模板
            $data['protocol_doc'] = $req->zcxymb;
            //*资金存管情况
            $data['asset_host'] = $req->zjcgqk;
            //*担保机构
            $data['guarantee_operator'] = $req->dbjg;
            //*实际控制人的名单
            $data['controller_doc'] = $req->sjkzrmb;
            //*网站
            $data['website'] = $req->wz;
            //*平台名称
            $data['platform_name'] = $req->ptmc;
            //*平台上线运营时间
            $data['platform_duration'] = $req->ptsxyysja.'~'.$req->ptsxyysjb;
            //*ICP证号
            $data['icp_license_no'] = $req->icp;
            //*移动APP应用
            $data['app_package']=$req->app;
            //*年度财务会计报
            $data['anual_audit_doc'] = $req->ndcwkjb;
            //*业务人名称
            $data['bd_name'] = $req->ywrmc;
            //*业务人联系方式
            $data['bd_contact'] = $req->ywrlxfs;
            //未评级
            $data['level'] = 0;
            //未审核
            $data['status'] = 0;
            /**可填字段**/
            if(isset($req->fzjgjycs)){
                //分支机构经营场所
                $data['subsidiary_address'] = $req->fzjgjycs;
            }
            if(isset($req->hzdsfjggl)){
                //合作第三方机构的关联
                $data['co_operation_relation'] = $req->hzdsfjggl;
            }
            if(isset($req->zzjgqk)) {
                //组织架构情况
                $data['team_structure'] = $req->zzjgqk;
            }
            if(isset($req->ygxx)){
                //员工信息
                $data['staff'] = $req->ygxx;
            }
            if(isset($req->gjglmd)) {
                //高级管理名单
                $data['manager_doc'] = $req->gjglmd;
            }
            if(isset($req->dsjj)) {
                //董事简介
                $data['board_intro'] = $req->dsjj;
            }
            if(isset($req->jsjj)) {
                //监事简介
                $data['supervisor_intro'] = $req->jsjj;
            }
            if(isset($req->gzh)) {
                //公众号或服务号
                $data['wechat_open_account'] = $req->gzh;
            }
            if(isset($req->zyrzxx)) {
                //重要融资信息
                $data['capital_round_news'] = $req->zyrzxx;
            }
            if(isset($req->sjbg)) {
                //审计报告
                $data['audit_doc'] = $req->sjbg;
            }
            if(isset($req->xgxw)) {
                //相关新闻
                $data['platform_news'] = $req->xgxw;
            }
            if(isset($req->qtxw)) {
                //其他信息
                $data['orther_info'] = $req->qtxw;
            }
            //插入记录
            DB::connection('mysql_debt')->table('agency')->insert(
                $data
            );
            return Redirect::route('admin.institutionmanage_audit_institution_info');
            exit;
        }
        return view('backend.InstitutionManage.addInstitution');
    }

    /**
     * 修改机构信息
     * @param Request $req
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function modifyInstitution(Request $req){
        if($req->isMethod('post')){
            /**机构信息入库**/
            $data = [];
            /**必填字段**/
            //*机构名称
            $data['agency_name'] =$req->jgmc;
            //*注册资本
            $data['registered_capital'] = $req->zczb;
            //*实缴资本
            $data['confirmed_capital'] = $req->sjzb;
            //*注册地址
            $data['registered_address'] = $req->zcdz;
            //*注册时间
            $data['registration_time'] = $req->zcsj;
            //*法定代表人
            $data['legal_person'] = $req->fddbr;
            //*三证合一
            $data['company_document'] = $req->szhy;
            //*经营范围
            $data['business_filed'] = $req->jyfw;
            //*联系方式
            $data['contact'] = $req->lxfs;
            //*服务费扣除规则
            $data['service_fee_type'] = $req->fwfdkgz;
            //*是否接受兜底
            $data['service_fee'] = $req->fwfdkgz_num;
            $data['guarantee'] = $req->jsdd;
            //*注册协议模板
            $data['protocol_doc'] = $req->zcxymb;
            //*资金存管情况
            $data['asset_host'] = $req->zjcgqk;
            //*担保机构
            $data['guarantee_operator'] = $req->dbjg;
            //*实际控制人的名单
            $data['controller_doc'] = $req->sjkzrmb;
            //*网站
            $data['website'] = $req->wz;
            //*平台名称
            $data['platform_name'] = $req->ptmc;
            //*平台上线运营时间
            $data['platform_duration'] = $req->ptsxyysja.'~'.$req->ptsxyysjb;
            //*ICP证号
            $data['icp_license_no'] = $req->icp;
            //*移动APP应用
            $data['app_package']=$req->app;
            //*年度财务会计报
            $data['anual_audit_doc'] = $req->ndcwkjb;
            //*业务人名称
            $data['bd_name'] = $req->ywrmc;
            //*业务人联系方式
            $data['bd_contact'] = $req->ywrlxfs;
            /**可填字段**/
            if(isset($req->fzjgjycs)){
                //分支机构经营场所
                $data['subsidiary_address'] = $req->fzjgjycs;
            }
            if(isset($req->hzdsfjggl)){
                //合作第三方机构的关联
                $data['co_operation_relation'] = $req->hzdsfjggl;
            }
            if(isset($req->zzjgqk)) {
                //组织架构情况
                $data['team_structure'] = $req->zzjgqk;
            }
            if(isset($req->ygxx)){
                //员工信息
                $data['staff'] = $req->ygxx;
            }
            if(isset($req->gjglmd)) {
                //高级管理名单
                $data['manager_doc'] = $req->gjglmd;
            }
            if(isset($req->dsjj)) {
                //董事简介
                $data['board_intro'] = $req->dsjj;
            }
            if(isset($req->jsjj)) {
                //监事简介
                $data['supervisor_intro'] = $req->jsjj;
            }
            if(isset($req->gzh)) {
                //公众号或服务号
                $data['wechat_open_account'] = $req->gzh;
            }
            if(isset($req->zyrzxx)) {
                //重要融资信息
                $data['capital_round_news'] = $req->zyrzxx;
            }
            if(isset($req->sjbg)) {
                //审计报告
                $data['audit_doc'] = $req->sjbg;
            }
            if(isset($req->xgxw)) {
                //相关新闻
                $data['platform_news'] = $req->xgxw;
            }
            if(isset($req->qtxw)) {
                //其他信息
                $data['orther_info'] = $req->qtxw;
            }
            //修改过后状态变为待审核,未评级
            $data['status'] = 0;
            $data['level'] = 0;
            $data['status_proposal'] = '';
            $data['level_proposal'] = '';
            //插入记录
            DB::connection('mysql_debt')->table('agency')->where('id',$req->id)->update(
                $data
            );
            return Redirect::route('admin.institutionmanage_audit_institution_info');
            exit;
        }
        $result = DB::connection('mysql_debt')->table('agency')->where('id',$req->id)->first();
        $platform_duration = explode('~',$result->platform_duration);
        return view('backend.InstitutionManage.modifyInstitution',['result'=>$result,'platform_duration'=>$platform_duration]);
    }

    /**
     * 添加机构页面上传文件操作
     */
    public function uploadInstitutionFile(Request $request){
        if($request->isMethod('post')) {
            $result = putFileUp($_FILES['file']);
            if (getenv('APP_DEBUG')==true){
                if ('local' === getenv('APP_ENV') || 'dev' === getenv('APP_ENV'))
                    \Debugbar::disable();
            }
            if ($result){
                if (@$_GET['wysiwyg']) {
                    return '<script type="text/javascript">window.parent.CKEDITOR.dialog.getCurrent().getContentElement("info", "txtUrl").setValue("'.
                    $result.
                    '");window.parent.jQuery(".cke_dialog_ui_button_ok span").click();</script>';
                }
                return Response::json(['code' => 1000, 'message' => 'OK', 'data' => ['url' => $result]]);
            }
            else{
                return Response::json(['code' => 5000, 'message' => 'FAIL', 'data' => ['url' => null]]);

            }
        }
    }

    /**
     * 需要审核的机构列表
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function auditInstitutionInfo(){

        return view('backend.InstitutionManage.auditInstitutionInfo');
    }
    /**
     * 获得需要审核/评级的机构信息
     * @return mixed
     */
    public function getAuditInstitutionInfo(){
        return Datatables::queryBuilder(DB::connection('mysql_debt')->table('agency')->select(['id','agency_name','registered_capital','guarantee','bd_name','created_at','status','level']))
            ->filterColumn('status', function($query, $keyword) {
                if($keyword == 1){
                    $query->where('status',1);
                }elseif($keyword == 0){
                    $query->where('status',0);
                }elseif($keyword == -1){
                    $query->where('status',-1);
                }
            })->make(true);
    }
    /**
     * 审核具体某个机构的页面
     */
    public function auditInstitution(Request $req){
        if(is_numeric($req->id)){
            if($req->isMethod('post')) {
                if($req->status==1){
                    DB::connection('mysql_debt')->table('agency')
                        ->where('id', $req->id)
                        ->update(['status' => 1]);
                    return Redirect::route('admin.institutionmanage_audit_institution_info');
                }else{
                    DB::connection('mysql_debt')->table('agency')
                        ->where('id', $req->id)
                        ->update(['status' => -1,'status_proposal'=>$req->reason]);
                    return Redirect::route('admin.institutionmanage_audit_institution_info');
                }
            }else{
                $result = DB::connection('mysql_debt')->table('agency')->where('id',$req->id)->first();
                return view('backend.InstitutionManage.auditInstitution',['res'=>$result]);
            }
        }
    }
    /**
     * 机构列表
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getInstitutionList(){
        return view('backend.InstitutionManage.getInstitutionList');
    }

    /**
     * 设置评级
     * @param Request $req
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function setRating(Request $req){
        if($req->isMethod('post')&&is_numeric($req->id)) {
                if(empty($req->level)){
                    $level = 0;
                }else{
                    $level = $req->level;
                }
                DB::connection('mysql_debt')->table('agency')
                    ->where('id', $req->id)
                    ->update(['level' => $level,'level_proposal' => $req->pjsm]);
        }
        return Redirect::route('admin.institutionmanage_audit_institution_info');
    }

    /**
     * 获取所有机构信息
     * @return mixed
     */
    public function getInstitutionListInfo(){
        return Datatables::queryBuilder(
            DB::connection('mysql_debt')
                ->table('agency')
                ->select(DB::raw('
                    id,
                    agency_name,
                    registered_capital,
                    guarantee,
                    bd_name,
                    created_at,
                    status,
                    level
                ')))->filterColumn('status', function($query, $keyword) {
                        if($keyword == 1){
                            $query->where('status',1);
                        }elseif($keyword == 0){
                            $query->where('status',0);
                        }elseif($keyword == -1){
                            $query->where('status',-1);
                        }
                })->make(true);
    }
}