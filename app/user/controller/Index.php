<?php

namespace app\user\controller;

use app\user\service\LoginService;

class Index extends Base
{
    //框架主体
    public function index()
    {
        $this->assign([
            'menus'=>config('menu'),
        ]);
        return view('index');
    }

    //后台首页框架内容
    public function main()
    {
        return view('main');
    }

    function qq(){
        $res = LoginService::bind('qq');
        if(isset($res['code']) && $res['code']==0){
            $this->redirect($res['url']);
        }elseif(isset($arr['code'])){
            exit('登录接口返回：'.$arr['msg']);
        }
    }

    function wx(){
        $res = LoginService::bind('wx');
        if(isset($res['code']) && $res['code']==0){
            $this->redirect($res['url']);
        }elseif(isset($arr['code'])){
            exit('登录接口返回：'.$arr['msg']);
        }
    }
}