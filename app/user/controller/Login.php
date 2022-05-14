<?php

namespace app\user\controller;

use app\BaseController;
use app\common\model\ConfigModel;
use app\common\model\MemberModel;
use app\user\service\LoginService;
use app\user\validate\MemberValidate;
use think\exception\ValidateException;

class Login extends Base
{

    //用户登录
    public function index()
    {
        if (!$this->request->isPost()) {
            return view('login');
        } else {
            $data = $this->request->only([
                'account' => '',
                'password' => '',
                'verify' => '',
            ], 'post', null);
            if (!captcha_check($data['verify'])) {
                throw new ValidateException('验证码错误');
            }
            $info = MemberModel::where('account',$data['account'])->find();
            if (!$info || $info['password'] != buildPass($data['password'])) {
                throw new ValidateException("请检查用户名或者密码");
            }
            if($info['status'] != 1){
                throw new ValidateException("账户已被禁用");
            }
            session('member_id', $info['id']);
            return $this->ajaxReturn($this->successCode,'登录成功');
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
        session('member_id', null);
        return $this->redirect(url('user/login/index'));
    }

    function register(){
        if(!$this->request->isAjax()){
            return view('register');
        }
        if(!$this->request->post('is_agree',0,null)){
            throw new ValidateException('请先同意注册协议');
        }
        $data = $this->request->only([
            'account' => '',
            'password' => '',
            'verify' => '',
        ], 'post', null);
        if (!captcha_check($data['verify'])) {
            throw new ValidateException('验证码错误');
        }

        try{
            $data['status'] = 1;
            $data['wx_id'] = $data['qq_id'] = '';
            validate(MemberValidate::class)->scene('create')->check($data);
            $data['password'] = buildPass($data['password']);
            $res = MemberModel::create($data);
        }catch(ValidateException $e){
            throw new ValidateException ($e->getError());
        }catch(\Exception $e){
            abort(500,$e->getMessage());
        }
        if(!$res){
            throw new ValidateException('系统错误');
        }
        return $this->ajaxReturn($this->successCode,'注册成功');
    }

    public function qq(){
        $res = LoginService::login('qq');
        if(isset($res['code']) && $res['code']==0){
            $this->redirect($res['url']);
        }elseif(isset($arr['code'])){
            exit('登录接口返回：'.$arr['msg']);
        }

    }

    public function wx(){
        $res = LoginService::login('wx');
        if(isset($res['code']) && $res['code']==0){
            $this->redirect($res['url']);
        }elseif(isset($arr['code'])){
            exit('登录接口返回：'.$arr['msg']);
        }

    }
}