<?php

namespace app\common\service;

use app\common\model\ConfigModel;
use app\common\model\PhoneCodeLogModel;

class SmsServer extends BaseService
{
    public static function send($phone,$type,$param){
        $config = ConfigModel::where('cate','sms')
            ->select()
            ->column('data', 'name');
        $data = [];
        if($type == 1){
            $data = [
                $config['sms_temp_param_key'] => $param,
            ];
        }
        switch ($config['sms_type']){
            //腾讯云短信
            case 1:
                $res = \org\sms\Tencent::send($config,$phone,$data);
                if(!isset($res['SendStatusSet'])){
                    return self::ajaxError('调用错误');
                }
                if(count($res['SendStatusSet'])==0){
                    return self::ajaxError('调用错误');
                }
                if($res['SendStatusSet'][0]['Code'] != 'Ok'){
                    return self::ajaxError($res['SendStatusSet'][0]['Message']);
                }
                return true;
            //阿里云短信
            case 2:
                $res = \org\sms\Ali::send($config,$phone,json_encode($data));
                if(!isset($res->code)){
                    return self::ajaxError('调用错误');
                }
                if($res->code != 'OK'){
                    return self::ajaxError($res->message);
                }
                return true;
        }
        return true;
    }

    public static function checkCode($msg_id,$type,$phone,$code){
        $last = PhoneCodeLogModel::where('phone',$phone)->where('type',$type)->where('id',$msg_id)->find();
        if(!$last){
            return "请先发送验证码";
        }
        if(time() - strtotime($last['created_at']) > 900){
            return '验证码已过期';
        }
        if($last['count'] >= config('my.sms_limit_check')){
            return "验证错误次数太多，该验证码已失效";
        }
        if($last['status'] != 0){
            return "验证码已失效";
        }
        if($last['code'] != $code){
            PhoneCodeLogModel::where('id',$msg_id)->inc('count')->update();
            return "验证码有误";
        }
        //PhoneCodeLogModel::where('id',$msg_id)->update(['status'=>1]);
        return true;
    }

    public static function commit($msg_id){
        PhoneCodeLogModel::where('id',$msg_id)->update(['status'=>1]);
        return true;
    }
}