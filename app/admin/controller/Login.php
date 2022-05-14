<?php

namespace app\admin\controller;

use app\BaseController;
use app\common\model\AdminModel;
use app\common\model\AdminRoleAccessModel;
use app\common\model\ConfigModel;
use think\exception\ValidateException;

class Login extends BaseController
{

    public function initialize() {
        buildConfig();

    }
    //用户登录
    public function index()
    {
        if (!$this->request->isPost()) {
            return view('index');
        } else {
            $data = $this->request->only([
                'account' => '',
                'password' => '',
                'verify' => '',
            ], 'post', null);
            if (!captcha_check($data['verify'])) {
                throw new ValidateException('验证码错误');
            }
            $secret = buildPass($data['account'] . buildPass($data['password']));
            $info = ConfigModel::where('data',$secret)
                ->where('name','password')
                ->find();
            if (!$info) {
                throw new ValidateException("请检查用户名或者密码".$secret);
            }
            session('admin', 1);
            $this->success('登录成功', url('admin/index/index'));
        }
    }

    //验证码
    public function verify()
    {
        ob_clean();
        return captcha();
    }

    //退出
    public function logout()
    {
        session('admin', null);
        return redirect(url('admin/login/index'));
    }

}
