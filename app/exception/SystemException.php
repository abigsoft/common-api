<?php
/**
 * Notes:
 * User: 王小明
 * Date: 2020/12/29
 * Time: 11:32
 */

namespace app\exception;


class SystemException extends BaseException
{
    public $status = 500;
    public $data = null;
    public $msg = '当前操作人数太多,请点击重试';

    public function __construct($msg = '',$data = [])
    {
        parent::__construct([
            'status'=>$this->status,
            'data'=>$data?:$this->data,
            'msg'=>$msg?:$this->msg,
        ]);
    }
}
