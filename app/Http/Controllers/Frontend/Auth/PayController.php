<?php

namespace App\Http\Controllers\Frontend\Auth;
use App\Http\Controllers\Controller;
use Omnipay\Omnipay;

class PayController extends Controller
{
    public function __construct() {
    }

    public function test() {
        $gateway = Omnipay::create('Alipay_AopF2F');
        $gateway->setAppId('the_app_id');
        $gateway->setPrivateKey('the_app_private_key');
        $gateway->setAlipayPublicKey('the_alipay_public_key');
        $gateway->setNotifyUrl('https://www.example.com/notify');

        $request = $gateway->purchase();
        $request->setBizContent([
            'subject'      => 'test',
            'out_trade_no' => date('YmdHis') . mt_rand(1000, 9999),
            'total_amount' => '0.01'
        ]);

        /**
         * @var AopTradePreCreateResponse $response
         */
        $response = $request->send();

        // 获取收款二维码内容
        $qrCodeContent = $response->getQrCode();
        echo $qrCodeContent;
        return $qrCodeContent;
    }
}
