<?php

namespace app\admin\validate;

use think\Validate;

class MemberValidate extends Validate
{
    protected $rule = [
        'account'=>['require','alphaNum','unique:member,account','graph','max:20','min:6'],
        'password'=>['require','alphaDash','max:20','min:6'],
    ];

    protected $message = [
        'account.require'=>'登录账号不能为空',
        'account.unique'=>'登录账号已经存在',
        'account.alphaNum'=>'登录账号只能是字母和数字',
        'account.graph'=>'登录账号输入不符合标准',
        'account.max'=>'登录账号不能超过20个字符',
        'account.min'=>'登录账号不能少于6个字符',
        'password.require'=>'登录密码不能为空',
        'password.max'=>'登录密码不能超过20个字符',
        'password.min'=>'登录密码不能少于6个字符',
        'password.alphaDash'=>'登录密码只能为字母和数字，下划线及破折号',
    ];

    protected $scene  = [
        'password'=>['password'],
        'create'=>['account','password'],
    ];
}