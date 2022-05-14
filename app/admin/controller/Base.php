<?php

namespace app\admin\controller;
use app\BaseController;
use think\exception\HttpResponseException;
use think\exception\FuncNotFoundException;
use think\facade\View;

class Base extends BaseController
{

    protected $successCode;
    protected $errorCode;

    public function initialize(){
        $controller = strtolower($this->request->controller());
        $action = strtolower($this->request->action());

        $this->successCode = config('my.successCode');
        $this->errorCode = config('my.errorCode');

        $admin = session('admin');

        if( !$admin && !in_array($controller,['login','callback'])){
            echo '<script type="text/javascript">top.parent.frames.location.href="'.url('admin/login/index').'";</script>';exit();
        }

        event('DoLog');
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
        return View::fetch($template);
    }

    /**
     * 重定向
     * @param mixed ...$args
     */
    protected function redirect(...$args){
        throw new HttpResponseException(redirect(...$args));
    }

    protected function ajaxReturn($status, $msg, $data = []): \think\response\Json {
        $res = [
            'status' => $status,
            'msg'  => $msg,
            'data' => $data
        ];
        !empty($data) && $res['data'] = $data;
        return json($res);
    }

}
