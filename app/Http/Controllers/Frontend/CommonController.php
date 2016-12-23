<?php
namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Response;
use DB;

class CommonController extends Controller {

    /**
     * 上传文件
     */
    public function upload(Request $request){
        if($request->isMethod('post')) {
            $result = putFileUp($_FILES['file']);
            if (getenv('APP_DEBUG')==true && class_exists('\Debugbar') ) \Debugbar::disable();
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
}
