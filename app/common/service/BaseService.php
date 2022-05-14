<?php

namespace app\common\service;

use app\common\model\ConfigModel;

class BaseService
{

    protected static function ajaxSuccess($data, $msg = 'SUCCESS')
    {
        return [
            'status' => config('my.successCode'),
            'data' => $data,
            'msg' => $msg,
        ];
    }

    protected static function ajaxError($msg = '', $data = '')
    {
        return [
            'status' => config('my.errorCode'),
            'data' => $data,
            'msg' => $msg,
        ];
    }

    /**
     * @param $action
     * @return stringClass 'Api' not found[/www/wwwroot/php/app/app/api/controller/baofu/Callback.php:51]
    [2022-04-08T12:00:12+08:00][info] {"orgNo":"1255385","merchantNo":"1255385","terminalNo":"63986","orderStatus":"SUCCESS","tradeId":"20220226081952194207","paidType":"CARD","orderMoney":"1","loginId":"12","finishTime":"20220408120012","orderId":"22040800026720360","errorMsg":"\u6210\u529f","signature":"428dbd4b07762d62493bf5a23b584200d52b6584cb6a60df4c29ebfb7803625a7de546e84f68a77fdf4dd499462e5a1a9a92260bd00bef61be63ddcdf06cfa2f60208e4f69bb011b377bb10ec675fc2d70cce1b8714ae6731d90c3f74ae3998e770cca85bd36c05c55d2e80884877ad8887eabba468af68ba29a4e790cad39f4"}
     */

    protected static function getNotify($action): string
    {
        return "https://" . $_SERVER['HTTP_HOST'] . "/api/callback/" . $action;
    }
}