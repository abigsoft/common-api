<?php

namespace app\index\controller;

use app\BaseController;
use HttpResponseException;
use think\exception\FuncNotFoundException;
use think\facade\View;

class Base extends BaseController
{
    public function initialize(){
        buildConfig();
    }

    public function __call($method, $args){
        throw new FuncNotFoundException('方法不存在',$method);
    }

    /**
     * 模板赋值
     * @param mixed ...$vars
     */
    protected function assign(...$vars)
    {
        View::assign(...$vars);
    }

    /**
     * 解析和获取模板内容
     * @param string $template
     * @return string
     * @throws \Exception
     */
    protected function fetch(string $template = ''): string
    {
        return View::fetch('temp' . config('sys.site_temp') . '/' .$template);
    }

    /**
     * 重定向
     * @param mixed ...$args
     */
    protected function redirect(...$args){
        throw new HttpResponseException(redirect(...$args));
    }
}