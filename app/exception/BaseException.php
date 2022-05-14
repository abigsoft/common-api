<?php


namespace app\exception;


use think\Exception;

class BaseException extends Exception
{
    public $code = 0;
    public $message = '网络异常';
    public $data = null;

    /**
     * 构造函数，接收一个关联数组
     * @param array $params 关联数组只应包含code、msg和errorCode，且不应该是空值
     */
    public function __construct($params = [])
    {
        $this->code = config('my.errorCode');
        if (!is_array($params)) {
            return [];
        }
        if (array_key_exists('status', $params)) {
            $this->code = $params['status'];
        }
        if (array_key_exists('msg', $params)) {
            $this->message = $params['msg'];
        }
        if (array_key_exists('data', $params)) {
            $this->data = $params['data'];
        }
        return [];
    }
}