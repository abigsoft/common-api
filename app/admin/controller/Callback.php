<?php

namespace app\admin\controller;

use app\common\model\PayOrderModel;
use app\common\service\OrderService;
use pay\epay\Notify;

class Callback extends Base
{
    //阿里云oss上传异步回调返回上传路径，放到这是因为这个地址必须外部能直接访问到
    function aliOssCallBack()
    {
        $body = file_get_contents('php://input');
        header("Content-Type: application/json");
        $url = getAliEndPoint(config('my.ali_oss_endpoint')) . '/' . str_replace('%2F', '/', $body);
        return json(['code' => 1, 'data' => $url]);
    }
}