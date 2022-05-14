<?php

namespace app\api\service\demo;

use app\common\service\BaseService;
use app\exception\ParamException;

class ApiService extends BaseService
{
    public static function index($api_info, $request, $config){
        //执行成功 return self::ajaxSuccess('这里是数据','这里是消息');
        return self::ajaxSuccess('这里是数据','这里是消息');
        //执行失败 return self::ajaxError('这里是消息','这里是数据');
        //异常数据 throw new ParamException('这里是消息');
    }

}