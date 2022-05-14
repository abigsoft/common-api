<?php

namespace app\tasks;

use app\common\model\OrderModel;
use app\common\model\PayOrderModel;
use think\facade\Log;

class Order
{
    public static function run()
    {
        PayOrderModel::where('end_time', '<', formatDate())->where('status', 0)->update(['status' => -1]);
    }
}