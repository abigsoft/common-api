<?php

namespace app\admin\controller;

use app\common\model\ConfigModel;
use app\exception\ParamException;

class Config extends Base
{
    //系统配置
    function index(){
        if (!$this->request->isPost()){
            $info = ConfigModel::column('data','name');
            $this->view->assign('info',$info);
            return view('index');
        }else{
            $data = $this->request->post();
            $info = ConfigModel::column('data','name');
            foreach ($data as $key => $value) {
                if(array_key_exists($key,$info)){
                    ConfigModel::where(['name'=>$key])->update(['data'=>$value]);
                }
            }
            return $this->ajaxReturn($this->successCode,'修改成功');
        }
    }

    //修改密码
    public function password(){
        if (!$this->request->isPost()){
            return view('password');
        }else{
            $account = $this->request->post('account','');
            $password = $this->request->post('password','');
            if(!$account){
                throw new ParamException('请输入账号');
            }

            if(!$password){
                throw new ParamException('请输入密码');
            }

            $secret = buildPass($account . buildPass($password));

            ConfigModel::where('name','password')->update([
                'data'=>$secret,
            ]);
            return $this->ajaxReturn($this->successCode,'修改成功');
        }
    }

    function clear(){
        $dir = app()->getRootPath().'/runtime';
        try{
            deldir($dir);
        }catch(\Exception $e){
            $this->error($e->getMessage());
        }
        $this->success('缓存清理成功');
    }
}