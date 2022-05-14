<?php
/**
 * Notes:
 * User: 王小明
 * Date: 2020/12/29
 * Time: 11:32
 */

namespace app\exception;


class ParamException extends BaseException
{
    public $status = 202;
    public $data = null;
    public $msg = '参数异常';

    public function __construct($msg = '')
    {
        parent::__construct([
            'status'=>$this->status,
            'data'=>$this->data,
            'msg'=>$msg?:$this->msg,
        ]);
    }
}
