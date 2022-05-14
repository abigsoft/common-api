<?php

namespace app\common\service;

use app\common\model\PayOrderModel;
use app\common\model\ProjectApiModel;

class OrderService extends BaseService
{
    public static function realOrder($order_id){
        $order = PayOrderModel::where('id', $order_id)->find();
        if ($order['status'] == 1) {
            return true;
        }
        PayOrderModel::where('id', $order_id)->update(['status' => 1]);
        switch ($order['order_type']) {
            case 1:
                $info = ProjectApiModel::where('id', $order['other'])->find();
                if($info['limit_date'] > formatDate()){
                    $limit_date = $info['limit_date'];
                }else{
                    $limit_date = formatDate();
                }
                $limit_date = date("Y-m-d H:i:s", strtotime("+" . $order['order_num'] . " months", strtotime($limit_date)));
                ProjectApiModel::where('id', $info['id'])->update([
                    'limit_date' => $limit_date,
                ]);
                break;
            default:
                return false;
        }
        return true;
    }
}