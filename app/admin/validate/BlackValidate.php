<?php

namespace app\admin\validate;

use think\Validate;

class BlackValidate extends Validate
{
    protected $rule = [
        'ip'=>['require','ip','unique:black,ip'],
        'deadline'=>['require','date'],
    ];

    protected $message = [
        'ip.require'=>'IP地址不能为空',
        'ip.unique'=>'IP地址已经存在',
        'deadline.require'=>'到期时间不能为空',
    ];

    protected $scene  = [
        'update'=>['deadline'],
        'create'=>['ip','deadline'],
    ];
}