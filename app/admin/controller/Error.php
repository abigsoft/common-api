<?php

namespace app\admin\controller;
use think\exception\ClassNotFoundException;

class Error 
{
    public function __call($method, $args){
        throw new ClassNotFoundException('控制器不存在',request()->controller());
    }
	
}
