<?php

namespace app\common\service;

use app\common\model\PayOrderModel;
use pay\epay\DoPay;
use think\facade\Log;

class PayService extends BaseService
{
    public static function doPay($order_id)
    {

        $order = PayOrderModel::where('id', $order_id)->find();

        switch ($order['pay_type']) {
            case 'wxpay':
                $keysArr = array(
                    "pid" => intval(config('sys.pay_epay_mchid')),
                    "type" => 'wxpay',
                    "notify_url"	=> "https://".$_SERVER['HTTP_HOST']."/user/callback/epay",
                    "return_url"	=> "https://".$_SERVER['HTTP_HOST']."/user/callback/epay",
                    "out_trade_no"	=> $order['order_sn'],
                    "name"	=> $order['title'],
                    "money"	=> $order['pay_money'],
                    "sitename"	=> config('sys.site_title'),
                );
                $epay = new DoPay([
                    'apiurl'=>config('sys.pay_epay_url'),
                    'key'=>config('sys.pay_epay_key'),
                ]);
                return config('sys.pay_epay_url') . 'submit.php?'.http_build_query($epay->buildRequestPara($keysArr));
            default:
                return self::ajaxError('支付方式不存在');
        }
    }
}