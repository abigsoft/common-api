<?php

namespace app\user\controller;

use app\common\model\MemberModel;
use app\exception\ParamException;
use app\user\validate\MemberValidate;
use think\exception\ValidateException;

class Config extends Base
{
    public function password(){
        if (!$this->request->isPost()){
            return view('password');
        }
        $password = $this->request->post('password','');
        if(!$password){
            throw new ParamException('请输入密码');
        }
        try {
            validate(MemberValidate::class)->scene('password')->check(['password'=>$password]);
            $data['password'] = buildPass($password);
            MemberModel::where('id', $this->member_id)->update($data);
        } catch (ValidateException $e) {
            throw new ParamException($e->getError());
        } catch (\Exception $e) {
            throw new ParamException($e->getMessage());
        }
        return $this->ajaxReturn($this->successCode,'修改成功');
    }
}