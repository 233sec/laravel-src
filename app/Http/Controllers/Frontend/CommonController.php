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
    public function upload(\Request $request){
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

    /**
     * 异步上传文件 用户选择文件后请求 需要带入后缀名
     */
    public function uploadAsync(\Request $request){
        $access_id  = getenv('OSS_ACCESS_KEY_ID');
        $access_key = getenv('OSS_ACCESS_KEY_SECRET');
        $endpoint   = getenv('OSS_ENDPOINT');
        $file_name  = date('Y') . date('m') . substr(mt_rand(100000, 999999), 1) . md5(microtime(true)) . '.';
        $dir        = '';
        $redirect   = route('common.file.upload.callback', ['status' => 0, 'file' => $file_name, '_token' => csrf_token() ]);

        $policy = [
            'expiration' => date('Y-m-d\TH:i:s.000\Z', time() + 1800),
            'conditions' => [
                [
                    'bucket' => getenv('OSS_BUCKET')
                ],
                [
                    'content-length-range',
                    1,
                    1024*1024*50
                ],
                [
                    'starts-with',
                    '$key',
                    $file_name
                ]
            ]
        ];
        $policy = base64_encode(json_encode($policy));
        $signature = base64_encode(hash_hmac('sha1', $policy, $access_key, true));
        $response = [
            'accessid'  => $access_id,
            'host'      => $endpoint,
            'policy'    => $policy,
            'signature' => $signature,
            'expire'    => time()+1800,
            'dir'       => $dir.$file_name,
            'callback'  => $redirect
        ];
        return Response::json([
            'head' => ['statusCode' => 0, 'note' => 'OK'],
            'body' => $response
        ]);
    }

    public function uploadCallback(){
        return Response::json([
            'head' => ['statusCode' => 0, 'note' => 'OK'],
            'body' => ['url' => $_GET['file'] ?? '']
        ])
        ->header('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, HEAD')
        ->header('Access-Control-Allow-Origin', '*')
        ->header('Access-Control-Max-Age', 86400);
    }
}
